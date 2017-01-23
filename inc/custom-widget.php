<?php


/******************************************************************
* WIDGETS AREA 
*/


// Register Sidebars
function wpaeris_custom_sidebars() {

    $args = array(
        'id'            => 'footer-widget-area',
        'class'         => 'footer-widget-area',
        'name'          => __( 'Footer', 'text_domain' ),
        'description'   => esc_html__( 'Ajouter des widgets ici.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
    'id'            => 'partners',
    'class'         => 'partners-widget',
    'name'          => __( 'Foire aux Logos', 'text_domain' ),
    'description'   => esc_html__( 'Ajouter des Images widgets ici.', 'theme-aeris' ),
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'wpaeris_custom_sidebars' );


/******************************************************************
* WIDGET PARTENAIRES
*/

//require get_template_directory() . '/inc/widgets/custom-widget-partenaires.php';




?>