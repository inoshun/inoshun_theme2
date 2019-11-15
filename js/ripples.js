jQuery(function($){

  // 波紋エフェクト
  var ripplesBg = $('#ripples_bg');
  var winWidth = $(window).width();

  if (winWidth > 768) {
    ripplesBg.ripples({
      resolution: 400,
  		dropRadius: 20,
  		perturbance: 0.005
    });
  }

  $(window).resize(function() {
    winWidth = $(window).width();
    if (winWidth > 768) {
      ripplesBg.ripples({
        resolution: 400,
    		dropRadius: 25,
    		perturbance: 0.05
      });
    } else {
      ripplesBg.ripples('destroy');
    }
  });

	// setInterval(function() {
	// 	var x = Math.random() * ripplesBg.outerWidth();
	// 	var y = Math.random() * ripplesBg.outerHeight();
	// 	var dropRadius = 25;
	// 	var strength = 0.2 + Math.random() * 0.1;
  //
	// 	ripplesBg.ripples('drop', x, y, dropRadius, strength);
	// }, 1500);

});
