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
		
        <div class="ft-center">
			<h1 class="fs-200 ft-uc"><?php _e( 'Oops! That page can\'t be found!', 'wp-lighthouse' );?></h1>
			<p class="ft-uc"><?php _e( 'THE PAGE YOU ARE TRYING TO ACCESS IS NO LONGER AVAILABLE', 'wp-lighthouse' );?></p>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-lighthouse' );?></p>
			<div class="section s-404">
				<?php get_search_form();?>
			</div>
			<p>&lsaquo; <a href="/"><?php _e( 'go back to homepage', 'wp-lighthouse' );?></a></p>
		</div>

		<section class="section">
			<div class="ft-center"><h2><?php _e( 'You may be interested in these instead', 'wp-lighthouse' );?></h2></div>
		</section> 
      
		</div>

    </main>

<?php
get_footer();