<?php
function business_cover_lite_customize_register($wp_customize){
    $wp_customize->add_section('business_cover_lite_header', array(
        'title'    => esc_html__('Business Cover Header Phone and email', 'business-cover-lite'),
        'description' => '',
        'priority' => 30,
    ));
	
	 $wp_customize->add_section('business_cover_lite_social', array(
        'title'    => esc_html__('Business Cover Social Link', 'business-cover-lite'),
        'description' => '',
        'priority' => 35,
    ));
	
	$wp_customize->add_section('business_cover_lite_footer', array(
        'title'    => esc_html__('Business Cover Lite Footer', 'business-cover-lite'),
        'description' => '',
        'priority' => 37,
    ));
 
    //  =============================
    //  = Text Input phone number                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_phone', array(
        'default'        => '',
		'sanitize_callback' => 'sanitize_text_field'
    ));
 
    $wp_customize->add_control('business_cover_lite_phone', array(
        'label'      => esc_html__('Phone Number', 'business-cover-lite'),
        'section'    => 'business_cover_lite_header',
        'setting'   => 'business_cover_lite_phone',
		'type'    => 'number'
    ));
	
	//  =============================
    //  = Text Input Email                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_email', array(
        'default'        => '',
		'sanitize_callback' => 'sanitize_email'       
    ));
 
    $wp_customize->add_control('business_cover_lite_email', array(
        'label'      => esc_html__('Email', 'business-cover-lite'),
        'section'    => 'business_cover_lite_header',
        'setting'   => 'business_cover_lite_email',
		'type'    => 'email'
    ));
	
	//  =============================
    //  = Text Input facebook                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_fb', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
 
    $wp_customize->add_control('business_cover_lite_fb', array(
        'label'      => esc_html__('Facebook', 'business-cover-lite'),
        'section'    => 'business_cover_lite_social',
        'setting'   => 'business_cover_lite_fb',
    ));
	//  =============================
    //  = Text Input Twitter                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_twitter', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
 
    $wp_customize->add_control('business_cover_lite_twitter', array(
        'label'      => esc_html__('Twitter', 'business-cover-lite'),
        'section'    => 'business_cover_lite_social',
        'setting'   => 'business_cover_lite_twitter',
    ));
	//  =============================
    //  = Text Input googleplus                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_glplus', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
 
    $wp_customize->add_control('business_cover_lite_glplus', array(
        'label'      => esc_html__('Google Plus', 'business-cover-lite'),
        'section'    => 'business_cover_lite_social',
        'setting'   => 'business_cover_lite_glplus',
    ));
	//  =============================
    //  = Text Input linkedin                =
    //  =============================
    $wp_customize->add_setting('business_cover_lite_in', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url_raw'
    ));
 
    $wp_customize->add_control('business_cover_lite_in', array(
        'label'      => esc_html__('Linkedin', 'business-cover-lite'),
        'section'    => 'business_cover_lite_social',
        'setting'   => 'business_cover_lite_in',
    ));
	
	
  //  =============================
    //  = Footer              =
    //  =============================
	
	// Footer design and developed
	 $wp_customize->add_setting('business_cover_lite_design', array(
        'default'        => '',
		'sanitize_callback' => 'sanitize_textarea_field'
    ));
 
    $wp_customize->add_control('business_cover_lite_design', array(
        'label'      => esc_html__('Design and developed', 'business-cover-lite'),
        'section'    => 'business_cover_lite_footer',
        'setting'   => 'business_cover_lite_design',
		'type'	   =>'textarea'
    ));
	// Footer copyright
	 $wp_customize->add_setting('business_cover_lite_copyright', array(
        'default'        => '',
		'sanitize_callback' => 'sanitize_textarea_field'       
    ));
 
    $wp_customize->add_control('business_cover_lite_copyright', array(
        'label'      => esc_html__('Copyright', 'business-cover-lite'),
        'section'    => 'business_cover_lite_footer',
        'setting'   => 'business_cover_lite_copyright',
		'type'	   =>'textarea'
    ));	
}
add_action('customize_register', 'business_cover_lite_customize_register');
?>