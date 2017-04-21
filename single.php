<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aeris
 */

get_header(); 

$format = get_post_format();

?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
			
			if ($format == 'gallery') { ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 rel="bookmark"><?php the_title();?></h1>
					<div class="entry-meta">
						<?php theme_aeris_posted_on(); ?>
					</div><!-- .entry-meta -->
					<div class="featured-media">
					
						<?php theme_aeris_flexslider('post-image'); ?>
										
					</div> <!-- /featured-media -->
					<div>
						<?php the_content(); ?>
					</div>
				</article>
			<?php } 
			else {
				get_template_part( 'template-parts/content', get_post_format() );
			}
			
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;



		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
		
		<?php 
		get_sidebar();
		?>
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
