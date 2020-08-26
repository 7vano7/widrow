/*
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

// (function($) {
// 	// Scrolly.
// 		$('.scrolly')
// 			.scrolly({
// 				speed: 1500,
// 				offset: $header.outerHeight()
// 			});
// })(jQuery);
// if(localStorage.getItem('userLang') == null) {
// 	console.log('fdsdf');
// 	var language = window.navigator.language || navigator.userLanguage;
// 	language = language.substr(0, 2).toLowerCase();
// 	if (language != 'ru' || language != 'uk' || language != 'ua') {
// 		language = 'ru';
// 	} else if (language == 'uk') {
// 		language = 'uk';
// 	}
// 	localStorage.setItem(language, 'userLang');
// 	window.location.replace("/"+language);
// 	console.log(language);
// }

$(document).ready(function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > 0) {
			$('#scroller').fadeIn();
		} else {
			$('#scroller').fadeOut();
		}
	});
	$('#scroller').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
	});

	$('.search-view').click(function() {
		$('.menu').hide();
		$('.search-form').show();
		return false;
	}) ;

	$('.close').click(function() {
		$('.search-form').hide();
		$('.menu').show();
		return false;
	}) ;
});