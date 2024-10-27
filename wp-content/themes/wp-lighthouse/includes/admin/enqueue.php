<?php

function wp_lighthouse_admin_scripts_enqueue() {

    global $typenow;
    
    if( (in_array($typenow, array('casino')) )) {
        wp_enqueue_media();

        wp_register_script( 'meta-image', get_template_directory_uri() . '/includes/assets/js/admin.js', array( 'jquery' ) );
        wp_localize_script( 'meta-image', 'meta_image',
            array(
                'title' => __('Upload Image', 'wp-lighthouse'),
                'button' => __('Use Image', 'wp-lighthouse'),
            )
        );
        wp_enqueue_script( 'meta-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'wp_lighthouse_admin_scripts_enqueue' );