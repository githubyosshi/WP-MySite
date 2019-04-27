<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Insights
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 */
function insights_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'insights_jetpack_setup' );
