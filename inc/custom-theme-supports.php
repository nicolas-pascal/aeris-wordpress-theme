<?php

function theme_aeris_support() {

// POST FORMATS
// https://developer.wordpress.org/themes/functionality/post-formats/

add_theme_support('post-formats', array('video', 'gallery', 'link'));

}

add_action('after_setup_theme','theme_aeris_support');

?>