<?php

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    set_post_thumbnail_size( 390, 390, true );
    set_post_thumbnail_size( 288, 288, true );
}

/**
 * Modify the main query on the home page to display the latest news.
 *
 * This function sets the query to show posts from a specific category
 * and limits the number of posts displayed to 6. It also orders the posts
 * by their publication date.
 *
 * @param WP_Query $query The main query instance.
 */
function wpc_news_query( $query ) {
    if ( !$query->is_home() || !$query->is_main_query() ) {
        return;
    }

    $query->set( 'cat', LATEST_NEWS_CAT_ID );
    $query->set('posts_per_page', 9);
    $query->set('orderby',     'post_date');
}
add_action( 'pre_get_posts', 'wpc_news_query' );

/**
 * Retrieves the post thumbnail URL or returns a "not found" image URL.
 *
 * @param int $id The ID of the post.
 * @param string|array $args Optional. Additional arguments for retrieving the thumbnail.
 * @return string The post thumbnail URL or a "not found" image URL.
 */
function wpc_get_post_thumbnail_url($id, $args = '') {
    $thumbnailUrl = get_the_post_thumbnail_url( $id, $args ); 

    if($thumbnailUrl) {
        return $thumbnailUrl;
    }

    return IMAGES_URI.'/not-found.webp';
}