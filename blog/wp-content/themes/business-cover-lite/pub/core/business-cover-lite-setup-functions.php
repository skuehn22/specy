<?php 
 if ( ! function_exists( 'business_cover_lite_setup' ) ) :
function business_cover_lite_setup() {   
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'business-cover-lite' ),
		'footer' => esc_html__( 'Footer Menu', 'business-cover-lite' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );	

			$defaults = array(
			'default-image'          => get_template_directory_uri() .'/images/slider.jpg',
			'width'                  => 1400,
			'height'                 => 500,
			'uploads'                => true,			
		);
		add_theme_support( 'custom-header', $defaults );
} 
endif; // business_cover_lite_setup
add_action( 'after_setup_theme', 'business_cover_lite_setup' );
?>