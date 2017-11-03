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
        'description'   => esc_html__( 'Add image widgets here.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
    'id'            => 'partners',
    'class'         => 'partners-widget',
    'name'          => __( 'List of logos', 'theme-aeris' ),
    'description'   => esc_html__( 'Add image widgets here.', 'theme-aeris' ),
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
        'name'          => __( 'homepage top', 'theme-aeris' ),
        'description'   => esc_html__( 'Add widgets here.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
        'id'            => 'homepage-mdleft-widget-area',
        'class'         => 'homepage-mdleft-widget-area',
        'name'          => __( 'homepage center left', 'theme-aeris' ),
        'description'   => esc_html__( 'Add widgets here.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

        $args = array(
        'id'            => 'homepage-mdright-widget-area',
        'class'         => 'homepage-mdright-widget-area',
        'name'          => __( 'homepage middle right', 'theme-aeris' ),
        'description'   => esc_html__( 'Add widgets here.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    );
    register_sidebar( $args );

    $args = array(
        'id'            => 'homepage-footer-widget-area',
        'class'         => 'homepage-footer-widget-area',
        'name'          => __( 'homepage pre footer', 'theme-aeris' ),
        'description'   => esc_html__( 'Add widgets here.', 'theme-aeris' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
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