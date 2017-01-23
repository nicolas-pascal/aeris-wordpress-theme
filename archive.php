<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 

get_template_part( 'template-parts/header-content', 'archive' );


?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

			<section role="listNews">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'embed-page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				the_posts_navigation();
				?>
			</section>
			<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		
		</main><!-- #main -->
		<?php 
		get_sidebar();
		?>
	</div><!-- #content-area -->
<?php
get_footer();
?>

