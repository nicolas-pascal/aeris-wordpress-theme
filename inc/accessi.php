<?php
/******************************************************************
* ACCESSIBILITE
*/

//Title Tag
add_theme_support('title-tag');

/*
 * Modify TinyMCE editor to remove H1.
 * source : https://www.jowaltham.com/modify-tinymce-editor/
 */
/*
*     ###### A EVALUER... ######
*  
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;Heading 1=h2;Heading 2=h3;Heading 3=h4;Heading 4=h5;Heading 5=h6;Heading 6=h6;Address=address;Pre=pre';
	return $init;
}
*/