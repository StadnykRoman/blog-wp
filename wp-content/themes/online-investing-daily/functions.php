<?php

define('LATEST_NEWS_CAT_ID', 1);
define('IMAGES_URI', get_template_directory_uri().'/assets/images');

require_once 'include/admin/settings.php';
require_once 'include/contact-form.php';
require_once 'include/menus.php';
require_once 'include/posts.php';
require_once 'include/shortcodes.php';

/**
 * Enqueue the main stylesheet for the theme.
 *
 * This function loads the main stylesheet located in the root directory
 * of the theme.
 */
function wpc_enqueue_styles() {
    wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/assets/css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpc_enqueue_styles');


function get_terms_and_conditions_url() {
    $pageId = get_option( 'wpc_terms_and_conditions_id');

    if(!$pageId) {
        return '';
    }

    return get_permalink($pageId);
}

