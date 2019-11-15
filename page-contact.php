<?php get_header(); ?>

<main id="page_contact">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="contact">
    <div class="container">
      <div class="small_container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1 class="ptSansNarrow"><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php
        endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
