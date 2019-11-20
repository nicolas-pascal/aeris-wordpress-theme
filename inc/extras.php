<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aeris
 */

/*

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theme_aeris_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	return $classes;
}
add_filter( 'body_class', 'theme_aeris_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function theme_aeris_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'theme_aeris_pingback_header' );

/******************************************************************
 * EXCERPT CUSTOM
 *
 */

// Change the length of excerpts
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Add more-link text to excerpt
function new_excerpt_more( $more ) {
	return '... <br><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading', 'theme_aeris') . ' <span class="icon-angle-right"></span></a>';
}
// add_filter( 'excerpt_more', 'new_excerpt_more' );


/******************************************************************
 * Creation de liste des pages en fonction d'arguments passés à WP_Query()
 *
 */

function list_pages($arg, $infiniteScroll){
	
	// The Query
	$queryListPages = new WP_Query( $arg );
	
	// The Loop
	if ( $queryListPages->have_posts() ) {
		
		if ($infiniteScroll) {
			echo '<div id="i-scroll">';
		}
		?>
        <?php
        while ( $queryListPages->have_posts() ) :
            $queryListPages->the_post(); 

            // Appel embed template
            get_template_part( 'template-parts/content', get_post_format() );

        endwhile;
        ?>
        
        <figure style="display:none" class="loader">
            <img src="<?php bloginfo('template_directory');?>/images/loader.gif" alt="">
        </figure>
    <?php
    if ($infiniteScroll) {
        echo '</div> ';
        }
    ?>
    <?php
      the_posts_navigation(array(
                'prev_text' => __( 'Previous page', 'theme-aeris' ),
                'next_text' => __( 'Next page', 'theme-aeris' ),
                'screen_reader_text' => 'Plus de fiches'
            ));
        
    } else {
        get_template_part( 'template-parts/content', 'none' );
    }

    // Restore original Post Data
    wp_reset_postdata();
}

/******************************************************************
* Liste des pages enfants
*/

/*********************
* Function utilisée sur le template template-listchild.php
* Equivalent en shortcode dans custom-shortcode.php : theme_aeris_shortcode_listchild_pages() > [aeris_childpage]
*/

function theme_aeris_listchild_pages( $atts ) {

global $post;

	// The Query
		$queryListChildPages = new WP_Query( $atts );
		
		// The Loop
		if ( $queryListChildPages->have_posts() ) {
			
			?>
	    <?php
	    while ( $queryListChildPages->have_posts() ) :
	        $queryListChildPages->the_post(); 
	
	        // Appel embed template
	        get_template_part( 'template-parts/content', 'listchild' );
	
	    endwhile;
	        
	  }	
	  // Restore original Post Data
    wp_reset_postdata();
}

/******************************************************************
 * Afficher les catégories
 * $categories = get_the_terms( $post->ID, 'category');  
 */

function theme_aeris_show_categories($categories) {
 
  if( $categories ) {
  ?>
  <div class="tag">
  <?php
      foreach( $categories as $categorie ) { 
          if ($categorie->slug !== "non-classe") {
            if( (function_exists('pll_current_language') ) && ( "en" == pll_current_language()) ) {
              echo '<a href="'.site_url().'/'.pll_current_language().'/category/'.$categorie->slug.'" class="'.$categorie->slug.'">';
            }else {
              echo '<a href="'.site_url().'/category/'.$categorie->slug.'" class="'.$categorie->slug.'">';
            }
            echo $categorie->name; 
            ?>                    
          </a>
  <?php 
          }
      }
  ?>
  </div>
<?php
    } 
}

/******************************************************************
* GESTION DES IMAGES
*
* Support des thumbnails (images à la une)
* Tailles d'images
* Paramètre d'attachement par défaut d'une illustration (alignement/lien/taille)
*
*  https://developer.wordpress.org/reference/functions/add_image_size/ 
*/

// active les Post thumbnails (images à la une).
// add_theme_support( 'post-thumbnails' );

/* Ajout de tailles d'images
* https://developer.wordpress.org/reference/functions/add_image_size/
*/
function images_setup() {
    add_image_size( 'illustration-article', 1024, 500, true );
    add_image_size( 'single-article', 1024, 500, false );
    add_image_size( 'embed-article', 1024, 250, false );
    add_image_size( 'post-image', 945, 9999 );
    add_image_size( 'logo-partenaire', 100, 40, false );
 }
add_action( 'after_setup_theme', 'images_setup' );

/* set default attachment setting
* https://writenowdesign.com/blog/wordpress/wordpress-how-to/change-wordpress-default-image-alignment-link-type/
*/
function default_attachment_display_settings() {
    update_option( 'image_default_align', 'none' );
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'medium' );
}
add_action( 'after_setup_theme', 'default_attachment_display_settings' );


// Flexslider function for format-gallery
function theme_aeris_flexslider($size = thumbnail, $post) {

  if ( is_page()) :
    $attachment_parent = $post->ID;
  else : 
    $attachment_parent = get_the_ID();
  endif;

  if($images = get_posts(array(
    'post_parent'    => $attachment_parent,
    'post_type'      => 'attachment',
    'numberposts'    => -1, // show all
    'post_status'    => null,
    'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
  ))) { ?>
  
    <div class="flexslider">
      <ul class="slides">
  
        <?php foreach($images as $image) { 
          $attimg = wp_get_attachment_image($image->ID,$size); ?>
          
          <li>
            <?php echo $attimg; ?>
            <?php if ( !empty($image->post_excerpt) && is_single()) : ?>
              <div class="media-caption-container">
                <p class="media-caption"><?php echo $image->post_excerpt ?></p>
              </div>
            <?php endif; ?>
          </li>
          
        <?php }; ?>
    
      </ul>
      
    </div><?php
    
  }
}

/******************************************************************
* CONVERTISSEUR DE COULEUR HEX > RGB
*
* source : https://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/

function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
  }
  
/******************************************************************
* CACHER L'EDITEUR POUR UN MODELE DE PAGE
*/


add_action( 'admin_head', 'theme_aeris_hide_editor' );
function theme_aeris_hide_editor() {
  $template_file = basename( get_page_template() );
  
  /**
  * CACHER TOUT L'EDITEUR PPOUR LE MODELE HOMEPAGE CUSTOM
  * source : https://gist.github.com/ramseyp/4060095
  */
	if($template_file == 'template-homepage.php'){ // template homepage custom
		remove_post_type_support('page', 'editor');
  } 
  /**
  * CACHER TOUT L'EDITEUR PPOUR LE MODELE CATALOGUE
  * source : https://gist.github.com/ramseyp/4060095
  */
  // if($template_file == 'template-catalogue.php'){ // template catalogue
	// 	echo "<style>.mce-tinymce.mce-container.mce-panel, #content-tmce{display:none;}</style>";
  // } 
}

