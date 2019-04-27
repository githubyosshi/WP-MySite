<?php 

$default = insights_get_default_theme_options();

//$wp_customize->get_section('colors')->title = __( 'General settings' );

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_color_typo',
	array(
		'title'      => __( 'General settings', 'insights' ),
		'priority'   => 40,
		'capability' => 'edit_theme_options',
	)
);

// font Section.
$wp_customize->add_section( 'font_typo_section',
	array(
		'title'      => __( 'Fonts & Typography', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_color_typo',
	)
);

// font Section.
$wp_customize->add_section( 'colors',
	array(
		'title'      => __( 'Color Options', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_color_typo',
	)
);

// category color Section.
$wp_customize->add_section( 'category_colors',
	array(
		'title'      => __( 'Category Background Color Options', 'insights' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_color_typo',
	)
);

$i = 1;
$args = array(
	'orderby' => 'id',
	'hide_empty' => 1
);
$categories = get_categories($args);
$wp_category_list = array();

// looping through each category colors
foreach ($categories as $category_list) {
	$wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

	$wp_customize->add_setting('insights_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]), array(
		'default' => '#e40914',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'insights_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]), array(
		'label' => sprintf(esc_html__('%s ', 'insights'), $wp_category_list[$category_list->cat_ID]),
		'section' => 'category_colors',
		'settings' => 'insights_category_color_' . get_cat_id($wp_category_list[$category_list->cat_ID]),
		'priority' => $i
	)));
	$i++;
}


// Setting - text_size_h1.
$wp_customize->add_setting( 'text_size_h1',
	array(
		'default'           => $default['text_size_h1'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'text_size_h1',
	array(
		'label'    => __( 'Single page/post Title', 'insights' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 120,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

// Setting - medium_article_title.
$wp_customize->add_setting( 'medium_article_title',
	array(
		'default'           => $default['medium_article_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'medium_article_title',
	array(
		'label'    => __( 'Medium article title', 'insights' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 125,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

// Setting - small_article_title.
$wp_customize->add_setting( 'small_article_title',
	array(
		'default'           => $default['small_article_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'small_article_title',
	array(
		'label'    => __( 'Small article title', 'insights' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 130,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

// Setting - inner_banner_title_size.
$wp_customize->add_setting( 'inner_banner_title_size',
	array(
		'default'           => $default['inner_banner_title_size'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'inner_banner_title_size',
	array(
		'label'    => __( 'Inner Banner Title Size', 'insights' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 135,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);


// Setting - text_size_p.
$wp_customize->add_setting( 'text_size_p',
	array(
		'default'           => $default['text_size_p'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'text_size_p',
	array(
		'label'    => __( 'Sitewide font size', 'insights' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 140,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

