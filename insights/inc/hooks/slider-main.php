<?php
if (!function_exists('insights_banner_slider_args')) :
    /**
     * Banner Slider Details
     *
     * @since Insights 1.0.0
     *
     * @return array $qargs Slider details.
     */
    function insights_banner_slider_args()
    {
        $insights_banner_slider_number = absint(insights_get_option('number_of_home_slider'));
        $insights_banner_slider_from = esc_attr(insights_get_option('select_slider_from'));
        switch ($insights_banner_slider_from) {
            case 'from-page':
                $insights_banner_slider_page_list_array = array();
                for ($i = 1; $i <= $insights_banner_slider_number; $i++) {
                    $insights_banner_slider_page_list = insights_get_option('select_page_for_slider_' . $i);
                    if (!empty($insights_banner_slider_page_list)) {
                        $insights_banner_slider_page_list_array[] = absint($insights_banner_slider_page_list);
                    }
                }
                // Bail if no valid pages are selected.
                if (empty($insights_banner_slider_page_list_array)) {
                    return;
                }
                /*page query*/
                $qargs = array(
                    'posts_per_page' => esc_attr($insights_banner_slider_number),
                    'orderby' => 'post__in',
                    'post_type' => 'page',
                    'post__in' => $insights_banner_slider_page_list_array,
                );
                return $qargs;
                break;

            case 'from-category':
                $insights_banner_slider_category = esc_attr(insights_get_option('select_category_for_slider'));
                $qargs = array(
                    'posts_per_page' => esc_attr($insights_banner_slider_number),
                    'post_type' => 'post',
                    'cat' => $insights_banner_slider_category,
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


if (!function_exists('insights_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since Insights 1.0.0
     *
     */
    function insights_banner_slider()
    {
        $insights_slider_button_text = esc_html(insights_get_option('button_text_on_slider'));

        $insights_slider_excerpt_number = absint(insights_get_option('number_of_content_home_slider'));
        if (1 != insights_get_option('show_slider_section')) {
            return null;
        }
        $insights_banner_slider_args = insights_banner_slider_args();
        $insights_banner_slider_query = new WP_Query($insights_banner_slider_args); ?>
        <section class="twp-slider-wrapper twp-slider-bgwrapper">
            <div class="container">
                <div class="twp-slider twp-slider-main">
                    <?php
                    if ($insights_banner_slider_query->have_posts()) :
                        while ($insights_banner_slider_query->have_posts()) : $insights_banner_slider_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                $url = $thumb['0'];
                            }
                            if (has_excerpt()) {
                                $insights_slider_content = get_the_excerpt();
                            } else {
                                $insights_slider_content = insights_words_count($insights_slider_excerpt_number, get_the_content());
                            }
                            ?>
                            <div class="single-slide">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="slidernav">
                                            <div class="twp-slide-prev tertiary-color slide-prev-1">
                                                <i class="navcontrol-transparent ion-ios-arrow-left"></i>
                                            </div>
                                            <div class="twp-slide-next tertiary-color slide-next-1">
                                                <i class="navcontrol-transparent ion-ios-arrow-right"></i>
                                            </div>
                                        </div>
                                        <div class="slide-bg-wrapper article-image-radius">
                                            <div class="slide-bg bg-image">
                                                <?php if (has_post_thumbnail()) { ?> 
                                                    <img src="<?php echo esc_url($url); ?>">
                                                <?php  } ?>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="article-item-link"></a>
                                            <?php if (1 == insights_get_option('enable_slider_overlay')) { ?>
                                                <div class="slider-overlay"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="slide-text">
                                            <div class="slide-text-wrapper">
                                                <div class="post-category post-category-1">
                                                    <?php insights_entry_category_style_2(); ?>
                                                </div>
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
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>
                <div class="row">

                    
                    <?php         
                        $insights_featured_slider_category = esc_attr(insights_get_option('select_category_for_post_below_slider'));
                            $qarg = array(
                                'posts_per_page' => 4,
                                'post_type' => 'post',
                                'cat' => $insights_featured_slider_category,
                            ); 
                        $insights_featured_slider_querys = new WP_Query($qarg);
                        ?>
                        <?php
                        if ($insights_featured_slider_querys->have_posts()) :
                            while ($insights_featured_slider_querys->have_posts()) : $insights_featured_slider_querys->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                    $url = $thumb['0'];
                                }
                                ?>
                                    <div class="col-sm-3">
                                        <article class="article-col">
                                            <div class="article-container-col">
                                                <div class="article-image article-image-radius">
                                                    <div class="bg-image bg-image-2">
                                                        <?php if (has_post_thumbnail()) { ?> 
                                                            <img src="<?php echo esc_url($url); ?>">
                                                        <?php  } ?>
                                                    </div>
                                                    <div class="post-category post-category-1">
                                                        <?php insights_entry_category_style_2(); ?>
                                                    </div>
                                                </div>
                                                <div class="article-item-content">


                                                    <h3 class="entry-title entry-title-small">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title();?>
                                                        </a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php insights_posted_details_date_name(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action('insights_action_slider_post_1', 'insights_banner_slider', 10);