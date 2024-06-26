<?php

/**
 * Register navigation menus for the theme.
 *
 * This function registers a single navigation menu called 'Header'
 * that can be used in the theme's header section.
 */
function wpc_register_menus() { 
    register_nav_menus(
        array(
            'header' => 'Header',
        )
    ); 
}
add_action( 'init', 'wpc_register_menus' );