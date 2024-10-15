<?php
/**
 * Front-end enqueue functions
 *
 * @package WP_Lighthouse
 */
add_action('wp_head', 'wp_lighthouse_inline_styles', 100);
function wp_lighthouse_inline_styles() {

    $search[] = "{{themepath}}";
    $replace[] = get_theme_file_uri();

    $required_css = file_get_contents(get_theme_file_path( '/includes/assets/css/grid.css' ));
    $required_css .= file_get_contents(get_theme_file_path( '/includes/assets/css/required.css' ));

    echo '<style>'.str_replace($search, $replace, $required_css).'</style>';
}

add_action( 'wp_footer', 'wp_lighthouse_footer_enqueue', 50 );
function wp_lighthouse_footer_enqueue() {

    $search[] = "{{themepath}}";
    $replace[] = get_theme_file_uri();

    $defer_css = str_replace($search, $replace, file_get_contents(get_theme_file_path( '/includes/assets/css/defer.css' )));
    $jquery_js = file_get_contents(get_theme_file_path( '/includes/assets/js/jquery-3.6.0.min.js' ));
    $app_js = str_replace($search, $replace, file_get_contents(get_theme_file_path( '/includes/assets/js/app.js' )));
    
    echo '<style>'.$defer_css.'</style>';
    echo '<script>'.$jquery_js.'</script>';
    echo '<script>'.$app_js.'</script>';
    echo '<script>var ajax_object = ' . json_encode(
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'ajax_nonce' => wp_create_nonce( AJAX_NONCE ),
        )
    ). ';</script>';
}

/**
 * Disable the emoji's
 */
 add_action( 'init', 'wp_lighthouse_disable_emojis' );
function wp_lighthouse_disable_emojis() {
    
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'wp_lighthouse_disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'wp_lighthouse_disable_emojis_remove_dns_prefetch', 10, 2 );
}

function wp_lighthouse_disable_emojis_tinymce( $plugins ) {
    
    if ( is_array( $plugins ) ) {
    
        return array_diff( $plugins, array( 'wpemoji' ) );
    } 
    else {
    
        return array();
    }
}

function wp_lighthouse_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {

    if ( 'dns-prefetch' == $relation_type ) {
    
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   
    return $urls;
}
