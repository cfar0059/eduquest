<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Lighthouse
 */

get_header(); ?>

	<main id="main" role="main">

		<section id="home-banner" class="section home-banner">
		
			<div class="container home-text">
				<h1>Casino Online - Vi guidar dig rätt!</h1>

				<p>Vi tar sedan 2017 tempen på casinon online och är en komplett jämförelseportal för svenska licensierade casinon där du utifrån dina egna preferenser kan hitta det casino som passar dig bäst. Oavsett vad du är ute efter, så finns allt inom casino här på CasinoFeber.se!</p>

			</div>

			<div class="header-menu">
				<div class="container">
					<strong>Innehåll:</strong>
					<ul>
						<li><a href="/">Casinotopplista januari 2023</a></li>
						<li><a href="/">Nya Casinon på CasinoFeber</a></li>
						<li><a href="/">Senaste Casinonyheterna</a></li>
					</ul>
				</div>
			</div>

		</section>

		<div style="height: 800px;">
		[content here...]
		</div>

	</main><!-- #maim -->

<?php
get_footer();