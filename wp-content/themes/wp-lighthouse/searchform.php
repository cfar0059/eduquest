<form role="search" method="get" class="search d-flex flex-between bg-dark" action="<?php echo esc_url( home_url( '/search' ) ); ?>">
    <div>
        <input class="form-control-search" type="text" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wp-lighthouse' ); ?>" aria-label="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wp-lighthouse' ); ?>" aria-describedby="search-btn" value="<?php echo !empty( $_GET['keyword'] ) ? esc_attr( $_GET['keyword'] ) : ''; ?>" name="keyword" id="search" title="<?php _ex( 'Search for:', 'label', 'wp-lighthouse' ); ?>" onclick="this.select();" />
    </div>
	<div><button id="search-btn" type="submit" class="btn search-icon" aria-label="<?php esc_attr_e('Search site', 'wp-lighthouse');?>"></button></div>
</form>