<?php
/**
 * Theme widgets.
 *
 * @package Insights
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('insights_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function insights_load_widgets()
    {
        // Recent Post widget.
        register_widget('TWP_sidebar_widget');

        // Auther widget.
        register_widget('TWP_Author_Post_widget');

        // Social widget.
        register_widget('TWP_Social_widget');

    }
endif;
add_action('widgets_init', 'insights_load_widgets');

/*Grid Panel widget*/
if (!class_exists('TWP_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class TWP_sidebar_widget extends Insights_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'insights_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'insights'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'insights'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'insights'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'insights'),
                ),
                'enable_counter' => array(
                    'label' => __('Enable Counter:', 'insights'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'insights'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
            );

            parent::__construct('insights-popular-sidebar-layout', __('TWP: Recent Post', 'insights'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php global $post; 
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">                
                <ul class="recent-widget-list">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li>
                        <article class="article-list">
                            <div class="row row-sm">
                                <div class="col-xs-4">
                                    <div class="article-image  article-image-radius">
                                        <?php if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'insights-900-600' );
                                            $url = $thumb['0'];
                                            } else {
                                                $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                        }
                                        ?>
                                        <a href="<?php the_permalink(); ?>" class="bg-image bg-image-light bg-image-1">
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                        <?php if (true === $params['enable_counter']) { ?>
                                        <div class="trend-item">
                                            <span class="number secondary-bgcolor"> <?php echo $count; ?></span>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="article-body">
                                        <div class="entry-meta">
                                            <span class="posted-on primary-font">
                                                <?php the_time('j M Y'); ?>
                                            </span>
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
                    </li>
                <?php 
                $count++;
                endforeach; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Video widget*/
if (!class_exists('TWP_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Author_Post_widget extends Insights_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'insights_author_widget',
                'description' => __('Displays authors details in post.', 'insights'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'insights'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_bg_url' => array(
                    'label' => __('Widget Background Image:', 'insights'),
                    'type'  => 'image',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'insights'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'insights'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'insights'),
                    'type'  => 'image',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => __('Linkedin URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => __('Instagram URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('insights-author-layout', __('TWP: Author Widget', 'insights'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <?php if ( ! empty( $params['image_bg_url'] ) ) { ?>
                    <div class="author-background bg-image bg-image-light">
                        <img src="<?php echo esc_url( $params['image_bg_url'] ); ?>">
                    </div>
                <?php } ?>
                <div class="author-image">
                    <?php if ( ! empty( $params['image_url'] ) ) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url( $params['image_url'] ); ?>">
                        </div>
                    <?php } ?>
                </div>
                <div class="author-details">
                    <?php if ( ! empty( $params['author-name'] ) ) { ?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name'] );?></h3>
                    <?php } ?>
                    <?php if ( ! empty( $params['description'] ) ) { ?>
                        <div class="author-bio"><?php echo wp_kses_post( $params['description']); ?></div>
                    <?php } ?>
                </div>
                <div class="author-social">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>"><i class="meta-icon ion-social-facebook"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>"><i class="meta-icon ion-social-twitter"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-lt'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-lt']); ?>"><i class="meta-icon ion-social-linkedin"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-ig'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-ig']); ?>"><i class="meta-icon ion-social-instagram"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;



/*Social widget*/
if (!class_exists('TWP_Social_widget')) :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Social_widget extends Insights_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'insights_social_widget',
                'description' => __('Displays Social share.', 'insights'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'insights'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => __('Linkedin URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => __('Instagram URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-pt' => array(
                   'label' => __('Pinterest URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-rt' => array(
                   'label' => __('Reddit URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sk' => array(
                   'label' => __('Skype URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sc' => array(
                   'label' => __('Snapchat URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tr' => array(
                   'label' => __('Tumblr URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-th' => array(
                   'label' => __('Twitch URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-yt' => array(
                   'label' => __('Youtube URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vo' => array(
                   'label' => __('Vimeo URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wa' => array(
                   'label' => __('Whatsapp URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wp' => array(
                   'label' => __('WordPress URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gh' => array(
                   'label' => __('Github URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-fs' => array(
                   'label' => __('FourSquare URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-db' => array(
                   'label' => __('Dribbble URL:', 'insights'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('insights-social-layout', __('TWP: Social Widget', 'insights'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <div class="twp-social-widget">
                <ul class="social-widget-wrapper">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank"><i class="meta-icon ion-social-facebook"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank"><i class="social-icon ion-social-twitter"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-lt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank"><i class="social-icon ion-social-linkedin"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-ig'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank"><i class="social-icon ion-social-instagram"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-pt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank"><i class="social-icon ion-social-pinterest"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-rt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank"><i class="social-icon ion-social-reddit"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-sk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank"><i class="social-icon ion-social-skype"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-sc'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank"><i class="social-icon ion-social-snapchat"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tr'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank"><i class="social-icon ion-social-tumblr"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-th'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank"><i class="social-icon ion-social-twitch"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-yt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank"><i class="social-icon ion-social-youtube"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-vo'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank"><i class="social-icon ion-social-vimeo"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-wa'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank"><i class="social-icon ion-social-whatsapp"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-wp'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank"><i class="social-icon ion-social-wordpress"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-gh'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank"><i class="social-icon ion-social-github"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-fs'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank"><i class="social-icon ion-social-foursquare"></i></a>
                        </li>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-db'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank"><i class="social-icon ion-social-dribbble"></i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

