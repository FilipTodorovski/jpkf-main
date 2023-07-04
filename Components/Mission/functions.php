<?php

namespace Flynt\Components\Mission;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-mission',
            'title'             => __('Mission'),
            'description'       => __('Mission Section'),
            'render_callback'   => 'Flynt\Components\Mission\missionFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'mission'],
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

function missionFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/Mission/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $image = get_field('image');
        $pre_title = get_field('pre_title');
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');

        Timber::render('index.twig', [
            'image' => $image,
            'pre_title' => $pre_title,
            'title' => $title,
            'content' => $content,
            'link' => $link,
        ]);
    }
}
