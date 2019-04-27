<?php
if (!function_exists('insights_featured_blog_args')) :
    /**
     * Banner Slider Details
     *
     * @since Insights 1.0.0
     *
     * @return array $qargs Slider details.
     */
    function insights_featured_blog_args()
    {
        $insights_featured_blog_category = esc_attr(insights_get_option('select_category_for_featured_blog'));
        $qargs = array(
            'posts_per_page' => 1,
            'post_type' => 'post',
            'cat' => $insights_featured_blog_category,
        );
        return $qargs;
        ?>
        <?php
    }
endif;


if (!function_exists('insights_featured_blog')) :
    /**
     * Banner Slider
     *
     * @since Insights 1.0.0
     *
     */
    function insights_featured_blog()
    {
        $insights_featured_blog_title_text = esc_html(insights_get_option('heading_text_on_featured_blog'));

        if (1 != insights_get_option('show_featured_blog_section')) {
            return null;
        }
        $insights_featured_blog_args = insights_featured_blog_args();
        $insights_featured_blog_query = new WP_Query($insights_featured_blog_args); ?>

        <section class="most-read-section section-block">
            <div class="container">
                <?php if (!empty($insights_featured_blog_title_text)) { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-heading">
                                <h2 class="section-title">
                                    <?php echo esc_html($insights_featured_blog_title_text); ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <?php
                    if ($insights_featured_blog_query->have_posts()) :
                        while ($insights_featured_blog_query->have_posts()) : $insights_featured_blog_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                $url = $thumb['0'];
                            }
                            ?>
                            <div class="col-md-8">
                                <article class="article-full">
                                    <div class="article-container">
                                        <div class="article-image article-image-radius">
                                            <a href="<?php the_permalink(); ?>">
                                                <span class="article-bg bg-image">
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
                                        <div class="article-item-content">
                                            <h3 class="entry-title">
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
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif; ?>
                    <?php         
                        $insights_featured_blog_category = esc_attr(insights_get_option('select_category_for_featured_blog'));
                            $qarg = array(
                                'posts_per_page' => 5,
                                'offset' => 1,
                                'post_type' => 'post',
                                'cat' => $insights_featured_blog_category,
                            ); 
                        $insights_featured_blog_querys = new WP_Query($qarg);
                        ?>
                            <div class="col-md-4">
                                <?php
                                if ($insights_featured_blog_querys->have_posts()) :
                                    while ($insights_featured_blog_querys->have_posts()) : $insights_featured_blog_querys->the_post();
                                        if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                            $url = $thumb['0'];
                                        }
                                        ?>
                                            <article class="article-list">
                                                <div class="row row-sm">
                                                    <div class="col-xs-4">
                                                        <div class="article-image article-image-radius">
                                                            <div class="article-bg-list bg-image">
                                                                <?php if (has_post_thumbnail()) { ?>
                                                                    <img src="<?php echo esc_url($url); ?>">
                                                                <?php  } ?>
                                                            </div>
                                                            <a href="<?php the_permalink(); ?>" class="article-item-link"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="article-item-content">
                                                            <div class="entry-meta">
                                                                <?php insights_posted_details_date_name(); ?>
                                                            </div>
                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h3>
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
        </section>



        <?php
    }
endif;
add_action('insights_action_featured_blog_post', 'insights_featured_blog', 10);