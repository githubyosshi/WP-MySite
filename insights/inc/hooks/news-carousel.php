<?php
if (!function_exists('insights_carousel_args')) :
    /**
     * Banner Slider Details
     *
     * @since Insights 1.0.0
     *
     * @return array $qargs Slider details.
     */
    function insights_carousel_args()
    {
        $insights_carousel_number = absint(insights_get_option('number_of_home_carousel'));
        $insights_carousel_category = esc_attr(insights_get_option('select_category_for_carousel'));
        $qargs = array(
            'posts_per_page' => esc_attr($insights_carousel_number),
            'post_type' => 'post',
            'cat' => $insights_carousel_category,
        );
        return $qargs;
        ?>
        <?php
    }
endif;


if (!function_exists('insights_carousel')) :
    /**
     * Banner Slider
     *
     * @since Insights 1.0.0
     *
     */
    function insights_carousel()
    {
        $insights_carousel_title_text = esc_html(insights_get_option('heading_text_on_carousel'));

        if (1 != insights_get_option('show_carousel_section')) {
            return null;
        }
        $insights_carousel_args = insights_carousel_args();
        $insights_carousel_query = new WP_Query($insights_carousel_args); ?>
        <section class="recent-section section-block">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (!empty($insights_carousel_title_text)) { ?>
                            <div class="section-heading">
                                <h2 class="section-title">
                                    <?php echo esc_html($insights_carousel_title_text); ?>
                                    <?php $insights_carousel_category = esc_attr(insights_get_option('select_category_for_carousel')); 
                                    if ($insights_carousel_category != 0) { ?>
                                        <span class="header-link">
                                            <?php
                                            $insights_carousel_category_url = get_category_link( $insights_carousel_category ); ?>
                                            <a href="<?php echo esc_url($insights_carousel_category_url); ?>">
                                                <?php echo esc_html('view all articles','insights'); ?>
                                            </a>
                                        </span>
                                    <?php } ?>
                                </h2>
                                <div class="slidernav">
                                    <div class="twp-slide-prev tertiary-color slide-prev-2">
                                        <i class="navcontrol-transparent ion-ios-arrow-left"></i>
                                    </div>
                                    <div class="twp-slide-next tertiary-color slide-next-2">
                                        <i class="navcontrol-transparent ion-ios-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-content">
                            <div class="recent-slider">
                                <?php
                                if ($insights_carousel_query->have_posts()) :
                                    while ($insights_carousel_query->have_posts()) : $insights_carousel_query->the_post();
                                        if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                            $url = $thumb['0'];
                                        }
                                        ?>
                                            <article class="slide-items">
                                                <div class="slide-container">
                                                    <div class="article-image">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <span class="slide-bg bg-image">
                                                                <?php if (has_post_thumbnail()) { ?>
                                                                    <img src="<?php echo esc_url($url); ?>">
                                                                <?php  } ?>
                                                            </span>
                                                        </a>
                                                        <div class="post-category post-category-1">
                                                            <?php insights_entry_category_style_2(); ?>
                                                        </div>
                                                        <div class="post-type-icon">

                                                        </div>
                                                    </div>
                                                    <div class="slide-item-content">
                                                        <h3 class="entry-title entry-title-medium">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h3>
                                                        <div class="entry-meta">
                                                            <?php insights_posted_details_date_name(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action('insights_action_carousel_post', 'insights_carousel', 10);