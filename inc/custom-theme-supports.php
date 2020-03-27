<?php

// function theme_aeris_support() {

// POST FORMATS
// https://developer.wordpress.org/themes/functionality/post-formats/

// add_theme_support('post-formats', array(
// 	'gallery',
// 	'quote',
// 	// 'video',
// 	// 'aside',
// 	// 'image',
// 	// 'link',
// 	// 'status',
// 	// 'audio',
// 	//'chat'
// 	));
// }

// add_action('after_setup_theme','theme_aeris_support');

// Ajouter l'image à la une dans le flux RSS
function theme_aeris_post_thumbnail($content) {
	global $post;
	$content ='';

	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID , 'full') . '</p>' . get_the_excerpt();
	}
	return $content;
}
add_filter('the_excerpt_rss', 'theme_aeris_post_thumbnail');
add_filter('the_content_feed', 'theme_aeris_post_thumbnail');

?>