<?php
/*
Template Name: Homepage custom
*/
get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper default">
		<main id="main" class="site-main" role="main">

			<?php
				// get_template_part( 'template-parts/content', 'page' );

				// // If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;
			
			?>
            <section role="homepage-top-widget-area">
            <?php 
                if ( ! is_active_sidebar( 'homepage-top-widget-area' ) ) {
                    return;
                }
                ?>
                    <?php dynamic_sidebar( 'homepage-top-widget-area' ); ?>

         
            </section>
            <div role="homepage-md">
                <section role="homepage-mdleft-widget-area">
                <?php 
                    if ( ! is_active_sidebar( 'homepage-mdleft-widget-area' ) ) {
                        return;
                    }
                    ?>
                        <?php dynamic_sidebar( 'homepage-mdleft-widget-area' ); ?>

                </section>

            <section role="homepage-mdright-widget-area">
                <?php 
                    if ( ! is_active_sidebar( 'homepage-mdright-widget-area' ) ) {
                        return;
                    }
                    ?>
                        <?php dynamic_sidebar( 'homepage-mdright-widget-area' ); ?>

                </section>
            </div>
           <section role="homepage-footer-widget-area">
            <?php 
                if ( ! is_active_sidebar( 'homepage-footer-widget-area' ) ) {
                    return;
                }
                ?>
                    <?php dynamic_sidebar( 'homepage-footer-widget-area' ); ?>

            </section>
		
		</main><!-- #main -->
		
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();