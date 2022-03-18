<?php
/*
Template Name: Page avec sommaire
*/
get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
		<?php // Table of content generated / sticky menu ?>
		<aside id="stickyMenu">
            <nav role="sommaire">
                <ul id="tocList">
                </ul>
            </nav>
        </aside>
		<main id="main" class="site-main" role="main">
			<?php
			get_template_part( 'template-parts/content', 'page' );	
			?>
		</main>
        
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
?>
<?php
get_footer();
