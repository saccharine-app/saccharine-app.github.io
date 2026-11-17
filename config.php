<?php

use Illuminate\Support\Str;

return [
    'production' => false,
    'baseUrl' => '',
    // 'baseUrl' => 'https://saccharine.app',
    'title' => 'Saccharine',
    'baseName' => 'Saccharine',
    'description' => 'Open-source Modular Operational Infrastructure for Laravel',
    'ogImage' => '/assets/images/bpmn-index.png',
    'ogImageAlt' => 'A process orchestrator for Laravel that turns flowcharts into durable background queue jobs.',
    'ogType' => 'website',
    
    'collections' => [
        // BPMN Documentation Collection
        'bpmn_docs' => [
            // Look for files in source/_bpmn_docs/
            // Strips leading "01_", "02_", etc. from the generated URL slug
            'path' => function ($page) {
                $slug = preg_replace('/^\d+_/', '', $page->getFilename());
                return 'bpmn/docs/' . $slug;
            },
            'sort' => 'order',
            // Default layout wrapper for every markdown doc
            'extends' => '_layouts.docs',
            'section' => 'docs_content',
        ],
        // Blog Posts Collection
        'posts' => [
            'author' => 'Saccharine Team',
            'path' => 'blog/{date|Y-m}/{filename}',
            'sort' => '-date',
            'extends' => '_layouts.post',
            'section' => 'post_content',
        ],
        //Categories Collection
        'categories' => [
            'path' => 'blog/categories/{filename}',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return in_array($page->getFilename(), $post->categories ?? []);
                });
            },
            'extends' => '_layouts.category',
            'section' => 'category_content',
        ],
        // Tags Collection
        'tags' => [
            'path' => 'blog/tags/{filename}',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return in_array($page->getFilename(), $post->tags ?? []);
                });
            },
            'extends' => '_layouts.tag',
            'section' => 'tag_content',
        ],
    ],
    // Helper functions accessible anywhere via $page->...
    'isActiveDoc' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
];
