<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Insights
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ((insights_get_option('enable_preloader')) == 1) { ?>
    <div class="preloader">
        <div class="loader-circle">
            <div class="loader-up">
                <div class="innera"></div>
            </div>
            <div class="loader-down">
                <div class="innerb"></div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (insights_get_option('homepage_layout_option') == 'full-width') {
    $insights_homepage_layout = 'full-screen-layout';
} elseif (insights_get_option('homepage_layout_option') == 'boxed') {
    $insights_homepage_layout = 'boxed-layout';
} ?>
<div id="page" class="site site-bg <?php echo esc_attr($insights_homepage_layout); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'insights'); ?></a>
    <?php if ((has_nav_menu('top')) || (has_nav_menu('social'))) { ?>
        <div class="top-bar hidden-xs hidden-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-8">
                        <?php if (has_nav_menu('top')) { ?>
                        <div class="pull-left">
                            <div id="top-nav" class="auxiliary-nav">
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'top',
                                    'menu_id' => 'top-menu',
                                    'depth'   => 1,
                                    'container' => 'div',
                                    'menu_class'=> false
                                )); ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-md-4">
                        <div class="pull-right">
                            <div class="social-icons social-icons-main">
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'social',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'menu_class'=> false
                                    )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php get_template_part( 'template-parts/header/offcanvas', 'menu' ); ?>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="header-main">
                <div class="nav-left">
                    <div class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                        <div class="visible-sm visible-xs">
                             <span class="menu-label">
                                <?php esc_html_e('Menu', 'insights'); ?>
                            </span>
                            <a class="offcanvas-toggle" href="#">
                                <div class="trigger-icon">
                                    <span class="icon-bar top"></span>
                                    <span class="icon-bar middle"></span>
                                    <span class="icon-bar bottom"></span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="site-branding">
                        <div class="branding-wrapper">
                            <?php insights_the_custom_logo(); ?>
                            <span class="site-title primary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                            <?php $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description">
                                    <?php echo esc_html($description); ?>
                                </p>
                            <?php
                            endif; ?>
                        </div>
                    </div>

                    <nav class="hidden-xs hidden-sm main-navigation" role="navigation">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => 'div',
                            'container_class' => 'menu'
                        )); ?>
                    </nav>
                </div>
                <div class="nav-right">
                    <?php if (1 == insights_get_option('enable_top_header_date')) { ?>
                        <div class="nav-items nav-date hidden-xs">
                            <?php $time = current_time('l, M j, Y');
                            echo esc_html($time); ?>
                        </div>
                    <?php } ?>
                    <?php if (1 == insights_get_option('enable_top_header_search')) { ?>
                        <div class="nav-items icon-search">
                            <i class="ion-ios-search-strong"></i>
                        </div>
                    <?php } ?>
                    <?php if (is_active_sidebar('slide-menu')) {?>
                        <div id="widgets-nav" class="nav-items icon-sidr">
                            <div class="trigger-icon">
                                <span class="icon-bar top"></span>
                                <span class="icon-bar middle"></span>
                                <span class="icon-bar bottom"></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <!-- #masthead -->
    <div class="popup-search">
        <div class="table-align">
            <div class="table-align-cell v-align-middle">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="close-popup"></div>
    </div>
    <!--    Searchbar Ends-->
    <!-- Innerpage Header Begins Here -->
    <?php
    if (is_home()) {
        $insights_slider_layout = esc_attr(insights_get_option('slider_section_layout'));
        if ($insights_slider_layout == 'twp-slider-1') {
            do_action('insights_action_slider_post_1');
        } else {
            do_action('insights_action_slider_post_2');
        }
        // carousel sldier
        do_action('insights_action_carousel_post');
        // featured blog
        do_action('insights_action_featured_blog_post');
        
        do_action('insights_action_full_width_carousel_post');
    } elseif (is_front_page()) {
        $insights_slider_layout = esc_attr(insights_get_option('slider_section_layout'));
        if ($insights_slider_layout == 'twp-slider-1') {
            do_action('insights_action_slider_post_1');
        } else {
            do_action('insights_action_slider_post_2');
        }
        // carousel sldier
        do_action('insights_action_carousel_post');
        // featured blog
        do_action('insights_action_featured_blog_post');
        
        do_action('insights_action_full_width_carousel_post');
        do_action('insights-page-inner-title');
    } else {
        do_action('insights-page-inner-title');
    }
    ?>
    <!-- Innerpage Header Ends Here -->
    <div id="content" class="site-content">