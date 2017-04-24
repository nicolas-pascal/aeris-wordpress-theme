
<?php
/**
 * Template part for displaying embed post Gallery 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <div class="tag">
        <?php
        if( $categories ) {
            foreach( $categories as $categorie ) { 

            echo '<a href="'.site_url().'/category/'.$categorie->slug.'">';
            ?>
            <span class="<?php echo $categorie->slug; ?>">
                <?php echo $categorie->name; ?>
            </span>
            </a>
        <?php }
          } ?>
        </div>

        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php the_title();?>
            </a>
        </h3>     
        
        <div class="featured-media">

			<?php theme_aeris_flexslider('illustration-article'); ?>
							
		</div> <!-- /featured-media -->  

    </header>
    <section>
		<?php if($post->post_content != "") : ?>
											                                    	    
			<div class="post-excerpt">
				    		            			            	                                                                                            
				<?php the_excerpt('100'); ?>
			
			</div> <!-- /post-excerpt -->

		<?php endif; ?>   
        <a href="<?php the_permalink(); ?>"><span class="icon-angle-right"></span> Lire la suite</a>
    </section>
</article>