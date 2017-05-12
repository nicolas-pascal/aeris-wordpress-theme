<?php
/**
* Template homepage par défaut pour lister les articles
*
*/
get_header(); 

?>

	<div id="content-area" class="wrapper ">
		<main id="main" class="site-main" role="main">

			<!--<section role="listNews">
                <h2>News</h2>-->
               <?php
                /*******  WP_QUERY
                * Liste des derniers articles (actus)
                */

                // $argsListPost = array (
                //     'post_type'             => array( 'post' ),
                //     'post_status'           => array( 'publish' ),
                //     'order'                 => 'DESC'
                // );
                
                // list_pages($argsListPost, false);
                
                ?>
            <!--</section>-->


            <section role="listNews" class="posts">
               <?php
                /*******  WP_QUERY
                * Liste des derniers articles (actus)
                */

                // $argsListPost = array (
                //     'post_type'             => array( 'post' ),
                //     'post_status'           => array( 'publish' ),
                //     'order'                 => 'DESC'
                // );
				                
                // list_pages($argsListPost, false);
				global $post;
				$argsListPost = array(
					'posts_per_page'   => 10,
					'offset'           => 0,
					'category'         => '',
					'category_name'    => '',
					'orderby'          => 'date',
					'order'            => 'DESC',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'post',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'author'		   => '',
					'author_name'	   => '',
					'post_status'      => 'publish',
					'suppress_filters' => true 
				);

				$postsList = get_posts ($argsListPost);

				foreach ($postsList as $post) :
  				  setup_postdata( $post );
					?>
					<div class="post-container">
					<?php
					get_template_part( 'template-parts/content', get_post_format() );
					?>
					</div>
					<?php
				endforeach;
                wp_reset_postdata();
                ?>
            </section>
		</main><!-- #main -->
		<?php 
		// get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
//endwhile; // End of the loop.
// get_sidebar();
get_footer();


