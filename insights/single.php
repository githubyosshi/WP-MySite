<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Insights
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			$format = get_post_format();
			$format = ( false === $format ) ? 'single' : $format;
			?>
			<?php get_template_part( 'template-parts/content', $format ); ?>

            <?php
            // Previous/next post navigation.
            the_post_navigation(array(
                'next_text' => '<h2 class="entry-title entry-title-medium" aria-hidden="true">' . __('Next', 'insights') . '</h2> ' .
                    '<span class="screen-reader-text">' . __('Next post:', 'insights') . '</span> ' .
                    '<h3 class="entry-title entry-title-small">%title</h3>',
                'prev_text' => '<h2 class="entry-title entry-title-medium" aria-hidden="true">' . __('Previous', 'insights') . '</h2> ' .
                    '<span class="screen-reader-text">' . __('Previous post:', 'insights') . '</span> ' .
                    '<h3 class="entry-title entry-title-small">%title</h3>',
            ));
            ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
