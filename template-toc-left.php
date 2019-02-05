
<?php
/*
Template Name: Page avec sommaire
*/
get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
		<main id="main" class="site-main" role="main">

			<?php
			

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			
			?>
			<?php 
			// if ( get_edit_post_link() ) : 
			// 	edit_post_link(
			// 		sprintf(
			// 			/* translators: %s: Name of current post */
			// 			esc_html__( 'Edit page%s', 'theme-aeris' ),
			// 			the_title( '<span class="screen-reader-text">"', '"</span>', false )
			// 		),
			// 		'<span class="edit-link">',
			// 		'</span>'
			// 	);
			// endif; ?>
		</main><!-- #main -->
            <!-- Ici sera généré la table des matières en "sticky menu" -->
        <aside>
            <nav role="sommaire">
                <ul id="tocList">
                </ul>
            </nav>
        </aside>
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
?>
<?php
get_footer();
