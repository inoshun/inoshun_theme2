<?php get_header(); ?>

<main id="page_page">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="article">
    <div class="container">
      <div class="small_container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article">
          <h1><?php the_title(); ?></h1>
          <div class="thumbnail">
            <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php else: ?><img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail_sample.jpg"><?php endif; ?>
          </div>
          <div class="article_detail">
            <?php the_content(); ?>
          </div>
        </div><!-- END article -->
        <?php
        endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
