<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Insights
 */

if ( ! function_exists( 'insights_posted_details' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function insights_posted_details() {
	global $post;
	$author_id = $post->post_author;
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
	    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf($time_string,
	    esc_attr(get_the_date('c')),
	    esc_html(get_the_date()),
	    esc_attr(get_the_modified_date('c')),
	    esc_html(get_the_modified_date())
	); 
	$avatar = get_avatar( $author_id , 100, '', '', array( 'class' => 'byline' ) );
	if( $avatar !== false )
	{
	    $avatar_img = $avatar;
	}
	$byline = sprintf(
	    esc_html__( 'By %s', 'insights' ),
	    '<a class="url" href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author_meta('display_name', $author_id)) . '</a>'
	);
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	$posted_on = sprintf(
	    esc_html__( ' %s', 'insights' ),
	    '<a href="' . esc_url(get_day_link( $archive_year, $archive_month, $archive_day)) . '" rel="bookmark">' . $time_string . '</a>'
	);


	echo '<span class="author primary-font"> ' .$avatar_img .' '.$byline . '</span><span class="posted-on primary-font">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;


if ( ! function_exists( 'insights_posted_details_date_name' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function insights_posted_details_date_name() {
	global $post;
	$author_id = $post->post_author;
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
	    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf($time_string,
	    esc_attr(get_the_date('c')),
	    esc_html(get_the_date()),
	    esc_attr(get_the_modified_date('c')),
	    esc_html(get_the_modified_date())
	); 
	$byline = sprintf(
	    esc_html__( 'By %s', 'insights' ),
	    '<a class="url" href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author_meta('display_name', $author_id)) . '</a>'
	);
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	$posted_on = sprintf(
	    esc_html__( ' %s', 'insights' ),
	    '<a href="' . esc_url(get_day_link( $archive_year, $archive_month, $archive_day)) . '" rel="bookmark">' . $time_string . '</a>'
	);


	echo '<span class="author primary-font">'.$byline . '</span><span class="posted-on primary-font">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;
if ( ! function_exists( 'insights_entry_category' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function insights_entry_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(' / ');
		if ( $categories_list && insights_categorized_blog() ) {
			//printf( '<span class="cat-links"><span class="icon meta-icon ion-ios-folder"></span>' . esc_html__( 'Posted in %1$s', 'insights' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			printf($categories_list);
		}
	}
}
endif;
/*
 * Category Color Options
 */
if (!function_exists('insights_category_color')) :

	function insights_category_color($wp_category_id) {
		$args = array(
			'orderby' => 'id',
			'hide_empty' => 0
		);
		$category = get_categories($args);
		foreach ($category as $category_list) {
			$color = insights_get_option('insights_category_color_' . $wp_category_id);
			return esc_attr($color);
		}
	}

endif;

/*
 * Category Color display
 */
if ( ! function_exists( 'insights_entry_category_style_2' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function insights_entry_category_style_2() {
	global $post;
	$categories = get_the_category();
	$output = '';
	if ($categories) {
		foreach ($categories as $category) {
			$color_code = insights_category_color(get_cat_id($category->cat_name));
			if (!empty($color_code)) {
				$output .= '<a href="' . get_category_link($category->term_id) . '" style="background:' . insights_category_color(get_cat_id($category->cat_name)) . '" rel="category tag">' . $category->cat_name . '</a>';
			} else {
				$output .= '<a href="' . get_category_link($category->term_id) . '"  rel="category tag">' . $category->cat_name . '</a>';
			}
		}
	}
	echo wp_kses_post($output);
	
}
endif;


if ( ! function_exists( 'insights_entry_tags' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function insights_entry_tags() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'insights' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged :  %1$s', 'insights' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
		
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function insights_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'insights_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'insights_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so insights_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so insights_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in insights_categorized_blog.
 */
function insights_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'insights_categories' );
}
add_action( 'edit_category', 'insights_category_transient_flusher' );
add_action( 'save_post',     'insights_category_transient_flusher' );
