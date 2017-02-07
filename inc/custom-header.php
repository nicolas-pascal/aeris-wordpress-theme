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

/*****
*  Ajout du support de l'image d'entête personnalisée dans le customizer
*
*/

$args = array(
	'width'         => 1600,
	'height'        => 300,
	'default-image' => get_template_directory_uri() . '/images/atmosphere-cover.jpg',
);
add_theme_support( 'custom-header', $args );

/*****
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
        'title'    => __('Couleur du thème', 'theme-aeris'),
        'description' => '',
        'priority' => 30,
    ));

//2. Register new settings to the WP database...

    //  =============================
    //  = Select Box                =
    //  =============================
     $wp_customize->add_setting('theme_aeris_main_color', array(
        'default'        => 'atmosphere',
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
            'atmosphere' => 'Bleu clair (Atmosphere)',
            'picdumidi' => 'Bleu clair 2 (Pic du Midi)',
            'hydrosphere' => 'Bleu océan (Hydrosphère)',
            'astronomie' => 'Bleu foncé (Astronomie)',
            'biosphere' => 'Vert clair (Biosphère)',
            'environnement' => 'Vert foncé Environnement',
            'geosciences' => 'Orange (Géosciences)',
            'planetologie' => 'Rouge (Planétologie)',
        ),
    ));
}
add_action( 'customize_register', 'theme_aeris_customize_color' );

/*****
* 
* chargement de la feuille de style de couleur personnalisée
* 
*/

function theme_aeris_color_style() {
	
	// if(get_theme_mod( 'theme_aeris_theme_color' ) == 'atmosphere'){
	$theme_color= get_theme_mod( 'theme_aeris_main_color' );

	wp_enqueue_style('theme-aeris-color', get_bloginfo('template_directory') . '/css/'.$theme_color.'.css');

}
add_action( 'wp_enqueue_scripts', 'theme_aeris_color_style' );

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
