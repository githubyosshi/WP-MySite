<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Insights
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="twp-article-wrapper">
			<?php if (is_singular()) {
			    if ( has_post_thumbnail( $post->ID ) ) {
			        $banner_image_single_post = get_post_meta( $post->ID, 'insights-meta-checkbox', true );
			        if ( 'yes' != $banner_image_single_post ) {
			        	echo "<div class='image-full'>";
			        		the_post_thumbnail('full');
			        	echo "</div>";/*div end */
			        }
			    }
			}
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'insights' ),
				'after'  => '</div>',
			) );
		?>
		</div>
	</div><!-- .entry-content -->
<?php if (  current_user_can( 'edit_theme_options' ) ) {?>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'insights' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);

		?>
	</footer><!-- .entry-footer -->
<?php } ?>
</article><!-- #post-## -->
