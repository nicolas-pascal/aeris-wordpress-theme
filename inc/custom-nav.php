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

/** Adding custom visibility rules in a plugin or theme
* Custom visibility rules can be added easily by any plugin or theme.
* Example of adding a new rule for displaying/hiding a menu item when current page is a custom-post-type.
*/
// theme's functions.php or plugin file
add_filter('if_menu_conditions', 'theme_aeris_menu_conditions');

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


?>