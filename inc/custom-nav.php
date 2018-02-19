<?php
/******************************************************************
* MENU FRONT END
*
* fonctions affectant les menus en front end
* register_menu_location() -> Ajoute des emplacements de menu
*/


/** 
 * Ajout d'emplacements de menu
*/
function theme_aeris_register_menu_location() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      // 'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'theme_aeris_register_menu_location' );

/** 
 * Ajout des liens login/logout au menu header
 * source : https://profilepress.net/register-login-logout-links-wordpress-menu/
*/
function theme_aeris_add_login_logout_register_menu( $items, $args ) {
  if ( $args->theme_location != 'header-menu' ) {
  return $items;
  }
  
  if ( is_user_logged_in() ) {
  $items .= '<li><a href="' . wp_logout_url() . '"><i class="fa fa-sign-out"></i> ' . __( 'Log Out' ) . '</a></li>';
  } else {
  $items .= '<li><a href="' . wp_login_url() . '"><i class="fa fa-sign-in"></i> ' . __( 'Log In' ) . '</a></li>';
  // $items .= '<li><a href="' . wp_registration_url() . '">' . __( 'Sign Up' ) . '</a></li>';
  }
  
  return $items;
 }
  
add_filter( 'wp_nav_menu_items', 'theme_aeris_add_login_logout_register_menu', 199, 2 );

/** Adding custom visibility rules in a plugin or theme
* Custom visibility rules can be added easily by any plugin or theme.
* Example of adding a new rule for displaying/hiding a menu item when current page is a custom-post-type or custom template
*
* Ajoute au plugin "If Menu" la possibilité de filtrer sur le modèle "template catalogue"
*/
function theme_aeris_menu_conditions($conditions) {

  $conditions[] = array(
    'id'        =>  'single-my-custom-post-type',           // unique ID for the condition
    'name'      =>  __('If template catalogue', 'i18n-domain'),     // name of the condition
    'condition' =>  function($item) {                       // callback - must return Boolean
      return is_page_template('template-catalogue.php');
    }
  );

  return $conditions;
}
add_filter('if_menu_conditions', 'theme_aeris_menu_conditions');

?>