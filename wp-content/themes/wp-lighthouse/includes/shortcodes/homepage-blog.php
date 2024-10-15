<?php

function wp_lighthouse_homepage_blog_shortcode( $attr, $content = null ) {

	extract(
		shortcode_atts(
			array(
				'per_page' => 3,
			), 
			$attr
		)
	);

	$args['post_type'] = 'post';
	$args['status'] = 'publish';
	$args['posts_per_page'] = $per_page;

	$posts = new WP_Query( $args );

	$output = '';

	if ( $posts->have_posts() ) {
        
		$output .= '<div class="row clearfix">';

		ob_start();

		while( $posts->have_posts() ) {

			$posts->the_post();

			get_template_part( 'template-parts/loops/content', 'post' );
            
        }

        wp_reset_postdata();

		$output .= ob_get_contents();

		ob_end_clean();

		$output .= '</div>';
    }

	return $output;
}