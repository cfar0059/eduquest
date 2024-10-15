<?php
/**
 * Alter queries for custom post types and taxonomies
 * 
 * @package WP_Lighthouse
 */

//add_filter( 'posts_request', 'dump_request' );

function dump_request( $input ) {

    //var_dump($input); 
	echo $input; 
	//exit;

    return $input;
}