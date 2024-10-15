<div class="col-3">
	<article class="category">
		<a href="<?php echo esc_attr( get_term_link( $args['tax_term'], $args['taxonomy'] ) );?>" title="<?php esc_attr_e( sprintf( __( "View all casinos in %s" ), $args['tax_term']->name ) ); ?>" class="m-title pt-0 pb-0">
			<div class="m-wrap">
				<div class="m-img rounded lazy-bg" data-src="<?php echo esc_attr( $args['tax_image'] );?>"></div>
			</div>
			<div class="d-flex flex-between flex-align-baseline mt-2 ctitle">
				<h2><?php esc_html_e( $args['tax_term']->name ); ?></h2>
				<span><?php echo wp_lighthouse_post_views_format( $args['tax_term']->count ); ?></span>
			</div>
		</a>
	</article>
</div>