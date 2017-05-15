<?php
/*
Template Name: Homepage
*/
get_header(); 
// Description (slogan)
$description = get_bloginfo( 'description', 'display' );

while ( have_posts() ) : the_post();

	// get_template_part( 'template-parts/header-content', 'page' );
?>
	<div id="breadcrumbs">
		<?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>
	</div>
	
<script>
	var bgImageArray = [];

<?php 
    if (is_random_header_image()) {
		$headers = get_uploaded_header_images();
		foreach($headers as $item) {
			echo "bgImageArray.push('".esc_url($item['url'])."');";
		}
	}
	else {
		echo "bgImageArray.push('";
		header_image();
		echo "');";
	}
?>



var secs = 10;
bgImageArray.forEach(function(img){
    new Image().src = img; 
});

function backgroundSequence() {
	if (bgImageArray.length>1) {
	window.clearTimeout();
	var k = 0;
	for (i = 0; i < bgImageArray.length; i++) {
		setTimeout(function(){
			document.querySelector(".site-branding").style.backgroundImage = "url(" + bgImageArray[k] + ")"; 
		if ((k + 1) === bgImageArray.length) { setTimeout(function() { backgroundSequence() }, (secs * 1000))} else { k++; }			
		}, (secs * 1000) * i)	
	}
	}
}

</script>

<div class="site-branding" style="-webkit-transition: 2s; transition: 2s">
		<div>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			if ( $description || is_customize_preview() ) { ?>
			<p class="site-description"><?php echo $description; ?></p>
				<?php
			}
			?>
		</div>
	</div>

<script>
document.querySelector(".site-branding").style.backgroundImage = "url(" + bgImageArray[bgImageArray.length-1] + ")"; 
backgroundSequence();

</script>

	<div id="content-area" class="wrapper">
		<main id="main" class="site-main" role="main">

			<?php
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			
			?>
			<section role="listNews" class="posts">
               <?php
                /*******  WP_QUERY
                * Liste des derniers articles (actus)
                */

                // $argsListPost = array (
                //     'post_type'             => array( 'post' ),
                //     'post_status'           => array( 'publish' ),
                //     'order'                 => 'DESC'
                // );
				                
                // list_pages($argsListPost, false);
				global $post;
				$argsListPost = array(
					'posts_per_page'   => get_option('posts_per_page'),
					'offset'           => 0,
					'category'         => '',
					'category_name'    => '',
					'orderby'          => 'date',
					'order'            => 'DESC',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'post',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'author'		   => '',
					'author_name'	   => '',
					'post_status'      => 'publish',
					'suppress_filters' => true 
				);

				$postsList = get_posts ($argsListPost);

				foreach ($postsList as $post) :
  				  setup_postdata( $post );
					?>
					<div class="post-container">
					<?php
					get_template_part( 'template-parts/content', get_post_format() );
					?>
					</div>
					<?php
				endforeach;
               
                ?>
				
            </section>
			<?php 
				the_posts_navigation();
				wp_reset_postdata();
			?>
		</main><!-- #main -->
		<?php 
		//get_sidebar();
		?>
	</div><!-- #content-area -->

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();


