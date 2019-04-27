<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function insights_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'insights' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'insights' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	
	register_sidebar(array(
		'name' => esc_html__('Off-Canvas Panel', 'insights'),
		'id' => 'slide-menu',
		'description' => esc_html__('Add widgets here.', 'insights'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar(array(
	    'name' => esc_html__('Shop Sidebar', 'insights'),
	    'id' => 'shop-sidebar',
	    'description' => esc_html__('Displays items on sidebar.', 'insights'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2 class="widget-title">',
	    'after_title' => '</h2>',
	));

	$insights_footer_widgets_number = insights_get_option('number_of_footer_widget');

	if( $insights_footer_widgets_number > 0 ){
	    register_sidebar(array(
	        'name' => __('Footer Column One', 'insights'),
	        'id' => 'footer-col-one',
	        'description' => __('Displays items on footer section.','insights'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ));
	    if( $insights_footer_widgets_number > 1 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Two', 'insights'),
	            'id' => 'footer-col-two',
	            'description' => __('Displays items on footer section.','insights'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	    if( $insights_footer_widgets_number > 2 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Three', 'insights'),
	            'id' => 'footer-col-three',
	            'description' => __('Displays items on footer section.','insights'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	    if( $insights_footer_widgets_number > 3 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Four', 'insights'),
	            'id' => 'footer-col-four',
	            'description' => __('Displays items on footer section.','insights'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	}
}
add_action( 'widgets_init', 'insights_widgets_init' );
