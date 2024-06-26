
<article class="item">
    <?php
        $thumbnailUrl = wpc_get_post_thumbnail_url( get_the_ID(), array( 300, 300) ); 

        echo '<a href="'.get_permalink().'">';
        echo '<img src="'.$thumbnailUrl.'" alt="'.get_the_title().'">';
        
        echo '<span class="title">'.get_the_title().'</span>';
        echo '</a>';
    ?>
</article>