<?php
/**
 * Template part for displaying page content in page.php
 * 
 * @package WP_Lighthouse
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
    $enable_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );
    if(!$enable_vc ) {
    ?>
    <header class="entry-header">
		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>
	</header><!-- .entry-header -->
    <?php } ?>

	<div class="entry-content">

		<?php
			
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-lighthouse' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->