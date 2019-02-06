<?php
/**
 * Template part for displaying embed post 
 *
 */
$categories = get_the_terms( $post->ID, 'category');  

$title = get_the_title();
$title = mb_strimwidth($title, 0, 50, '...');
?>

<article role="short-embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
    <?php theme_aeris_show_categories($categories);?>
    <?php 
    if (get_the_post_thumbnail()) {
    ?>
        <figure>
        <?php the_post_thumbnail( 'single-article' ); ?>
        </figure>
    <?php 
    }
    ?> 
        
        <h3>
           <a href="<?php the_permalink(); ?>">
            <?php echo $title;?>
            </a>
        </h3>      
                 
    </header>
    <footer>
        <?php theme_aeris_meta(); ?> 
    </footer>
</article>