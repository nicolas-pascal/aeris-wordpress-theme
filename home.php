<?php
/**
* Template homepage par défaut pour lister les articles
*
*/
get_header(); 

?>

	<div id="content-area" class="wrapper sidebar">
		<main id="main" class="site-main" role="main">
			<section role="listNews">
                <h2>News</h2>
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
		get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
//endwhile; // End of the loop.
// get_sidebar();
get_footer();


