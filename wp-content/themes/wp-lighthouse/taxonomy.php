<?php
/**
 * The template for displaying all pages
 *
 * @package WP_Lighthouse
 */

get_header(); 
?>

	<main id="main" class="mt-5" role="main">
    	
		<div class="container">
		
            <div>
                <?php the_archive_title( '<h1>', '</h1>' ); ?>
            </div>

            <?php
            if ( have_posts() ) {

                echo '<div class="row">';

                /* Start the Loop */
                $loop_count = 1;
                $loop_count_offset = 4;
                while ( have_posts() ) { 
                    
                    the_post();

                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */
                    get_template_part( 'template-parts/loops/content', 'casino', array( 'loop_count' => $loop_count, 'loop_count_offset' => $loop_count_offset ) );
                    $loop_count++;
                }

			    echo '</div>';

			    $pagination_range = (wp_is_mobile() ? 1 : 4);
			    echo wp_lighthouse_pagination( '', $pagination_range, 'justify-content-center pagination-lg' ); 
            }
            else {

                get_template_part( 'template-parts/content', 'none' );

            } ?>

            <?php the_archive_description( '<div class="archive-description fs-2 mt-5">', '</div>' ); ?>
      
		</div>

    </main>
<?php
get_footer();