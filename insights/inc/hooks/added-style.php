<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Insights
 */

if (!function_exists('insights_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
function insights_trigger_custom_css_action()
{
    $insights_enable_banner_overlay = insights_get_option('enable_overlay_option');
    $insights_primary_color = insights_get_option('primary_color');
    $insights_secondary_color = insights_get_option('secondary_color');
    $insights_tertiary_color = insights_get_option('tertiary_color');

    $insights_banner_background_color = insights_get_option('banner_background_color');
    $insights_banner_text_color = insights_get_option('banner_text_color');
    
    $insights_footer_background_color = insights_get_option('footer_background_color');
    $insights_footer_line_color = insights_get_option('footer_line_color');
    $insights_footer_text_color = insights_get_option('footer_text_color');
    $insights_copyright_background_color = insights_get_option('copyright_background_color');
    $insights_copyright_text_color = insights_get_option('copyright_text_color');
    
    $insights_featured_blog_text_color = insights_get_option('featured_blog_text_color');
    $insights_featured_blog_background_color = insights_get_option('featured_blog_background_color');
    
    $insights_font_size_h1 = insights_get_option('text_size_h1');
    $insights_medium_article_title = insights_get_option('medium_article_title');
    $insights_small_article_title = insights_get_option('small_article_title');
    $insights_inner_banner_title_size = insights_get_option('inner_banner_title_size');
    $insights_font_size_p = insights_get_option('text_size_p');

    ?>
        <style type="text/css">
        <?php
        
        if ( $insights_enable_banner_overlay == 1 ){
            ?>
            .inner-banner.banner-bg-enabled .entry-header,
            .inner-banner.banner-bg-enabled .entry-header a{
                color: #fff;
            }

            body .banner-bg-enabled .inner-header-overlay{
                background: #2b2b2b;
                filter: alpha(opacity=45);
                opacity: .45;
            }
            <?php
        } 
        
        if (!empty($insights_primary_color) ){
            ?>
            body .primary-bgcolor{
                background: <?php echo esc_html($insights_primary_color); ?>;
            }
            body .primary-textcolor{
                color: <?php echo esc_html( $insights_primary_color ); ?>;
            }
            <?php
        }

        if (!empty($insights_secondary_color) ){
            ?>
            body .secondary-bgcolor,
            .site .widget-title:after,
            .site .bordered-title:after,
            .site .comment-reply-title:after{
                background: <?php echo esc_html($insights_secondary_color); ?>;
            }

            body .secondary-textcolor,
            body a:hover,
            body a:focus,
            body .main-navigation .menu ul > li.current-menu-item > a,
            body .main-navigation .menu ul > li.current-post-ancestor > a {
                color: <?php echo esc_html($insights_secondary_color); ?> !important;
            }

            body .read-more {
                box-shadow: 0 -2px 0 <?php echo esc_html($insights_secondary_color); ?> inset;
            }
            <?php
        }

        if (!empty($insights_tertiary_color) ){
            ?>
            .site .tertiary-color{
                background: <?php echo esc_html($insights_tertiary_color); ?>;
            }
            <?php
        }

        if (!empty($insights_banner_background_color) ){
            ?>
            .site .twp-slider-wrapper.twp-slider-bgwrapper{
                background: <?php echo esc_html($insights_banner_background_color); ?>;
            }
            <?php
        }

        if (!empty($insights_banner_text_color) ){
            ?>
            .site .twp-slider-wrapper.twp-slider-bgwrapper,
            .site .twp-slider-wrapper.twp-slider-bgwrapper a{
                color: <?php echo esc_html($insights_banner_text_color); ?>;
            }
            <?php
        }

        if (!empty($insights_footer_background_color) ){
            ?>
            body .site-footer .footer-widget{
                background: <?php echo esc_html($insights_footer_background_color); ?>;
            }
            <?php
        }

        if (!empty($insights_footer_text_color) ){
            ?>
            body .site-footer .footer-widget,
            body.site-footer .footer-widget a {
                color: <?php echo esc_html($insights_footer_text_color); ?>;
            }
            <?php
        }

        if (!empty($insights_footer_line_color) ){
            ?>
            body .site-footer .widget:not(.insights_social_widget):not(.insights_popular_post_widget) ul li,
            body.site-footer .footer-widget .widget-title{
                border-color: <?php echo esc_html($insights_footer_line_color); ?>;
            }
            <?php
        }

        if (!empty($insights_copyright_background_color) ){
            ?>
            body .site-footer .site-info {
                background: <?php echo esc_html($insights_copyright_background_color); ?>;
            }
            <?php
        }

        if (!empty($insights_copyright_text_color) ){
            ?>
            body .site-footer .site-info,
            body .site-footer .site-info a {
                color: <?php echo esc_html($insights_copyright_text_color); ?>;
            }
            <?php
        }

        if (!empty($insights_featured_blog_text_color) ){
            ?>
            body .most-read-section,
            body .most-read-section a{
                color: <?php echo esc_html($insights_featured_blog_text_color); ?>;
            }
            <?php
        }

        if (!empty($insights_featured_blog_background_color) ){
            ?>
            body .most-read-section{
                background: <?php echo esc_html($insights_featured_blog_background_color); ?>;
            }
            <?php
        }

        if (!empty($insights_font_size_h1) ){
            ?>
            body h1.entry-title,
            body h1,
            body .entry-title-large{
                font-size: <?php echo esc_html($insights_font_size_h1); ?>px;
            }
            <?php
        }

        if (!empty($insights_medium_article_title) ){
            ?>
            body .entry-title-medium{
                font-size: <?php echo esc_html($insights_medium_article_title); ?>px;
            }
            <?php
        }

        if (!empty($insights_small_article_title) ){
            ?>
            body .entry-title-small{
                font-size: <?php echo esc_html($insights_small_article_title); ?>px;
            }
            <?php
        }

        if (!empty($insights_inner_banner_title_size) ){
            ?>
            body h4{
                font-size: <?php echo esc_html($insights_inner_banner_title_size); ?>px;
            }
            <?php
        }

         if (!empty($insights_font_size_p) ){
            ?>
            html body, body p, body button, body input, body select, body textarea, body .widget{
                font-size: <?php echo esc_html($insights_font_size_p); ?>px;
            }
            <?php
        }
        ?>
        </style>

        <?php }

        endif;