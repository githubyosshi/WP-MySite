<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Insights
 */

/*select page for slider*/
if ( ! function_exists( 'insights_is_select_slider_layout_1' ) ) :

	/**
	 * Check if slider section page/post is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function insights_is_select_slider_layout_1( $control ) {

		if ( 'twp-slider-1' === $control->manager->get_setting( 'slider_section_layout' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
