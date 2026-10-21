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
});
