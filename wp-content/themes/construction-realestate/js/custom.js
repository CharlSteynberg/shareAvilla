jQuery(function($){
	"use strict";
	jQuery('.main-menu-navigation > ul').superfish({
		delay:       500,                            
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'                        
	});
});

function construction_realestate_responsive_menu_open() {
	jQuery(".menu-brand").addClass('show');
}
function construction_realestate_responsive_menu_close() {
	jQuery(".menu-brand").removeClass('show');
}

var construction_realestate_Keyboard_loop = function (elem) {

    var construction_realestate_tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

    var construction_realestate_firstTabbable = construction_realestate_tabbable.first();
    var construction_realestate_lastTabbable = construction_realestate_tabbable.last();
    /*set focus on first input*/
    construction_realestate_firstTabbable.focus();

    /*redirect last tab to first input*/
    construction_realestate_lastTabbable.on('keydown', function (e) {
        if ((e.which === 9 && !e.shiftKey)) {
            e.preventDefault();
            construction_realestate_firstTabbable.focus();
        }
    });

    /*redirect first shift+tab to last input*/
    construction_realestate_firstTabbable.on('keydown', function (e) {
        if ((e.which === 9 && e.shiftKey)) {
            e.preventDefault();
            construction_realestate_lastTabbable.focus();
        }
    });

    /* allow escape key to close insiders div */
    elem.on('keyup', function (e) {
        if (e.keyCode === 27) {
            elem.hide();
        }
        ;
    });
};

// scroll
jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 0) {
	        jQuery('#scrollbutton').fadeIn();
	    } else {
	        jQuery('#scrollbutton').fadeOut();
	    }
	});
	jQuery(window).on("scroll", function () {
	   document.getElementById("scrollbutton").style.display = "block";
	});
	jQuery('#scrollbutton').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});

jQuery(function($){
	$(window).load(function() {
		$(".loader").delay(2000).fadeOut("slow");
	    $(".frame").delay(2000).fadeOut("slow");
	})

	$('.mobiletoggle').click(function () {
        construction_realestate_Keyboard_loop($('.menu-brand'));
    });
});

(function( $ ) {

	$(window).scroll(function(){
		var sticky = $('.sticky-header'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('fixed-header');
		else sticky.removeClass('fixed-header');
	});

})( jQuery );