<!doctype html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

<header>
    <div class="top-panel container">
        <?php
            echo get_custom_logo();
        ?>
    </div> 

    <div class="main-menu">
        <?php 
            wp_nav_menu(
                array (
                    'theme_location' => 'header',
                    'depth' => 1
                )
            ); 
        ?>
    </div>
</header>

<?php
    if(is_single()) {
        get_template_part( 'template-parts/single', 'thumbnail');
    }
?>

<div class="main-content container">
