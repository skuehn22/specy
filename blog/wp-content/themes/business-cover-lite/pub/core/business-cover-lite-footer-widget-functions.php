<?php
function business_cover_lite_widgets_init_footer() {    
    register_sidebar( array(
        'name'          => __( 'Footer Widget 1', 'business-cover-lite' ),
        'description'   => __( 'Appears on footer', 'business-cover-lite' ),
        'id'            => 'footer-1',
        'before_widget' => '<aside id="%1$s" class="cols-4 widget-column-1 %2$s footercont">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer Widget 2', 'business-cover-lite' ),
        'description'   => __( 'Appears on footer', 'business-cover-lite' ),
        'id'            => 'footer-2',
        'before_widget' => '<aside id="%1$s" class="cols-4 widget-column-2 %2$s footercont">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => __( 'Footer Widget 3', 'business-cover-lite' ),
        'description'   => __( 'Appears on footer', 'business-cover-lite' ),
        'id'            => 'footer-3',
        'before_widget' => '<aside id="%1$s" class="cols-4 widget-column-3 %2$s footercont">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget 4', 'business-cover-lite' ),
        'description'   => __( 'Appears on footer', 'business-cover-lite' ),
        'id'            => 'footer-4',
        'before_widget' => '<aside id="%1$s" class="cols-4 widget-column-3 %2$s footercont">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'business_cover_lite_widgets_init_footer' );
?>