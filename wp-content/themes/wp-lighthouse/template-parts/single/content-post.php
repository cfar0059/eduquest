<?php
/**
 * Single blog post template
 * 
 * @package WP_Lighthouse
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $page;

?>
<div class="row">
    <div class="col-1">
        <a href="#" onclick="historyBackWFallback('<?php echo home_url('/blog');?>');" class="btn btn-outline-secondary">&laquo;</a>
    </div>
    <div class="col-8">

        <article <?php post_class( 'mb-5' ); ?> id="post-<?php the_ID(); ?>">

            <h1 class="mt-0"><?php the_title();?></h1>
            <?php if( $excerpt = get_the_excerpt() ) { echo '<p>' . $excerpt . '</p>'; } ?>
				
            <?php if( $page == 1 ) { if( has_post_thumbnail() ) { ?>
            <div class="m-wrap mt-3 mb-5">
                <div class="m-img b-img lazy-bg" data-src="<?php echo get_the_post_thumbnail_url();?>">
                    <span class="visually-hidden">
                    <?php 
                    if( $caption = get_the_post_thumbnail_caption() ) 
                    { 
                        echo $caption;
                    } 
                    else 
                    {
                        sprintf( '%s header image', array( the_title() ) );
                    } 
                    ?>
                    </span>
                </div>
            </div>
            <?php } } ?>

            <?php the_content();?>

            <?php wp_lighthouse_wp_link_pages(); ?>

        </article>

    </div>

    <div class="col-3">
        [ads]
    </div>
</div>

<section class="section">
    <h2><?php _e( 'Related blog posts', 'wp-lighthouse' ); ?></h2>
</section>

<?php
$postCats = wp_get_post_categories( get_the_ID(), array('fields' => 'ids') );
$relPosts = new WP_Query();
$relPosts->query(array(
    'category__in' => $postCats,
    'post_type' => 'post',
    'post_status' => 'publish',
    'post__not_in' => array( get_the_ID() ),
    'posts_per_page' => 3,
    'cache_results'  => true
));

if($relPosts->have_posts()) {

    echo '<div class="row">';

    while ($relPosts->have_posts()) {
        
        $relPosts->the_post();

        get_template_part( 'template-parts/loops/content', 'post' );
    }

    echo '</div>';

    wp_reset_postdata();
}

?>


<section class="section">
    <h2><?php _e( 'You may like these', 'wp-lighthouse' ); ?></h2>
</section>
