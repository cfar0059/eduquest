<?php
/**
 * The template for displaying all pages
 *
 * @package WP_Lighthouse
 */

$categories = get_categories();
get_header(); 
?>

	<main id="main" class="mt-5" role="main">
    	
		<div class="container">
		
            <div class="d-flex flex-between flex-wrap flex-align-end mb-4">
                <div>
                    <?php the_archive_title( '<h1 class="mb-0">', '</h1>' ); ?>
                </div>
                <div>
                    <select class="btn btn-outline-secondary" id="blog-categories">
                        <option value="<?php echo home_url('/blog/');?>"><?php _e( ' - category - ', 'wp-lighthouse' );?></option>
                        <?php
                        foreach ( $categories as $category ) {
                            printf( '<option value="%1$s">%2$s</option>',
                                esc_url( get_category_link( $category->term_id ) ),
                                esc_html( $category->name )
                            );
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php
            if ( have_posts() ) {

                echo '<div class="row">';

                /* Start the Loop */
                while ( have_posts() ) { 
                    
                    the_post();

                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */ 
                    get_template_part( 'template-parts/loops/content', get_post_type() );

                }

                echo '</div>';

                the_posts_navigation();
            }
            else {

                get_template_part( 'template-parts/content', 'none' );

            } ?>

            <?php the_archive_description( '<div class="archive-description fs-2 mt-5">', '</div>' ); ?>
      
		</div>

    </main>
<?php
get_footer();