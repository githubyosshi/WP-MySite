<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Insights
 */

?>
<?php $archive_layout_image = insights_get_option('archive_layout_image'); ?>

<?php if (has_post_thumbnail()) :
    if ('left' == $archive_layout_image) {
        $archive_post_image_alig = 'image-left';
    } elseif ('right' == $archive_layout_image) {
        $archive_post_image_alig = 'image-right';
    } elseif ('full' == $archive_layout_image) {
        $archive_post_image_alig = 'image-full';
    } else {
        $archive_post_image_alig = '';
    }

endif; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="twp-article-wrapper <?php echo $archive_post_image_alig; ?>">
        <div class="entry-content twp-entry-content">
            <div class='twp-image-archive article-image-radius'>
                <?php the_post_thumbnail( ); ?>
            </div>
            <div class="twp-archive-content">
                <?php if (!is_single()) { ?>
                <header class="article-header">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </header>
                <div class="entry-meta primary-font">
                <?php if ('full' == $archive_layout_image) { ?>
                    <?php insights_posted_details(); ?>
                    <div class="post-category">
                        <span>
                            <?php insights_entry_category(); ?>
                        </span>
                    </div>
                <?php } else {
                    insights_posted_details_date_name();
                } ?>

                </div><!-- .entry-meta -->
                <?php if ('full' == $archive_layout_image) { ?>
                    <div class="article-excerpt-archive">
                        <?php the_excerpt(); ?>
                    </div>
                <?php } ?>
            </div>
        </div><!-- .entry-content -->
        <?php if ('full' != $archive_layout_image) { ?>
            <?php the_excerpt(); ?>
        <?php } ?>
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
</article><!-- #post-## -->