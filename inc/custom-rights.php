<?php
/**
 * aeris Theme Customizer
 *
 * @package aeris
 */

function theme_aeris_add_theme_caps() {
    // gets the author role
    $role = get_role( 'administrator' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'unfiltered_html' ); 
}
add_action( 'admin_init', 'theme_aeris_add_theme_caps');

/* Hide admin bar when user have subscriber role */
// add_action('set_current_user', 'theme_aeris_hide_admin_bar');

function theme_aeris_hide_admin_bar() {
    if (!current_user_can('edit_posts')) {
        return false;
    }
    else {
        return true;
    }
}
add_filter('show_admin_bar', 'theme_aeris_hide_admin_bar');

