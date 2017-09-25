
<?php
/*
Template Name: Page vierge pour Divi Builder
*/

get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="blank">
		<main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>">
            <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
                    'after'  => '</div>',
                ) );
            ?>
            </article><!-- #post-## -->			
		</main><!-- #main -->
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
