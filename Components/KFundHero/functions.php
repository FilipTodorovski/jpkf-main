<?php

namespace Flynt\Components\KFundHero;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-k-fund-hero',
            'title'             => __('K Fund Hero'),
            'description'       => __('K Fund Hero Section'),
            'render_callback'   => 'Flynt\Components\KFundHero\kFundHeroFunc',
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

function kFundHeroFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/KFundHero/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $image = get_field('image');
        $hero_title = get_field('hero_title');
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $bottom_image = get_field('bottom_image');

        Timber::render('index.twig', [
            'image' => $image,
            'hero_title' => $hero_title,
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'bottom_image' => $bottom_image,
        ]);
    }
}
