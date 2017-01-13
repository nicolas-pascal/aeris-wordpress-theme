<?php
/**
 * The template for displaying all pages
 *
 *
 * @package aeris
 */

get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper">
		<main id="main" class="site-main" role="main">

			<?php
			

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			
			?>

		</main><!-- #main -->
		<?php 
		get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
