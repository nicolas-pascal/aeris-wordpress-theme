<?php
/*
Template Name: Homepage
*/
get_header(); 
COUCOUC
// Description (slogan)
$description = get_bloginfo( 'description', 'display' );

while ( have_posts() ) : the_post();

	// get_template_part( 'template-parts/header-content', 'page' );
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

	<div id="content-area" class="wrapper">
		<main id="main" class="site-main" role="main">

			<?php
			

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			
			?>
			<section role="listNews">
               <?php
                /*******  WP_QUERY
                * Liste des derniers articles (actus)
                */

                $argsListPost = array (
                    'post_type'             => array( 'post' ),
                    'post_status'           => array( 'publish' ),
                    'order'                 => 'DESC'
                );
                
                list_pages($argsListPost, false);
                
                ?>
            </section>
		</main><!-- #main -->
		<?php 
		//get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();


