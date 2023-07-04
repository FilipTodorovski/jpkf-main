<?php

namespace Flynt\Components\PartnerSlider;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-partner-slider',
            'title'             => __('Partner Slider'),
            'description'       => __('Partner Slider Section'),
            'render_callback'   => 'Flynt\Components\PartnerSlider\partnerSliderFunc',
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

function partnerSliderFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/PartnerSlider/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $slider_list = get_field('slider_list');
        $solid_background = get_field('solid_background');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'slider_list' => $slider_list,
            'solid_background' => $solid_background
        ]);
    }
}
