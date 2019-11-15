objectFitImages('.thumbnail img');

jQuery(function($) {

  // ローディング
  setTimeout(function(){
    $('.loading').fadeOut(300);
  }, 1500);


  ////// height指定

  var winHeight = $(window).height();
  var main = $('main');

  // ページ最低height
  main.css('min-height', winHeight + 'px');

  // リサイズ時
  $(window).resize(function() {
    var winHeight = $(window).height();
    main.css('min-height', winHeight + 'px');
  });

  /////// navメニュー
  $('.nav_btn').click(function() {
    $(this).toggleClass('open');
    $('.nav_menu').toggleClass('open');
  });


  /////// 共通hover

  // arrowアニメーション
  $(document).on({
		'mouseenter' : function(){
      $(this).addClass('hover');
      $(this).removeClass('unhover');
		},
		'mouseleave' : function(){
      $(this).addClass('unhover');
      $(this).removeClass('hover');
		}
	}, '.arrow_animation');

  // ページネーションのhoverエフェクト
  var pagenationLink = $('.pagination a');
  pagenationLink.hover(
    function(){
      $(this).addClass('hover');
      $(this).removeClass('unhover');
    },
    function(){
      $(this).addClass('unhover');
      $(this).removeClass('hover');
    }
  );


});
