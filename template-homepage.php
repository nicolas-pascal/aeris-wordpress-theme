<?php
/*
Template Name: Homepage custom
*/
get_header(); 
// Description (slogan)
$description = get_bloginfo( 'description', 'display' );

while ( have_posts() ) : the_post();


?>
	<div id="breadcrumbs">
		<?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>
	</div>
	
	<div class="site-branding" style="background-image:url(<?php header_image()?>);">
		<div>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			if ( $description || is_customize_preview() ) { ?>
			<p class="site-description"><?php echo $description; ?></p>
				<?php
			}
			?>
		</div>
	</div><!-- .site-branding -->

	<div id="content-area" class="wrapper default">
		<main id="main" class="site-main" role="main">

            <?php 
            if ( is_active_sidebar( 'homepage-top-widget-area' ) ) {
                ?>
            <section role="homepage-top-widget-area">    
                <?php
                dynamic_sidebar( 'homepage-top-widget-area' );
                ?>
            </section>
            <?php
            }
            ?>
            <?php 
            if ( ( is_active_sidebar( 'homepage-mdleft-widget-area' ) )||( is_active_sidebar( 'homepage-mdright-widget-area' ) ) ) 
            {
            ?>
            <div role="homepage-md">
                <?php 
                if ( is_active_sidebar( 'homepage-mdleft-widget-area' ) ) {
                    ?>
                <section role="homepage-mdleft-widget-area">    
                    <?php
                    dynamic_sidebar( 'homepage-mdleft-widget-area' );
                    ?>
                </section>
                <?php
                }
                ?>

                <?php 
                if ( is_active_sidebar( 'homepage-mdright-widget-area' ) ) {
                    ?>
                <section role="homepage-mdright-widget-area">    
                    <?php
                    dynamic_sidebar( 'homepage-mdright-widget-area' );
                    ?>
                </section>
                <?php
                }
                ?>            
            </div>
            <?php
            }
            ?>
            <?php 
            if ( is_active_sidebar( 'homepage-footer-widget-area' ) ) {
                ?>
            <section role="homepage-footer-widget-area">    
                <?php
                dynamic_sidebar( 'homepage-footer-widget-area' );
                ?>
            </section>
            <?php
            }
            ?>         
		</main><!-- #main -->
		
	</div><!-- #content-area -->
<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();