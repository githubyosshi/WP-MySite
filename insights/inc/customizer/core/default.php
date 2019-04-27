<?php
/**
 * Default theme options.
 *
 * @package Insights
 */

if ( ! function_exists( 'insights_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function insights_get_default_theme_options() {

		$defaults = array();
		
		
		// Slider options.
		$defaults['show_slider_section']				        = 1;
		$defaults['enable_slider_overlay']				        = 0;
		$defaults['number_of_home_slider']				        = 4;
		$defaults['number_of_content_home_slider']		        = 30;
		$defaults['select_slider_from']					        = 'from-category';
		$defaults['slider_section_layout']				        = 'twp-slider-1';
		$defaults['select-page-for-slider']				        = 0;
		$defaults['select_category_for_slider']			        = 0;
		$defaults['banner_background_color']			        ='#1e1e1e';
		$defaults['banner_text_color']			                = '#ffffff';
        $defaults['select_category_for_post_below_slider']		= 0;
		$defaults['button_text_on_slider']				        = esc_html__( 'Continue Reading', 'insights' );
		
		// Font and color options.
		$defaults['primary_color']					= '#f7f7f7';
		$defaults['secondary_color']				= '#ff4200';
		$defaults['tertiary_color']				    = '#0015ff';
        $defaults['footer_background_color']		= '#000';
        $defaults['footer_line_color']				= '#2d2d2d';
		$defaults['footer_text_color']				= '#fff';
		$defaults['copyright_background_color']		= '#111';
		$defaults['copyright_text_color']			= '#fff';


		$defaults['primary_font']					= 'Poppins:300,400,500,600,700';
		$defaults['secondary_font']					= 'Open+Sans:400,400italic,600,700';
		$defaults['text_size_h1']					= 36;
		$defaults['medium_article_title']			= 20;
		$defaults['small_article_title']			= 16;
		$defaults['inner_banner_title_size']					= 18;
		$defaults['text_size_p']					= 16;
		
		// Footer fixed post options.
		$defaults['show_latest_fixed_post_section_section'] = 1;
		$defaults['number_of_fixed_post'] = 8;
		$defaults['select_category_for_footer_fix_section'] = 0;

		// carousel section options.
		$defaults['show_carousel_section']				= 1;
		$defaults['number_of_home_carousel']			= 6;
		$defaults['heading_text_on_carousel']			= esc_html__( 'Recent Post', 'insights' );
		$defaults['select_category_for_carousel']		= 0;

		// featured_blog section
		$defaults['show_featured_blog_section']			= 1;
		$defaults['heading_text_on_featured_blog']		= esc_html__( 'Featured Blog Post', 'insights' );
		$defaults['select_category_for_featured_blog']	= 0;
		$defaults['featured_blog_background_color']		= '#f9e3d2';
		$defaults['featured_blog_text_color']			= '#000';

		// footer you may have missed section
		$defaults['show_footer_pinned_post_section_section']    = 1;
		$defaults['enable_pined_section_banner_overlay']    = 1;
        $defaults['title_footer_pinned_post']                   = esc_html__('You may also like', 'insights');
        $defaults['select_category_for_footer_pinned_section']  = 0;

		//Layout options.
		$defaults['enable_top_header_date']     		= 1;
		$defaults['enable_top_header_search']     		= 1;
		$defaults['enable_overlay_option']     		= 0;
		$defaults['homepage_layout_option']			= 'full-width';
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 50;
		$defaults['archive_layout_image']			= 'full';
		$defaults['pagination_type']				= 'numeric';
		$defaults['enable_copyright_credit']     	= 1;
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'insights' );
		$defaults['number_of_footer_widget']		= 3;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader']				= 1;

		// Pass through filter.
		$defaults = apply_filters( 'insights_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
