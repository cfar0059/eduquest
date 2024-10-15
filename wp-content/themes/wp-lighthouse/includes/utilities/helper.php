<?php
/**
 *  WP Tube helper functions
*/
// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function wp_lighthouse_post_thumbnail( $post_id, $css = false, $show_dummy = true, $size = 'thumb', $dwidth = 150, $dheight = 150 ) {

	if( has_post_thumbnail( $post_id ) ) {

		echo '<figure class="entry-image">
				<a href="' . esc_url( get_the_permalink( $post_id ) ) . '"> 
				' . get_the_post_thumbnail( $post_id, $size, array( 'class' => ( $css ? $css : ''), 'alt' => esc_attr( get_the_title( $post_id ) ) ) ) . '
				</a>
			</figure>';
	}
	else {

		if( $show_dummy ) {

			$thumb_w 	= ( $dwidth ? $dwidth : get_option( 'thumbnail_size_w' ) );
			$thumb_h 	= ( $dheight ? $dheight : get_option( 'thumbnail_size_h' ) );
			$alpha		= strtoupper( substr( get_the_title( $post_id ), 0, 1 ) );
			$title		= explode(" ", get_the_title( $post_id ) );
			if( isset( $title[1] ) ) {
				$alpha .= strtoupper( substr( $title[1], 0, 1 ) );
			}

			$colors 	= array( 'D32F2F', 'C2185B', '7B1FA2', '512DA8', '303F9F', '1976D2', '00796B', '388E3C', 'FFA000', 'F57C00', 'E64A19', '5D4037', '455A64' );
			shuffle( $colors );

			echo '<figure class="entry-image">
					<a href="' . esc_url( get_the_permalink( $post_id ) ) . '"> 
					<img src="https://via.placeholder.com/' . $thumb_w . 'x' . $thumb_h . '/' . $colors[0] . '/FFFFFF?text=' . $alpha . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" ' . ( $css ? 'class="'.$css.'"' : '') . ' />
					 </a>
				</figure>';
		}
	}
}

function wp_lighthouse_posted_on( $show_author = true ) {
	
	$post_date_gmt = get_post_datetime( null, 'date', 'gmt')->format('Y-m-d H:i:s');

	$time_string = '<time class="entry-date published updated" datetime="%1$s" title="%2$s">%3$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

		$time_string = '<time class="entry-date published" datetime="%1$s" title="%2$s">%3$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( wp_lighthouse_time_ago( $post_date_gmt ) )
	);

	$posted_on   = apply_filters(
		'wp_lighthouse_posted_on', sprintf(
			'<span class="posted-on">%1$s %2$s</span>',
			esc_html_x( ' ', 'post date', 'wp-lighthouse' ),
			apply_filters( 'wp_lighthouse_posted_on_time', $time_string )
		)
	);

	$byline      = apply_filters(
		'wp_lighthouse_posted_by', sprintf(
			'<span class="byline"> %1$s<span class="author vcard"><a class="url fn n text-secondary" href="%2$s"> %3$s</a></span></span>',
			$posted_on ? esc_html_x( 'By ', 'post author', 'wp-lighthouse' ) : esc_html_x( '', 'post author', 'wp-lighthouse' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);

	echo ( $show_author ) ? $byline : '';
	
	echo $posted_on; // WPCS: XSS OK.
}

function wp_lighthouse_time_ago( $datetime, $show_time = true, $show_tense = true ) {

	if( ! strtotime( $datetime) ) {

		return $datetime;
	}

	$period	 = array(
				__( 'second', 'wp-lighthouse' ), 
				__( 'minute', 'wp-lighthouse' ), 
				__( 'hour', 'wp-lighthouse' ), 
				__( 'day', 'wp-lighthouse' ), 
				__( 'week', 'wp-lighthouse' ), 
				__( 'month', 'wp-lighthouse' ), 
				__( 'year', 'wp-lighthouse' ), 
				__( 'decade', 'wp-lighthouse' ),
			);

	$periods = array(
				__( 'seconds', 'wp-lighthouse' ), 
				__( 'minutes', 'wp-lighthouse' ), 
				__( 'hours', 'wp-lighthouse' ), 
				__( 'days', 'wp-lighthouse' ), 
				__( 'weeks', 'wp-lighthouse' ), 
				__( 'months', 'wp-lighthouse' ), 
				__( 'years', 'wp-lighthouse' ), 
				__( 'decades', 'wp-lighthouse' ),
			);

	$tense = __( 'ago', 'wp-lighthouse' );

	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = current_time( 'timestamp' );

	$unix_date = strtotime( $datetime );

	$difference = $now - $unix_date;

	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {

		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if ($difference != 1) {

		$time = $periods[$j];
	}
	else {

		$time = $period[$j];
	}

	$output = '<span id="diffH-diff">'.$difference.'</span> ';

	if($show_time) { $output .= '<span id="diffH-time" class="me-1">'.$time.'</span> '; }
	if($show_tense) { $output .= '<span id="diffH-tense">'.$tense.'</span> '; }
	
	return $output;
}

function wp_lighthouse_wp_link_pages() {

	$args = array (
		'before'            => '<div class="av-page-links"><span class="page-link-text">' . __( 'Pages: ', 'wp-lighthouse' ) . '</span>',
		'after'             => '</div>',
		'link_before'       => '',
		'link_after'        => '',
		'next_or_number'    => 'number',
		'separator'         => '',
		'nextpagelink'      => __( 'Next &raquo', 'wp-lighthouse' ),
		'previouspagelink'  => __( '&laquo Previous', 'wp-lighthouse' ),
	);

	wp_link_pages( $args );
}

function wp_lighthouse_post_taxonomy( $post_id, $taxonomy = 'category', $css = '' ) {
	
	$terms = get_the_terms( $post_id, $taxonomy );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

		$post_terms = '';

		foreach($terms as $term) {
			
			$term_link = get_term_link( $term->term_id, $taxonomy );

			$post_terms .= '<a href="' . esc_url( $term_link ) . '" title="' . $term->name . '" class="'.$css.'">';
			
			if( ! in_array( $taxonomy, array( 'category' ) ) ) {

				$post_terms .= '#';
			}

			$post_terms .= $term->name . '</a> ';
		}

		return $post_terms;
	}

	return;
}

function wp_lighthouse_post_views_format( $num, $precision = 1 ) {

	if ( $num >= 1000000000 ) {

		$num = round( $num / 1000000000, $precision );
		$unit = __( 'B', 'wp-lighthouse' );
	}
	elseif ( $num >= 1000000 ) {
		
		$num = round($num / 1000000, $precision);
		$unit = __( 'M', 'wp-lighthouse' );
	}
	elseif ( $num >= 1000 ) {
		
		$num = round($num / 1000, $precision);
		$unit = __( 'K', 'wp-lighthouse' );
	}
	else {
		
		return number_format($num);
	}

	return number_format($num, $precision).' '.$unit;
}

if( ! function_exists( 'wp_lighthouse_get_ip_address' ) ) {

	function wp_lighthouse_get_ip_address() {
		
		foreach ( array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key ) {
			
			if ( array_key_exists( $key, $_SERVER ) === true ) {

				foreach ( explode( ',', $_SERVER[$key] ) as $ip ) {
				
					$ip = trim( $ip ); // just to be safe

					if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false ) {
						
						return $ip;
					}
				}
			}
		}
	}
}
