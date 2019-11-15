<?php get_header(); ?>

<main id="page_categorylist">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="categorylist">
    <div id="ripples_bg"></div>
    <a id="back_btn" href="javascript:history.back()"><span></span></a>
    <div class="container">
      <ul id="category_ul" class="flex_box">
        <?php wp_list_categories( 'title_li=' ); ?>
      </ul>
    </div>
  </section>
</main>

<?php get_footer(); ?>
