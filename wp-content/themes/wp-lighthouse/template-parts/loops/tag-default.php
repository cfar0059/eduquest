<li>
    <a href="<?php echo esc_attr( get_term_link( (int)$args['tax_term']->term_id, $args['taxonomy'] ) ); ?>" class="channel">
        <span class="tname"><?php echo esc_html( ucwords($args['tax_term']->name) );?></span>
        <span class="tcount"><?php echo wp_lighthouse_post_views_format( $args['tax_term']->count );?></span>
    </a>
</li>