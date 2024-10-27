<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Lighthouse
 */

?>
<div class="last-updated">
	<div class="container">
		<strong><?php _e( 'Last Updated', 'wp-lighthouse');?>:</strong> <?php echo date('jS F Y');?>
	</div>
</div>
<section class="footer">
    <div class="container">
        <?php 
		if ( is_active_sidebar( 'pre-footer' ) ) { 
			echo '<div class="mb-4">'; 
			dynamic_sidebar( 'pre-footer' );
			echo '</div>'; 
		}
		?>

        <div class="footer-nav">
			<div class="row">
				<div class="col-4 col-6-sm">
					<h3><?php _e( 'Popular articles', 'wp-lighthouse' ); ?></h3>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-col-1',
						'menu_id'        => false,
						'menu_class'     => '',
						'depth'          => 1,
					));
					?>
				</div>
				<div class="col-4 col-6-sm">
					<h3><?php _e( 'Top casinos', 'wp-lighthouse' ); ?></h3>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-col-2',
						'menu_id'        => false,
						'menu_class'     => '',
						'depth'          => 1,
					));
					?>
				</div>
				<div class="col-4">
					<div class="footer-about">
						<div>
							<h3><?php _e( sprintf( 'About %s', get_bloginfo( 'name' ) ), 'wp-lighthouse' ); ?></h3>
							<ul>
								<li><a href="/"><?php _e( sprintf( 'About %s', get_bloginfo( 'name' ) ), 'wp-lighthouse' ); ?></a></li>
								<li><a href="/"><?php _e( 'Terms & Privacy Policy', 'wp-lighthouse' ); ?></a></li>
								<li><a href="/"><?php _e( 'Sitemap', 'wp-lighthouse' ); ?></a></li>
							</ul>
						</div>

						<div class="footer-contact">
							<h3><?php _e( 'Contact us', 'wp-lighthouse' ); ?></h3>
							<ul>
								<li><a href="/contact-us"><?php _e( 'Contact us', 'wp-lighthouse' ); ?></a></li>
								<li><a href="mailto:"><?php _e( 'Email us', 'wp-lighthouse' ); ?></a></li>
							</ul>
							<p>
								<?php _e( 'RakeTech Group<br>
								Kurta Konrada 8<br>
								Liben-Praha 9<br>
								Czech Republic', 'wp-lighthouse' );?>
							</p>
						</div>
					</div>
				</div>
			</div>
            
            
            <div class="clearfix"></div>
        </div>

        <?php 
		if ( is_active_sidebar( 'post-footer' ) ) { 
			echo '<div class="post-footer-nav-widget">'; 
			dynamic_sidebar( 'post-footer' );
			echo '</div>'; 
		}
		?>

		<div class="text-center">&copy; <?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?></div>

    </div>
</section>

<button onclick="topFunction();" id="btn-scroll-top" class="box-shadow" title="<?php esc_attr( 'Go to top', 'wp-lighthouse' ) ;?>" style="display: none;">&#8673;</button>

<?php if(empty($_COOKIE['_privacy_agreed'])) { ?>
<div id="privacy-footer" class="privacy-footer" style="display: none;">
	<div class="privacy-content">
		<div><?php _e( 'This website uses cookies to improve the experience for you as a visitor', 'wp-lighthouse' );?> &rsaquo; <a href="/terms-privacy-policy" class="text-white fw-bold"><?php _e( 'Read our privacy policy', 'wp-lighthouse' );?></a></div>
		<button type="button" id="btn-privacy-agree" class="btn btn-success fw-bold f-nowrap"><?php _e( 'I agree', 'wp-lighthouse' );?></button>
	</div>
</div>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
<?php
if ( WP_DEBUG && current_user_can( 'administrator' ) ) 
{
    if( empty($wpdb) ) { global $wpdb; }
    echo "<a href=\"javascript:void(0);\" onclick=\"jQuery('#sql-debug').show();\">+ Show SQL Queries</a><pre id=\"sql-debug\" style=\"display:none;\">" . print_r( $wpdb->queries, true ) . "</pre>";
}
?>