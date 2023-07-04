<?php

namespace Flynt\Components\InterestArea;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-interest-area',
            'title'             => __('Interest Area'),
            'description'       => __('Interest Area Section'),
            'render_callback'   => 'Flynt\Components\InterestArea\interestAreaFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'interest', 'area'],
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

function interestAreaFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/InterestArea/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $pre_title = get_field('pre_title');
        $area_list = get_field('area_list');

        Timber::render('index.twig', [
            'pre_title' => $pre_title,
            'area_list' => $area_list,
        ]);
    }
}
