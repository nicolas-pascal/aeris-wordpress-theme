<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package aeris
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses theme_aeris_header_style()
 */
function theme_aeris_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'theme_aeris_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'theme_aeris_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'theme_aeris_custom_header_setup' );

/*****
*  Ajout du support du logo dans le customizer
*
*/

function theme_aeris_logo_setup() {
	add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
	) ) ;
}
add_action( 'after_setup_theme', 'theme_aeris_logo_setup' );

function theme_aeris_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

}

/*************************************************************************************************************
*  Ajout du support de l'image d'entête personnalisée dans le customizer
*
*/

$args = array(
	'width'         => 1600,
	'height'        => 300,
	'default-image' => get_template_directory_uri() . '/images/atmosphere-cover.jpg',
);
add_theme_support( 'custom-header', $args );

/**************************************************************************************************************
*  Ajout du controleur de couleur personnalisée dans le customizer
*
*  source : https://codex.wordpress.org/Plugin_API/Action_Reference/customize_register
*/

function theme_aeris_customize_color( $wp_customize )
{
   //All our sections, settings, and controls will be added here

// remove section colors
	$wp_customize->remove_section('colors');

//1. Define a new section (if desired) to the Theme Customizer
 	$wp_customize->add_section('theme_aeris_color_scheme', array(
        'title'    => __('Options du thème', 'theme-aeris'),
        'description' => '',
        'priority' => 30,
    ));

//2. Register new settings to the WP database...

    //  =================================
    //  = Select Box pour theme color   =
    //  =================================
     $wp_customize->add_setting('theme_aeris_main_color', array(
        'default'        => 'custom',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));
 
//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
	
    // $wp_customize->add_control( 'theme_aeris_main_color', array(
    //     'settings' => 'theme_aeris_main_color',
    //     'label'   => 'Sélectionner une couleur dominante:',
    //     'section' => 'theme_aeris_color_scheme',
    //     'type'    => 'select',
    //     'choices'    => array(        	
    //         'atmosphere' => 'Bleu clair (Atmosphere)',
    //         'picdumidi' => 'Bleu clair 2 (Pic du Midi)',
    //         'hydrosphere' => 'Bleu océan (Hydrosphère)',
    //         'aeris' => 'Bleu (Aeris)',
    //         'astronomie' => 'Bleu foncé (Astronomie)',
    //         'biosphere' => 'Vert clair (Biosphère)',
    //         'environnement' => 'Vert foncé Environnement',
    //         'geosciences' => 'Orange (Géosciences)',
    //         'planetologie' => 'Rouge (Planétologie)',
    //         'gray1' => 'Gris clair',
    //         'gray2' => 'Gris',
    //         'gray3' => 'Gris foncé',
    //         'black' => 'Noir',
	// 		'custom' => 'Code couleur personnalisé, remplir le champs ci-dessous',
    //     ),
    // ));
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

	//  =============================
    //  = Text Input color code     =
    //  =============================
    $wp_customize->add_setting('theme_aeris_color_code', array(
        'default'        => '#CCC',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
 
    ));

	$wp_customize->add_control('theme_aeris_color_code', array(
        'label'      => __('...ou un code couleur personnalisé', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_color_code',
    ));


    //  =============================
    //  = Radio Input boxes or not  =
    //  =============================
    $wp_customize->add_setting('theme_aeris_box', array(
        'default'        => 'nobox',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
    ));

    $wp_customize->add_control('theme_aeris_box', array(
        'label'      => __('Mode d\'affichage', 'theme_aeris'),
        'section'    => 'theme_aeris_color_scheme',
        'settings'   => 'theme_aeris_box',
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Tous en boîte',
            'value2' => 'Aplat',
        ),
    ));

	//  =============================
    //  = Text Input copyright     =
    //  =============================
    $wp_customize->add_setting('theme_aeris_copyright', array(
        'default'        => 'Pôle Aeris '.date('Y').'- Service de données OMP (SEDOO)',
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
* chargement du code couleur selectionné ou saisi
* 
*/

function theme_aeris_color_style() {
	
	if (get_theme_mod('theme_aeris_main_color') == "custom" ) {
		$code_color = get_theme_mod( 'theme_aeris_color_code' );
	}
	else {
		$code_color	= get_theme_mod( 'theme_aeris_main_color' );
	}

	$rgb_color = hex2rgb($code_color); // array 0 => r , 1 => g, 2 => b
	
	//wp_enqueue_style('theme-aeris-color', get_bloginfo('template_directory') . '/css/'.$theme_color.'.css');
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
			.main-navigation .nav-menu > .current-menu-ancestor > a {
				border-color: <?php echo $code_color;?>; 
			}

			a,
			a:visited,
			.main-navigation .nav-menu > li > a:hover,
			.main-navigation .nav-menu > li > a:focus,
			.main-navigation .nav-menu > .current_page_item > a,
			.main-navigation .nav-menu > .current-menu-item > a,
			.main-navigation .nav-menu > .current_page_ancestor > a,
			.main-navigation .nav-menu > .current-menu-ancestor > a
			{
				color: <?php echo $code_color;?>;
			}

			aside .widget-title,
			.bkg,
			[role="listNews"] article.format-quote > header > blockquote {
				background: <?php echo $code_color;?>;
			}

			a:hover,
			a:focus,
			a:active {
				color: #009FDE;
			}

			.site-branding h1 {
				background-color: rgba(<?php echo $rgb_color[0].",".$rgb_color[1].",".$rgb_color[2].",.5)";?>;
			}
         </style>
    <?php

}
// add_action( 'wp_enqueue_scripts', 'theme_aeris_color_style' );
add_action( 'wp_head', 'theme_aeris_color_style');

/*****
* 
* Ajout des styles Boxes
* 
*/

function theme_aeris_box_style() {
	
	if( get_theme_mod( 'theme_aeris_box' ) == "value1") {
	wp_enqueue_style('theme-aeris-box', get_bloginfo('template_directory') . '/css/boxes.css');
	}

}
add_action( 'wp_enqueue_scripts', 'theme_aeris_box_style' );
/*****
* 
* chargement de la feuille de style d'icones
* 
*/

function theme_aeris_icons_font() {
	
	wp_enqueue_style('theme-aeris-icon', get_bloginfo('template_directory') . '/css/icon-aeris.css');

}
add_action( 'wp_enqueue_scripts', 'theme_aeris_icons_font' );

/************************************************************/

if ( ! function_exists( 'theme_aeris_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see theme_aeris_custom_header_setup().
 */
function theme_aeris_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


/******************************************************************
* Ajout du css custom dans le customizer 
*/
function custom_customize_enqueue() {
    wp_enqueue_style('custom-css-customize', get_bloginfo('template_directory') . '/css/customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );
