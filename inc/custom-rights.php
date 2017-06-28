<?php
/**
 * aeris Theme Customizer
 *
 * @package aeris
 */


function add_theme_caps() {
    // gets the author role
    $role = get_role( 'administrator' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'unfiltered_html' ); 
}
add_action( 'admin_init', 'add_theme_caps');

