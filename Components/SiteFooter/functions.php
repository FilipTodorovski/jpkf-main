<?php

namespace Flynt\Components\SiteFooter;

use Timber;
use Flynt\Utils\Options;
use Flynt\Utils\Asset;

add_action('init', function () {
    register_nav_menus([
        'footer_menu' => __('Footer Menu', 'flynt'),
    ]);
});

add_filter('Flynt/addComponentData?name=SiteFooter', function ($data) {
    $data['footer_menu'] = new Timber\Menu('footer_menu');

    $data['linkedin_url'] = Options::getGlobal('Footer Settings', 'linkedin_url');

    $data['logo'] = [
        'src' => Asset::requireUrl('Components/SiteHeader/Assets/logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    return $data;
});
