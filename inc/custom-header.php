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
* 
* chargement de la feuille de style d'icones
* 
*/

function theme_aeris_icons_font() {
	
	wp_enqueue_style('theme-aeris-icon', get_bloginfo('template_directory') . '/css/icon-aeris.css');

}
add_action( 'wp_enqueue_scripts', 'theme_aeris_icons_font' );

function theme_aeris_google_fonts() {
	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Nunito+Sans:400,600', false );
	}
	add_action( 'wp_enqueue_scripts', 'theme_aeris_google_fonts' );

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
?>
