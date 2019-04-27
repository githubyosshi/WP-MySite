<?php
global $post;
if (!function_exists('insights_single_page_title')) :
    function insights_single_page_title()
    { 
        global $post;
        $global_banner_image = get_header_image();
        // Check if single.
            if (is_singular()) {
                if ( has_post_thumbnail( $post->ID ) ) {
                    $banner_image_single_post = get_post_meta( $post->ID, 'insights-meta-checkbox', true );
                    if ( 'yes' == $banner_image_single_post ) {
                        $banner_image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'insights-header-image' );
                        $global_banner_image = $banner_image_array[0];
                    }
                }
            }
            ?>
            <?php 
            $banner_bg_enabled_class = '';
            if (!empty($global_banner_image)) {
                $banner_bg_enabled_class = 'banner-bg-enabled';
            } else {
                $banner_bg_enabled_class = 'banner-bg-disabled';
            } ?>

            <?php if ( class_exists( 'WooCommerce' ) ) {
                if (is_woocommerce()) {
                    return;
                }
            } ?>
        <section class="page-inner-title inner-banner <?php echo esc_attr($banner_bg_enabled_class); ?> data-bg" data-background="<?php echo esc_url($global_banner_image); ?>">
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <?php if (is_singular()) { ?>
                                <?php the_title('<h1 class="entry-title">', '</h1>');?>
                                <div class="entry-meta">
                                     <div class="inner-meta-info">
                                         <?php insights_posted_details(); ?>
                                         <span class="post-category primary-font">
                                             <?php insights_entry_category(); ?>
                                         </span>
                                     </div>
                                 </div>
                            <?php } elseif (is_404()) { ?>
                                <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'insights'); ?></h1>
                            <?php } elseif (is_archive()) {
                                the_archive_title('<h1 class="entry-title">', '</h1>');
                                the_archive_description('<div class="taxonomy-description">', '</div>');
                            } elseif (is_search()) { ?>
                                <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'insights'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            <?php } else { ?>
                                <h1 class="entry-title"><?php esc_html_e('Latest Blog', 'insights'); ?></h1>
                            <?php }
                            ?>
                        </div>

                    </div>
                </div>
            </header>
            <div class="inner-header-overlay"></div>
        </section>
        <?php if (! is_front_page()) {?>
            <section class="section-block section-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <?php
                        /**
                         * Hook - insights_add_breadcrumb.
                         */
                        do_action( 'insights_action_breadcrumb' );
                        ?>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php
    }
endif;
add_action('insights-page-inner-title', 'insights_single_page_title', 15);
