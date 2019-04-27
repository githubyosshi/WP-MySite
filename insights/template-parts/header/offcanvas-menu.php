<?php
/**
 * Template for Off canvas Menu
 * @since Insights 1.0.0
 */
?>
<div id="offcanvas-menu">
    <div class="close-offcanvas-menu offcanvas-item">
        <div class="offcanvas-close">
            <span>
               <?php echo esc_html__('Close','insights'); ?>
            </span>
            <span class="ion-ios-close-empty meta-icon meta-icon-large"></span>
        </div>
    </div>
    <div class="offcanvas-search offcanvas-item">
        <div class="offcanvas-title">
            <?php esc_html_e('Search', 'insights'); ?>
        </div>
        <div id="search-form">
            <?php get_search_form(); ?>
        </div>
    </div>
    <?php if (has_nav_menu('primary')) { ?>
    <div id="primary-nav-offcanvas" class="offcanvas-navigation offcanvas-item">
        <div class="offcanvas-title">
            <?php esc_html_e('Menu', 'insights'); ?>
        </div>
        <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id' => 'primary-menu',
            'container' => 'div',
            'container_class' => 'menu'
        )); ?>
    </div>
<?php } ?>
    <?php if (has_nav_menu('social')) { ?>
        <div class="offcanvas-social offcanvas-item">
            <div class="offcanvas-title">
                <?php esc_html_e('Social profiles', 'insights'); ?>
            </div>
            <div class="social-icons">
                <?php
                wp_nav_menu(
                    array('theme_location' => 'social',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after' => '</span>',
                        'menu_id' => 'social-menu',
                        'fallback_cb' => false,
                        'menu_class' => false
                    )); ?>
            </div>
        </div>
    <?php } ?>
</div>