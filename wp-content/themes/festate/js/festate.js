(function($) {

	"use strict";

	function festate_mainMenuClear() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').removeClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').removeClass('level-two-sub-menu');										
		}

		if ( $('ul:first-child', $('#navmain > div') ).is( ":visible" ) ) {

			$('ul:first-child', $('#navmain > div') ).css('display', '');
		}
	}

	function festate_mainMenuInit() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').addClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').addClass('level-two-sub-menu');

    // add support of browsers which don't support focus-within
    $('#navmain > div > ul > li > a:not(.login-form-icon):not(.search-form-icon), #navmain > div > ul > li > ul > li > a, #navmain > div > ul > li > ul > li > ul > li > a, .mega-menu-sub-menu')
      .on('mouseenter focus', function() {
        $(this).closest('li.level-one-sub-menu').addClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').addClass('menu-item-focused');

        if (!$(this).parent().find('#cart-popup-content').length && $('#cart-popup-content').css('z-index') != '-1')
          $('#cart-popup-content').css('z-index', '-1');
      }).on('mouseleave blur', function() {
        $(this).closest('li.level-one-sub-menu').removeClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').removeClass('menu-item-focused');
    });										
		}
	}

	function festate_init_loading_effects() {

	    $('#header-logo').addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounce',
	            offset: 1
	          });

	    

	    $('#page-header').addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounceInUp',
	            offset: 1
	          });

	    $('#main-content-wrapper h2, #main-content-wrapper h3')
	            .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounceInUp',
	            offset: 1
	          });

	    $('img:not(.sldr-img)').addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated zoomIn',
	            offset: 1
	          });

	    $('#sidebar').addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated zoomIn',
	            offset: 1
	          });

	    $('.before-content, .after-content').addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounce',
	            offset: 1
	          });

	    $('.header-social-widget')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounceInLeft',
	            offset: 1
	          });

	    $('article, article p, article li')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated zoomIn',
	            offset: 1
	          });

	    $('#footer-main h1, #footer-main h2, #footer-main h3')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounceInUp',
	            offset: 1
	          });

	    $('#footer-main p, #footer-main ul, #footer-main li, .footer-title, .col3a, .col3b, .col3c')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated zoomIn',
	            offset: 1
	          });

	    $('.footer-social-widget')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated rubberBand',
	            offset: 1
	          });

	    $('#footer-menu')
	        .addClass("animations-hidden").viewportChecker({
	            classToAdd: 'animated bounceInDown',
	            offset: 1
	          });
	}

	$( document ).ready(function() {

		if (festate_options && festate_options.loading_effect) {
	       festate_init_loading_effects();
	    }

		festate_mainMenuInit();

		if ( $(window).width() < 800 ) {
		
			$('#navmain > div > ul > li').each(
		       function() {
		         if ($(this).find('> ul.sub-menu').length > 0) {

		           $(this).prepend('<span class="sub-menu-item-toggle"></span>');
		         }
		       }
		     );

		   $('#navmain').on('focusin', function(){

      if ($('#navmain > div > ul').css('z-index') == '-1') {

        $('#navmain > div > ul').css({'z-index': '5000'});
        $('#navmain ul ul').css({'z-index': '5000'}).css({'position': 'relative'});

        $('.sub-menu-item-toggle').addClass('sub-menu-item-toggle-expanded');
      }
    });

	$('#main-content-wrapper, #home-content-wrapper').on('focusin', function(){

      if ($('#navmain > div > ul').css('z-index') != '-1') {
        $('#navmain > div > ul').css({'z-index': '-1'});  
      }

    });

   $('.sub-menu-item-toggle').on('click', function(e) {

		     e.stopPropagation();

		     var subMenu = $(this).parent().find('> ul.sub-menu');

		     $('#navmain ul ul.sub-menu').not(subMenu).css('z-index', '-1').css('position', 'absolute');
		     $(this).toggleClass('sub-menu-item-toggle-expanded');
		     if (subMenu.css('z-index') == '-1') {

        subMenu.css({'z-index': '5000'}).css({'position': 'relative'});
        subMenu.find('ul.sub-menu').css({'z-index': '5000'}).css({'position': 'relative'});

     } else {

        subMenu.css({'z-index': '-1'}).css({'position': 'absolute'});
        subMenu.find('ul.sub-menu').css({'z-index': '-1'}).css({'position': 'absolute'});
     }
		   });

		}

		$('#navmain > div').on('click', function(e) {

			e.stopPropagation();

			// toggle main menu
			if ( $(window).width() < 800 ) {

				var parentOffset = $(this).parent().offset(); 
				
				var relY = e.pageY - parentOffset.top;
			
				if (relY < 36) {
				
					var firstChild = $('ul:first-child', this);

        if (firstChild.css('z-index') == '-1')
            firstChild.css({'z-index': '5000'});
        else
            firstChild.css({'z-index': '-1'});

        firstChild.parent().toggleClass('mobile-menu-expanded');
				}
			}
		});

		// re-init main menu on screen resize
		$(window).on('resize', function () {
	       
	    	festate_mainMenuClear();
	    	festate_mainMenuInit();
		});

		$('.scrollup').on('click', function () {
			
			$("html, body").animate({
				  scrollTop: 0
			  }, 600);

			return false;
		});

		$(window).on('scroll', function () {

			var fadeInScrollUp = $(this).scrollTop() > 100;

			if (fadeInScrollUp) {

				$('.scrollup').fadeIn();

			} else {

				$('.scrollup').fadeOut();

			}
		});

		// display slider
		$( '.sldr' ).each( function() {
			var th = $( this );
			th.sldr({
				focalClass    : 'focalPoint',
				offset        : th.width() / 2,
				sldrWidth     : 'responsive',
				nextSlide     : th.nextAll( '.sldr-nav.next').first(),
				previousSlide : th.nextAll( '.sldr-nav.prev').first(),
				selectors     : th.nextAll( '.selectors').first().find( 'li' ),
				toggle        : th.nextAll( '.captions').first().find( 'div' ),
				sldrAuto      : false,
				sldrTime      : 4500,
				hasChange     : true
			});
		});
	});

})(jQuery);