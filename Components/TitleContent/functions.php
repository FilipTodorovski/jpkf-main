<?php

namespace Flynt\Components\TitleContent;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-title-content',
            'title'             => __('Title Content'),
            'description'       => __('Title Content Section'),
            'render_callback'   => 'Flynt\Components\TitleContent\titleContentFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'title', 'content'],
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

function titleContentFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/TitleContent/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $signers = get_field('signers');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'signers' => $signers,
        ]);
    }
}
