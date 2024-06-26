<?php
get_header();

get_template_part( 'template-parts/category', 'name', ['cat-name' => 'Latest news']);

echo '<section class="latest-articles articles-container">';

while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/news', 'article');
endwhile;

echo '</section>';

$args = [  
    'hide_empty' => 1,    
    'exclude'    => [LATEST_NEWS_CAT_ID]
]; 

$categories = get_categories($args);
foreach ($categories as $category) {
    $catId = $category->term_id;
    
    $query_args = [
        'cat'            => $catId,
        'posts_per_page' => 4
    ];
    
    $query = new WP_Query($query_args);
    
    if ($query->have_posts()) {
        get_template_part( 'template-parts/category', 'name', ['cat-name' => $category->name]);

        echo '<section class="articles-container">';

        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/news', 'article');
        }

        echo '</section>';
    }
    
    wp_reset_postdata();
}


get_footer();