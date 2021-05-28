var G5Plus = G5Plus || {};
(function ($) {
    "use strict";

    var $window = $(window),
        $body = $('body'),
        isRTL = $body.hasClass('site-rtl') ? true : false,
        deviceAgent = navigator.userAgent.toLowerCase(),
        isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
        isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
        isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
        isIEMobile = deviceAgent.match(/(iemobile)/);


    G5Plus.common = {
        init: function () {
            G5Plus.common.owlCarousel();
            G5Plus.common.stellar();
            G5Plus.common.prettyPhoto();
            G5Plus.common.magicLine();
            G5Plus.common.tooltip();
        },
        owlCarousel: function () {
            $('div.owl-carousel:not(.manual)').each(function () {
                var slider = $(this);

                var defaults = {
                    // Most important owl features
                    items: 5,
                    itemsCustom: false,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [980, 3],
                    itemsTablet: [768, 2],
                    itemsTabletSmall: false,
                    itemsMobile: [479, 1],
                    singleItem: false,
                    itemsScaleUp: false,

                    //Basic Speeds
                    slideSpeed: 200,
                    paginationSpeed: 800,
                    rewindSpeed: 1000,

                    //Autoplay
                    autoPlay: false,
                    stopOnHover: false,

                    // Navigation
                    navigation: false,
                    navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                    rewindNav: true,
                    scrollPerPage: false,

                    //Pagination
                    pagination: true,
                    paginationNumbers: false,

                    // Responsive
                    responsive: true,
                    responsiveRefreshRate: 200,
                    responsiveBaseWidth: window,

                    // CSS Styles
                    baseClass: "owl-carousel",
                    theme: "owl-theme",

                    //Lazy load
                    lazyLoad: false,
                    lazyFollow: true,
                    lazyEffect: "fade",

                    //Auto height
                    autoHeight: false,

                    //JSON
                    jsonPath: false,
                    jsonSuccess: false,

                    //Mouse Events
                    dragBeforeAnimFinish: true,
                    mouseDrag: true,
                    touchDrag: true,

                    //Transitions
                    transitionStyle: false,

                    // Other
                    addClassActive: false,

                    //Callbacks
                    beforeUpdate: false,
                    afterUpdate: false,
                    beforeInit: false,
                    afterInit: false,
                    beforeMove: false,
                    afterMove: false,
                    afterAction: false,
                    startDragging: false,
                    afterLazyLoad: false
                };

                var config = $.extend({}, defaults, slider.data("plugin-options"));
                var fucStr_afterInit = config.afterInit;
                var fuc_afterInit = function () {
                    eval(fucStr_afterInit);
                };
                if (config.afterInit != false) {
                    config.afterInit = fuc_afterInit;
                }

                var fucStr_afterMove = config.afterMove;

                var fuc_afterMove = function () {
                    eval(fucStr_afterMove);
                };
                if (config.afterMove != false) {
                    config.afterMove = fuc_afterMove;
                }


                // Initialize Slider


                slider.owlCarousel(config);
            });
        },
        isDesktop: function () {
            var responsive_breakpoint = 991;
            var $menu = $('.x-nav-menu');
            if (($menu.length > 0) && (typeof ($menu.attr('responsive-breakpoint')) != "undefined" ) && !isNaN(parseInt($menu.attr('responsive-breakpoint'), 10))) {
                responsive_breakpoint = parseInt($menu.attr('responsive-breakpoint'), 10);
            }
            return window.matchMedia('(min-width: ' + (responsive_breakpoint + 1) + 'px)').matches;
        },
        stellar : function() {
            $.stellar({
                horizontalScrolling: false,
                scrollProperty: 'scroll',
                positionProperty: 'position'
            });
        },
        prettyPhoto : function() {
            $("a[data-rel^='prettyPhoto']").prettyPhoto({
                hook:'data-rel',
                social_tools:'',
                animation_speed:'normal',
                theme:'light_square'
            });
        },
        magicLine : function(){
            $('.magic-line-container').each(function() {
                var activeItem = $('li.active',this);
                G5Plus.common.magicLineSetPosition(activeItem);
                $('li',this).hover(function(){
                    if(!$(this).hasClass('none-magic-line')){
                        G5Plus.common.magicLineSetPosition(this);
                    }

                },function(){
                    if(!$(this).hasClass('none-magic-line')){
                        G5Plus.common.magicLineReturnActive(this);
                    }
                });
            });
        },
        magicLineSetPosition : function(item) {
            if(item!=null && item!='undefined'){
                var left = 0;
                if($(item).position()!=null)
                    left = $(item).position().left;
                var marginLeft = $(item).css('margin-left');
                var marginRight = $(item).css('margin-right');

                var topMagicLine = $('.top.magic-line', $(item).parent());
                var bottomMagicLine = $('.bottom.magic-line', $(item).parent());
                if(topMagicLine!=null && topMagicLine != 'undefined'){
                    $(topMagicLine).css('left',left);
                    $(topMagicLine).css('width',$(item).width());
                    $(topMagicLine).css('margin-left',marginLeft);
                    $(topMagicLine).css('margin-right',marginRight);
                }
                if(bottomMagicLine!=null && bottomMagicLine != 'undefined'){
                    $(bottomMagicLine).css('left',left);
                    $(bottomMagicLine).css('width',$(item).width());
                    $(bottomMagicLine).css('margin-left',marginLeft);
                    $(bottomMagicLine).css('margin-right',marginRight);
                }
            }
        },
        magicLineReturnActive : function(current_item) {
            if(!$(current_item).hasClass('active')){
                var activeItem = $('li.active',$(current_item).parent());
                G5Plus.common.magicLineSetPosition(activeItem);
            }
        },
        showLoading : function() {
            $body.addClass('overflow-hidden');
            if ($('.loading-wrapper').length == 0) {
                $body.append('<div class="loading-wrapper"><span class="spinner-double-section-far"></span></div>');
            }
        },
        hideLoading : function() {
            $('.loading-wrapper').fadeOut(function () {
                $('.loading-wrapper').remove();
                $('body').removeClass('overflow-hidden');
            });
        },
        tooltip : function () {
            if ($().tooltip && !isMobileAlt) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        },
	    isIE: function() {
		    var ua = window.navigator.userAgent;
		    var msie = ua.indexOf("MSIE ");

		    if (msie || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
			    return true;
		    }
		    return false;
	    }
    };


    G5Plus.page = {
        init: function () {
            G5Plus.page.footerParallax();
            G5Plus.page.topDrawer();
            G5Plus.page.setOverlayVC();
            G5Plus.page.progressBar();
            G5Plus.page.events();
            G5Plus.page.backToTop();
            G5Plus.page.onQuotesClickHandler();
            G5Plus.page.onMenuProductClickHandler();
            G5Plus.page.setWidgetCollapse();
        },
        events : function() {
            $('.wpb_map_wraper').on('click', G5Plus.page.onMapClickHandler);
        },
        windowLoad : function() {
            if ($body.hasClass('site-loading')) {
                G5Plus.page.pageIn();
            }
	        G5Plus.page.setPositionPageTitle();
        },
        windowResized: function() {
            G5Plus.page.footerParallax();
            G5Plus.page.setPositionPageTitle();
            G5Plus.page.setWidgetCollapse();
        },
        setPositionPageTitle : function() {
            if (!G5Plus.common.isDesktop()) {
                return;
            }

            var sectionTitle = $('.page-title-wrap');
            if( $('header.main-header').hasClass('header-float')){
                if(sectionTitle!=null && typeof sectionTitle!='undefined'){
                    var headerHeight = $('header.main-header').outerHeight();
                    if ($('.top-bar').length) {
                        headerHeight += $('.top-bar').outerHeight();
                    }
                    var buffer = ($(sectionTitle).outerHeight() - headerHeight - $('.block-center-inner', sectionTitle).outerHeight()) / 2;

                    $(sectionTitle).css('padding-top',headerHeight + buffer);
                    $(sectionTitle).css('padding-bottom',buffer);

                    var pageTitleInner = $('.page-title-inner', sectionTitle);
                    $(pageTitleInner).css('transition','all 0.5s');
                    $(pageTitleInner).css('-webkit-transition','all 0.5s ease-in-out');
                    $(pageTitleInner).css('-moz-transition','all 0.5s ease-in-out');
                    $(pageTitleInner).css('-o-transition','all 0.5s ease-in-out');
                    $(pageTitleInner).css('-ms-transition','all 0.5s ease-in-out');
                }
            }
        },
        footerParallax: function () {
            var $footer = $('footer'),
                headerSticky  = $('header.main-header .sticky-wrapper').length > 0 ? 60 : 0,
                $adminBar = $('#wpadminbar'),
                $adminBarHeight = $adminBar.length > 0 ?  $adminBar.outerHeight() : 0;


            if (!$body.hasClass('page-template-coming-soon')) {
                if ($footer.hasClass('enable-parallax')) {
                    if ((G5Plus.common.isDesktop()) && ($window.height() >= ($footer.outerHeight() + headerSticky + $adminBarHeight))) {
                        $body.css({
                            'padding-bottom': ($footer.outerHeight()) + 'px'
                        });
                        $body.removeClass('footer-static');
                    } else {
                        $body.addClass('footer-static');
                        $body.css({
                            'padding-bottom': '0px'
                        });
                    }
                }
            } else {
                $body.removeClass('footer-static');
            }
        },
        topDrawer : function() {
            $('.top-drawer-toggle').click( function(){
                var $topDrawerBar = $('#top-drawer-bar' );
                $topDrawerBar.slideToggle('slow' );
                $(this).toggleClass('open');
            });
        },
        setOverlayVC : function() {
            $('[data-overlay-image]').each(function() {
                var $selector =$(this);
                setTimeout(function() {
                    var overlay_image = $selector.data('overlay-image');
                    var overlay_opacity = $selector.data('overlay-opacity');
                    var html = '<div class="overlay-bg-vc" style="background-image: url('+ overlay_image +') ;background-repeat:repeat; opacity:'+overlay_opacity+'"></div>';
                    $selector.prepend(html);
                }, 100);
            });
            $('[data-overlay-color]').each(function() {
                var $selector =$(this);
                setTimeout(function() {
                    var overlay_color = $selector.data('overlay-color');
                    var html = '<div class="overlay-bg-vc" style="background-color: '+ overlay_color +'"></div>';
                    $selector.prepend(html);
                }, 100);
            });
        },
        progressBar : function() {
            if ($().waypoint) {
                $('.wolverine-vertical-progress-bar').waypoint(function () {
                    $(this).find('.vc_single_bar').each(function (index) {
                        var $this = $(this),
                            bar = $this.find('.vc_bar'),
                            val = bar.data('percentage-value');

                        setTimeout(function () {
                            bar.css({"height":val + '%'});
                        }, index * 200);
                    });
                }, { offset:'85%' });
            }
            else
            {
                $(this).find('.wolverine-vertical-progress-bar .vc_single_bar').each(function (index) {
                    var $this = $(this),
                        bar = $this.find('.vc_bar'),
                        val = bar.data('percentage-value');

                    setTimeout(function () {
                        bar.css({"height":val + '%'});
                    }, index * 200);
                });
            }
        },
        backToTop : function() {
            var $backTopTopWrap = $('.back-top-top-wrap');
            var $backToTop = $('.back-to-top');
            if ($backToTop.length > 0) {
                $backToTop.click(function(event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: '0px'},800);
                });
                $window.on('scroll', function (event) {
                    var scrollPosition = $window.scrollTop();
                    var windowHeight = $window.height() / 2;
                    if (scrollPosition > windowHeight) {
                        $backTopTopWrap.addClass('in');
                    }
                    else {
                        $backTopTopWrap.removeClass('in');
                    }
                });
            }
        },
        onMapClickHandler : function() {
            var that = $(this);

            // Disable the click handler until the user leaves the map area
            that.off('click', G5Plus.page.onMapClickHandler);

            // Enable scrolling zoom
            that.find('iframe').css("pointer-events", "auto");

            // Handle the mouse leave event
            that.on('mouseleave', G5Plus.page.onMapMouseleaveHandler);
        },
        onMapMouseleaveHandler : function() {
            var that = $(this);

            that.on('click', G5Plus.page.onMapClickHandler);
            that.off('mouseleave', G5Plus.page.onMapMouseleaveHandler);
            that.find('iframe').css("pointer-events", "none");
        },
        onQuotesClickHandler : function() {
            $('.wolverine-quotes .custom-owl-prev').click(function() {
                var owl = $(".owl-carousel",$(this).parent()).data('owlCarousel');
                owl.prev();
            });
            $('.wolverine-quotes .custom-owl-next').click(function() {
                var owl = $(".owl-carousel",$(this).parent()).data('owlCarousel');
                owl.next();
            });
        },
        onMenuProductClickHandler : function() {
            $('.wolverine-menu-product-cate li.cat-parent').click(function(){
                $('.wolverine-menu-product-cate ul ul').slideUp();
                if(!$('ul',this).is(":visible"))
                {
                    $('ul',this).slideDown();
                }
            })
        },
        pageIn : function() {
            setTimeout(function() {
                $('#site-loading').fadeOut(300);
            }, 300);
        },
        setWidgetCollapse : function() {
            var windowWidth = $window.width();
            if( window.matchMedia('(max-width: 767px)').matches){
                $('footer.footer-collapse-able aside.widget').each(function(){
                    var title = $('h4:first',this);
                    var content = $(title).next();
                    $(title).addClass('collapse');
                    if(content!=null && content!='undefined')
                        $(content).hide();
                    $(title).off();
                    $(title).click(function(){
                        var content = $(this).next();
                        if($(this).hasClass('expanded')){
                            $(this).removeClass('expanded');
                            $(title).addClass('collapse');
                            $(content).slideUp();
                        }
                        else
                        {
                            $(this).addClass('expanded');
                            $(title).removeClass('collapse');
                            $(content).slideDown();
                        }

                    });

                });
            }else{
                $('footer aside.widget').each(function(){
                    var title = $('h4:first',this);
                    $(title).off();
                    var content = $(title).next();
                    $(title).removeClass('collapse');
                    $(title).removeClass('expanded');
                    $(content).show();
                });
            }
        }
    };

    G5Plus.portfolio = {
        init: function () {

        }
    };

    G5Plus.blog = {
        init: function () {
            G5Plus.blog.postLayout();
            setInterval(G5Plus.blog.postLayout,300);
            G5Plus.blog.jPlayerSetup();
            G5Plus.blog.infiniteScroll();
            G5Plus.blog.loadMore();
            G5Plus.blog.gridLayout();
            setInterval(G5Plus.blog.gridLayout,300);
            G5Plus.blog.masonryLayout();
            setInterval(G5Plus.blog.masonryLayout,300);
            G5Plus.blog.likeComment();
        },
        windowResized : function() {
            G5Plus.blog.processWidthAudioPlayer();
        },
        postLayout : function() {
            $('.wolverine-post-isotope').each(function() {
                var $post = $(this).imagesLoaded( function() {
                    $post.isotope({
                        itemSelector : '.wolverine-post-item',
                        layoutMode: "fitRows",
                        isOriginLeft: !isRTL
                    });
                    setTimeout(function () {
                        $post.isotope('layout');
                    }, 300);

                });
            });
        },
        jPlayerSetup : function() {
            $('.jp-jplayer').each(function () {
                var $this = $(this),
                    url = $this.data('audio'),
                    title = $this.data('title'),
                    type = url.substr(url.lastIndexOf('.') + 1),
                    player = '#' + $this.data('player'),
                    audio = {};
                audio[type] = url;
                audio['title'] = title;
                $this.jPlayer({
                    ready: function () {
                        $this.jPlayer('setMedia', audio);
                    },
                    swfPath: '../plugins/jquery.jPlayer',
                    cssSelectorAncestor: player
                });
            });
            G5Plus.blog.processWidthAudioPlayer();
        },
        processWidthAudioPlayer : function() {
            setTimeout(function () {
                $('.jp-audio').each(function () {
                    var _width = $(this).outerWidth() - $('.jp-play-pause', this).outerWidth() - $('.jp-volume', this).outerWidth() - 46;
                    $('.jp-progress', this).width(_width);
                });
            }, 100);
        },
        infiniteScroll : function() {
            var contentWrapper = '.blog-inner';
            $('.blog-inner').infinitescroll({
                navSelector: "#infinite_scroll_button",
                nextSelector: "#infinite_scroll_button a",
                itemSelector: "article",
                loading: {
                    'selector': '#infinite_scroll_loading',
                    'img': g5plus_framework_vars.theme_url + 'assets/images/ajax-loader.gif',
                    'msgText': 'Loading...',
                    'finishedMsg': ''
                }
            }, function (newElements, data, url) {
                var $newElems = $(newElements).css({
                    opacity: 0
                });
                $newElems.imagesLoaded(function () {
                    G5Plus.common.owlCarousel();
                    G5Plus.blog.jPlayerSetup();
                    G5Plus.common.prettyPhoto();
                    $newElems.animate({
                        opacity: 1
                    });


                    if (($(contentWrapper).hasClass('blog-style-masonry-01')) || ($(contentWrapper).hasClass('blog-style-masonry-02')) || ($(contentWrapper).hasClass('blog-style-grid-01')) || ($(contentWrapper).hasClass('blog-style-grid-02'))) {
                        $(contentWrapper).isotope('appended', $newElems);
                        setTimeout(function() {
                            $(contentWrapper).isotope('layout');
                        }, 400);
                    }


                });

            });
        },
        loadMore : function() {
            $('.blog-load-more').on('click', function (event) {
                event.preventDefault();
                var $this = $(this).button('loading');
                var link = $(this).attr('data-href');
                var contentWrapper = '.blog-inner';
                var element = 'article';

                $.get(link, function (data) {
                    var next_href = $('.blog-load-more', data).attr('data-href');
                    var $newElems = $(element, data).css({
                        opacity: 0
                    });

                    $(contentWrapper).append($newElems);

                    $newElems.imagesLoaded(function () {
                        G5Plus.common.owlCarousel();
                        G5Plus.blog.jPlayerSetup();
                        G5Plus.common.prettyPhoto();
                        $newElems.animate({
                            opacity: 1
                        });

                        if (($(contentWrapper).hasClass('blog-style-masonry-01')) || ($(contentWrapper).hasClass('blog-style-masonry-02')) || ($(contentWrapper).hasClass('blog-style-grid-01')) || ($(contentWrapper).hasClass('blog-style-grid-02'))) {
                            $(contentWrapper).isotope('appended', $newElems);
                            setTimeout(function() {
                                $(contentWrapper).isotope('layout');
                            }, 400);
                        }

                    });


                    if (typeof(next_href) == 'undefined') {
                        $this.parent().parent().remove();
                    } else {
                        $this.button('reset');
                        $this.attr('data-href', next_href);
                    }

                });
            });
        },
        gridLayout : function() {
            var $blog_grid = $('.blog-style-grid-01,.blog-style-grid-02');
            $blog_grid.imagesLoaded( function() {
                $blog_grid.isotope({
                    itemSelector : 'article',
                    layoutMode: "fitRows",
                    isOriginLeft: !isRTL
                });
                setTimeout(function () {
                    $blog_grid.isotope('layout');
                }, 500);
            });
        },
        masonryLayout : function() {
            var $blog_masonry = $('.blog-style-masonry-01,.blog-style-masonry-02');
            $blog_masonry.imagesLoaded( function() {
                $blog_masonry.isotope({
                    itemSelector : 'article',
                    layoutMode: "masonry",
                    isOriginLeft: !isRTL
                });

                setTimeout(function () {
                    $blog_masonry.isotope('layout');
                }, 500);
            });
        },
        likeComment : function() {
            $(document).on('click','a[data-like-comment="true"]:not(".liked")',function(event){
                event.preventDefault();
                var $this = $(this);
                var id = $(this).data('id');
                var comment_liked = $.cookie('g5plus_comment_liked');
                if (typeof(comment_liked) != "undefined" && comment_liked.indexOf('|'+id+'|') >= 0) {
                    return;
                }
                $.ajax({
                    url: g5plus_framework_vars.ajax_url,
                    data : {
                        action : 'blog_comment_like',
                        id : id
                    },
                    success: function(data) {
                        var comment_liked =   $.cookie('g5plus_comment_liked');
                        if (typeof(comment_liked) == "undefined") {
                            comment_liked = '|' + id + '|';
                        } else {
                            comment_liked += id + '|';
                        }
                        $.cookie('g5plus_comment_liked',comment_liked,{path: '/'});
                        $this.addClass('liked');
                        $('label',$this).text(data);
                    }
                });
            });
        }
    };

    G5Plus.woocommerce = {
        init: function () {
            G5Plus.woocommerce.setCartScrollBar();
            G5Plus.woocommerce.addCartQuantity();
            G5Plus.woocommerce.addToCart();
            G5Plus.woocommerce.quickView();
            G5Plus.woocommerce.updateShippingMethod();
            var $productImageWrap = $('.single-product-image');
            this.singleProductImage($productImageWrap);
        },
        windowResized : function () {
            G5Plus.woocommerce.setCartScrollBar();
        },
        windowLoad : function() {
            G5Plus.woocommerce.setCartScrollBar();
        },
        setCartScrollBar: function () {
            setTimeout(function () {
                var $adminBar = $('#wpadminbar');
                var $adminBarHeight = $adminBar.outerHeight();
                var $site_top = $('.site-top').outerHeight();
                var $shopping_cart_wrapper = $('.shopping-cart-wrapper').outerHeight();

                var $windowHeight = $window.height();
                var $divCartWrapperHeight = 417;
                var $bufferBottom = 40;
                var $maxCartHeight = 325;
                var $heightScroll = '124px';
                var $max_item_product = 3;

                if ($windowHeight - $adminBarHeight - $site_top - $shopping_cart_wrapper - $bufferBottom < $divCartWrapperHeight) {
                    $maxCartHeight = 200;
                    $heightScroll = '100px';
                    $max_item_product = 2;
                }

                $('ul.cart_list.product_list_widget').css('max-height', $maxCartHeight);
                $('ul.cart_list.product_list_widget').perfectScrollbar({
                    wheelSpeed: 0.5,
                    suppressScrollX: true
                });
                $('ul.cart_list.product_list_widget').perfectScrollbar('update');
                if ($("ul.cart_list.product_list_widget li").length > $max_item_product) {
                    $('ul.cart_list.product_list_widget .ps-scrollbar-y').css('height', $heightScroll);

                }
            }, 1000);
        },
        addCartQuantity: function () {
            $(document).off('click', '.quantity .btn-number').on('click', '.quantity .btn-number', function (event) {
                event.preventDefault();
                var type = $(this).data('type'),
                    input = $('input', $(this).parent()),
                    current_value = parseFloat(input.val()),
                    max  = parseFloat(input.attr('max')),
                    min = parseFloat(input.attr('min')),
                    step = parseFloat(input.attr('step')),
                    stepLength = 0;

                if (input.attr('step').indexOf('.') > 0) {
                    stepLength = input.attr('step').split('.')[1].length;
                }

                if (isNaN(max)) {
                    max = 100;
                }
                if (isNaN(min)) {
                    min = 0;
                }
                if (isNaN(step)) {
                    step = 1;
                    stepLength = 0;
                }

                if (!isNaN(current_value)) {
                    if (type == 'minus') {
                        if (current_value > min) {
                            current_value = (current_value - step).toFixed(stepLength);
                            input.val(current_value).change();
                        }

                        if (parseFloat(input.val()) <= min) {
                            input.val(min).change();
                            $(this).attr('disabled', true);
                        }
                    }

                    if (type == 'plus') {
                        if (current_value < max) {
                            current_value = (current_value + step).toFixed(stepLength);
                            input.val(current_value).change();
                        }
                        if (parseFloat(input.val()) >= max) {
                            input.val(max).change();
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(min);
                }
            });


            $('input', '.quantity').focusin(function () {
                $(this).data('oldValue', $(this).val());
            });

            $('input', '.quantity').on('change', function () {
                var input = $(this),
                    max = parseFloat(input.attr('max')),
                    min = parseFloat(input.attr('min')),
                    current_value = parseFloat(input.val()),
                    step = parseFloat(input.attr('step'));

                if (isNaN(max)) {
                    max = 100;
                }
                if (isNaN(min)) {
                    min = 0;
                }

                if (isNaN(step)) {
                    step = 1;
                }


                var btn_add_to_cart = $('.add_to_cart_button', $(this).parent().parent().parent());
                if (current_value >= min) {
                    $(".btn-number[data-type='minus']", $(this).parent()).removeAttr('disabled');
                    if (typeof(btn_add_to_cart) != 'undefined') {
                        btn_add_to_cart.attr('data-quantity', current_value);
                    }

                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));

                    if (typeof(btn_add_to_cart) != 'undefined') {
                        btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
                    }
                }

                if (current_value <= max) {
                    $(".btn-number[data-type='plus']", $(this).parent()).removeAttr('disabled');
                    if (typeof(btn_add_to_cart) != 'undefined') {
                        btn_add_to_cart.attr('data-quantity', current_value);
                    }
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                    if (typeof(btn_add_to_cart) != 'undefined') {
                        btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
                    }
                }

            });
        },
        addToCart: function () {
            $(document).on('click', '.add_to_cart_button', function () {

                var button = $(this),
                    buttonWrap = button.parent();

                button.addClass("added-spinner");
                button.find('i').attr('class', 'fa fa-spinner fa-spin');

                if (!button.hasClass('single_add_to_cart_button')) {


                    var productWrap;

                    if (buttonWrap.data('style') == 'classic-1') {
                        productWrap = buttonWrap.parent().parent().parent().parent();
                    }

                    if (buttonWrap.data('style') == 'classic-2') {
                        productWrap = buttonWrap.parent().parent().parent().parent();
                    }

                    if (buttonWrap.data('style') == 'creative') {
                        productWrap = buttonWrap.parent().parent().parent().parent();
                    }

                    if (typeof(productWrap) == 'undefined') {
                        return;
                    }
                    productWrap.addClass('active');
                }

            });


            $body.bind("added_to_cart", function (event, fragments, cart_hash, $thisbutton) {
                G5Plus.woocommerce.setCartScrollBar();
                var is_single_product = $thisbutton.hasClass('single_add_to_cart_button');
                var button = $('.added-spinner'),
                    buttonWrap = button.parent(),
                    buttonViewCart = buttonWrap.find('.added_to_cart'),
                    addedTitle = buttonViewCart.text();

                button.remove();


                if (is_single_product) {
                    buttonViewCart.html('<i class="wicon icon-svg-icon-17"></i> ' + addedTitle);
                } else {
                    buttonViewCart.html('<i class="wicon icon-svg-icon-17"></i>');
                    setTimeout(function () {
                        buttonWrap.tooltip('hide').attr('title', addedTitle).tooltip('fixTitle');
                    }, 500);
                    setTimeout(function () {
                        buttonWrap.tooltip('show');
                    }, 700);
                }


                var productThumb;
                var productWrap;
                var productImage;

                if (!is_single_product) {
                    productWrap = $('.product-item-wrap.active');
                    setTimeout(function () {
                        productWrap.removeClass('active');
                    }, 300);
                } else {
                    var product_id = parseInt($thisbutton.data('product_id'), 10);
                    if (!isNaN(product_id)) {
                        productWrap = $('#product-' + product_id);
                    }
                }

                if (productWrap.hasClass('add-to-cart-animation-visible')) {
                    return;
                }


                if (is_single_product) {
                    productThumb = $($('.woocommerce-main-image')[0]);
                    productImage = $('img', productThumb);
                } else {
                    if (productWrap.length == 0) {
                        return;
                    }
                    productThumb = $('.product-thumb', productWrap);
                    productImage = $('.product-thumb-primary img', productThumb);
                    if (productImage.length == 0) {
                        productImage = $('.product-thumb-one img', productThumb);
                    }
                }

                if (productImage.length == 0) {
                    return;
                }

                var position = productThumb.offset();

                $body.append('<div class="floating-cart"></div>');
                var cart = $('div.floating-cart');
                productImage.clone().appendTo(cart);

                var mini_cart = $('.widget_shopping_cart_icon', '.header-desktop-wrapper');


                if (mini_cart.length == 0) {
                    return;
                }

                $(cart).css({
                    'top': position.top + 'px',
                    'left': position.left + 'px',
                    'width': productThumb.width() + 'px',
                    'height': productThumb.height() + 'px'
                }).fadeIn("slow");


                $(cart).animate({
                    'width': (productThumb.width() / 2) + 'px',
                    'height': (productThumb.height() / 2) + 'px',
                    top: '+=' + (productThumb.height() / 4) + 'px',
                    left: '+=' + (productThumb.width() / 4) + 'px'
                }, 400, 'swing', function () {
                    $(cart).animate({
                        top: mini_cart.offset().top + 'px',
                        left: mini_cart.offset().left + 'px',
                        height: '18px',
                        width: '25px'
                    }, 800, "swing", function () {
                        $('div.floating-cart').fadeIn('fast', function () {
                            $('div.floating-cart').remove();
                        });
                        mini_cart.addClass('animated').addClass('tada');
                        setTimeout(function () {
                            mini_cart.removeClass('animated').removeClass('tada');
                        }, 4000);
                    });
                });

            });


            $body.on('wc_fragments_refreshed',function(){
                G5Plus.woocommerce.setCartScrollBar();
            });

        },
        quickView : function() {
            $('.product-quick-view').on('click', function (event) {
                event.preventDefault();
                var product_id = $(this).data('product_id'),
                    popupWrapper = '#popup-product-quick-view-wrapper',
                    $icon = $(this).find('i'),
                    iconClass = $icon.attr('class'),
                    productWrap = $(this).parent().parent().parent().parent();
                productWrap.addClass('active');
                $icon.attr('class','fa fa-spinner fa-spin');
                $.ajax({
                    url: g5plus_framework_vars.ajax_url,
                    data: {
                        action: 'product_quick_view',
                        id: product_id
                    },
                    success: function (html) {
                        productWrap.removeClass('active');
                        $icon.attr('class',iconClass);
                        if ($(popupWrapper).length) {
                            $(popupWrapper).remove();
                        }
                        $('body').append(html);
                        G5Plus.woocommerce.addCartQuantity();
                        G5Plus.common.tooltip();
                        $(popupWrapper).modal();
                    },
                    error: function (html) {
                        G5Plus.common.hideLoading();
                    }
                });

            });
        },
        updateShippingMethod : function() {
            $body.bind('updated_shipping_method',function(){
                $('select.country_to_state, input.country_to_state').change();
            });
        },
        singleProductImage: function ($productImageWrap) {
            var slider_thumb = $productImageWrap.find('.flex-control-thumbs');
            if(slider_thumb.length) {
                slider_thumb.owlCarousel({
                    items : 4,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [980, 4],
                    itemsTablet: [768, 4],
                    itemsTabletSmall: false,
                    itemsMobile: [479, 4],
                    pagination:false,
                    responsiveRefreshRate : 100,
                    navigation: false,
                });


            }
        }
    };


    G5Plus.header = {
        timeOutSearch: null,
        init: function () {
            G5Plus.header.stickyHeader();
            G5Plus.header.menuOnePage();
            G5Plus.header.menuMobile();
            G5Plus.header.events();
            G5Plus.header.search();
	        G5Plus.header.searchAjaxForm();
	        G5Plus.header.headerNavSeparate();
	        G5Plus.header.headerLeftPosition();
        },
        events: function() {
            // Anchors Position
            $("a[data-hash]").on("click", function (e) {
                e.preventDefault();
                G5Plus.page.anchorsPosition(this);
                return false;
            });
        },
        windowResized : function(){
            G5Plus.header.stickyHeader();
	        G5Plus.header.headerNavSpacing();
            if (G5Plus.common.isDesktop()) {
                $('.toggle-icon-wrapper[data-drop]').removeClass('in');
            }
            var $adminBar = $('#wpadminbar');

            if ($adminBar.length > 0) {
                $body.attr('data-offset', $adminBar.outerHeight() + 1);
            }
            if ($adminBar.length > 0) {
                $body.attr('data-offset', $adminBar.outerHeight() + 1);
            }
	        G5Plus.header.headerMobileFlyPosition();
	        G5Plus.header.headerMobilePosition();
        },
	    windowLoad: function() {
		    G5Plus.header.headerNavSpacing(1);
		    G5Plus.header.headerLeftScrollBar();
		    G5Plus.header.headerMobileFlyPosition();
		    G5Plus.header.headerMobilePosition();
		    G5Plus.header.fixStickyLogoSize();
	    },
	    fixStickyLogoSize: function() {
			// if IE
		    if (G5Plus.common.isIE()) {
			    var $logo = $("header .logo-sticky img");
			    if ($logo.length == 0) {
				    return;
			    }
			    var logo_url = $logo.attr('src');
			    if (logo_url.length - logo_url.lastIndexOf('.svg') != 4) {
				    return;
			    }
			    $.get(logo_url, function(svgxml){
				    /* now with access to the source of the SVG, lookup the values you want... */
				    var attrs = svgxml.documentElement.attributes;

				    var pic_real_width = attrs.width.value;   // Note: $(this).width() will not
				    var pic_real_height = attrs.height.value; // work for in memory images.

				    if (typeof (pic_real_width) == "string") {
					    pic_real_width = pic_real_width.replace('px','');
					    pic_real_width = parseInt(pic_real_width, 10);
				    }
				    if (typeof (pic_real_height) == "string") {
					    pic_real_height = pic_real_height.replace('px','');
					    pic_real_height = parseInt(pic_real_height, 10);
				    }

				    if (pic_real_height > 0) {
					    $logo.css('width', (pic_real_width * 30 / pic_real_height) +  'px');
				    }
			    }, "xml");

			}
	    },
		headerMobileFlyPosition: function() {
			var top = 0;
			if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
				top = $('#wpadminbar').outerHeight();
			}
			if (top > 0) {
				$('.header-mobile-nav.menu-drop-fly').css('top',top + 'px');
			}
			else {
				$('.header-mobile-nav.menu-drop-fly').css('top','');
			}
		},
	    headerMobilePosition: function() {
		    var top = 0;
		    if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
			    top = $('#wpadminbar').outerHeight();
		    }
		    if (top > 0) {
			    $('.header-mobile-nav.menu-drop-fly').css('top',top + 'px');
		    }
		    else {
			    $('.header-mobile-nav.menu-drop-fly').css('top','');
		    }
	    },
	    headerLeftPosition: function() {
			var top = 0;
		    if ($('#wpadminbar').length > 0) {
			    top = $('#wpadminbar').outerHeight();
		    }
			if (top > 0) {
				$('header.header-left').css('top',top + 'px');
			}
	    },
        stickyHeader : function() {
            var topSpacing = 0,
                $adminBar = $('#wpadminbar');
            if (($adminBar.length > 0) && ($adminBar.css('position') =='fixed')) {
                topSpacing = $adminBar.outerHeight();
            }

            $('.header-sticky, .header-mobile-sticky').unstick();
	        var topSticky = topSpacing;
            if (G5Plus.common.isDesktop()) {
	            topSpacing = -$(window).height() + 65;

                $('.header-sticky').sticky({
	                topSpacing:topSpacing,
	                topSticky: topSticky,
	                change: function() {
		                G5Plus.header.headerNavSpacing();
		                $('header.main-header .x-nav-menu > li').each(function() {
			                APP_XMENU.process_menu_position(this);
		                });
	                }
                });
            }
            else {
                $('.header-mobile-sticky').sticky({topSpacing:topSpacing, topSticky: topSticky});
            }
        },
        menuOnePage : function() {
            $('.menu-one-page').onePageNav({
                currentClass: 'menu-current',
                changeHash: false,
                scrollSpeed: 750,
                scrollThreshold: 0.5,
                filter: '',
                easing: 'swing'
            });
        },
        anchorsPosition : function(obj, time) {
            var target = $(obj).attr("href");
            if ($(target).length > 0) {
                var _scrollTop = $(target).offset().top,
                    $adminBar = $('#wpadminbar');
                if ($adminBar.length > 0) {
                    _scrollTop -= $adminBar.outerHeight();
                }
                $("html,body").animate({scrollTop: _scrollTop}, time, 'swing', function () {

                });
            }
        },
        menuMobile : function() {
            $('.toggle-mobile-menu[data-ref]').click(function(event) {
                event.preventDefault();
                var $this = $(this);
                var data_drop = $this.data('ref');
                $this.toggleClass('in');
                switch ($this.data('drop-type')) {
                    case 'dropdown':
                        $('#' + data_drop).slideToggle();
                        break;
                    case 'fly':
                        $('body').toggleClass('menu-mobile-in');
                        $('#' + data_drop).toggleClass('in');
                        break;
                }

            });

            $('.toggle-icon-wrapper[data-ref]:not(.toggle-mobile-menu)').click(function(event) {
                event.preventDefault();
                var $this = $(this);
                var data_ref = $this.data('ref');
                $this.toggleClass('in');
                $('#' + data_ref).toggleClass('in');
            });

            $('.main-menu-overlay').click(function() {
                $body.removeClass('menu-mobile-in');
                $('#nav-menu-mobile').removeClass('in');
                $('.toggle-icon-wrapper[data-ref]').removeClass('in');
            });
        },
        search : function() {
            var $search_popup = $('#search_popup_wrapper');
            if (($search_popup.length > 0) && ($('header .icon-search-menu').data('search-type') == 'standard')) {
                var dlg_search = new DialogFx( $search_popup[0] );
                $('header .icon-search-menu').click(dlg_search.toggle.bind(dlg_search));

            }

            $('header .icon-search-menu').click(function (event) {
                event.preventDefault();
                if ($(this).data('search-type') == 'ajax') {
                    G5Plus.header.searchPopupOpen();
                }
                else {
                    $('#search_popup_wrapper input[type="text"]').focus();
                }
            });

            $('.g5plus-dismiss-modal, .modal-backdrop', '#g5plus-modal-search').click(function(){
                G5Plus.header.searchPopupClose();
            });
            $('.g5plus-search-wrapper button > i.ajax-search-icon').click(function(){
                s_search();
            });

            // Search Ajax
            $('#search-ajax', '#g5plus-modal-search').on('keyup', function(event){
                if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
                    return;
                }

                var keys = ["Control", "Alt", "Shift"];
                if (keys.indexOf(event.key) != -1) return;
                switch (event.which) {
                    case 27:	// ESC
                        G5Plus.header.searchPopupClose();
                        break;
                    case 38:	// UP
                        s_up();
                        break;
                    case 40:	// DOWN
                        s_down();
                        break;
                    case 13:	//ENTER
                        var $item = $('li.selected a', '#g5plus-modal-search');
                        if ($item.length == 0) {
                            event.preventDefault();
                            return false;
                        }
                        s_enter();
                        break;
                    default:
                        clearTimeout(G5Plus.header.timeOutSearch);
                        G5Plus.header.timeOutSearch = setTimeout(s_search, 500);
                        break;
                }
            });

            function s_up(){
                var $item = $('li.selected', '#g5plus-modal-search');
                if ($('li', '#g5plus-modal-search').length < 2) return;
                var $prev = $item.prev();
                $item.removeClass('selected');
                if ($prev.length) {
                    $prev.addClass('selected');
                }
                else {
                    $('li:last', '#g5plus-modal-search').addClass('selected');
                    $prev = $('li:last', '#g5plus-modal-search');
                }
                if ($prev.position().top < $('#g5plus-modal-search .ajax-search-result').scrollTop()) {
                    $('#g5plus-modal-search .ajax-search-result').scrollTop($prev.position().top);
                }
                else if ($prev.position().top + $prev.outerHeight() > $('#g5plus-modal-search .ajax-search-result').scrollTop() + $('#g5plus-modal-search .ajax-search-result').height()) {
                    $('#g5plus-modal-search .ajax-search-result').scrollTop($prev.position().top - $('#g5plus-modal-search .ajax-search-result').height() + $prev.outerHeight());
                }
            }
            function s_down() {
                var $item = $('li.selected', '#g5plus-modal-search');
                if ($('li', '#g5plus-modal-search').length < 2) return;
                var $next = $item.next();
                $item.removeClass('selected');
                if ($next.length) {
                    $next.addClass('selected');
                }
                else {
                    $('li:first', '#g5plus-modal-search').addClass('selected');
                    $next = $('li:first', '#g5plus-modal-search');
                }
                if ($next.position().top < $('#g5plus-modal-search .ajax-search-result').scrollTop()) {
                    $('#g5plus-modal-search .ajax-search-result').scrollTop($next.position().top);
                }
                else if ($next.position().top + $next.outerHeight() > $('#g5plus-modal-search .ajax-search-result').scrollTop() + $('#g5plus-modal-search .ajax-search-result').height()) {
                    $('#g5plus-modal-search .ajax-search-result').scrollTop($next.position().top - $('#g5plus-modal-search .ajax-search-result').height() + $next.outerHeight());
                }
            }
            function s_enter() {
                var $item = $('li.selected a', '#g5plus-modal-search');
                if ($item.length > 0) {
                    window.location = $item.attr('href');
                }
            }
            function s_search() {
                var keyword = $('input[type="search"]', '#g5plus-modal-search').val();
                if (keyword.length < 3) {
                    $('.ajax-search-result', '#g5plus-modal-search').html('');
                    return;
                }
                $('.ajax-search-icon', '#g5plus-modal-search').addClass('fa fa-spinner fa-spin');
                $('.ajax-search-icon', '#g5plus-modal-search').removeClass('icon-search-icon');
                $.ajax({
                    type   : 'POST',
                    data   : 'action=result_search&keyword=' + keyword,
                    url    : g5plus_framework_vars.ajax_url,
                    success: function (data) {
                        $('.ajax-search-icon', '#g5plus-modal-search').removeClass('fa fa-spinner fa-spin');
                        $('.ajax-search-icon', '#g5plus-modal-search').addClass('icon-search-icon');
                        var html = '';
	                    var html_view_more = '';
                        if (data) {
                            var items = $.parseJSON(data);
                            if (items.length) {
                                html +='<ul>';
                                if (items[0]['id'] == -1) {
                                    html += '<li>' + items[0]['title']  + '</li>';
                                }
                                else {
                                    $.each(items, function (index) {
	                                    if (this['id'] == -2) {
		                                    html_view_more = '<div class="search-view-more">' + this['title'] + '</div>';
	                                    }
	                                    else {
		                                    if (index == 0) {
			                                    html += '<li class="selected">';
		                                    }
		                                    else {
			                                    html += '<li>';
		                                    }
		                                    if (this['title'] == null || this['title'] == '') {
			                                    html += '<a href="' + this['guid'] + '">' + this['date'] + '</a>';
		                                    }
		                                    else {
			                                    html += '<a href="' + this['guid'] + '">' + this['title'] + '</a>';
			                                    html += '<span>' + this['date'] + ' </span>';
		                                    }
		                                    html += '</li>';
	                                    }
                                    });
                                }


                                html +='</ul>';
                            }
                            else {
                                html = '';
                            }
                        }
                        $('.ajax-search-result', '#g5plus-modal-search').html(html + html_view_more);
                        $('#g5plus-modal-search .ajax-search-result').scrollTop(0);
                    },
                    error : function(data) {
                        $('.ajax-search-icon', '#g5plus-modal-search').removeClass('fa fa-spinner fa-spin');
                        $('.ajax-search-icon', '#g5plus-modal-search').addClass('icon-search-icon');
                    }
                });
            }
        },
        searchPopupOpen : function() {
            if (!$('#g5plus-modal-search').hasClass('in')) {
	            $('body').addClass('overflow-hidden');
                $('#g5plus-modal-search').show();
                setTimeout(function () {
                    $('#g5plus-modal-search').addClass('in');
                }, 300);

                if ($('#search-ajax', '#g5plus-modal-search').length > 0) {
                    $('#search-ajax', '#g5plus-modal-search').focus();
                    $('#search-ajax', '#g5plus-modal-search').val('');
                }
                else {
                    $('#search-standard', '#g5plus-modal-search').focus();
                    $('#search-standard', '#g5plus-modal-search').val('');
                }

                $('.ajax-search-result', '#g5plus-modal-search').html('');
            }
        },
        searchPopupClose : function() {
            if ($('#g5plus-modal-search').hasClass('in')) {
                $('#g5plus-modal-search').removeClass('in');
                setTimeout(function () {
                    $('#g5plus-modal-search').hide();
	                $('body').removeClass('overflow-hidden');
                }, 300);
            }
        },
	    searchAjaxForm: function() {
		    var $wrapper = $('header.main-header .search-button-wrapper');
		    var $form_wrapper = $('header.main-header .search-button-wrapper form.search-type-ajax');
		    $($window).click(function(event){
			    if ($(event.target).closest('header.main-header .search-button-wrapper').length == 0) {
				    $('.ajax-search-result', $wrapper).remove();
				    $('> input[type="text"]', $form_wrapper).val('');
			    }
		    });
		    $form_wrapper.submit(function() {
			    return false;
		    });

		    $('> input[type="text"]', $form_wrapper).on('keyup', function(event) {
			    if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
				    return;
			    }

			    var keys = ["Control", "Alt", "Shift"];
			    if (keys.indexOf(event.key) != -1) return;
			    switch (event.which) {
				    case 27:	// ESC
					    remove_search_result();
					    break;
				    case 38:	// UP
					    s_up();
					    break;
				    case 40:	// DOWN
					    s_down();

					    break;
				    case 13:	//ENTER
					    s_enter();
					    break;
				    default:
					    clearTimeout(G5Plus.header.timeOutSearch);
					    G5Plus.header.timeOutSearch = setTimeout(s_search, 500);
					    break;
			    }
			    function remove_search_result() {
					$('.ajax-search-result', $wrapper).remove();
				    $('> input[type="text"]', $form_wrapper).val('');
			    }

			    function s_up() {
				    var $item = $('li.selected', $wrapper);
				    if ($('li', $wrapper).length < 2) return;
				    var $prev = $item.prev();
				    $item.removeClass('selected');
				    if ($prev.length) {
					    $prev.addClass('selected');
				    }
				    else {
					    $('li:last', $wrapper).addClass('selected');
					    $prev = $('li:last', $wrapper);
				    }
				    var $ajaxSearchResult = $('.ajax-search-result ul', $wrapper);

				    if ($prev.position().top < $ajaxSearchResult.scrollTop()) {
					    $ajaxSearchResult.scrollTop($prev.position().top);
				    }
				    else if ($prev.position().top + $prev.outerHeight() > $ajaxSearchResult.scrollTop() + $ajaxSearchResult.height()) {
					    $ajaxSearchResult.scrollTop($prev.position().top - $ajaxSearchResult.height() + $prev.outerHeight());
				    }
			    }
			    function s_down() {
				    var $item = $('li.selected', $wrapper);
				    if ($('li', $wrapper).length < 2) return;
				    var $next = $item.next();
				    $item.removeClass('selected');
				    if ($next.length) {
					    $next.addClass('selected');
				    }
				    else {
					    $('li:first', $wrapper).addClass('selected');
					    $next = $('li:first', $wrapper);
				    }
				    var $ajaxSearchResult = $('.ajax-search-result ul', $wrapper);

				    if ($next.position().top < $ajaxSearchResult.scrollTop()) {
					    $ajaxSearchResult.scrollTop($next.position().top);
				    }
				    else if ($next.position().top + $next.outerHeight() > $ajaxSearchResult.scrollTop() + $ajaxSearchResult.height()) {
					    $ajaxSearchResult.scrollTop($next.position().top - $ajaxSearchResult.height() + $next.outerHeight());
				    }
			    }
			    function s_enter() {
				    var $item = $('li.selected a', $wrapper);

				    if ($item.length > 0) {
					    window.location = $item.attr('href');
				    }
			    }
			    function s_search() {
				    var keyword = $('input[type="text"]', $form_wrapper).val();
				    if (keyword.length < 3) {
					    if ($('.ajax-search-result', $wrapper).length == 0) {
						    $($wrapper).append('<div class="ajax-search-result"></div>');
					    }
					    var hint_message = $wrapper.attr('data-hint-message');

					    $('.ajax-search-result', $wrapper).html('<ul><li class="no-result">' + hint_message + '</li></ul>');
					    return;
				    }
				    $('button > i', $form_wrapper).addClass('fa fa-spinner fa-spin');
				    $('button > i', $form_wrapper).removeClass('wicon icon-search-icon');
				    $.ajax({
					    type   : 'POST',
					    data   : 'action=result_search&keyword=' + keyword,
					    url    : g5plus_framework_vars.ajax_url,
					    success: function (data) {
						    $('button > i', $wrapper).removeClass('fa fa-spinner fa-spin');
						    $('button > i', $wrapper).addClass('wicon icon-search-icon');
						    var html = '';
						    var html_view_more = '';
						    if (data) {
							    var items = $.parseJSON(data);
							    if (items.length) {
								    html +='<ul>';
								    if (items[0]['id'] == -1) {
									    html += '<li class="no-result">' + items[0]['title']  + '</li>';
								    }
								    else {
									    $.each(items, function (index) {
										    if (this['id'] == -2) {
											    html_view_more = '<div class="search-view-more">' + this['title'] + '</div>';
										    }
										    else {
											    if (index == 0) {
												    html += '<li class="selected">';
											    }
											    else {
												    html += '<li>';
											    }
											    if (this['title'] == null || this['title'] == '') {
												    html += '<a href="' + this['guid'] + '">' + this['date'] + '</a>';
											    }
											    else {
												    html += '<a href="' + this['guid'] + '">' + this['title'] + '</a>';
											    }
											    html += '</li>';
										    }
									    });
								    }
								    html +='</ul>';
							    }
							    else {
								    html = '';
							    }
						    }
						    if ($('.ajax-search-result', $wrapper).length == 0) {
							    $($wrapper).append('<div class="ajax-search-result"></div>');
						    }

						    $('.ajax-search-result', $wrapper).html(html + html_view_more);
						    $('.ajax-search-result ul', $wrapper).scrollTop(0);
					    },
					    error : function(data) {
						    $('button > i', $wrapper).removeClass('fa fa-spinner fa-spin');
						    $('button > i', $wrapper).addClass('wicon icon-search-icon');
					    }
				    });
			    }


		    });
	    },

	    headerNavSeparate: function() {
		    var $menu = $('header.main-header ul.main-menu');
			if ($menu.hasClass('nav-separate')) {
				$('> li.x-menu-item + li.x-menu-item > a', $menu).append('<span class="x-nav-separate"></span>');
			}

		    var $headerCustomize = $('header.main-header .header-customize');
		    if ($headerCustomize.hasClass('nav-separate')) {
			    $('> .header-customize-item + .header-customize-item', $headerCustomize).append('<span class="x-nav-separate"></span>');
		    }
		    else if ($headerCustomize.hasClass('nav-separate-outer')) {
			    $('> .header-customize-item', $headerCustomize).append('<span class="x-nav-separate"></span>');
		    }

	    },
	    headerNavSpacing: function(retryAmount) {
		    if (typeof (retryAmount) == "undefined") {
			    retryAmount = 0;
		    }

		    if (!G5Plus.common.isDesktop()) {
		        return;
		    }
		    var $container = $('header.main-header .header-nav-wrapper > .container');
		    var is_rtl = $('body').hasClass('site-rtl');

		    $('ul.main-menu > li, .header-customize > .header-customize-item, .header-customize,.menu-wrapper + .toggle-icon-wrapper', $container).css(is_rtl ? 'margin-right' : 'margin-left','');
		    $('header.main-header span.x-nav-separate').css(is_rtl ? 'right' : 'left', '');

		    var navContainerWidth = $container.width();
		    var navItemWidth = 0;
		    var navItemCount = 0;
		    var marginLeft = 0;
		    var totalMarginLeft = 0;

			$('ul.main-menu > li, .header-customize > .header-customize-item,.header-left .header-logo,.header-left .logo-sticky, .menu-wrapper + .toggle-icon-wrapper', $container).each(function() {
				var $this = $(this);
				if ($this.is(':visible')) {
					marginLeft = parseInt($this.css(is_rtl ? 'margin-right' : 'margin-left').replace('px','') , 10);
					navItemWidth += $this.outerWidth() + marginLeft + 1;
					totalMarginLeft += marginLeft;
					if (marginLeft > 0) {
						navItemCount++;
					}
				}

			});

		    if ($('.header-customize', $container).length > 0) {
			    marginLeft = parseInt($('.header-customize', $container).css(is_rtl ? 'margin-right' : 'margin-left').replace('px','') , 10);
			    totalMarginLeft += marginLeft;
			    navItemWidth += marginLeft;
			    if (marginLeft > 0) {
				    navItemCount++;
			    }
		    }

		    navItemWidth += 50;


		    if ((navItemCount > 0) && (navItemWidth > navContainerWidth)) {
				var newMarginLeft = (totalMarginLeft - (navItemWidth - navContainerWidth)) / (1.0 * navItemCount);
			    if (marginLeft < 5) {
				    marginLeft = 5;
			    }
			    $('ul.main-menu > li.x-menu-item + li, .header-customize > .header-customize-item + .header-customize-item, .header-customize, .menu-wrapper + .toggle-icon-wrapper', $container).css(is_rtl ? 'margin-right' : 'margin-left', newMarginLeft + 'px');
			    if ($('ul.main-menu > li.logo-sticky', $container).is(':visible')) {
				    $('ul.main-menu > li.logo-sticky + li', $container).css(is_rtl ? 'margin-right' : 'margin-left', newMarginLeft + 'px');
			    }
			    $('header.main-header span.x-nav-separate').css(is_rtl ? 'right' : 'left',(-newMarginLeft/2) + 'px');
		    }
		    //G5Plus.header.changeStickyWrapperSize(2);

		    if (retryAmount > 0) {
			    setTimeout(function() {
				    G5Plus.header.headerNavSpacing(retryAmount - 1);
			    }, 100);
		    }
	    },
	    changeStickyWrapperSize: function(count) {
		    var $sticky_wrapper = $('header.main-header .sticky-wrapper');
		    if ($sticky_wrapper.length > 0) {
			    $sticky_wrapper.height($(' > .header-sticky',$sticky_wrapper).outerHeight());
		    }

		    if (count > 0) {
			    setTimeout(function() {
				    G5Plus.header.changeStickyWrapperSize(count - 1);
			    }, 100);
		    }
	    },
	    headerLeftScrollBar: function () {
		    $('header.header-left').perfectScrollbar({
			    wheelSpeed: 0.5,
			    suppressScrollX: true
		    });
	    }
    };


    G5Plus.onReady = {
        init: function () {
            G5Plus.common.init();
            G5Plus.header.init();
            G5Plus.page.init();
            G5Plus.blog.init();
            G5Plus.portfolio.init();
            G5Plus.woocommerce.init();
        }
    };

    G5Plus.onLoad = {
        init: function () {
	        G5Plus.header.windowLoad();
	        G5Plus.page.windowLoad();
	        G5Plus.woocommerce.windowLoad();
        }
    };

    G5Plus.onResize = {
        init: function () {
            G5Plus.page.windowResized();
            G5Plus.woocommerce.windowResized();
            G5Plus.header.windowResized();
            G5Plus.blog.windowResized();
        }
    };

	G5Plus.onScroll = {
		init: function () {

		}
	};

    $(window).resize(G5Plus.onResize.init);
	$(window).scroll(G5Plus.onScroll.init);
    $(document).ready(G5Plus.onReady.init);
    $(window).load(G5Plus.onLoad.init);
})(jQuery);

