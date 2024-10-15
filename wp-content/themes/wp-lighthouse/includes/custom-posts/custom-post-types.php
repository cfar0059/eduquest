<?php
/**
 * WP Tube casino custom post types and taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Lighthouse
 */


/*
add_filter('use_block_editor_for_post_type', 'wp_lighthouse_actor_disable_gutenberg', 10, 2);
function wp_lighthouse_actor_disable_gutenberg($current_status, $post_type) {
    
	// Use your post type key
    if ($post_type === 'casino') return false;
    
	return $current_status;
}
*/


// Include relevant files
include( get_theme_file_path( '/includes/custom-posts/queries.php' ) );