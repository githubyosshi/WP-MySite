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

                <?php
                $raw_content = get_the_content();
                $content = apply_filters( 'the_content', $raw_content );

                $audio = false;
                // Only get audio from the content if a playlist isn't present.
                if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                    $audio = get_media_embedded_in_content( $content, array( 'audio' ) );
                }

                /*Get first word of content*/
                $first_word = substr($raw_content, 0, 1);
                /*only allow alphabets*/
                if(preg_match("/[A-Za-z]+/", $first_word) != TRUE){
                    $first_word = '';
                }

                if ( ! empty( $audio ) ) {
                    foreach ( $audio as $audio_html ) {
                        echo '<div class="entry-audio">';
                        echo $audio_html;
                        echo '</div><!-- .entry-audio -->';
                    }
                };
                ?>
				<?php the_excerpt(); ?>
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