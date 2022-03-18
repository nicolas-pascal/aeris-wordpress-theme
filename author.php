<?php
/**
 * The template for displaying author archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$categories = get_the_terms( $post->ID, 'category');  
get_template_part( 'template-parts/header-content', 'archive' );

?>

	<div id="content-area" class="wrapper archives">
		<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>

			<section role="listNews" class="posts">
				
			<?php
				while ( have_posts() ) : the_post();
				?>
				<div class="post-container">
				<?php
					get_template_part( 'template-parts/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>
				<?php
				endwhile; // End of the loop.
				?>				
			</section>
			<?php 
				the_posts_navigation();
				?>
			<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		
		</main><!-- #main -->
		<?php 
		// get_sidebar();
		?>
	</div><!-- #content-area -->
<?php
get_footer();
?>

