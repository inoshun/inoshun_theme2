jQuery(function($){

  var parentCategory = $('#category_ul > li > a');
  var childCategory = $('#category_ul ul a');
  var winHeight = $(window).innerHeight();
  var cont = $("#ripples_bg");


  /////// height指定
  cont.css('height', winHeight + 'px');
  $(window).resize(function() {
    winHeight = $(window).innerHeight();
    cont.css('height', winHeight + 'px');
  });

  /////// アニメーション追加

  // 親カテゴリー
  parentCategory.append('<span><span></span></span>');
  parentCategory.addClass('arrow_animation');

});
