<?php
get_header();

$cat = get_the_category();
get_template_part( 'template-parts/category', 'name', ['cat-name' => $cat[0]->name]);

echo '<section class="articles-container">';

while ( have_posts() ) : the_post();
    get_template_part( 'template-parts/news', 'article');
endwhile;

echo '</section>';

the_posts_pagination( array(
    'mid_size'  => 2,
    'prev_text' => 'Previous',
    'next_text' => 'Next',
) );

get_footer();