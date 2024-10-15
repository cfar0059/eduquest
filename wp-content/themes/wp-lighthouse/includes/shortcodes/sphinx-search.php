<?php

function wp_lighthouse_sphinx_search_shortcode( $attr, $content = null ) {


	if( wp_lighthouse_verify_user_token() == false ) {

		return '<div><p>' . __( 'This is required only once per session.', 'wp-lighthouse' ) . '</p>' . wp_lighthouse_hcaptcha_shortcode( array(), null ) . '</div>';
	}
	else {

		if( ! empty( $_GET['keyword'] ) ) {

			$term = sanitize_text_field( $_GET['keyword'] );
			$paged = ( ! empty( $_GET['pg'] ) ? (int)$_GET['pg'] : 0 );

			$output = '<div id="search-results"><img src="' . get_theme_file_uri( '/includes/assets/images/s-loader.gif' ) . '" alt="searching..."> <i>' . __( 'searching...', 'wp-lighthouse' ) . '</i></div>';

			$output .= '<script>window.onload = function() { if (window.jQuery) { 
			jQuery(document).ready(function() { 
				jQuery.ajax({
					type : "post",
					dataType : "text",
					url : ajax_object.ajaxurl,
					data : {
							action: \'wp_lighthouse_casino_search\',
							term: "' . esc_attr( $term ) . '",
							page: ' . $paged . ',
							key: ajax_object.ajax_nonce,
						},
					success: function(res) {
						jQuery("#search-results").html(res);
					}
				});
			});}}
			</script>';

			return $output;
		}
		else {

			return __( 'No search keyword supplied', 'wp-lighthouse' );
		}
	}
}