<?php

namespace Flynt\Components\AboutUsHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-about-us-hero',
            'title'             => __('About Us Hero'),
            'description'       => __('About Us Hero Section'),
            'render_callback'   => 'Flynt\Components\AboutUsHero\aboutUsHeroFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'hero'],
            'example'           => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        'is_example' => true
                    ]
                ]
            ]
        ]);
    }
});

function aboutUsHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/AboutUsHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $image = get_field('image');
        $hero_title = get_field('hero_title');
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');

        Timber::render('index.twig', [
            'image' => $image,
            'hero_title' => $hero_title,
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
        ]);
    }
}
