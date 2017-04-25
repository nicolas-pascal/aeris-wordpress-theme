<?php
/**
 * Template part for displaying embed page 
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
            </a>
        </h3>     
        
        <?php 
        if (get_the_post_thumbnail()) {
        ?>
        <figure>
        <?php the_post_thumbnail( 'illustration-article' ); ?>
        </figure>
        <?php 
        }
        ?>        

    </header>
    <section>        
       <?php if($post->post_content != "") : ?>				    		            			            	                                                                                            
			<?php the_excerpt(); ?>

		<?php endif; ?>   
        <a href="<?php the_permalink(); ?>"><span class="icon-angle-right"></span> Lire la suite</a>
    </section>
</article>
