<?php
require_once('../../wp-load.php');

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

define('NEWS_API_KEY', 'b0e49d572bb44549ac20ca8ef1d65e27');

$url = 'https://newsapi.org/v2/top-headlines?country=us&apiKey=' . NEWS_API_KEY;

$args = array(
    'headers' => array(
        'User-Agent' => 'Mozilla/5.0'
    )
);

$response = wp_remote_get($url, $args);

if (is_wp_error($response)) {
    error_log('Error fetching news: ' . $response->get_error_message());
    return;
}

$body = wp_remote_retrieve_body($response);

$data = json_decode($body, true);

if (!isset($data['articles']) || $data['status'] !== 'ok') {
    error_log('No articles found');
    return;
}

$allCategoryIds = [1, 2, 3, 4, 5];

foreach ($data['articles'] as $article) {
    $title = $article['title'];
    $excerpt = $article['description'] ?? '';
    $content = $article['content'] ?? '';
    $publishedAt = $article['publishedAt'];
    $author = $article['author'];
    $imageUrl = $article['urlToImage'];
    $url = $article['url'];

    $existingPost = get_posts(array(
        'meta_key' => 'news_source_url',
        'meta_value' => $url,
        'post_type' => 'post',
        'posts_per_page' => 1,
    ));

    if ($existingPost) {
        continue;
    }

    $postId = wp_insert_post(array(
        'post_title' => $title,
        'post_content' => $content,
        'post_excerpt' => $excerpt,
        'post_status' => 'publish'
    ));

    if (!is_wp_error($postId)) {
        update_post_meta($postId, 'news_source_url', $url);
        update_post_meta($postId, 'news_author', $author);
        update_post_meta($postId, 'news_published_at', $publishedAt);

        $randomCategoryId = $allCategoryIds[array_rand($allCategoryIds)];
        wp_set_post_categories($postId, [$randomCategoryId]);

        if (!empty($imageUrl)) {
            $imageId = media_sideload_image($imageUrl, $postId, null, 'id');
            if (!is_wp_error($imageId)) {
                set_post_thumbnail($postId, $imageId);
            } else {
                error_log('Error uploading image: ' . $imageId->get_error_message());
            }
        }
    } else {
        error_log('Error creating post: ' . $postId->get_error_message());
    }
}
