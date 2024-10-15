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
		
            <div class="d-flex flex-between flex-wrap flex-align-end">
                <div>
                    <h1 class="mb-0"><?php single_post_title();?></h1>
                    <p class="pb-0 mb-0"><?php echo _e( 'Read casino reviews, comments and other industry related news in our casino blog.', 'wp-lighthouse' ); ?></p>
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

            if( have_posts() ) {

                echo '<div class="row">';

                while ( have_posts() ) { 
                    
                    the_post();

                    get_template_part( 'template-parts/loops/content', 'post' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        
                        comments_template();
                    }

                } // End of the loop.

                echo '</div>';

                the_posts_navigation();
            }
			?>
      
		</div>

    </main>

<?php
get_footer();