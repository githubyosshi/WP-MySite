<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Insights
 */

?>

</div><!-- #content -->

    <?php if (is_active_sidebar('slide-menu')) : ?>
        <div id="sidr-nav">
            <a class="sidr-offcanvas-close" href="#sidr-nav">
                   <span>
                       <?php echo esc_html__('Close','insights'); ?>
                    </span>
                <span class="ion-ios-close-empty meta-icon meta-icon-large"></span>
            </a>
            <?php dynamic_sidebar('slide-menu'); ?>
        </div>
    <?php endif; ?>


    <?php if (is_front_page() || is_home() ) { ?>
        <?php if (1 == insights_get_option('show_footer_pinned_post_section_section')) { ?>
            <section class="cover-stories">
                <div class="cover-stories-featured">
                    <div class="container">
                        <div class="row">
                            <?php
                                $category_ids_footer_pined_post = insights_get_option('select_category_for_footer_pinned_section');
                                $args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 1,
                                    'cat' => absint($category_ids_footer_pined_post),
                                );
                                $footer_pined_post = new WP_Query($args);
                                if($footer_pined_post->have_posts()):?>
                                    <?php while ($footer_pined_post->have_posts()):$footer_pined_post->the_post();
                                        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                                        ?>
                                    <div class="col-sm-12">
                                        <div class="cover-stories-bg data-bg" data-background="<?php echo esc_url($featured_img_url); ?>">
                                            <div class="section-details">
                                                <?php
                                                $insights_pinned_title_text = wp_kses_post(insights_get_option('title_footer_pinned_post'));
                                                if (!empty($insights_pinned_title_text)) { ?>
                                                    <h2 class="section-title entry-title"><?php echo wp_kses_post($insights_pinned_title_text); ?> <i class="ion-ios-arrow-thin-right"></i></h2>
                                                <?php } ?>
                                                <div class="article-featured">
                                                    <header class="article-header">
                                                        <div class="entry-meta">
                                                            <?php insights_posted_details(); ?>
                                                        </div>
                                                        <h3 class="entry-title entry-title-large">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                    </header>
                                                        <div class="entry-content">
                                                            <div class="twp-content-details">
                                                                <?php the_excerpt(); ?>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <?php if (1 == insights_get_option('enable_pined_section_banner_overlay')) { ?>
                                                <div class="section-overlay"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php endwhile;
                                    wp_reset_postdata();?>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
                $category_ids_footer_pined_post = insights_get_option('select_category_for_footer_pinned_section');
                $args = array(
                    'post_type'      => 'post',
                    'offset'         => 1,
                    'posts_per_page' => 3,
                    'cat' => absint($category_ids_footer_pined_post),
                );
                $footer_pined_post = new WP_Query($args);
                if($footer_pined_post->have_posts()):?>
                <div class="cover-stories-others">
                    <div class="container">
                        <div class="row">
                            <?php while ($footer_pined_post->have_posts()):$footer_pined_post->the_post();
                                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
                                ?>
                                <div class="col-sm-4">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="article-image article-image-radius">
                                            <a href="<?php the_permalink(); ?>" class="bg-image bg-image-light bg-image-3">
                                                <img src="<?php echo esc_url($featured_img_url); ?>">
                                            </a>
                                            <div class="post-category post-category-1">
                                                <?php insights_entry_category_style_2(); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="content">
                                        <div class="entry-meta">
                                            <?php insights_posted_details_date_name(); ?>
                                        </div>
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </section>
        <?php } ?>
    <?php } ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
    <?php $insights_footer_widgets_number = insights_get_option('number_of_footer_widget');
    if ($insights_footer_widgets_number != 0) {?>
        <?php
        if (1 == $insights_footer_widgets_number) {
            $col = 'col-md-12';
        } elseif (2 == $insights_footer_widgets_number) {
            $col = 'col-md-6';
        } elseif (3 == $insights_footer_widgets_number) {
            $col = 'col-md-4';
        } elseif (4 == $insights_footer_widgets_number) {
            $col = 'col-md-3';
        } else {
            $col = 'col-md-3';
        }
        if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <?php if (is_active_sidebar('footer-col-one') && $insights_footer_widgets_number > 0) : ?>
                            <div class="contact-list <?php echo esc_attr($col); ?>">
                                <?php dynamic_sidebar('footer-col-one'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('footer-col-two') && $insights_footer_widgets_number > 1) : ?>
                            <div class="contact-list <?php echo esc_attr($col); ?>">
                                <?php dynamic_sidebar('footer-col-two'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('footer-col-three') && $insights_footer_widgets_number > 2) : ?>
                            <div class="contact-list <?php echo esc_attr($col); ?>">
                                <?php dynamic_sidebar('footer-col-three'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('footer-col-four') && $insights_footer_widgets_number > 3) : ?>
                            <div class="contact-list <?php echo esc_attr($col); ?>">
                                <?php dynamic_sidebar('footer-col-four'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
        <div class="site-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="site-copyright secondary-font">
                            <?php
                            $insights_copyright_text = wp_kses_post(insights_get_option('copyright_text'));
                            if (!empty ($insights_copyright_text)) {
                                echo wp_kses_post(insights_get_option('copyright_text'));
                            }
                            ?>
                            <?php if ((insights_get_option('enable_copyright_credit')) == 1) { ?>
                                <span class="heart"> </span>
                                <?php printf(esc_html__('Theme: %1$s by %2$s', 'insights'), '<strong>Insights</strong>', '<a href="http://themeinwp.com/" target = "_blank" rel="designer"><strong>Themeinwp</strong></a>'); ?>
                            <?php } ?>
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <?php if (has_nav_menu('footer')) { ?>
                            <div id="footer-nav" >
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'footer',
                                    'menu_id' => 'footer-menu',
                                    'depth'   => 1,
                                    'container' => 'div',
                                    'menu_class'=> false
                                )); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="scroll-up">
    <i class="ion-ios-arrow-up text-light"></i>
</div>

<?php
if ((insights_get_option('show_latest_fixed_post_section_section')) == 1) { ?>
    <div class="recommendation-panel-handle" id="recommendation-panel-handle">
        <div class="recommendation-panel-open">
            <i class="ion-ios-plus-empty"></i>
        </div>
    </div>
    <?php
        $no_of_post_latext_fixed = insights_get_option('number_of_fixed_post');
        $category_ids_latest_fixed_post = insights_get_option('select_category_for_footer_fix_section');
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => absint($no_of_post_latext_fixed),
            'cat' => absint($category_ids_latest_fixed_post),
        );
        $recomended_featured_posts = new WP_Query($args);
        if($recomended_featured_posts->have_posts()):?>
            <div class="recommendation-panel-content" id="recommendation-panel-content">
                <div class="recommendation-panel-close">
                    <i class="ion-ios-close-empty"></i>
                </div>
                <div class="recommendation-panel-slider">
                    <div class="recommendation-slides-wrapper">
                        <div class="recommendation-slides">
                            <?php while ($recomended_featured_posts->have_posts()):$recomended_featured_posts->the_post();?>
                                <div class="slide-item">
                                    <figure class="slide-item-image bg-image bg-image-light bg-image-0 hidden-xs">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </figure>
                                    <div class="slide-item-details">
                                        <h3>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            <?php endwhile;wp_reset_postdata();?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
<?php } ?>


<?php wp_footer(); ?>

</body>
</html>
