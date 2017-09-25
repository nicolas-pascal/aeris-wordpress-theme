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

?>