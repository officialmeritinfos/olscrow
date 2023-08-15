(function($) {
	'use strict';

	// Sidebar Menu JS
	$('#sidebar-menu').metisMenu();
	
	// Header Sticky, Go To Top JS
	$(window).on('scroll', function() {
		// Header Sticky JS
		if ($(this).scrollTop() >150){  
			$('.main-top-navbar').addClass("is-sticky");
		}

		else{
			$('.main-top-navbar').removeClass("is-sticky");
		};

		// Go To Top JS
		var scrolled = $(window).scrollTop();
		if (scrolled > 300) $('.go-top').addClass('active');
		if (scrolled < 300) $('.go-top').removeClass('active');
	});
	
	// Click Event JS
	$('.go-top').on('click', function() {
		$("html, body").animate({ scrollTop: "0" }, 50);
	});

	// Webpage FullScreen JS
	$("#fullscreen-button").on("click", function toggleFullScreen() {
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	});
	$('.ri-fullscreen-btn').on('click', function() {
		$(this).toggleClass('active');
	});

	// Count Time JS
	function makeTimer() {
		var endTime = new Date("november  30, 2021 17:00:00 PDT");			
		var endTime = (Date.parse(endTime)) / 1000;
		var now = new Date();
		var now = (Date.parse(now) / 1000);
		var timeLeft = endTime - now;
		var days = Math.floor(timeLeft / 86400); 
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }
		$("#days, #days-p").html(days + "<span>Days</span>");
		$("#hours, #hours-p").html(hours + "<span>Hours</span>");
		$("#minutes, #minutes-p").html(minutes + "<span>Minutes</span>");
		$("#seconds, #seconds-p").html(seconds + "<span>Seconds</span>");
	}
	setInterval(function() { makeTimer(); }, 300);

	// Preloader
	$(window).on('load', function() {
		$('.preloader').addClass('preloader-deactivate');
	}) 

	// Input Plus & Minus Number JS
	$('.input-counter').each(function() {
		var spinner = jQuery(this),
		input = spinner.find('input[type="text"]'),
		btnUp = spinner.find('.plus-btn'),
		btnDown = spinner.find('.minus-btn'),
		min = input.attr('min'),
		max = input.attr('max');
		
		btnUp.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

	// Burger Menu JS
	$('.burger-menu').on('click', function() {
		$(this).toggleClass('active');
		$('.main-content').toggleClass('hide-sidemenu-area');
		$('.side-menu-area').toggleClass('toggle-sidemenu-area');
		$('.navbar').toggleClass('toggle-navbar-area');
	});
	$('.responsive-burger-menu').on('click', function() {
		$('.responsive-burger-menu').toggleClass('active');
		$('.side-menu-area').toggleClass('active-sidemenu-area');
	});

	// Search Popup JS
	$('.close-btn').on('click', function() {
		$('.search-overlay').fadeOut();
		$('.search-btn').show();
		$('.close-btn').removeClass('active');
	});
	$('.search-btn').on('click', function() {
		$(this).hide();
		$('.search-overlay').fadeIn();
		$('.close-btn').addClass('active');
	});

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});

	// FAQ Accordion JS
	$('.accordion').find('.accordion-title').on('click', function(){
		// Adds Active Class
		$(this).toggleClass('active');
		// Expand or Collapse This Panel
		$(this).next().slideToggle('fast');
		// Hide The Other Panels
		$('.accordion-content').not($(this).next()).slideUp('fast');
		// Removes Active Class From Other Titles
		$('.accordion-title').not($(this)).removeClass('active');		
	});

	// Toast JS
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});

	// Tooltip JS
	var toastTrigger = document.getElementById('liveToastBtn')
	var toastLiveExample = document.getElementById('liveToast')
	if (toastTrigger) {
		toastTrigger.addEventListener('click', function () {
			var toast = new bootstrap.Toast(toastLiveExample)

			toast.show()
		})
	}

	// Tabs JS
	$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
	$('.tab ul.tabs li').on('click', function (g) {
		var tab = $(this).closest('.tab'), 
		index = $(this).closest('li').index();
		tab.find('ul.tabs > li').removeClass('current');
		$(this).closest('li').addClass('current');
		tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
		tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
		g.preventDefault();
	});

	// Emmeli Slider JS
	$('.emmeli-slider').owlCarousel({
		loop: true,
		margin: 24,
		nav: false,
		dots: false,
		autoplay: true,
		responsive: {
			0:{
				items:1
			},
			600:{
				items:2
			},
			960:{
				items:2
			},
			1360:{
				items:2
			},
			1400:{
				items:3
			}
		}
	})

	// Recent Contacts Slider JS
	$('.recent-contacts-slider').owlCarousel({
		loop: true,
		margin: 5,
		nav: false,
		dots: false,
		autoplay: true,
		responsive: {
			0:{
				items:3
			},
			600:{
				items:6
			},
			960:{
				items:6
			},
			1200:{
				items:3
			},
			1320:{
				items:4
			},
			1400:{
				items:6
			}
		}
	})

	// Visa Card Slider JS
	$('.visa-card-slider').owlCarousel({
		items: 1,
		loop: true,
		margin: 24,
		nav: false,
		dots: true,
		autoplay: true,
		autoplayHoverPause: true,
	})

	// MixItUp Shorting JS
	$('.shorting').mixItUp();

})(jQuery);