<?php

namespace Flynt\Components\FellowContent;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-fellow-content',
            'title'             => __('Fellow Content'),
            'description'       => __('Fellow Content Section'),
            'render_callback'   => 'Flynt\Components\FellowContent\fellowContentFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'fellow', 'content'],
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

function fellowContentFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/FellowContent/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $title = get_field('title');
        $content = get_field('content');
        $link = get_field('link');

        Timber::render('index.twig', [
            'title' => $title,
            'content' => $content,
            'link' => $link,
        ]);
    }
}
