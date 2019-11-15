<?php get_header(); ?>

<main id="page_category">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="category_articles">
    <div class="container">
      <div class="small_container">
        <h1>「<?php single_cat_title(); ?>」カテゴリー記事一覧</h1>
        <ul>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <div class="thumbnail">
                <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php else: ?><img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail_sample.jpg"><?php endif; ?>
              </div>
              <div class="article_infos">
                <h2><?php the_title(); ?></h2>
                <p class="date"><?php the_time('Y.m.j') ?></p>
              </div>
            </a>
          </li>
          <?php
          endwhile;
          endif;
          ?>
        </ul>
      </div>
    </div>
  </section>
  <section id="pagination">
    <?php if( function_exists("the_pagination") ) the_pagination(); ?>
  </section>
</main>

<?php get_footer(); ?>
