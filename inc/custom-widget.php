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


    /**** HOMEPAGE AREA  *****/

    $args = array(
        'id'            => 'homepage-top-widget-area',
        'class'         => 'homepage-top-widget-area',
        'name'          => __( 'homepage-top', 'text_domain' ),
        'description'   => esc_html__( 'Ajouter des widgets ici.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
        'id'            => 'homepage-mdleft-widget-area',
        'class'         => 'homepage-mdleft-widget-area',
        'name'          => __( 'homepage milieu gauche', 'text_domain' ),
        'description'   => esc_html__( 'Ajouter des widgets ici.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

        $args = array(
        'id'            => 'homepage-mdright-widget-area',
        'class'         => 'homepage-mdright-widget-area',
        'name'          => __( 'homepage milieu droit', 'text_domain' ),
        'description'   => esc_html__( 'Ajouter des widgets ici.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
        'id'            => 'homepage-footer-widget-area',
        'class'         => 'homepage-footer-widget-area',
        'name'          => __( 'homepage pre footer', 'text_domain' ),
        'description'   => esc_html__( 'Ajouter des widgets ici.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

}
add_action( 'widgets_init', 'wpaeris_custom_sidebars' );

?>