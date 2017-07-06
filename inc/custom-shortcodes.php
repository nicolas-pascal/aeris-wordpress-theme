<?php

/*********************
* Shortcode permettant de lister les éléments enfants 
* Default : list des pages du post courant
* Attributs possibles ou d'un post->ID donnée
*/

function theme_aeris_shortcode_listchild_pages( $atts ) {
// begin output buffering
ob_start();

global $post;
$default_attributes = array(
        'post_parent'    => $post->ID,
        'post_type'      => 'page',
        'posts_per_page' => '-1',
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
      );
	// Attributes
    $atts = shortcode_atts( $default_attributes, $atts);

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
    
    // end output buffering, grab the buffer contents, and empty the buffer
    return ob_get_clean();
	  // Restore original Post Data
    wp_reset_postdata();
}

// ajout du bouton dans TinyMCE
function theme_aeris_register_button( $buttons ) {
   array_push( $buttons, "|", "listchild" );
   return $buttons;
}
// ajout du script js pour le bouton dans TinyMCE
function theme_aeris_add_plugin( $plugin_array ) {
   $plugin_array['listchild'] = get_template_directory_uri() . '/js/listchild-shortcode-button.js';
   return $plugin_array;
}

function theme_aeris_shortcode_listchild_pages_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'theme_aeris_add_plugin' );
      add_filter( 'mce_buttons', 'theme_aeris_register_button' );
   }

}

add_action('init', 'theme_aeris_shortcode_listchild_pages_button');

/*********************
* Register the Shortcode
*/

function theme_aeris_register_shortcodes() {

    add_shortcode( 'aeris_childpage', 'theme_aeris_shortcode_listchild_pages' );

}
add_action( 'init', 'theme_aeris_register_shortcodes');
?>