<?php
/**
 * Template part for displaying embed page 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h3>
           <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
            <?php the_title();?>
            </a>
        </h3>     
        
        <?php 
        if (get_the_post_thumbnail()) {
        ?>
        <figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                <?php the_post_thumbnail( 'illustration-article' ); ?>
            </a>
        </figure>
        <?php 
        }
        ?>        

    </header>
    <section>
       <?php if($post->post_content != "") : ?>			
       <div class="post-excerpt">	    		            			            	                                                                                            
			<?php the_excerpt(); ?>
        </div>
		<?php endif; ?>
    </section>
    <footer>
        <?php theme_aeris_show_categories($categories);?>
        <small>
            <?php theme_aeris_meta(); ?>
        </small>
	</footer>
</article>