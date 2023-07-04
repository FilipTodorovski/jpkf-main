<?php

namespace Flynt\Components\SupportSlider;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-support-slider',
            'title'             => __('Support Slider'),
            'description'       => __('Support Slider Section'),
            'render_callback'   => 'Flynt\Components\SupportSlider\supportSliderFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'slider'],
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

function supportSliderFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/SupportSlider/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $slider_list = get_field('slider_list');
        $link = get_field('link');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'slider_list' => $slider_list,
            'link' => $link,
        ]);
    }
}
