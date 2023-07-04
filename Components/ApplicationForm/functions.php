<?php

namespace Flynt\Components\ApplicationForm;

use Timber\Timber;
use Flynt\Utils\Asset;

add_action('acf/init', function () {
    
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        // register a test block.
        acf_register_block_type([
            'name'              => 'jpkf-application-form',
            'title'             => __('Application Form'),
            'description'       => __('Application Form Section'),
            'render_callback'   => 'Flynt\Components\ApplicationForm\applicationFormFunc',
            'category'          => 'jpkf',
            'icon'              => 'admin-comments',
            'keywords'          => ['jpkf', 'application', 'form'],
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

function applicationFormFunc($block, $content = '', $is_preview = false, $post_id = 0)
{
    $is_example = get_field('is_example');

    if (!empty($is_example) && $is_example) {
        $screenshot = Asset::requireUrl('Components/ApplicationForm/Assets/example.png');

        echo '<img src="' . $screenshot . '" />';
    } else {
        $hero_title = get_field('hero_title');
        $content = get_field('content');
        $gravity_form_shortcode = get_field('gravity_form_shortcode');

        Timber::render('index.twig', [
            'hero_title' => $hero_title,
            'content' => $content,
            'gravity_form_shortcode' => $gravity_form_shortcode,
        ]);
    }
}

// file upload field html customize for application form
// 1 is application from gravity form id
add_filter('gform_field_content_1', function ($content, $field, $value, $lead_id, $form_id) {
    if ($field->type === 'fileupload') {
        // echo '<pre>';
        // print_r($field);
        // echo '</pre>';
        // change label content to upload
        $content = preg_replace('/>.*<\/label>/i', '>Upload</label>', $content);

        $content = "
            <div class=\"jpkf-app-form__gform-file-row\">
                <div class=\"jpkf-app-form__gform-file-label-col\">{$field->label}</div>
                <div class=\"jpkf-app-form__gform-file-input-col\">
                    <div class=\"jpkf-app-form__gform-file-input-row\">
                        <div class=\"jpkf-app-form__gform-file-input-name\"></div>
                        <div class=\"jpkf-app-form__gform-file-input-field\">
                            {$content}
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    return $content;
}, 10, 5);
