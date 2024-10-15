<?php
/**
 * The sidebar init
 *
 * @package WP_Lighthouse
 */

add_action( 'widgets_init', 'wp_lighthouse_widgets_init' );
function wp_lighthouse_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Top Movie Sidebar', 'wp-lighthouse' ),
        'id'            => 'sidebar-casino-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-lighthouse' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Bottom Movie Sidebar', 'wp-lighthouse' ),
        'id'            => 'sidebar-casino-2',
        'description'   => esc_html__( 'Add widgets here.', 'wp-lighthouse' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'wp-lighthouse' ),
        'id'            => 'sidebar-blog',
        'description'   => esc_html__( 'Add widgets here.', 'wp-lighthouse' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Pre Footer Menu', 'wp-lighthouse' ),
        'id'            => 'pre-footer',
        'description'   => esc_html__( 'Add widgets here.', 'wp-lighthouse' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Post Footer Menu', 'wp-lighthouse' ),
        'id'            => 'post-footer',
        'description'   => esc_html__( 'Add widgets here.', 'wp-lighthouse' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}