<?php

namespace Flynt\Components\ContactForm;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-contact-form',
            'title'             => __('Contact Form'),
            'description'       => __('Contact Form Section'),
            'render_callback'   => 'Flynt\Components\ContactForm\contactFormFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'contact', 'form'],
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

function contactFormFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ContactForm/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $image = get_field('image');
        $hero_title = get_field('hero_title');
        $gravity_form_shortcode = get_field('gravity_form_shortcode');

        Timber::render('index.twig', [
            'image' => $image,
            'hero_title' => $hero_title,
            'gravity_form_shortcode' => $gravity_form_shortcode,
        ]);
    }
}
