<?php
$thumbnail = get_theme_file_uri( '/includes/assets/images/no-image.png' ); 
if($image = get_the_post_thumbnail_url(get_the_ID(), 'medium'))
{
    $thumbnail = $image;
}
?>
<div class="col-4">
    <article class="casino article">
        <div class="m-wrap">
            <a href="<?php the_permalink();?>" class="m-img m-blog-img lazy-bg" data-src="<?php echo $thumbnail;?>">
                <span class="visually-hidden"><?php the_title(); ?></span>
            </a>
        </div>
        <div class="b-excerpt">
            <h2><a href="<?php the_permalink();?>" class="b-title"><?php the_title();?></a></h2>
            <p class="b-excerpt-prev"><?php echo get_the_excerpt();?></p>
            <div class="ft-center"><a href="<?php the_permalink();?>" class="btn btn-primary d-block"><?php _e( 'Read more', 'wp-lighthouse' ); ?> &rsaquo;</a></div>
        </div>
    </article>
</div>