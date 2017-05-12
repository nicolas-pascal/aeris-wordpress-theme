<?php

// Enqueue Javascript files
function theme_aeris_load_javascript_files() {

	wp_register_script( 'theme_aeris_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'theme_aeris_flexslider' );
	

}
add_action( 'wp_enqueue_scripts', 'theme_aeris_load_javascript_files' );
?>