jQuery(function($){

  ////////// TOPページのメインビジュアル関連

  var winHeight = $(window).innerHeight();
  var winWidth = $(window).width();
  var mv = $('#mv');
  var cont = $("#ripples_bg");
  var copy = $("#mv_copy");
  var btn = $("#mv_btn");

  // height指定
  mv.css('height', winHeight + 'px');
  cont.css('height', winHeight + 'px');

  $(window).resize(function() {
    winWidth = $(window).width();
    winHeight = $(window).innerHeight();

    mv.css('height', winHeight + 'px');
    cont.css('height', winHeight + 'px');

  });

  // スクロールボタン
  var scrollBtn = $('#scroll');
  var articles = $('#articles');
  var articlesTop = articles.offset().top;
  scrollBtn.on('click', function(){
    $("html,body").animate({scrollTop:articlesTop});
  });


  // スクロールでの発火処理
  $(window).scroll(function() {

    // パララックス
    var offset = $(this).scrollTop() / -5;
    cont.css( 'background-position', '0px ' + offset + 'px' );
    copy.css( 'top', offset*(-1.5) + 'px' );
    btn.css( 'top', offset*(-3) + 'px' );

    // キャッチコピー、ボタンの入れ替えアニメーション
    var scrollBottom = $(window).scrollTop() + winHeight;
    var changePosition = winHeight + 100;

    if (scrollBottom >= changePosition) {
      mv.addClass('change');
    } else {
      mv.removeClass('change');
    }

  });



});
