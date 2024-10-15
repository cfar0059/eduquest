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
	
			<?php

            if( have_posts() ) {

                echo '<div class="row">';

                while ( have_posts() ) { 
                    
                    the_post();

                    get_template_part( 'template-parts/single/content', 'post' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        
                        comments_template();
                    }

                } // End of the loop.

                echo '</div>';
            }
			?>
      
		</div>

    </main>

<?php
get_footer();