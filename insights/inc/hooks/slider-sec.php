<?php
if (!function_exists('insights_banner_slider_sec_args_2')) :
    /**
     * Banner Slider Details
     *
     * @since Insights 1.0.0
     *
     * @return array $qargs Slider details.
     */
    function insights_banner_slider_sec_args_2()
    {
        $insights_banner_slider_sec_number = absint(insights_get_option('number_of_home_slider'));
        $insights_banner_slider_sec_from = esc_attr(insights_get_option('select_slider_from'));
        switch ($insights_banner_slider_sec_from) {
            case 'from-page':
                $insights_banner_slider_sec_page_list_array = array();
                for ($i = 1; $i <= $insights_banner_slider_sec_number; $i++) {
                    $insights_banner_slider_sec_page_list = insights_get_option('select_page_for_slider_' . $i);
                    if (!empty($insights_banner_slider_sec_page_list)) {
                        $insights_banner_slider_sec_page_list_array[] = absint($insights_banner_slider_sec_page_list);
                    }
                }
                // Bail if no valid pages are selected.
                if (empty($insights_banner_slider_sec_page_list_array)) {
                    return;
                }
                /*page query*/
                $qargs = array(
                    'posts_per_page' => esc_attr($insights_banner_slider_sec_number),
                    'orderby' => 'post__in',
                    'post_type' => 'page',
                    'post__in' => $insights_banner_slider_sec_page_list_array,
                );
                return $qargs;
                break;

            case 'from-category':
                $insights_banner_slider_sec_category = esc_attr(insights_get_option('select_category_for_slider'));
                $qargs = array(
                    'posts_per_page' => esc_attr($insights_banner_slider_sec_number),
                    'post_type' => 'post',
                    'cat' => $insights_banner_slider_sec_category,
                );
                return $qargs;
                break;

            default:
                break;
        }
        ?>
        <?php
    }
endif;


if (!function_exists('insights_banner_slider_sec')) :
    /**
     * Banner Slider
     *
     * @since Insights 1.0.0
     *
     */
    function insights_banner_slider_sec()
    {
        $insights_slider_button_text = esc_html(insights_get_option('button_text_on_slider'));

        $insights_slider_excerpt_number = absint(insights_get_option('number_of_content_home_slider'));
        if (1 != insights_get_option('show_slider_section')) {
            return null;
        }
        $insights_banner_slider_sec_args_2 = insights_banner_slider_sec_args_2();
        $insights_banner_slider_sec_query = new WP_Query($insights_banner_slider_sec_args_2); ?>
        <section class="twp-slider-wrapper">
            <div class="container">
                <div class="twp-slider twp-slider-secondary">
                    <?php
                    if ($insights_banner_slider_sec_query->have_posts()) :
                        $slider_nav = '';
                        while ($insights_banner_slider_sec_query->have_posts()) : $insights_banner_slider_sec_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                $url = $thumb['0'];
                                $thumbs = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                $urls = $thumbs['0'];
                            }
                            $slider_img = '<img src="' . esc_url($urls) . '">';
                            if (has_excerpt()) {
                                $insights_slider_content = get_the_excerpt();
                            } else {
                                $insights_slider_content = insights_words_count($insights_slider_excerpt_number, get_the_content());
                            }
                            ?>
                            <div class="single-slide">
                                <div class="slide-bg-wrapper">
                                    <div class="slide-bg-large bg-image bg-image-light">
                                        <?php if (has_post_thumbnail()) { ?> 
                                            <img src="<?php echo esc_url($url); ?>">
                                        <?php  } ?>
                                    </div>
                                    <?php if (1 == insights_get_option('enable_slider_overlay')) { ?>
                                        <div class="slider-overlay"></div>
                                    <?php } ?>
                                </div>
                                <div class="slide-text">
                                    <div class="post-category post-category-1">
                                        <?php insights_entry_category_style_2(); ?>
                                    </div>
                                    <div class="slide-text-wrapper">
                                        <h2>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <p class="visible hidden-xs"><?php echo wp_kses_post($insights_slider_content); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <?php echo esc_html($insights_slider_button_text); ?> <i class="ion-ios-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            /*Slider nav*/
                            $slider_nav .= '<div class="slider-nav-item"><figure class="slider-article">';
                            if (has_post_thumbnail()) { 
                                $slider_nav .= '<span class="slider-nav-image bg-image bg-image-light">'.$slider_img.'</span>';
                            }
                            $slider_nav .= '<h4 class="slide-nav-title">';
                            $slider_nav .=  esc_html(wp_trim_words( get_the_title(), 10, ' ...' ));
                            $slider_nav .= '</h4>';
                            $slider_nav .= '</figure></div>';
                            /**/
                        endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>
                <div class="twp-slidesnav">
                    <div class="container">
                        <div class="slider-nav">
                            <?php echo $slider_nav;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }
endif;
add_action('insights_action_slider_post_2', 'insights_banner_slider_sec', 10);