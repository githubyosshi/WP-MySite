<?php 

/**
 * Theme Options Panel.
 *
 * @package Insights
 */

$default = insights_get_default_theme_options();

/*slider and its property section*/
require get_template_directory() . '/inc/customizer/slider.php';
require get_template_directory() . '/inc/customizer/homepage-options.php';

// Add Theme Options Panel.
$wp_customize->add_panel( 'homepage_option_panel',
	array(
		'title'      => esc_html__( 'HomePage Setting Options', 'insights' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);


// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'insights' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);
// Footer Latest fix post Section.
$wp_customize->add_section('fix_post_section_settings',
    array(
        'title' => esc_html__('Fixed Scroll News Section Options', 'insights'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);
// Setting - show_latest_fixed_post_section_section.
$wp_customize->add_setting('show_latest_fixed_post_section_section',
    array(
        'default' => $default['show_latest_fixed_post_section_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_latest_fixed_post_section_section',
    array(
        'label' => esc_html__('Enable Fixed Scroll News Section', 'insights'),
        'section' => 'fix_post_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);

/*No of Slider*/
$wp_customize->add_setting('number_of_fixed_post',
    array(
        'default'           => $default['number_of_fixed_post'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_positive_integer',
    )
);
$wp_customize->add_control('number_of_fixed_post',
    array(
        'label'       => esc_html__('Select no of post to display (max-15)', 'insights'),
        'section'     => 'fix_post_section_settings',
        'type'        => 'number',
        'priority'    => 110,
        'input_attrs' => array('min' => 1, 'max' => 15, 'style' => 'width: 150px;'),

    )
);

$wp_customize->add_setting('select_category_for_footer_fix_section',
    array(
        'default'           => $default['select_category_for_footer_fix_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Insights_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_footer_fix_section',
        array(
            'label'           => esc_html__('Category for You May Like', 'insights'),
            'section'         => 'fix_post_section_settings',
            'type'            => 'dropdown-taxonomies',
            'taxonomy'        => 'category',
            'priority'        => 130,

        )));

/*layout management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Layout Management', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_overlay_option',
	array(
		'label'    => esc_html__( 'Enable Banner Overlay', 'insights' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'homepage_layout_option',
	array(
		'default'           => $default['homepage_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'homepage_layout_option',
	array(
		'label'    => esc_html__( 'Home Page Layout', 'insights' ),
		'section'  => 'theme_option_section_settings',
		'choices'  => array(
                'full-width' => __( 'Full Width', 'insights' ),
                'boxed' => __( 'Boxed', 'insights' ),
		    ),
		'type'     => 'select',
		'priority' => 160,
	)
);

/*Global Layout*/
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'insights' ),
		'section'  => 'theme_option_section_settings',
		'choices'   => array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'insights' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'insights' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'insights' ),
			),
		'type'     => 'select',
		'priority' => 170,
	)
);


/*content excerpt in global*/
$wp_customize->add_setting( 'excerpt_length_global',
	array(
		'default'           => $default['excerpt_length_global'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length_global',
	array(
		'label'    => esc_html__( 'Set Global Archive Length', 'insights' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'number',
		'priority' => 175,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

/*Archive Layout image*/
$wp_customize->add_setting( 'archive_layout_image',
	array(
		'default'           => $default['archive_layout_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout_image',
	array(
		'label'    => esc_html__( 'Archive Image Alocation', 'insights' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => __( 'Full', 'insights' ),
			'right' => __( 'Right', 'insights' ),
			'left' => __( 'Left', 'insights' ),
			'no-image' => __( 'No image', 'insights' )
		    ),
		'type'     => 'select',
		'priority' => 185,
	)
);


// Pagination Section.
$wp_customize->add_section( 'pagination_section',
	array(
	'title'      => __( 'Pagination Options', 'insights' ),
	'priority'   => 110,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'pagination_type',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'pagination_type',
	array(
	'label'       => __( 'Pagination Type', 'insights' ),
	'section'     => 'pagination_section',
	'type'        => 'select',
	'choices'               => array(
		'default' => __( 'Default (Older / Newer Post)', 'insights' ),
		'numeric' => __( 'Numeric', 'insights' ),
	    ),
	'priority'    => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => __( 'Footer Options', 'insights' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


// Setting social_content_heading.
$wp_customize->add_setting( 'number_of_footer_widget',
	array(
	'default'           => $default['number_of_footer_widget'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_footer_widget',
	array(
	'label'    => __( 'Number Of Footer Widget', 'insights' ),
	'section'  => 'footer_section',
	'type'     => 'select',
	'priority' => 100,
	'choices'               => array(
		0 => __( 'Disable footer sidebar area', 'insights' ),
		1 => __( '1', 'insights' ),
		2 => __( '2', 'insights' ),
		3 => __( '3', 'insights' ),
		4 => __( '4', 'insights' ),
	    ),
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => __( 'Footer Copyright Text', 'insights' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);


// Setting - footer_background_color.
$wp_customize->add_setting( 'footer_background_color',
	array(
		'default'           => $default['footer_background_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color',
	array(
		'label'    => __( 'Footer Background Color', 'insights' ),
		'section'  => 'footer_section',
		'type'     => 'color',
		'priority' => 160,
	)
));


// Setting - footer_line_color.
$wp_customize->add_setting( 'footer_line_color',
	array(
		'default'           => $default['footer_line_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'footer_line_color',
	array(
		'label'    => __( 'Footer Line Color', 'insights' ),
		'section'  => 'footer_section',
		'type'     => 'color',
		'priority' => 160,
	)
));



// Setting - footer_text_color.
$wp_customize->add_setting( 'footer_text_color',
	array(
		'default'           => $default['footer_text_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'footer_text_color',
	array(
		'label'    => __( 'Footer Text Color', 'insights' ),
		'section'  => 'footer_section',
		'type'     => 'color',
		'priority' => 160,
	)
));


// Setting - copyright_background_color.
$wp_customize->add_setting( 'copyright_background_color',
	array(
		'default'           => $default['copyright_background_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'copyright_background_color',
	array(
		'label'    => __( 'Copyright Background Color', 'insights' ),
		'section'  => 'footer_section',
		'type'     => 'color',
		'priority' => 160,
	)
));



// Setting - copyright_text_color.
$wp_customize->add_setting( 'copyright_text_color',
	array(
		'default'           => $default['copyright_text_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'copyright_text_color',
	array(
		'label'    => __( 'Copyright Text Color', 'insights' ),
		'section'  => 'footer_section',
		'type'     => 'color',
		'priority' => 160,
	)
));
// Breadcrumb Section.
$wp_customize->add_section( 'breadcrumb_section',
	array(
	'title'      => __( 'Breadcrumb Options', 'insights' ),
	'priority'   => 120,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'insights_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
	'label'       => __( 'Breadcrumb Type', 'insights' ),
	'description' => sprintf( __( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'insights' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'breadcrumb_section',
	'type'        => 'select',
	'choices'               => array(
		'disabled' => __( 'Disabled', 'insights' ),
		'simple' => __( 'Simple', 'insights' ),
		'advanced' => __( 'Advanced', 'insights' ),
	    ),
	'priority'    => 100,
	)
);


// Preloader Section.
$wp_customize->add_section('enable_preloader_option',
    array(
        'title' => __('Preloader Options', 'insights'),
        'priority' => 120,
        'capability' => 'edit_theme_options',
        'panel' => 'theme_option_panel',
    )
);

// Setting enable_preloader.
$wp_customize->add_setting('enable_preloader',
    array(
        'default' => $default['enable_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'insights_sanitize_checkbox',
    )
);
$wp_customize->add_control('enable_preloader',
    array(
        'label' => __('Enable Preloader', 'insights'),
        'section' => 'enable_preloader_option',
        'type' => 'checkbox',
        'priority' => 150,
    )
);
