<?php
/**
 * WP Tube functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Lighthouse
 */

 define( 'AJAX_NONCE', '0f08e1ee9ce2efdf5dd52bdf846' );
 define( 'cpt_casino_slug', 'casino' );
 define( 'ctt_games_slug', 'games' );
 if ( !defined( 'WP_POST_REVISIONS' ) ) {
 	define( 'WP_POST_REVISIONS', 3 );
 }

 // Includes
 include( get_theme_file_path( '/includes/custom-posts/custom-post-types.php' ) );
 include( get_theme_file_path( '/includes/shortcodes/shortcodes.php' ) );

 include( get_theme_file_path( '/includes/admin/enqueue.php' ) );
 include( get_theme_file_path( '/includes/front/enqueue.php' ) );
 include( get_theme_file_path( '/includes/front/sidebar.php' ) );
 include( get_theme_file_path( '/includes/front/ajax.php' ) );
 include( get_theme_file_path( '/includes/setup.php' ) );
 include( get_theme_file_path( '/includes/classes/navWalker.php' ) );
 include( get_theme_file_path( '/includes/classes/commentWalker.php' ) );
 include( get_theme_file_path( '/includes/classes/pagination.php' ) );
 
 include( get_theme_file_path( '/includes/utilities/breadcrumbs.php' ) );
 include( get_theme_file_path( '/includes/utilities/helper.php' ) );
 

remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
add_filter( 'comment_form_logged_in', '__return_empty_string' );