<?php 
 function business_cover_lite_style()
 {
    wp_enqueue_style( 'business-cover-lite-basic-style', get_stylesheet_uri() );
    wp_enqueue_style( 'business-cover-lite-style', get_template_directory_uri() .'/pub/css/business-cover-lite-main.css');
    wp_enqueue_style( 'business-cover-lite-responsive', get_template_directory_uri() .'/pub/css/business-cover-lite-responsive.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/pub/css/font-awesome.css');
    wp_enqueue_script( 'business-cover-lite-toggle', get_template_directory_uri() . '/pub/js/business-cover-lite-toggle.js', array('jquery'));
 }
 add_action( 'wp_enqueue_scripts', 'business_cover_lite_style' );
?>