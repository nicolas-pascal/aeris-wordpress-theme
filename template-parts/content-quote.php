<?php
/**
 * Template part for displaying embed post Quote 
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
        <blockquote>
			<?php		
			// Fetch post content
			$content = get_post_field( 'post_content', get_the_ID() );
			
			// Get content parts
			$content_parts = get_extended( $content );
			
			// Output part before <!--more--> tag
			echo $content_parts['main'];
			
			?>
		</blockquote>
    </header>
   
	<section class="post-excerpt">
																																							
	<?php 
		if ($pos=strpos($post->post_content, '<!--more-->')) {
			echo  '<p>' . mb_strimwidth($content_parts['extended'], 0, 100, '...') . '</p>';
		} else {
			the_excerpt('100');
		}
	?>
	</section>
    
	<footer>
		<?php theme_aeris_show_categories($categories);?>
		<?php theme_aeris_meta(); ?>
	</footer>
</article>