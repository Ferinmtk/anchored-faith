jQuery(document).ready(function($) {
	$('.bxslider').bxSlider({
	  auto: true,
	  controls: false,
	  mode: 'fade',
	  speed: 1000,
	  pause: 7000,
	  pager: false,
	  infiniteLoop: true
	});

	$('.bxslider-custom').bxSlider({
	  auto: true,
	  controls: false,
	  mode: 'fade',
	  speed: 1000,
	  pause: 5000,
	  pager: false,
	  infiniteLoop: true
	});

});