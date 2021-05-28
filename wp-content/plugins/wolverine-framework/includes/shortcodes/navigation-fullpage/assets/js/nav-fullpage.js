(function ($) {
	"use strict";
	var G5PlusFullPage = {
		isWheelRun: false,
		sectionArr: [],
		currentSection: '',
		currentSectionIndex: -1,
		windowHeight: 0,
		wrapper: $('#wrapper'),

		isDesktop: function () {
			var responsive_breakpoint = 991;
			var $menu = $('.x-nav-menu');
			if (($menu.length > 0) && (typeof ($menu.attr('responsive-breakpoint')) != "undefined" ) && !isNaN(parseInt($menu.attr('responsive-breakpoint'), 10))) {
				responsive_breakpoint = parseInt($menu.attr('responsive-breakpoint'), 10);
			}
			return window.matchMedia('(min-width: ' + (responsive_breakpoint + 1) + 'px)').matches;
		},

		init: function() {
			G5PlusFullPage.setFullHeight();

			G5PlusFullPage.windowHeight = $(window).height();

			var indexSection = 0;
			$('.shortcode-nav-fullpage-wrap .nav-full-page a').each(function(index) {
				var idSection = $(this).attr('href');
				if ($(idSection).length == 0) {
					return;
				}

				G5PlusFullPage.sectionArr[indexSection] = idSection;
				indexSection++;
			});

			if (indexSection == 0) {
				return;
			}

			G5PlusFullPage.handleClick();
			G5PlusFullPage.handleScroll();
			if (G5PlusFullPage.wrapper.length > 0) {
				var wrapper_obj = G5PlusFullPage.wrapper[0];
				if (wrapper_obj.addEventListener) {
					wrapper_obj.addEventListener('mousewheel', G5PlusFullPage.fullPageMouseWheel, false); //IE9, Chrome, Safari, Oper
					wrapper_obj.addEventListener('wheel', G5PlusFullPage.fullPageMouseWheel, false); //Firefox
					wrapper_obj.addEventListener('DOMMouseScroll', G5PlusFullPage.fullPageMouseWheel, false); //Old Firefox
				} else {
					wrapper_obj.attachEvent('onmousewheel', G5PlusFullPage.fullPageMouseWheel); //IE 6/7/8
				}
			}
			G5PlusFullPage.wrapper.trigger('scroll');
			if ($('body').hasClass('safari')) {
				jQuery('.vc_row.slipscreen').perfectScrollbar({
					wheelSpeed: 0.5,
					suppressScrollX: true
				});
			}
		},

		handleScroll: function () {
			G5PlusFullPage.wrapper.scroll(function(event) {
				if (!G5PlusFullPage.isDesktop()) {
					return;
				}
				var scrollTop = $(G5PlusFullPage.wrapper).scrollTop();

				for (var i = G5PlusFullPage.sectionArr.length - 1; i >= 0 ; i--) {
					if ($(G5PlusFullPage.sectionArr[i]).length == 0) {
						continue;
					}
					var sectionTop = $(G5PlusFullPage.sectionArr[i]).position().top;

					if (scrollTop < sectionTop) {
						continue;
					}
					if ($('.shortcode-nav-fullpage-wrap .nav-full-page a[href="' + G5PlusFullPage.sectionArr[i] + '"]').parent().hasClass('nav-current')) {
						return;
					}
					G5PlusFullPage.currentSection = G5PlusFullPage.sectionArr[i];
					G5PlusFullPage.currentSectionIndex = i;
					$('.shortcode-nav-fullpage-wrap .nav-full-page li').removeClass('nav-current');
					$('.shortcode-nav-fullpage-wrap .nav-full-page a[href="' + G5PlusFullPage.sectionArr[i] + '"]').parent().addClass('nav-current');
					return;
				}

			});
		},
		handleClick: function (event) {
			$('.shortcode-nav-fullpage-wrap .nav-full-page a,.menu-one-page li.x-menu-item > a').click(function (event) {
				if (!G5PlusFullPage.isDesktop()) {
					return;
				}
				var link_arr = $(this).attr('href').split('#');
				if (link_arr.length <= 1) {
					return;
				}
				event.preventDefault();

				var idSection = '#' + link_arr[1];

				if (G5PlusFullPage.isWheelRun) {
					return;
				}
				if ($(idSection).length == 0) {
					return;
				}

				var sectionTop = $(idSection).position().top;

				G5PlusFullPage.currentSectionIndex = G5PlusFullPage.sectionArr.indexOf(idSection);
				G5PlusFullPage.currentSection = G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex];

				G5PlusFullPage.isWheelRun = true;
				G5PlusFullPage.wrapper.animate({scrollTop: sectionTop}, 500, 'easeInOutCubic', function () {
					G5PlusFullPage.isWheelRun = false;
				});
			});
		},
		fullPageMouseWheel: function(event) {
			if (!G5PlusFullPage.isDesktop()) {
				return;
			}
			event.preventDefault();
			if (G5PlusFullPage.isWheelRun) {
				return;
			}
			if (event.deltaY > 0) {
				// scroll down
				var wrapperHeight = G5PlusFullPage.wrapper.height();
				var scrollTop = $(G5PlusFullPage.wrapper).scrollTop();
				var sectionHeight = $(G5PlusFullPage.currentSection).outerHeight();
				var sectionTop = $(G5PlusFullPage.currentSection).position().top;
				var scrollTopDelta = sectionHeight + sectionTop - (scrollTop + wrapperHeight) >  wrapperHeight ? wrapperHeight : sectionHeight + sectionTop - (scrollTop + wrapperHeight);

				if (scrollTop + wrapperHeight < sectionHeight + sectionTop) {
					G5PlusFullPage.isWheelRun = true;
					G5PlusFullPage.wrapper.animate({scrollTop: scrollTop + scrollTopDelta}, 700, 'easeInOutCubic', function () {
						G5PlusFullPage.isWheelRun = false;
					});

					return;
				}


				if (G5PlusFullPage.currentSectionIndex >= G5PlusFullPage.sectionArr.length - 1) {
					return;
				}
				G5PlusFullPage.currentSectionIndex++;
				G5PlusFullPage.currentSection = G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex];

				if ($(G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex]).length == 0) {
					return;
				}

				sectionTop = $(G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex]).position().top;

				G5PlusFullPage.isWheelRun = true;
				G5PlusFullPage.wrapper.animate({scrollTop: sectionTop}, 700, 'easeInOutCubic', function () {
					G5PlusFullPage.isWheelRun = false;
				});
			}
			else {
				// scroll up
				var wrapperHeight = G5PlusFullPage.wrapper.height();
				var scrollTop = $(G5PlusFullPage.wrapper).scrollTop();
				var sectionHeight = $(G5PlusFullPage.currentSection).outerHeight();
				var sectionTop = $(G5PlusFullPage.currentSection).position().top;
				var scrollTopDelta = scrollTop - sectionTop >  wrapperHeight ? wrapperHeight : scrollTop - sectionTop;

				if (scrollTop > sectionTop) {
					G5PlusFullPage.isWheelRun = true;
					G5PlusFullPage.wrapper.animate({scrollTop: scrollTop - scrollTopDelta}, 700, 'easeInOutCubic', function () {
						G5PlusFullPage.isWheelRun = false;
					});

					return;
				}


				if (G5PlusFullPage.currentSectionIndex == 0) {
					return;
				}
				G5PlusFullPage.currentSectionIndex--;
				G5PlusFullPage.currentSection = G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex];

				if ($(G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex]).length == 0) {
					return;
				}

				var sectionTop = $(G5PlusFullPage.sectionArr[G5PlusFullPage.currentSectionIndex]).position().top;

				G5PlusFullPage.isWheelRun = true;
				G5PlusFullPage.wrapper.animate({scrollTop: sectionTop}, 700, 'easeInOutCubic', function () {
					G5PlusFullPage.isWheelRun = false;
				});
			}
		},
		setFullHeight: function () {
			var topBarHeight = 0;
			if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
				topBarHeight = $('#wpadminbar').outerHeight();
			}

			G5PlusFullPage.wrapper.css('overflow','');
			G5PlusFullPage.wrapper.css('position','');
			G5PlusFullPage.wrapper.css('height', '');

			$('.md-full-height').parent().css('height','');
			$('.md-full-height').css('height','');

			if (G5PlusFullPage.isDesktop()) {
				G5PlusFullPage.wrapper.css('overflow','hidden');
				G5PlusFullPage.wrapper.css('position','relative');
				G5PlusFullPage.wrapper.css('height', ($(window).height() - 40 - topBarHeight) + 'px');

				var wrapperHeight = $(G5PlusFullPage.wrapper).height();
				if($('.md-full-height').length) {
					$('.md-full-height').each(function() {
						var $parent = $(this).parent();
						$parent.css('min-height', '');
						$(this).css('height', '');
					});
					$('.md-full-height').each(function() {
						var $parent = $(this).parent();
						$parent.css('max-height', '');
						if ($parent.css('min-height') == '0px') {
							$parent.css('min-height', wrapperHeight + 'px');
						}
						$(this).css('height', $parent.height() + 'px');
						if ($('body').hasClass('safari')) {
							$parent.css('max-height', wrapperHeight + 'px');
						}
					});
				}
				$('.shortcode-nav-fullpage-wrap').css('display','');
			}
			else
			{
				$('.shortcode-nav-fullpage-wrap').css('display','none');
			}
		},

		load: function () {
			var topBarHeight = 0;
			if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
				topBarHeight = $('#wpadminbar').outerHeight();
			}

			G5PlusFullPage.wrapper.css('overflow','hidden');
			G5PlusFullPage.wrapper.css('position','relative');
			G5PlusFullPage.wrapper.css('height', ($(window).height() - 40 - topBarHeight) + 'px');

			G5PlusFullPage.setFullHeight();

			G5PlusFullPage.windowHeight = $(window).height();
		},
		resize: function() {
			G5PlusFullPage.setFullHeight();
		}
	};
	$.extend($.easing,{ easeInOutCubic: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t*t + b;return c/2*((t-=2)*t*t + 2) + b;}});
	$(document).ready(G5PlusFullPage.init);
	$(window).load(G5PlusFullPage.load);
	$(window).resize(G5PlusFullPage.resize);
})(jQuery);