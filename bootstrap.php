<?php

use Illuminate\Container\Container;
use TightenCo\Jigsaw\Events\EventBus;
use TightenCo\Jigsaw\Jigsaw;

/** @var Container $container */
/** @var EventBus $events */

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

use Spatie\ShikiPhp\Shiki;

/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->afterBuild(function (Jigsaw $jigsaw) {
    $destination = $jigsaw->getDestinationPath();
    
    $directory = new RecursiveDirectoryIterator($destination);
    $iterator = new RecursiveIteratorIterator($directory);
    $files = new RegexIterator($iterator, '/^.+\.html$/i', RecursiveRegexIterator::GET_MATCH);

    foreach ($files as $file) {
        $filePath = $file[0]; // RegexIterator returns an array, pick the string path
        $content = file_get_contents($filePath);

        // Convert Mermaid blocks into <div class="mermaid"> before Shiki touches them
        $content = preg_replace_callback(
            '/<pre><code class="language-mermaid">(.*?)<\/code><\/pre>/s',
            fn ($matches) => '<div class="mermaid my-8 flex justify-center">' . html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8') . '</div>',
            $content
        );
        
        // Highlight all remaining code blocks with Shiki
        // This targets <pre><code class="language-xyz">...</code></pre> blocks 
        // that Jigsaw spits out during the build phase.
        $content = preg_replace_callback('/<pre><code class="language-([A-Za-z0-9_-]+)">(.*?)<\/code><\/pre>/s', function ($matches) {
            $language = $matches[1];
            // Safely decode entities so Shiki evaluates the raw syntax string
            $code = html_entity_decode($matches[2], ENT_QUOTES, 'UTF-8');
            $theme = 'github-dark';
            
            try {
                // Shiki natively outputs a perfect <pre class="shiki">...</pre> element.
                // We return it as-is without re-wrapping it.
                return Shiki::highlight($code, $language, $theme);
            } catch (\Exception $e) {
                // If it fails (e.g. language not found), fall back safely to the raw markdown block
                return $matches[0];
            }
        }, $content);

        file_put_contents($filePath, $content);
    }

    // Auto-generate sitemap.xml from all built pages
    $baseUrl = rtrim($jigsaw->getConfig('baseUrl'), '/');
    $excludedPrefixes = ['/assets', '/blog/categories', '/blog/tags', '/favicon'];
    $excludedExact = ['/bpmn/docs', '/404', '/CNAME', '/robots', '/sitemap'];

    $urls = [];

    foreach ($jigsaw->getPages() as $page) {
        $rawPath = $page->getPath();

        // Skip non-HTML files (CNAME, favicon.png, robots.txt, feed.xml, images, CSS/JS)
        if ($rawPath !== '' && pathinfo($rawPath, PATHINFO_EXTENSION) !== '') {
            continue;
        }

        $path = '/' . trim($rawPath, '/');
        $path = $path === '/' ? '/' : rtrim($path, '/');

        if (in_array($path, $excludedExact, true)) {
            continue;
        }

        foreach ($excludedPrefixes as $prefix) {
            if (str_starts_with($path, $prefix)) {
                continue 2;
            }
        }

        // Also skip paginated blog subpages like /blog/2, /blog/3 if present
        if (preg_match('#^/blog/\d+$#', $path)) {
            continue;
        }

        $loc = $path === '/' ? $baseUrl . '/' : $baseUrl . $path;

        // Resolve <lastmod> from front matter (or latest post date for /blog)
        $rawDate = $page->updated ?? $page->date ?? null;
        if ($path === '/blog' && ! $rawDate) {
            $latestPost = $jigsaw->getCollection('posts')->first();
            $rawDate = $latestPost ? ($latestPost->updated ?? $latestPost->date ?? null) : null;
        }

        $lastmod = null;
        if ($rawDate) {
            $timestamp = is_numeric($rawDate) ? (int) $rawDate : strtotime((string) $rawDate);
            $lastmod = $timestamp ? date('Y-m-d', $timestamp) : null;
        }

        $entry = "    <url>\n        <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        if ($lastmod) {
            $entry .= "        <lastmod>{$lastmod}</lastmod>\n";
        }
        $entry .= "    </url>";

        $urls[] = $entry;
    }

    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
         . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n"
         . implode("\n", $urls) . "\n"
         . "</urlset>\n";

    file_put_contents($destination . '/sitemap.xml', $xml);
});
