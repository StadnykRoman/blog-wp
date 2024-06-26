<?php
    $thumbnailUrl = wpc_get_post_thumbnail_url( get_the_ID() ); 
?>
<div class="single-thumbnail">
    <img src="<?php echo $thumbnailUrl; ?>" alt="<?php echo get_the_title(); ?>">
    <div class="overlay"></div>
    <div class="post-title">
        <?php echo get_the_title(); ?>
    </div>
</div>