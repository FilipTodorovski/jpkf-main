<?php

namespace Flynt\Components\SiteHeader;

use Timber;
use Flynt\Utils\Asset;

add_action('init', function () {
    register_nav_menus([
        'header_menu' => __('Header Menu', 'flynt')
    ]);
});

add_filter('Flynt/addComponentData?name=SiteHeader', function ($data) {
    $data['header_menu'] = new Timber\Menu('header_menu');

    $data['logo'] = [
        'src' => Asset::requireUrl('Components/SiteHeader/Assets/logo.svg'),
        'alt' => get_bloginfo('name')
    ];
    
    return $data;
});
