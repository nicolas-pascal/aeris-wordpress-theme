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
$categories = get_the_terms( $post->ID, 'category');  
?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
				<header>
			        <div class="tag">
			        <?php
			        if( $categories ) {
			            foreach( $categories as $categorie ) { 

			            echo '<a href="'.site_url().'/category/'.$categorie->slug.'">';
			            ?>
			            <span class="<?php echo $categorie->slug; ?>">
			                <?php echo $categorie->name; ?>
			            </span>
			            </a>
			        <?php }
			          } ?>
			        </div>

			        <h1 rel="bookmark">
			           <a href="<?php the_permalink(); ?>">
			            <?php the_title();?>
			            </a>
			        </h1>
				</header>

			<?php
			if ($format == 'gallery') { ?>
				
				<section class="featured-media">					
					<?php theme_aeris_flexslider('post-image'); ?>									
				</section> <!-- /featured-media -->

			<?php } 

			else {

		        if (get_the_post_thumbnail()) {
		        ?>
		        <figure>
		        <?php the_post_thumbnail( 'illustration-article' ); ?>
		        </figure>
		        <?php 
		        }
		        ?>   
		        <section>
					<?php the_content(); ?>
		        </section>
				<!-- get_template_part( 'template-parts/content', get_post_format() ); -->

				<footer>
					<?php theme_aeris_posted_on(); ?>
				</footer><!-- .entry-meta -->
			<?php 
			}
			?>
			</article>
			<?php
			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php
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
