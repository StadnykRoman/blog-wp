<?php

require_once('../../wp-load.php');

/**
 * Deletes attachments of a post.
 *
 * @param int $post_id The ID of the post whose attachments should be deleted.
 */
function delete_post_attachments($postId) {
    $attachments = get_attached_media('', $postId);
    foreach ($attachments as $attachment) {
        wp_delete_attachment($attachment->ID, true);
    }
}

$args = array(
    'date_query' => array(
        array(
            'before' => date('Y-m-d', strtotime('-1 year')), 
            'inclusive' => true,
        ),
    ),
    'post_type' => 'post',
    'posts_per_page' => -1,
);

$query = new WP_Query($args);


if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $postId = get_the_ID();
        delete_post_attachments($postId);
        wp_delete_post($postId, true); 
    }
    wp_reset_postdata();
}

echo 'Script executed successfully.';
