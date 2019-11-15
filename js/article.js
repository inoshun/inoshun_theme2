jQuery(function($){

  var winHeight = $(window).height();
  $(window).resize(function() {
    winHeight = $(window).height();
  });

  // カテゴリーリンクのhoverエフェクト
  var categoryLink = $('.category a');
  categoryLink.hover(
    function(){
      $(this).addClass('hover');
      $(this).removeClass('unhover');
    },
    function(){
      $(this).addClass('unhover');
      $(this).removeClass('hover');
    }
  );

  // サムネイルのheight指定
  var thumbnail = $('.article .thumbnail');
  var thumbnailWidth;
  var setThumbnailHeight = function(){
    thumbnailWidth = thumbnail.innerWidth();
    thumbnail.css('height', (thumbnailWidth * 0.55) + 'px');
  }
  setThumbnailHeight();
  $(window).resize(function() {
    setThumbnailHeight();
  });

  // 記事内スクロールエフェクト
  $(window).scroll(function() {
    var h2 = $('.article_detail h2');
    var h3 = $('.article_detail h3');

    h2.each(function(){
      var h2Top = $(this).offset().top;
      var scrollBottom = $(window).scrollTop() + winHeight;
      if (scrollBottom > h2Top + 150) {
        $(this).addClass('show');
      }
    });
    h3.each(function(){
      var h3Top = $(this).offset().top;
      var scrollBottom = $(window).scrollTop() + winHeight;
      if (scrollBottom > h3Top + 150) {
        $(this).addClass('show');
      }
    });

  });

});
