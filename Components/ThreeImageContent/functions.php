<?php

namespace Flynt\Components\ThreeImageContent;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-three-image-content',
            'title'             => __('Three Image Content'),
            'description'       => __('Three Image Content Section'),
            'render_callback'   => 'Flynt\Components\ThreeImageContent\threeImageContentFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'content'],
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

function threeImageContentFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ThreeImageContent/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $header_image = get_field('header_image');
        $header_title = get_field('header_title');
        $header_content = get_field('header_content');
        $image_2 = get_field('image_2');
        $pre_title_2 = get_field('pre_title_2');
        $title_2 = get_field('title_2');
        $content_2 = get_field('content_2');
        $link_2 = get_field('link_2');
        $image_3 = get_field('image_3');
        $pre_title_3 = get_field('pre_title_3');
        $title_3 = get_field('title_3');
        $content_3 = get_field('content_3');
        $link_3 = get_field('link_3');

        Timber::render('index.twig', [
            'header_image' => $header_image,
            'header_title' => $header_title,
            'header_content' => $header_content,
            'image_2' => $image_2,
            'pre_title_2' => $pre_title_2,
            'title_2' => $title_2,
            'content_2' => $content_2,
            'link_2' => $link_2,
            'image_3' => $image_3,
            'pre_title_3' => $pre_title_3,
            'title_3' => $title_3,
            'content_3' => $content_3,
            'link_3' => $link_3,
        ]);
    }
}
