<?php
/**
 * aeris Theme Customizer
 *
 * @package aeris
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_aeris_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'theme_aeris_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_aeris_customize_preview_js() {
	wp_enqueue_script( 'theme_aeris_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'theme_aeris_customize_preview_js' );


/*****
* 
* Remove des sections inutiles
* 
*/

function theme_aeris_customizer_remove_section( $wp_customize )
{
// remove section colors
$wp_customize->remove_section('colors');
// remove section background image
// $wp_customize->remove_section('background_image');
}
add_action( 'customize_register', 'theme_aeris_customizer_remove_section' );

/*************************************************************************************************************
*  Ajout des supports de l'image d'entête personnalisée et du background-image dans le customizer
*
*/

$args = array(
	'width'         => 1600,
	'height'        => 300,
	'default-image' => get_template_directory_uri() . '/images/atmosphere-cover.jpg',
);
add_theme_support( 'custom-header', $args );

$defaults = array(
	'default-color'          => 'FFFFFF',
	'default-image'          => '',
	'default-repeat'         => 'repeat',
	'default-position-x'     => 'left',
        'default-position-y'     => 'top',
        'default-size'           => 'auto',
	'default-attachment'     => 'cover',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

/**************************************************************************************************************
*  Ajout du controleur de couleur personnalisée dans le customizer
*
*  source : https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
*/

function theme_aeris_customize_color( $wp_customize )
{
   //All our sections, settings, and controls will be added here

   //1. Define a new section (if desired) to the Theme Customizer
 	$wp_customize->add_section('theme_aeris_color_scheme', array(
        'title'    => __('Theme options', 'theme-aeris'),
        'description' => '',
        'priority' => 30,
    ));

//2. Register new settings to the WP database...

    //  =============================
    //  = Radio Input for Light/Dark side  =
    //  =============================
    $wp_customize->add_setting('theme_aeris_ambiance', array(
        'default'        => 'light',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));

    $wp_customize->add_control('theme_aeris_ambiance', array(
        'label'      => __('Ambiance du thème', 'theme_aeris'),
        'description'=> __('Choisissez votre ambiance, claire ou foncée', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_ambiance',
        'type'       => 'radio',
        'choices'    => array(
            'light' => 'Light',
            'dark' => 'Dark',
        ),
    ));


    //  =================================
    //  = Select Box pour theme color   =
    //  =================================
     $wp_customize->add_setting('theme_aeris_main_color', array(
        'default'        => 'custom',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));
 
//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
	
	$wp_customize->add_control( 'theme_aeris_main_color', array(
        'settings' => 'theme_aeris_main_color',
        'label'   => 'Sélectionner une couleur dominante:',
        'section' => 'theme_aeris_color_scheme',
        'type'    => 'select',
        'choices'    => array(        	
            '#90BCD1' => 'Bleu clair (Atmosphere)',
            '#08A5E0' => 'Bleu clair 2 (Pic du Midi)',
            '#1F7E9E' => 'Bleu océan (Hydrosphère)',
            '#4765a0' => 'Bleu (Aeris)',
            '#2D4F59' => 'Bleu foncé (Astronomie)',
            '#B6CC49' => 'Vert clair (Biosphère)',
            '#7DBF3B' => 'Vert foncé Environnement',
            '#DD9946' => 'Orange (Géosciences)',
            '#E25B3D' => 'Rouge (Planétologie)',
            '#CCC' => 'Gris clair',
            '#AAA' => 'Gris',
            '#777' => 'Gris foncé',
            '#000' => 'Noir',
			'custom' => 'Autre, remplir le champs "code couleur personnalisé"',
        ),
    ));

	//  ==================================
    //  = Text Input Main color code     =
    //  ==================================
    $wp_customize->add_setting('theme_aeris_color_code', array(
        'default'        => '#CCC',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_color_code', array(
        'label'      => __('...ou un code couleur personnalisé', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_color_code',
    )));

    //  =======================================
    //  = Text Input Secondary color code     =
    //  =======================================
    $wp_customize->add_setting('theme_aeris_second_color_code', array(
        'default'        => '#AAA',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_second_color_code', array(
        'label'      => __('Couleur secondaire', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_second_color_code',
    )) );

    //  =======================================
    //  = Text Input text color code     =
    //  =======================================
    $wp_customize->add_setting('theme_aeris_text_color_code', array(
        'default'        => '#FFF',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_text_color_code', array(
        'label'      => __('Couleur des textes sur les blocks utilisant la couleur dominante', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_text_color_code',
    )) );

    //  =======================================
    //  = Text Input Link hover color code     =
    //  =======================================
    $wp_customize->add_setting('theme_aeris_link_hover_color_code', array(
        'default'        => '#009FDE',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_link_hover_color_code', array(
        'label'      => __('Couleur de survol des liens', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_link_hover_color_code',
    )) );

    //  =======================================
    //  = Text Input Footer background color code        =
    //  =======================================
    $wp_customize->add_setting('theme_aeris_footer_background_color_code', array(
        'default'        => '#CCC',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_footer_background_color_code', array(
        'label'      => __('Couleur de fond du footer', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_footer_background_color_code',
    )) );
    //  =======================================
    //  = Text Input Footer text color code        =
    //  =======================================
    $wp_customize->add_setting('theme_aeris_footer_text_color_code', array(
        'default'        => '#333',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'theme_aeris_footer_text_color_code', array(
        'label'      => __('Couleur des textes du footer', 'theme_aeris'),
        'description'=> __('Préferez une couleur de texte foncé sur fond clair, et inversement', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_footer_text_color_code',
    )) );

    //  =============================
    //  = Radio Input boxes or not  =
    //  =============================
    $wp_customize->add_setting('theme_aeris_box', array(
        'default'        => 'nobox',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));

    $wp_customize->add_control('theme_aeris_box', array(
        'label'      => __('Display mode', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_box',
        'type'       => 'radio',
        'choices'    => array(
            'box' => 'Tous en boîte',
            'nobox' => 'Aplat',
        ),
    ));

    //  =============================
    //  = Checkbox breadcrumb       =
    //  =============================
    $wp_customize->add_setting('theme_aeris_breadcrumb', array(
        'default'        => 'false',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control('theme_aeris_breadcrumb', array(
        'label'      => __('Afficher le fil d\'ariane sur les pages', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_breadcrumb',
        'type'       => 'checkbox',
    ));

	//  =============================
    //  = Text Input copyright     =
    //  =============================
    $wp_customize->add_setting('theme_aeris_copyright', array(
        'default'        => 'Pôle Aeris '.date('Y').' - Service de données OMP (SEDOO)',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control('theme_aeris_copyright', array(
        'label'      => __('© Copyright', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_copyright',
    ));

}
add_action( 'customize_register', 'theme_aeris_customize_color' );


/*****
* 
* Main code couleur en fonction du choix utilisateur
* 
*/

function theme_aeris_main_color(){

    if (get_theme_mod('theme_aeris_main_color') == "custom" ) {
		$code_color = get_theme_mod( 'theme_aeris_color_code' );
	}
	else {
		$code_color	= get_theme_mod( 'theme_aeris_main_color' );
    }
    return $code_color;
}

/*****
* 
* chargement du code couleur selectionné ou saisi
* 
*/

function theme_aeris_color_style() {
	
	// if (get_theme_mod('theme_aeris_main_color') == "custom" ) {
	// 	$code_color = get_theme_mod( 'theme_aeris_color_code' );
	// }
	// else {
	// 	$code_color	= get_theme_mod( 'theme_aeris_main_color' );
	// }

    $code_color=theme_aeris_main_color();

	$rgb_color = hex2rgb($code_color); // array 0 => r , 1 => g, 2 => b
    
	?>
         <style type="text/css">
			h1,
			h2,
			h3,
			blockquote,
			.main-navigation ul ul li:first-child,
			.main-navigation .nav-menu > .current_page_item > a,
			.main-navigation .nav-menu > .current-menu-item > a,
			.main-navigation .nav-menu > .current_page_ancestor > a,
			.main-navigation .nav-menu > .current-menu-ancestor > a,
            [role="listNews"] article > header,
            .toc-left [role="sommaire"] li.active ul{
            /* .Aeris-seeAllButton { */
				border-color: <?php echo $code_color;?>; 
			}

			a,
			.main-navigation .nav-menu > li > a:hover,
			.main-navigation .nav-menu > li > a:focus,
			.main-navigation .nav-menu > .current_page_item > a,
			.main-navigation .nav-menu > .current-menu-item > a,
			.main-navigation .nav-menu > .current_page_ancestor > a,
			.main-navigation .nav-menu > .current-menu-ancestor > a,
            .toc-left [role="sommaire"] li.active a        
			{
				color: <?php echo $code_color;?>;
			}

			.bkg,
			[role="listNews"] article.format-quote > header > blockquote,
            [role="listProgram"] > header > h2,
            .Aeris-seeAllButton,            
            #cookie-notice .button,
            body .tag a:hover
             {
                background: <?php echo $code_color;?>;
                color:<?php echo get_theme_mod( 'theme_aeris_text_color_code' );?>;
			}
            
			a:hover,
			a:focus,
			a:active {
				color: <?php echo get_theme_mod( 'theme_aeris_link_hover_color_code' );?>;
			}

            .site-branding h1 a,
            .site-branding h1 span,
            #cookie-notice .button:hover {
                background-color: rgba(<?php echo $rgb_color[0].",".$rgb_color[1].",".$rgb_color[2].",.5)"; ?>;
                color:<?php echo get_theme_mod( 'theme_aeris_text_color_code' );?>;
            }
            
            [id="page"] > footer {
                background-color:<?php echo get_theme_mod( 'theme_aeris_footer_background_color_code');?>;
                
            }
            [id="page"] > footer,
            [id="page"] > footer a, 
            [id="page"] > footer h2 {
                color:<?php echo get_theme_mod( 'theme_aeris_footer_text_color_code');?>;
            }

         </style>
    <?php

}
add_action( 'wp_head', 'theme_aeris_color_style');

// Fonction renvoyant les valeurs du customizer "Options du thème / Ambiance & Display mode
function theme_aeris_bodyAttribute() {
    
    if( get_theme_mod( 'theme_aeris_ambiance' ) == "dark") {
        // wp_enqueue_style('theme_aeris_ambiance', get_bloginfo('template_directory') . '/css/dark.css');
        $classes['ambiance'] = "darkTheme";
    } else {
        $classes['ambiance'] = "lightTheme";
    }

	// le if == "value1" est une vieillerie, non supprimable !! tous les vieux sites sont parametrés avec cette valeur... bref, j'avais codé comme un con...
	if(( get_theme_mod( 'theme_aeris_box' ) == "value1") || (get_theme_mod( 'theme_aeris_box' ) == "box")) {
        $classes['box'] = "boxes";
	    // wp_enqueue_style('theme-aeris-box', get_bloginfo('template_directory') . '/css/boxes.css');
    }else {
        $classes['box'] = "nobox";
    }
    return $classes;
}

/******************************************************************
* Ajout du css custom dans le customizer 
*/
function custom_customize_enqueue() {
    wp_enqueue_style('custom-css-customize', get_bloginfo('template_directory') . '/css/customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );
?>