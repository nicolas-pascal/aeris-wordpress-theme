<?php
/*
Template Name: Liste d'éléments enfants
*/
get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper default">
		<main id="main" class="site-main" role="main">
            <section role="listChild">
			<?php
                $args = array(
                    'post_type'      => array( 'page' ),
                    'posts_per_page' => -1,
                    'post_parent'    => $post->ID,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order'
                );
				wpaeris_listchild_pages($args);
			?>
            </section>
		
		</main><!-- #main -->
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();