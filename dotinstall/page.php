<?php get_header(); ?>
    <div id="main" class="container">
      <div id="posts">

        <?php
        if (have_posts()) :
          while (have_posts()) :
            the_post();
        ?>

        <div class="post">
          <div class="post-header">
            <h2>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

          </div>
          <div class="post-content">

              <?php the_content(); ?>
          </div>
        </div><!-- /post -->

        <?php
          endwhile;
        else:
        ?>

        <p>ページはありません！</p>

        <?php
        endif;
        ?>


      </div><!-- /posts -->

      <?php get_sidebar(); ?>
  </div><!-- /main -->
<?php get_footer(); ?>