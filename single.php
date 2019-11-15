<?php get_header(); ?>

<main id="page_single">
  <?php get_template_part('loading'); ?>
  <?php get_template_part('nav'); ?>
  <section id="article">
    <div class="container">
      <div class="small_container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article">
          <h1><?php the_title(); ?></h1>
          <div class="flex_box article_cates">
            <div class="category">
              <?php the_category(); ?>
            </div>
            <p class="date"><?php the_time('Y.m.j') ?></p>
          </div>
          <div class="thumbnail">
            <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php else: ?><img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail_sample.jpg"><?php endif; ?>
          </div>
          <div class="article_detail">
            <?php the_content(); ?>
          </div>
        </div><!-- END article -->
        <div class="related">
          <!-- Swiper -->
          <div class="swiper-container related_slide">
            <div class="swiper-wrapper">
              <?php
              // 複数カテゴリーを持つ場合ランダムで取得
              $categories = wp_get_post_categories($post->ID, array('orderby'=>'rand'));
              if ($categories) {
                $args = array(
                  'category__in' => array($categories[0]), // カテゴリーのIDで記事を取得
                  'post__not_in' => array($post->ID), // 表示している記事を除く
                  'showposts'=>6, // 取得記事数
                  'caller_get_posts'=>1, // 取得した記事の何番目から表示するか
                  'orderby'=> 'rand' // 記事をランダムで取得
                );
                $my_query = new WP_Query($args);
                $related_number = $my_query->found_posts;
                if( $my_query->have_posts() ) {
              ?>
              <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
              <div class="swiper-slide">
                <a href="<?php the_permalink(); ?>">
                  <div class="thumbnail">
                    <?php if(has_post_thumbnail()): ?><?php the_post_thumbnail(); ?><?php else: ?><img class="cover_img" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail_sample.jpg"><?php endif; ?>
                  </div>
                  <p><?php the_title(); ?></p>
                </a>
              </div>
              <?php endwhile; wp_reset_query(); ?>
              <?php if($related_number == 2) { ?>
                <div class="swiper-slide">
                  <div class="thumbnail coming_soon">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                  </div>
                </div>
              <?php }  ?>
              <?php if($related_number == 1) { ?>
                <div class="swiper-slide">
                  <div class="thumbnail coming_soon">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="thumbnail coming_soon">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                  </div>
                </div>
              <?php }  ?>
              <?php } else { ?>
              <div class="swiper-slide">
                <div class="thumbnail coming_soon">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                </div>
              </div>
              <div class="swiper-slide">
                <div class="thumbnail coming_soon">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                </div>
              </div>
              <div class="swiper-slide">
                <div class="thumbnail coming_soon">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/coming_soon.png">
                </div>
              </div>
              <?php } } ?>
            </div>
          </div>
          <!-- Add Arrows -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
        <?php
        endwhile;
        endif;
        ?>
        <div class="bottom_article flex_box">
          <?php
          $prev_poxt = get_previous_post();
          if (!empty( $prev_poxt  )):
            echo '<a id="prev" class="bottom_pager" href="',get_permalink( $prev_poxt->ID ),'"><span></span></a>';
          else :
            echo '<p id="prev" class="bottom_pager"><span></span></p>';
          endif;
          ?>
          <?php
          $next_poxt = get_next_post();
          if (!empty( $next_poxt  )):
            echo '<a id="next" class="bottom_pager" href="',get_permalink( $next_poxt->ID ),'"><span></span></a>';
          else :
            echo '<p id="next" class="bottom_pager"><span></span></p>';
          endif;
          ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
