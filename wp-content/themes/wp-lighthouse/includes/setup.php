<?php
/**
 * WP Tube theme setup function
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Lighthouse
 */

 /**
  * Theme Setup functions
  */
add_action( 'after_setup_theme', 'wp_lighthouse_theme_setup' );
function wp_lighthouse_theme_setup() {

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'widgets' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'menus' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    flush_rewrite_rules();

    register_nav_menu( 'primary', __( 'Primary navigation menu', 'wp-lighthouse' ) );
    register_nav_menu( 'sub-menu', __( 'Sub navigation menu', 'wp-lighthouse' ) );
    register_nav_menu( 'footer-col-1', __( 'Footer menu - Column 1', 'wp-lighthouse' ) );
    register_nav_menu( 'footer-col-2', __( 'Footer menu - Column 2', 'wp-lighthouse' ) );
}

/**
 * Flush rewrite after theme switch
 */
add_action('after_switch_theme', 'wp_lighthouse_rewrite_flush');
function wp_lighthouse_rewrite_flush() {

    flush_rewrite_rules();
}

add_filter( 'rest_authentication_errors', 'wp_lighthouse_disable_public_api');
function wp_lighthouse_disable_public_api( $result ) {

    if ( ! empty( $result ) ) {
    
		return $result;
    }
    
	if ( ! is_user_logged_in() ) {
    
		return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    
	return $result;
}

add_filter( 'get_the_archive_title', 'wp_lighthouse_archives_titles' );
function wp_lighthouse_archives_titles( $title ) {

	if ( is_category() ) {
		
		$title = single_cat_title( '', false );
	} 
	elseif ( is_tag() ) {
		
		$title = single_tag_title( '', false );
	} 
	elseif ( is_author() ) {
		
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	} 
	elseif ( is_tax() ) { //for custom post types
		
		$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
	} 
	elseif ( is_post_type_archive() ) {
		
		$title = post_type_archive_title( __( 'Latest ', 'wp-lighthouse' ), false );
	}

	return $title;
}

//REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
    wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );