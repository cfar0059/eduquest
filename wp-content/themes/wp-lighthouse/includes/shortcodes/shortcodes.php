<?php
/**
 * WP Tube shortcodes inclue file
 *
 * @package WP_Lighthouse
 */

// Include relevant files
include( get_theme_file_path( '/includes/shortcodes/homepage-blog.php' ) );
include( get_theme_file_path( '/includes/shortcodes/hcaptcha.php' ) );
include( get_theme_file_path( '/includes/shortcodes/sphinx-search.php' ) );
include( get_theme_file_path( '/includes/shortcodes/wp-lighthouse-captcha.php' ) );

add_action( 'init', 'wp_lighthouse_register_shortcodes');

function wp_lighthouse_register_shortcodes() {

	add_shortcode( 'wp_lighthouse_homepage_blog', 'wp_lighthouse_homepage_blog_shortcode' );
	add_shortcode( 'wp_lighthouse_hcaptcha', 'wp_lighthouse_hcaptcha_shortcode' );
	add_shortcode( 'wp_lighthouse_sphinx_search', 'wp_lighthouse_sphinx_search_shortcode' );
	add_shortcode( 'wp_lighthouse_captcha', 'wp_lighthouse_generate_captcha_shortcode' );
 }