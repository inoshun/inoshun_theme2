<?php

// style.css読み込み
wp_enqueue_style( 'my-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.1.1');

// js読み込み
function twpp_enqueue_scripts() {
  wp_deregister_script('jquery');
  wp_enqueue_script(
    'jquery',
    '//code.jquery.com/jquery-1.12.4.min.js',
    array(),
    '1.12.4'
  );
  wp_enqueue_script(
    'ofi-script',
    get_template_directory_uri() . '/js/ofi.min.js',
    array(),
    false,
    true
  );
  wp_enqueue_script(
    'common-script',
    get_template_directory_uri() . '/js/common.js',
    array( 'jquery' ),
    '1.0.2',
    true
  );
  if (is_home()) {
    wp_enqueue_script(
      'ripples-plugin',
      get_template_directory_uri() . '/js/jquery.ripples-min.js',
      array( 'jquery', 'common-script' ),
      false,
      true
    );
    wp_enqueue_script(
      'ripples-script',
      get_template_directory_uri() . '/js/ripples.js',
      array( 'ripples-plugin', 'mv' ),
      '1.0.7',
      true
    );
    wp_enqueue_script(
      'mv',
      get_template_directory_uri() . '/js/mv.js',
      array( 'jquery', 'common-script' ),
      '1.1.8',
      true
    );
    wp_enqueue_script(
      'list',
      get_template_directory_uri() . '/js/list.js',
      array( 'jquery', 'ofi-script', 'common-script'),
      '1.0.0',
      true
    );
  }
  if (is_page('categorylist')) {
    wp_enqueue_script(
      'categorylist',
      get_template_directory_uri() . '/js/categorylist.js',
      array( 'jquery', 'common-script' ),
      '1.0.1',
      true
    );
  }
  if (is_singular()) {
    wp_enqueue_script(
      'article-script',
      get_template_directory_uri() . '/js/article.js',
      array( 'jquery', 'ofi-script', 'common-script' ),
      '1.0.0',
      true
    );
  }
  if (is_single()) {
    wp_enqueue_script(
      'swiper-script',
      get_template_directory_uri() . '/js/swiper.js',
      array( 'jquery', 'ofi-script', 'common-script' ),
      false,
      true
    );
    wp_enqueue_script(
      'slider-script',
      get_template_directory_uri() . '/js/slider.js',
      array( 'swiper-script' ),
      '1.0.0',
      true
    );
  }
}
add_action( 'wp_enqueue_scripts', 'twpp_enqueue_scripts' );

// アイキャッチ画像
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(1000, 550);

//概要（抜粋）の文字数調整
function my_excerpt_length($length) {
	return 120;
}
function my_excerpt_more($more) {
 return '…';
}
add_filter('excerpt_more', 'my_excerpt_more');
add_filter('excerpt_length', 'my_excerpt_length');

// ページャー
function the_pagination() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<span><</span>',
    'next_text'    => '<span>></span>',
    'type'         => 'list',
    'end_size'     => 1,
    'mid_size'     => 1
  ) );
  echo '</nav>';
}

// OGP設定
function my_meta_ogp() {
  if( is_front_page() || is_home() || is_singular() ){
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if( is_singular() ) { //記事＆固定ページ
       setup_postdata($post);
       $ogp_title = $post->post_title;
       $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
       $ogp_url = get_permalink();
       wp_reset_postdata();
    } elseif ( is_front_page() || is_home() ) { //トップページ
       $ogp_title = get_bloginfo('name');
       $ogp_descr = get_bloginfo('description');
       $ogp_url = home_url();
    }

    //og:type
    $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

    //og:image
    if ( is_singular() && has_post_thumbnail() ) {
       $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
       $ogp_img = $ps_thumb[0];
    } else {
     $ogp_img = get_template_directory_uri().'/images/ogp.png';
    }

    //出力するOGPタグをまとめる
    $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'" />' . "\n";
    $insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'" />' . "\n";
    $insert .= '<meta property="og:type" content="'.$ogp_type.'" />' . "\n";
    $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'" />' . "\n";
    $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
    $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />' . "\n";
    $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    $insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

    echo $insert;
  }
} //END my_meta_ogp

add_action('wp_head','my_meta_ogp');//headにOGPを出力

// 固定ページで自動整形を無効化
function disable_autoformat() {
  if (is_page()) remove_filter('the_content', 'wpautop');
}
add_action('wp', 'disable_autoformat');

// 固定ページでビジュアルエディタ無効化
// add_filter( 'user_can_richedit', function( $true ){
//   $postType = get_post_type();
//   if ($postType === 'page') {
//     return false;
//   } else {
//   return $true;
//   }
// });

//////////////////// 以下、記事用ショートコード ////////////////////

// あわせて読みたい
function articleLink_function($atts) {

  //スラッグが省略された場合のデフォルト値設定
  $slug = shortcode_atts( array(
    'slug' => 'aaa'
  ), $atts, 'articleLink');

  //ユーザーが入力したスラッグを取得
  $postSlug = $slug['slug'];

  //記事情報を取得
  $postInfo = get_page_by_path($postSlug, OBJECT, ['post', 'page']);

  //記事タイトルを取得
  $postTitle = $postInfo->post_title;

  //パーマリンクを取得
  $postLink = get_permalink($postInfo->ID);

  //サムネイル画像のURL取得
  $thumbnail = wp_get_attachment_url(get_post_thumbnail_id($postInfo->ID));

  // 出力タグ
  $outputTag = '
  <a href="'.$postLink.'" class="readTogether">
    <div class="thumbnail">
      <img src="'.$thumbnail.'">
    </div>
    <p class="readTogether_title">'.$postTitle.'</p>
  </a>
  ';

  return $outputTag;

}
add_shortcode('articleLink', 'articleLink_function');


//////////////////// カスタム投稿タイプ ////////////////////

// お知らせ
function create_post_type_news() {
  $Supports = [
    'title',
    'editor',
    'thumbnail',
  ];
  register_post_type( 'news',
    array(
      'label' => 'お知らせ',
      'labels' => array(
      'all_items' => 'お知らせ一覧'
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'supports' => $Supports
    )
  );
}
add_action( 'init', 'create_post_type_news' );


//////////////////// テーマカスタマイザーに設定項目を追加 ////////////////////

// TOPのMVキャッチコピー設定
function edit_top_mv($wp_customize) {
  //セクション
  $wp_customize->add_section( 'top_mv', array (
   'title' => 'TOPページのメインビジュアルのキャッチコピー',
   'priority' => 100,
  ));

  //テーマ設定
  $wp_customize->add_setting( 'copy', array (
    'default' => null,
  ));

  //コントロール
  $wp_customize->add_control( 'copy', array(
   'section' => 'top_mv',
   'settings' => 'copy',
   'label' =>'TOPページに表示するキャッチコピーの設定',
   'description' => 'TOPページのMVに表示するキャッチコピーを設定してください。',
   'type' => 'text',
   'priority' => 20,
  ));
}
add_action('customize_register', 'edit_top_mv');
function topCopy() {
 return get_theme_mod( 'copy' );
}

?>
