<?php get_header(); ?>

<main id="page_top">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="mv">
    <div id="ripples_bg"></div>
    <div id="mv_copy">
      <p class="ptSansNarrow"><?php echo topCopy(); ?></p>
    </div>
    <a id="mv_btn" class="arrow_animation ptSansNarrow" href="https://inoshunnomad.com/profile/">
      Profile
      <span><span></span></span>
    </a>
    <button id="scroll">
      <span></span>
    </button>
  </section>
  <section id="articles">
    <ul>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <div class="thumbnail">
            <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php else: ?><img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail_sample.jpg"><?php endif; ?>
          </div>
          <div class="article_infos">
            <div class="article_top">
              <div>
                <p class="date"><?php the_time('Y.m.j') ?></p>
                <p class="category">
                  <?php
                  $category = get_the_category();
                  echo $category[0]->cat_name;
                  ?>
                </p>
              </div>
            </div>
            <div class="article_bottom">
              <div class="article_title">
                <h2><?php the_title(); ?></h2>
              </div>
              <div class="article_description">
                <p><?php the_excerpt(); ?></p>
              </div>
            </div>
          </div>
        </a>
      </li>
      <?php
      endwhile;
      endif;
      ?>
    </ul>
  </section>
  <section id="pagination">
    <?php if( function_exists("the_pagination") ) the_pagination(); ?>
  </section>
</main>

<?php get_footer(); ?>
