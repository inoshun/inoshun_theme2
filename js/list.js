jQuery(function($){

  var list = $('#articles li')
  var winHeight = $(window).height();
  var winWidth = $(window).width();

  // height指定
  // 記事一覧のheight
  var listHeight = winHeight*0.75;
  list.css('height', listHeight + 'px');

  // リサイズ時
  $(window).resize(function() {
    winWidth = $(window).width();
    winHeight = $(window).height();
    listHeight = winHeight*0.75;
    list.css('height', listHeight + 'px');
  });


  // 記事一覧のスクロールエフェクト
  $(window).scroll(function() {

    list.each(function(){
      var listTop = $(this).offset().top;
      var listBottom = listTop + listHeight;
      var scrollBottom = $(window).scrollTop() + winHeight;
      var scrollMiddle = $(window).scrollTop() + winHeight/2;

      if (scrollMiddle >= listTop && scrollMiddle <= listBottom && winWidth <= 768) {
        $(this).addClass('hover');
      } else if (scrollMiddle > listBottom && winWidth <= 768) {
        $(this).removeClass('hover');
      } else if (scrollMiddle < listTop && winWidth <= 768) {
        $(this).removeClass('hover');
      }

    });
  });

  // 記事一覧のhoverエフェクト
  list.hover(
    function() {
      if (winWidth > 768) {
        $(this).addClass('hover');
      } else {
        return;
      }
    },
    function() {
      if (winWidth > 768) {
        $(this).removeClass('hover');
      } else {
        return;
      }
    }
  );


});
