<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Lighthouse
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="description" content="Most SEO friendly theme on the planet!">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
// WordPress 5.2 wp_body_open implementation
if ( function_exists( 'wp_body_open' ) ) 
{
	wp_body_open();
} else 
{    
	do_action( 'wp_body_open' );
}
?>
<a class="skip-link visually-hidden-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'wp-lighthouse' ); ?></a>
<header id="top-nav">
	<nav id="main-nav">
		<div class="container main-nav">
			<div class="d-flex flex15 flex-align-center">
				<a href="<?php echo esc_url( home_url( '/' ));?>" class="logo" title="<?php echo esc_attr( get_bloginfo( 'name' ) );?>"></a>
				<div class="main-menu">
					<div class="walker">
						<?php
							wp_nav_menu(array(
								'theme_location'    => 'primary',
								'container'       => '',
								'container_id'    => '',
								'container_class' => '',
								'menu_id'         => false,
								'menu_class'      => '',
								'depth'           => 3,
								'items_wrap' 	  => '<ul id="primary-menu" role="menu">%3$s</ul>',
								'fallback_cb'     => 'bootstrap_5_wp_nav_menu_walker::fallback',
								'walker'          => new wp_lighthouse_nav_menu_walker()
							));
						?>
					</div>
				</div>
			</div>
			
			<div class="d-flex flex-end flex15 flex-align-center">
				<div class="search-btn search-icon" role="button" aria-label="<?php _e( 'search site', 'wp-lighthouse' );?>">
					<span class="visually-hidden"><?php _e( 'search site', 'wp-lighthouse' );?></span>
				</div>
					
				<div class="hamburger" role="button" aria-label="Sub Menu">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			
		</div>
	</nav>
	<div id="sub-menu" class="d-flex flex-between flex-wrap flex-align-center" style="display: none;">
		<div class="container">
			<ul id="mobile-primary-menu"></ul>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'sub-menu',
				'menu_id'        => 'wt-bc',
				'menu_class'     => 'wt-bc',
				'depth'          => 1,
			));
			?>
		</div>
	</div>
</header>
<div id="top-msg"></div>