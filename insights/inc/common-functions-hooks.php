<?php
if ( ! function_exists( 'insights_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     * @since Insights 1.0.0
     */
    function insights_the_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }
    }
endif;


if ( ! function_exists( 'insights_body_class' ) ) :

    /**
     * body class.
     *
     * @since 1.0.0
     */
    function insights_body_class($insights_body_class) {
        global $post;
        $global_layout = insights_get_option( 'global_layout' );
        $input = '';
        // Check if single.
        if ( $post && is_singular() ) {
            $post_options = get_post_meta( $post->ID, 'insights-meta-select-layout', true );
            if ( empty( $post_options ) ) {
                $global_layout = esc_attr( insights_get_option('global_layout') );
            } else{
                $global_layout = esc_attr($post_options);
            }
        }

        if (($global_layout == 'left-sidebar') && (is_active_sidebar( 'sidebar-1' )) ) {
            $insights_body_class[]= 'left-sidebar ' . esc_attr( $input );
        }
        elseif (($global_layout == 'no-sidebar') && (is_active_sidebar( 'sidebar-1' )) ){
            $insights_body_class[]= 'no-sidebar ' . esc_attr( $input );
        }
        elseif (($global_layout == 'right-sidebar') && (is_active_sidebar( 'sidebar-1' )) ){
            $insights_body_class[]= 'right-sidebar ' . esc_attr( $input );
        }

        if (! is_active_sidebar( 'sidebar-1' )) {
            $insights_body_class[]= 'no-sidebar-main' ;
        }
        if ( class_exists( 'wooCommerce' ) ) {
            if ( (is_woocommerce()) && (! is_active_sidebar( 'shop-sidebar' ))) {
                $insights_body_class[] = 'twp-no-shop-sidebar';
            }
        }
        return $insights_body_class;
    }
endif;

add_action( 'body_class', 'insights_body_class' );

add_action( 'insights_action_sidebar', 'insights_add_sidebar' );


/**
 * Returns word count of the sentences.
 *
 * @since Insights 1.0.0
 */
if ( ! function_exists( 'insights_words_count' ) ) :
    function insights_words_count( $length = 25, $insights_content = null ) {
        $length = absint( $length );
        $source_content = preg_replace( '`\[[^\]]*\]`', '', $insights_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '' );
        return $trimmed_content;
    }
endif;


if ( ! function_exists( 'insights_simple_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function insights_simple_breadcrumb() {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {

            require_once get_template_directory() . '/assets/libraries/breadcrumbs/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );

    }

endif;


if ( ! function_exists( 'insights_custom_posts_navigation' ) ) :
    /**
     * Posts navigation.
     *
     * @since 1.0.0
     */
    function insights_custom_posts_navigation() {

        $pagination_type = insights_get_option( 'pagination_type' );

        switch ( $pagination_type ) {

            case 'default':
                the_posts_navigation();
                break;

            case 'numeric':
                the_posts_pagination();
                break;

            default:
                break;
        }

    }
endif;

add_action( 'insights_action_posts_navigation', 'insights_custom_posts_navigation' );


if( ! function_exists( 'insights_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  Insights 1.0.0
     *
     * @param null
     * @return int
     */
    function insights_excerpt_length( $length ){
        if ( is_admin() ) {
            return $length;
        }
        $excerpt_length = insights_get_option( 'excerpt_length_global' );

        if ( absint( $excerpt_length ) > 0 ) {
            $length = absint( $excerpt_length );
        }

        return $length;

    }

    add_filter( 'excerpt_length', 'insights_excerpt_length', 999 );
endif;


if ( ! function_exists( 'insights_excerpt_more' ) )  :

    /**
     * Implement read more in excerpt.
     *
     * @since 1.0.0
     *
     * @param string $more The string shown within the more link.
     * @return string The excerpt.
     */
    function insights_excerpt_more( $more ) {
        if ( is_admin() ) {
            return $more;
        }
        $flag_apply_excerpt_read_more = apply_filters( 'insights_filter_excerpt_read_more', true );
        if ( true !== $flag_apply_excerpt_read_more ) {
            return $more;
        }

        $output = $more;
        $read_more_text = esc_html__('Continue Reading','insights');
        if ( ! empty( $read_more_text ) ) {
            $output = ' <a href="'. esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '<i class="ion-ios-arrow-right read-more-right"></i>' . '</a>';
            $output = apply_filters( 'insights_filter_read_more_link' , $output );
        }
        return $output;

    }

    add_filter('excerpt_more', 'insights_excerpt_more');
endif;

if ( ! function_exists( 'insights_get_link_url' ) ) :

    /**
     * Return the post URL.
     *
     * Falls back to the post permalink if no URL is found in the post.
     *
     * @since 1.0.0
     *
     * @return string The Link format URL.
     */
    function insights_get_link_url() {
        $content = get_the_content();
        $has_url = get_url_in_content( $content );

        return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
    }

endif;

if ( ! function_exists( 'insights_fonts_url' ) ) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function insights_fonts_url() {
        $fonts_url = '';
        $fonts     = array();


        $insights_primary_font = insights_get_option('primary_font');
        $insights_secondary_font = insights_get_option('secondary_font');

        $insights_fonts = array();
        $insights_fonts[]=$insights_primary_font;
        $insights_fonts[]=$insights_secondary_font;

        $insights_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

        $i  = 0;
        for ($i=0; $i < count( $insights_fonts ); $i++) {

            if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'insights' ), $insights_fonts[$i] ) ) {
                $fonts[] = $insights_fonts[$i];
            }

        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urldecode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }

endif;

/*related post*/
if (!function_exists('insights_get_related_posts')) :
    /*
     * Function to get related posts
     */
    function insights_get_related_posts()
    {
        global $post;

        //$options = insights_get_theme_options(); // get theme options

        $post_categories = get_the_category($post->ID); // get category object
        $category_ids = array(); // set an empty array

        foreach ($post_categories as $post_category) {
            $category_ids[] = $post_category->term_id;
        }

        if (empty($category_ids)) return;

        $qargs = array(
            'posts_per_page' => 5,
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'order' => 'ASC',
            'orderby' => 'rand'
        );

        $related_posts = get_posts($qargs); // custom posts
        ?>
        <section class="related-block section-block">
            <header class="related-header">
                <h2 class="related-title bordered-title">
                    <span><?php esc_html_e('Related articles', 'insights'); ?></span>
                </h2>
            </header>

            <div class="entry-content">
                <?php foreach ($related_posts as $related_post) {
                    if (has_post_thumbnail($related_post->ID)) {
                        $img_array = wp_get_attachment_image_src(get_post_thumbnail_id($related_post->ID), 'medium');
                    }
                    $post_title = get_the_title($related_post->ID);
                    $post_url = get_permalink($related_post->ID);
                    $posts_categories = get_the_category($related_post->ID);
                    ?>
                    <div class="related-article-wrapper">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="article-image-radius">
                                    <a href="<?php echo esc_url($post_url); ?>" class="bg-image bg-image-light bg-image-2">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <img src="<?php echo esc_url($img_array[0]); ?>" alt="<?php echo esc_attr($post_title); ?>">
                                        <?php  } ?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="post-category-1">
                                    <?php insights_entry_category_style_2(); ?>
                                </div>
                                <div class="related-article-title">
                                    <h3 class="entry-title entry-title-medium">
                                        <a href="<?php echo esc_url($post_url); ?>"><?php echo esc_html($post_title); ?></a>
                                    </h3>
                                </div>
                                <div class="entry-meta">
                                    <?php insights_posted_details_date_name(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
        <?php
    }
endif;
add_action('insights_related_posts', 'insights_get_related_posts');

if( ! function_exists( 'insights_recommended_plugins' ) ) :

    /**
     * Recommended plugins
     *
     */
    function insights_recommended_plugins(){
        $insights_plugins = array(
            array(
                'name'     => __('Social Share With Floating Bar', 'insights'),
                'slug'     => 'social-share-with-floating-bar',
                'required' => false,
            ),
            array(
                'name'     => __('One Click Demo Import', 'insights'),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );
        $insights_plugins_config = array(
            'dismissable' => true,
        );

        tgmpa( $insights_plugins, $insights_plugins_config );
    }
endif;
add_action( 'tgmpa_register', 'insights_recommended_plugins' );

/*Disable PT branding.*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
function insights_check_other_plugin() {
    // Assign front page and posts page (blog page).
    $front_page_id = null;
    $blog_page_id  = null;

    $front_page = get_page_by_title( 'Homepage' );

    if ( $front_page ) {
        if ( is_array( $front_page ) ) {
            $first_page = array_shift( $front_page );
            $front_page_id = $first_page->ID;
        } else {
            $front_page_id = $front_page->ID;
        }
    }

    $blog_page = get_page_by_title( 'Blog' );

    if ( $blog_page ) {
        if ( is_array( $blog_page ) ) {
            $first_page = array_shift( $blog_page );
            $blog_page_id = $first_page->ID;
        } else {
            $blog_page_id = $blog_page->ID;
        }
    }

    if ( $front_page_id && $blog_page_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id );
        update_option( 'page_for_posts', $blog_page_id );
    }

    // Assign navigation menu locations.
    $menu_location_details = array(
        'top' => 'top-menu',
        'primary' => 'primary-menu',
        'social' => 'social-menu',
        'footer' => 'footer-menu',
    );

    if ( ! empty( $menu_location_details ) ) {
        $navigation_settings = array();
        $current_navigation_menus = wp_get_nav_menus();
        if ( ! empty( $current_navigation_menus ) && ! is_wp_error( $current_navigation_menus ) ) {
            foreach ( $current_navigation_menus as $menu ) {
                foreach ( $menu_location_details as $location => $menu_slug ) {
                    if ( $menu->slug === $menu_slug ) {
                        $navigation_settings[ $location ] = $menu->term_id;
                    }
                }
            }
        }
    }
}
add_action('admin_init', 'insights_check_other_plugin');
