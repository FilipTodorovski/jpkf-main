<?php

namespace Flynt\Components\KFund;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-k-fund',
            'title'             => __('K Fund'),
            'description'       => __('K Fund Section'),
            'render_callback'   => 'Flynt\Components\KFund\kFundFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'fund'],
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

function kFundFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/KFund/Assets/example.png');

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
