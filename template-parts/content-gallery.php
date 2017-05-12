
<?php
/**
 * Template part for displaying embed post Gallery 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php the_title();?>
            </a>
        </h3>     
        
    </header>
    <section>

        <div class="featured-media">

            <?php theme_aeris_flexslider('illustration-article', $post); ?>
                            
        </div> <!-- /featured-media -->  
		<?php if($post->post_content != "") : ?>
											                                    	    
			<div class="post-excerpt">
				    		            			            	                                                                                            
				<?php 
                // Fetch post content
                $content = get_post_field( 'post_content', get_the_ID() );
                
                // Get content parts
                $content_parts = get_extended( $content );
                 if ($pos=strpos($post->post_content, '<!--more-->')) {
                    echo  '<p>' . mb_strimwidth($content_parts['extended'], 0, 100, '...') . ' </p>';
                } else {
                    the_excerpt();
                }
			?>
			</div> <!-- /post-excerpt -->

		<?php endif; ?>
    </section>
    <footer>
        <?php theme_aeris_show_categories($categories);?>
		<?php theme_aeris_meta(); ?>
	</footer>
</article>