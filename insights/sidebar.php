<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Insights
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
global $post;
$global_layout = insights_get_option( 'global_layout' );
$input = '';
// Check if single.
if ( $post && is_singular() ) {
	$post_options = get_post_meta( $post->ID, 'insights-meta-select-layout', true );
	if ( empty( $post_options ) ) {
		$global_layout = esc_attr( insights_get_option('global_layout') );
	} else{
		$global_layout = esc_attr($post_options);
	}
}
if ($global_layout == 'no-sidebar') {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="theiaStickySidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->