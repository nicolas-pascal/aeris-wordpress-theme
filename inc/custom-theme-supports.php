<?php

function theme_aeris_support() {

// POST FORMATS
// https://developer.wordpress.org/themes/functionality/post-formats/

add_theme_support('post-formats', array(
	'gallery',
	'quote',
	'video',
	'aside',
	'image',
	'link',
	'status',
	'audio',
	//'chat'
	));

}

add_action('after_setup_theme','theme_aeris_support');

?>