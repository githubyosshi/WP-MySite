<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package insights
 */
if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
if ( class_exists( 'woocommerce' ) ) {
    if ( ! is_active_sidebar( 'shop-sidebar' ) && is_woocommerce()) {
        return;
    }
}
?>

<aside id="secondary" class="widget-area">
    <div class="theiaStickySidebar">
		<div class="sidebar-bg">
			<?php dynamic_sidebar( 'shop-sidebar' ); ?>
		</div>
	</div>
</aside><!-- #secondary -->