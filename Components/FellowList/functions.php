<?php

namespace Flynt\Components\FellowList;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-fellow-list',
            'title'             => __('Fellow List'),
            'description'       => __('Fellow List Section'),
            'render_callback'   => 'Flynt\Components\FellowList\fellowListFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'fellow', 'list'],
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

function fellowListFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/FellowList/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $fellow_list = get_field('fellow_list');

        Timber::render('index.twig', [
            'title' => $title,
            'fellow_list' => $fellow_list,
        ]);
    }
}
