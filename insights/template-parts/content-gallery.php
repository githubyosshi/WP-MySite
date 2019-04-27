<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Insights
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="twp-article-wrapper">
		<?php if (!is_single()) { ?>
			<div class="entry-content twp-entry-content <?php echo esc_attr($full_width_content); ?>">
				<div class="twp-archive-content">
					<?php 
					the_content(sprintf(
					/* translators: %s: Name of current post. */
					    wp_kses(__('%s <i class="ion-ios-arrow-right read-more-right"></i>', 'insights'), array('span' => array('class' => array()))),
					    the_title('<span class="screen-reader-text">"', '"</span>', false)
					)); ?>
					<header class="article-header">
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					</header>
					<div class="entry-meta primary-font">
						<?php insights_posted_details(); ?>
						<div class="post-category">
							<span>
								<?php insights_entry_category(); ?>
							</span>
						</div>
					</div><!-- .entry-meta -->
				</div>
			</div><!-- .entry-content -->
		<?php } else { ?>
			<div class="entry-content">
				<?php if (is_singular()) {
				    if ( has_post_thumbnail( $post->ID ) ) {
				        $banner_image_single_post = get_post_meta( $post->ID, 'insights-meta-checkbox', true );
				        if ( 'yes' != $banner_image_single_post ) {
				        	echo "<div class='image-full'>";
				        		the_post_thumbnail('full');
				        	echo "</div>";/*div end */
				        }
				    }
				} ?>
				<?php the_content(); ?>
				<?php
				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'insights'),
					'after' => '</div>',
				));
				?>
			</div>
		<?php } ?>
	</div>
	<?php if (is_single()) { ?>
		<footer class="entry-footer primary-font">
			<?php insights_entry_tags(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-## -->