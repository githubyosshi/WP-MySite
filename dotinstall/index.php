<?php get_header(); ?>
    <div id="main" class="container">
      <div id="posts">
        <div class="post">
          <div class="post-header">
            <h2>
              <a href="">タイトル</a>
            </h2>
            <div class="post-meta">
              2013年4月3日【カテゴリ】
            </div>
          </div>
          <div class="post-content">
            <div class="post-image">
              <img src="img/noimage.png" width="100" height="100">
            </div>
            <div class="post-body">
              <p>本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。本文。</p>
            </div>
          </div>
        </div><!-- /post -->
        <div class="navigation">
          <div class="prev">prev</div>
          <div class="next">next</div>
        </div>
      </div><!-- /posts -->

      <?php get_sidebar(); ?>
  </div><!-- /main -->
<?php get_footer(); ?>