<?php

namespace Flynt\Components\FellowHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-fellow-hero',
            'title'             => __('Fellow Hero'),
            'description'       => __('Fellow Hero Section'),
            'render_callback'   => 'Flynt\Components\FellowHero\fellowHeroFunc',
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

function fellowHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/FellowHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $image = get_field('image');
        $hero_title = get_field('hero_title');
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');

        Timber::render('index.twig', [
            'image' => $image,
            'hero_title' => $hero_title,
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'link' => $link,
        ]);
    }
}
