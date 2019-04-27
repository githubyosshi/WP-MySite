<?php
/**
 * Template part for displaying single posts.
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
			} ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'insights' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer primary-font">
		<?php insights_entry_tags(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
/**
* Hook insights_related_posts
*  
* @hooked insights_get_related_posts 
*/
do_action( 'insights_related_posts' ); ?>