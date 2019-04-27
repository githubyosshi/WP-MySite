<?php
/**
 * slider section
 *
 * @package Insights
 */

$default = insights_get_default_theme_options();
// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => __( 'Slider Section', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => __( 'Enable Slider', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
// Setting - enable_slider_overlay.
$wp_customize->add_setting( 'enable_slider_overlay',
	array(
		'default'           => $default['enable_slider_overlay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_slider_overlay',
	array(
		'label'    => __( 'Enable Slider Overlay', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Add the layout setting.
$wp_customize->add_setting( 'slider_section_layout',
    array(
		'default'           => $default['slider_section_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_select',
    )
);
$wp_customize->add_control( new Insights_Radio_Image_Control( $wp_customize, 'slider_section_layout',
            array(
                'label'    => esc_html__( 'Slider Layout', 'insights' ),
				'section'     => 'slider_section_settings',
				'priority' => 100,
                'choices'  => array(
                	'twp-slider-1' 				=> esc_url(get_template_directory_uri() . '/inc/customizer/images/slider-layout-1.png'),
                	'twp-slider-2' 			=> esc_url(get_template_directory_uri() . '/inc/customizer/images/slider-layout-2.png'),
                )
            )
        )
    );

/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_slider',
	array(
		'default'           => $default['number_of_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_home_slider',
	array(
		'label'    => __( 'Select no of slider', 'insights' ),
        'description'     => __( 'If you are using selection "from page" option please refresh to get actual no of page', 'insights' ),
		'section'  => 'slider_section_settings',
		'choices'               => array(
		    '1' => __( '1', 'insights' ),
		    '2' => __( '2', 'insights' ),
		    '3' => __( '3', 'insights' ),
		    '4' => __( '4', 'insights' ),
		    ),
		'type'     => 'select',
		'priority' => 105,
	)
);

/*content excerpt in Slider*/
$wp_customize->add_setting( 'number_of_content_home_slider',
	array(
		'default'           => $default['number_of_content_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_slider',
	array(
		'label'    => __( 'Select no words of slider', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'number',
		'priority' => 110,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => __( 'Category for slider', 'insights' ),
        'description'     => __( 'Select category to be shown on slider ', 'insights' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,

    ) ) );

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_post_below_slider',
	array(
		'default'           => $default['select_category_for_post_below_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_post_below_slider',
	array(
        'label'           => __( 'Category for Post Below Slider', 'insights' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
		'active_callback' => 'insights_is_select_slider_layout_1',

    ) ) );


// Setting - banner_background_color.
$wp_customize->add_setting( 'banner_background_color',
	array(
		'default'           => $default['banner_background_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'banner_background_color',
	array(
		'label'    => __( 'Banner/Slider Background Color', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'color',
		'priority' => 170,
		'active_callback' => 'insights_is_select_slider_layout_1',
	)
));


// Setting - banner_text_color.
$wp_customize->add_setting( 'banner_text_color',
	array(
		'default'           => $default['banner_text_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'banner_text_color',
	array(
		'label'    => __( 'Banner/Slider Text Color', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'color',
		'priority' => 170,
		'active_callback' => 'insights_is_select_slider_layout_1',
	)
));

/*settings for Section property*/
/*Button Text*/
$wp_customize->add_setting( 'button_text_on_slider',
	array(
		'default'           => $default['button_text_on_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'button_text_on_slider',
	array(
		'label'    => __( 'Button Text', 'insights' ),
		'description'     => __( 'Removing text will disable button on the slider', 'insights' ),
		'section'  => 'slider_section_settings',
		'type'     => 'text',
		'priority' => 170,
	)
);

