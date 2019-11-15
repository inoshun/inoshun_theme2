<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&display=swap" rel="stylesheet" />
  <?php if ( is_single() ): ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/swiper.css">
  <?php endif; ?>
  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png" type="image/png">
  <title><?php if ( is_home() || is_category() ) { bloginfo('name'); } ?> <?php if ( is_singular() ) { the_title_attribute(); } ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header id="<?php if ( is_singular() ) { echo "header_colored"; } ?>" class="<?php if ( is_page('categorylist') ) { echo "header_hide"; } ?>">
    <div class="container flex_box">
      <div class="header_title">
      <?php if ( is_home() ) { echo "<h1>"; } ?>
        <a class="ptSansNarrow" href="<?php echo home_url() ?>">ino nomad</a>
      <?php if ( is_home() ) { echo "</h1>"; } ?>
      </div>
      <button class="nav_btn">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>
