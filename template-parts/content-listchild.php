<?php
/**
 * Template part for displaying list child page content in template-listchild.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

?>
<article id="post-<?php the_ID(); ?>" class="item-child">
 	<header>
        <h2>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <span class="icon-link"></span> 
                <?php the_title(); ?>
            </a>
        </h2>
	</header> 
	<?php
		the_excerpt();
	?>
</article>