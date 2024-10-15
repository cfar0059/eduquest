<div class="col-3">
    <article class="category">
        <a href="<?php echo esc_attr( get_term_link( $args['tax_term'], $args['taxonomy'] ) );?>" title="<?php esc_attr_e( sprintf( __( "View all casinos in %s" ), $args['tax_term']->name ) ); ?>" class="m-title">
            <div class="m-wrap">
                <div class="m-img lazy-bg m-cat" data-src="<?php echo esc_attr( $args['tax_image'] );?>">
                    <h3># <?php esc_html_e( $args['tax_term']->name ); ?></h3>
                    <div><?php echo wp_lighthouse_post_views_format( $args['tax_term']->count ); ?></div>
                </div>
            </div>
        </a>
    </article>
</div>