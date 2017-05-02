
<?php
/**
 * Template part for displaying embed post Gallery 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php theme_aeris_show_categories($categories);?>

        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php the_title();?>
            // 
            <?php echo $post->ID; ?>
            </a>
        </h3>     
        
    </header>
    <section>

        <div class="featured-media">

            <?php theme_aeris_flexslider('illustration-article', $post); ?>
                            
        </div> <!-- /featured-media -->  
		<?php if($post->post_content != "") : ?>
											                                    	    
			<div class="post-excerpt">
				    		            			            	                                                                                            
				<?php the_excerpt(); ?>
			
			</div> <!-- /post-excerpt -->

		<?php endif; ?>   
        <a href="<?php the_permalink(); ?>"><span class="icon-angle-right"></span> Lire la suite</a>
    </section>
</article>