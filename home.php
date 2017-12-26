<?php
/**
* Template homepage par défaut pour lister les articles
*
*/
get_header(); 

?>

	<div id="content-area" class="wrapper">
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
		<?php 
		// get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
//endwhile; // End of the loop.
// get_sidebar();
get_footer();


