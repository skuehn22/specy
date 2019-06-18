<?php 
 function business_cover_lite_widgets_init() { 	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business-cover-lite' ),
		'description'   => esc_html__( 'Appears on sidebar', 'business-cover-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '',		
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	) );	
}
add_action( 'widgets_init', 'business_cover_lite_widgets_init' );
?>