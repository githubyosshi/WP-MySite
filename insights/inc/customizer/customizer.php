<?php 

/**
 * Insights Theme Customizer.
 *
 * @package Insights
 */

//customizer core option
require get_template_directory() . '/inc/customizer/core/customizer-core.php';

//customizer 
require get_template_directory() . '/inc/customizer/core/default.php';
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function insights_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/core/control.php';

	// Load customize sanitize.
	require get_template_directory() . '/inc/customizer/core/sanitize.php';

	// Load customize callback.
	require get_template_directory() . '/inc/customizer/core/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	
	/*theme option panel details*/
	require get_template_directory() . '/inc/customizer/theme-option.php';	
	/*color typo panel details*/
	require get_template_directory() . '/inc/customizer/color-typo.php';
	// Register custom section types.
	$wp_customize->register_section_type( 'Insights_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Insights_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Insights Pro', 'insights' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'insights' ),
				'pro_url'  => 'https://www.themeinwp.com/theme/insights-pro/',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'insights_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */
function insights_customize_preview_js() {

	wp_enqueue_script( 'insights_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}
add_action( 'customize_preview_init', 'insights_customize_preview_js' );


function insights_customizer_css() {
	wp_enqueue_script('insights_customize_admin_js', get_template_directory_uri().'/assets/twp/js/customizer-admin.js', array('customize-controls'));

	wp_enqueue_style( 'insights_customize_controls', get_template_directory_uri() . '/assets/twp/css/customizer-controll.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'insights_customizer_css',0 );
