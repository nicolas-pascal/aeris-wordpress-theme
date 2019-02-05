<?php

// Enqueue Javascript files
function theme_aeris_load_javascript_files() {
	if ( is_page_template('template-toc-left.php') ) {
		wp_enqueue_script('theme_aeris_jquery_sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '', false );
		wp_enqueue_script('theme_aeris_toc', get_template_directory_uri() . '/js/toc.js', array('jquery'), '', false );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_aeris_load_javascript_files' );
?>