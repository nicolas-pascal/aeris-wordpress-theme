<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<?php
$themeAmbiance = theme_aeris_bodyAttribute();
?>
<body <?php body_class(); ?> data-themeAmbiance="<?php echo $themeAmbiance['ambiance'];?>" data-themeDisplay="<?php echo $themeAmbiance['box'];?>" data-color="<?php echo theme_aeris_main_color();?>" data-secondary-color="<?php echo get_theme_mod( 'theme_aeris_second_color_code' );?>" data-text-color="<?php echo get_theme_mod( 'theme_aeris_text_color_code' );?>" data-link-hover-color="<?php echo get_theme_mod( 'theme_aeris_link_hover_color_code' );?>">
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content-area"><?php esc_html_e( 'Skip to content', 'theme-aeris' ); ?></a>

	<header id="masterhead" class="site-header" role="banner">
		<?php 
			/***
			* init var header
			*/

			// logo
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); 

			// Description (slogan)
			$description = get_bloginfo( 'description', 'display' );

		?>
		<div class="wrapper">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php if (!$image) { ?>class="nologo"<?php }?>>
				<?php if ($image) {?>
				<img src="<?php echo $image[0];?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?> : <?php echo $description;?>">
				<?php } else {?>
					<?php bloginfo( 'name' ); ?>

				<?php }?>
			</a>
			<div>
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Menu principal / Main menu">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="fa fa-bars"></span></button>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				</nav>
				<?php
				if ( has_nav_menu( 'header-menu' ) ){
				?>
				<nav id="top-header-menu" role="navigation" aria-label="Menu secondaire / Second menu">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'header-menu' ) ); 
					//@author epointal add switch language
					//@see http://developer.infoymas.com/wordpress/multilingual-press-switcher-for-your-theme-header/
					if( function_exists('mlp_show_linked_elements'))
					{
						// display "Alternative Language Title" link 
						// In sites array https://*********/wp-admin/network/sites.php see column Relations
						mlp_show_linked_elements( );
						
						// You can custom the link
						//mlp_show_linked_elements(
						//		array(
						//		'link_text' => 'none', // do not display text link
						//		'display_flag' => true, // display a flag
						//		'show_current_blog' => FALSE // do not display if no translation
						//		)
						//	);
					}
					?>
				</nav>
				<?php
				}
				?>
			</div>
			
		</div>
	</header>

<?php
	// Breadcrumbs sans titre
	if ( is_front_page() && is_home() ) { ?>
	<!-- <div id="breadcrumbs"> -->
		<?php 
		// Show breadcrumb if checked in customizer
		// if( get_theme_mod( 'theme_aeris_breadcrumb' ) == "true") {
		// 	if (function_exists('the_breadcrumb')) the_breadcrumb(); 
		// }
		?>
	<!-- </div> -->
	<div class="site-branding" style="background-image:url(<?php header_image()?>);">
		<div>
		
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			if ( $description || is_customize_preview() ) { ?>
			<p class="site-description"><?php echo $description; ?></p>
				<?php
			}
			?>
		</div>
	</div><!-- .site-branding -->
<?php
	}
	?>
	<!-- <div id="content" class="site-content"> -->
