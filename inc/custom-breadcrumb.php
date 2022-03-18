<?php
/*****
*  Function d'affichage du breadcrumb
*  source : https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
*/

function the_breadcrumb() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
  

    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<nav aria-label="Fil d\'Ariane / breadcrumbs" role="breadcrumbs">';
       
        // Home page
        echo '<a href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a>';
        echo '<span class="delimiter"> ' . $separator . ' </span>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
        	
        	//@author epointal add case events
        	if( !isset($prefix) ){
        		$prefix = '';
        	
        		if( isset($wp_query->query['post_type']) && $wp_query->query['post_type']== 'tribe_events'
        				&& post_type_archive_title('',false)== ''){
        
        			$prefix = __('Events','the-events-calendar');
        		}
        	} // end add case events
            echo '<span class="current">' . post_type_archive_title($prefix, false) . '</span>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
        
            // If post is a custom post type
            $post_type = get_post_type();
          
            // If it is a custom post type display name and link
            if($post_type != 'post' ) {
                
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                $titleItem=mb_strimwidth($post_type_object->labels->name, 0, 20, '...');
                echo '<a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $titleItem . '</a>';
                echo '<span class="delimiter"> ' . $separator . ' </span>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<span class="current">' . $custom_tax_name . '</span>';
              
        } else if ( is_single() ) {
        	
        
            // If post is a custom post type
            $post_type = get_post_type();
            
            //@author epointal case tribe_events
            if( $post_type === 'page' && isset($wp_query->query['post_type']) &&  $wp_query->query['post_type']=== 'tribe_events'){
            	if( class_exists('Tribe__Events__Main')){
	            	
            		echo '<a href="'.  Tribe__Events__Main::instance()->getLink() .'" title="'.__('Events', 'the-events-calendar').'">'. __('Events', 'the-events-calendar').'</a>';
            		if(isset( $wp_query->query['tribe_events'])){
            			echo '<span class="delimiter"> ' . $separator . '</span>';
            			echo '<span class="current"> '. get_the_title( $wp_query->posts[0] ).'</span>';
            		}
	            	$post_type = 'tribe_events';
            	}
            }
           
            // If it is a custom post type display name and link
            if($post_type != 'post' && $post_type != 'tribe_events') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                $titleItem=mb_strimwidth($post_type_object->labels->name, 0, 20, '...');
              
                echo '<a href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $titleItem . '</a>';
                echo '<span class="delimiter"> ' . $separator . '</span>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end($category);
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= ''.$parents.'';
                    $cat_display .= '<span class="delimiter"> ' . $separator . ' </span>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
            $titleItem=mb_strimwidth(get_the_title(), 0, 40, '...');  
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<span class="current">' . $titleItem . '</span>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                echo '<a href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a>';
                echo '<span class="delimiter"> ' . $separator . ' </span>';
                echo '<span class="current">' . $titleItem . '</span>';
              
            } else {
                echo '<span class="current">' . $titleItem . '</span>';
                  
            }
              
        } else if ( is_category() ) {
             
            // Category page
            echo '<span class="current item-cat">' . single_cat_title('', false) . '</span>';
               
        } else if ( is_page() ) {
    		
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $titleItem=mb_strimwidth(get_the_title($ancestor), 0, 20, '...');
                    $parents .= '<a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . $titleItem . '</a>';
                    $parents .= '<span class="delimiter"> ' . $separator . ' </span>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                $titleItem=mb_strimwidth(get_the_title(), 0, 40, '...');
                echo '<span class="current">' . $titleItem . '</span>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<span class="current">' . get_the_title() . '</span>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<span class="current">' . $get_term_name . '</span>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo '<span class="delimiter' . get_the_time('Y') . '"> ' . $separator . ' ';
               
            // Month link
            echo '<a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a>';
            echo '<span class="delimiter' . get_the_time('m') . '"> ' . $separator . ' ';
               
            // Day display
            echo '<span class="current">' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives </span>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a>';
            echo '<span class="delimiter"> ' . $separator . ' ';
               
            // Month display
            echo '<span class="item-month item-month-' . get_the_time('m') . '">' . get_the_time('M') . ' Archives </span>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<span class="current">' . get_the_time('Y') . ' Archives</span>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<span class="current">' . 'Author: ' . $userdata->display_name . '';
           
        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<span class="current">'.__('Page') . ' ' . get_query_var('paged') . '';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<span class="current">Search results for: ' . get_search_query() . '';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<span>' . 'Error 404' . '</span>';
        }
       
        echo '</nav>';
           
    }
       
}

?>