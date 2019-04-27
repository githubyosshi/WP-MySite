<?php
/**
 * carousel section
 *
 * @package Insights
 */

$default = insights_get_default_theme_options();

// Carousel Main Section.
$wp_customize->add_section( 'carousel_section_settings',
	array(
		'title'      => __( 'Blog/News Carousel Section', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_carousel_section.
$wp_customize->add_setting( 'show_carousel_section',
	array(
		'default'           => $default['show_carousel_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_carousel_section',
	array(
		'label'    => __( 'Enable Carousel', 'insights' ),
		'section'  => 'carousel_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'heading_text_on_carousel',
	array(
		'default'           => $default['heading_text_on_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'heading_text_on_carousel',
	array(
		'label'    => __( 'Section Title Text', 'insights' ),
		'section'  => 'carousel_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

/*No of Carousel*/
$wp_customize->add_setting( 'number_of_home_carousel',
	array(
		'default'           => $default['number_of_home_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_carousel',
	array(
		'label'    => __( 'Select no of carousel', 'insights' ),
		'section'  => 'carousel_section_settings',
		'input_attrs'     => array( 'min' => 1, 'max' => 6, 'style' => 'width: 150px;' ),

		'type'     => 'number',
		'priority' => 105,
	)
);


// Setting - drop down category for carousel.
$wp_customize->add_setting( 'select_category_for_carousel',
	array(
		'default'           => $default['select_category_for_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_carousel',
	array(
        'label'           => __( 'Category for carousel', 'insights' ),
        'description'     => __( 'Select category to be shown on Carousel bellow slider ', 'insights' ),
        'section'         => 'carousel_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,

    ) ) );



// Featured Blog Main Section.
$wp_customize->add_section( 'featured_blog_section_settings',
	array(
		'title'      => __( 'Blog/News Featured Blog Section', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_featured_blog_section.
$wp_customize->add_setting( 'show_featured_blog_section',
	array(
		'default'           => $default['show_featured_blog_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_featured_blog_section',
	array(
		'label'    => __( 'Enable Featured Blog', 'insights' ),
		'section'  => 'featured_blog_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'heading_text_on_featured_blog',
	array(
		'default'           => $default['heading_text_on_featured_blog'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'heading_text_on_featured_blog',
	array(
		'label'    => __( 'Section Title Text', 'insights' ),
		'section'  => 'featured_blog_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);


// Setting - drop down category for featured_blog.
$wp_customize->add_setting( 'select_category_for_featured_blog',
	array(
		'default'           => $default['select_category_for_featured_blog'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured_blog',
	array(
        'label'           => __( 'Category for Featured Blog', 'insights' ),
        'description'     => __( 'Select category to be shown on Featured Blog bellow slider ', 'insights' ),
        'section'         => 'featured_blog_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,

    ) ) );


// Setting - featured_blog_background_color.
$wp_customize->add_setting( 'featured_blog_background_color',
	array(
		'default'           => $default['featured_blog_background_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'featured_blog_background_color',
	array(
		'label'    => __( 'Featured Blog Background Color', 'insights' ),
		'section'  => 'featured_blog_section_settings',
		'type'     => 'color',
		'priority' => 170,
	)
));

// Setting - featured_blog_text_color.
$wp_customize->add_setting( 'featured_blog_text_color',
	array(
		'default'           => $default['featured_blog_text_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'featured_blog_text_color',
	array(
		'label'    => __( 'Featured Blog Text Color', 'insights' ),
		'section'  => 'featured_blog_section_settings',
		'type'     => 'color',
		'priority' => 170,
	)
));
/*settings for Section property*/

// Footer featured fix post Section.
$wp_customize->add_section('footer_pined_post_section_settings',
    array(
        'title' => esc_html__('Footer Related Post Section Options', 'insights'),
        'priority' => 110,
        'capability' => 'edit_theme_options',
        'panel' => 'homepage_option_panel',
    )
);
// Setting - show_footer_pinned_post_section_section.
$wp_customize->add_setting('show_footer_pinned_post_section_section',
    array(
        'default' => $default['show_footer_pinned_post_section_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_footer_pinned_post_section_section',
    array(
        'label' => esc_html__('Enable Footer Related Post Section', 'insights'),
        'section' => 'footer_pined_post_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);
// Setting - enable_pined_section_banner_overlay.
$wp_customize->add_setting('enable_pined_section_banner_overlay',
    array(
        'default' => $default['enable_pined_section_banner_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_checkbox',
    )
);
$wp_customize->add_control('enable_pined_section_banner_overlay',
    array(
        'label' => esc_html__('Enable Section Banner OverLay', 'insights'),
        'section' => 'footer_pined_post_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

/*No of Slider*/
$wp_customize->add_setting('title_footer_pinned_post',
	array(
		'default'           => $default['title_footer_pinned_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('title_footer_pinned_post',
	array(
		'label'       => esc_html__('Section Title', 'insights'),
		'section'     => 'footer_pined_post_section_settings',
		'type'        => 'text',
		'priority'    => 110,
	)
);

$wp_customize->add_setting('select_category_for_footer_pinned_section',
	array(
		'default'           => $default['select_category_for_footer_pinned_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Insights_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_footer_pinned_section',
		array(
			'label'           => esc_html__('Category for Footer Related Post', 'insights'),
			'section'         => 'footer_pined_post_section_settings',
			'type'            => 'dropdown-taxonomies',
			'taxonomy'        => 'category',
			'priority'        => 130,

		)));