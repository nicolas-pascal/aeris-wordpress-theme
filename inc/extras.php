<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aeris
 */

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


/*****
*  Function d'affichage du breadcrumb
*  source : http://www.techpulsetoday.com/wordpress-breadcrumbs-without-plugin/
*/
     
 function the_breadcrumb() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<span class="delimiter">/</span>'; // delimiter between crumbs   >> '&raquo;'
  $home = 'Home'; // text for the 'Home' link  
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<nav aria-label="Fil d\'Ariane / breadcrumbs" role="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></nav aria-label="breadcrumbs">';
 
  } else {
 
    echo '<nav aria-label="Fil d\'Ariane / breadcrumbs" role="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . '' . single_cat_title('', false) . '' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</nav>';
 
  }
} // end the_breadcrumb()

// Change the length of excerpts
function custom_excerpt_length( $length ) {
  return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/******************************************************************
* Creation de liste des pages en fonction d'arguments passés à WP_Query()
* Appelle le template content-embed-page.php
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
                'prev_text' => __( 'Page précédente', 'textdomain' ),
                'next_text' => __( 'Page suivante', 'textdomain' ),
                'screen_reader_text' => 'Plus de fiches'
            ));
        
    } else {
        get_template_part( 'template-parts/content', 'none' );
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
          echo '<a href="'.site_url().'/category/'.$categorie->slug.'" class="'.$categorie->slug.'">';

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
add_theme_support( 'post-thumbnails' );

/* Ajout de tailles d'images
* https://developer.wordpress.org/reference/functions/add_image_size/
*/
function images_setup() {
    add_image_size( 'illustration-article', 1024, 500, true );
    add_image_size( 'embed-article', 1024, 250, false );
    add_image_size( 'post-image', 945, 9999 );
    add_image_size( 'logo-partenaire', 100, 40, false );
 }
add_action( 'after_setup_theme', 'images_setup' );



// Flexslider function for format-gallery
function theme_aeris_flexslider($size = thumbnail) {

  // if ( is_page()) :
  //   $attachment_parent = the_ID(); //$post->ID;
  // else : 
  //   $attachment_parent = get_the_ID();
  // endif;
  if($images = get_posts(array(
    'post_parent'    => get_the_ID(),//$attachment_parent,
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
