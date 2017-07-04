<?php
/**
 * Template part for displaying list child page content in template-listchild.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

?>
<article id="post-<?php the_ID(); ?>" >
 	<header class="entry-header">
        <a href="<?php the_permalink(); ?>">
	        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        </a>
	</header> 
    <!--<div class="wrapper-content">-->
	<?php
		the_excerpt();
	?>

	<!--</div>-->
</article><!-- #post-## -->