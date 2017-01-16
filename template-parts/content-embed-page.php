<?php
/**
 * Template part for displaying embed page 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

?>

<article>
    <header>
        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php the_title();?>
            </a>
        </h3>
        <div class="tag">
        <?php
        if( $categories ) {
            foreach( $categories as $categorie ) { ?>
            <span class="<?php echo $categorie->slug; ?>">
                <?php echo $categorie->name; ?>
            </span>
        <?php }
          } ?>
        </div>

        
        <?php 
        if (get_the_post_thumbnail()) {
        ?>
        <figure>
        <?php the_post_thumbnail( 'embed-article' ); ?>
        </figure>
        <?php 
        }
        ?>        

    </header>
    <section>
       <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="tag"><span class="icon-angle-right"></span> Lire la suite</a>
    </section>
</article>