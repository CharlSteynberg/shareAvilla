"use strict";
var Page = {
    config: {
        $bookBlock: '#flips',
        $navNext: '.nav-next',
        $navPrev: '.nav-prev',
        $ajaxUrl: ''
    },
    init: function (ajax_url) {
        Page.config.$ajaxUrl = ajax_url;
        jQuery(Page.config.$bookBlock).bookblock({
            speed: 1000,
            shadowSides: 0.8,
            easing: 'ease-in-out',
            shadows: true,
            shadowFlip: 0.4

        });
        Page.initEvents();
        Page.initFlipHeight();
        Page.initMenuAndSearchClick();
        jQuery(window).resize(function () {
            Page.initFlipHeight();
        });
        jQuery('.portfolio-content', '.entry-hover-inner').perfectScrollbar({
            wheelSpeed: 1,
            suppressScrollX: true
        });
        Page.registerEventViewDetail();

        var params = Page.getUrlVars();
        if (params != '') {
            if (params['action'] == 'menu')
                jQuery('a', '#flips .bb-item .menu').click();
            if (params['action'] == 'search')
                jQuery('a', '#flips .bb-item .search').click();
        }

    },
    initEvents: function () {

        var $slides = jQuery(Page.config.$bookBlock).children();

        // add navigation events
        jQuery(Page.config.$navNext).on('click touchstart', function () {
            jQuery(Page.config.$bookBlock).bookblock('next');
            return false;
        });

        jQuery(Page.config.$navPrev).on('click touchstart', function () {
            jQuery(Page.config.$bookBlock).bookblock('prev');
            return false;
        });

        // add swipe events
        $slides.on({
            'swipeleft': function (event) {
                jQuery(Page.config.$bookBlock).bookblock('next');
                return false;
            },
            'swiperight': function (event) {
                jQuery(Page.config.$bookBlock).bookblock('prev');
                return false;
            }
        });

        // add keyboard events
        jQuery(document).keydown(function (e) {
            var keyCode = e.keyCode || e.which,
                arrow = {
                    left: 37,
                    up: 38,
                    right: 39,
                    down: 40
                };

            switch (keyCode) {
                case arrow.left:
                    jQuery(Page.config.$bookBlock).bookblock('prev');
                    break;
                case arrow.right:
                    jQuery(Page.config.$bookBlock).bookblock('next');
                    break;
            }
        });
    },
    initFlipHeight: function () {
        var $height = 500;

        var $windowWidth = jQuery(window).width();
        var $wpadminbar = jQuery('#wpadminbar');
        var padding = 0;
        if ($wpadminbar.length > 0)
            padding = $wpadminbar.height();
        if (jQuery(window).outerHeight() > $height)
            $height = (jQuery(window).outerHeight() - padding);
        jQuery('#flips').css('height', $height);

        var paddingTop = 25;
        var paddingBottom = 25;
        var itemHeight = $height - paddingTop - paddingBottom;
        jQuery('#flips .bb-item .bb-item-inner .bb-custom-side').css('height', itemHeight);
        setTimeout(function(){
            Page.initEntryHover();
        },500);


    },
    initEntryHover: function () {
        var entry_hover_height = jQuery('.entry-hover', '.content-wrap').height();
        var icon_logo_height = jQuery('.icon-logo', '.content-wrap').outerHeight();
        var $windowWidth = jQuery(window).width();
        var $padding = 60;
        if($windowWidth<=500)
            $padding = 20;
        var portfolio_content_height = entry_hover_height - icon_logo_height - $padding;
        jQuery('.portfolio-content', '.content-wrap').css('height', portfolio_content_height);
    },
    initFlipOtherPageHeight: function () {
        var $height = 600;
        var $wpadminbar = jQuery('#wpadminbar');
        var padding = 50;
        if ($wpadminbar.length > 0)
            padding = padding + $wpadminbar.height();
        if (jQuery(window).outerHeight() > $height)
            $height = (jQuery(window).outerHeight() - padding);

        jQuery('.other-page-flipbook .flipbook-col-left').css('height', $height);
        jQuery('.other-page-flipbook .flipbook-col-right').css('height', $height);

        jQuery('.other-page-flipbook .flipbook-col-right > .wpb_wrapper:first').css('height', $height);
        jQuery('.other-page-flipbook .flipbook-col-right > .wpb_wrapper .flipbook-content:first').parent().addClass('vertical-middle');


        var $contentHeight = $height - 300;
        var parentContentScroll = jQuery('.other-page-flipbook .flipbook-col-left .wpb_wrapper .flipbook-content').parent();
        jQuery(parentContentScroll).css('height', $contentHeight);
        jQuery(parentContentScroll).perfectScrollbar({
            wheelSpeed: 1,
            suppressScrollX: true
        });
    },
    initMenuAndSearchClick: function () {
        jQuery('a', '#flips .bb-item .menu').click(function () {
            jQuery('.bb-item', '#flips').each(function () {
                if (jQuery(this).css('display') == 'block') {
                    var post_id = jQuery(this).attr('data-post-id');
                    var post_bg = jQuery('#post_bg_' + post_id, this).css('background-image');
                    var post_thumb = jQuery('#post_thumbnail_' + post_id, this).attr('src');
                    var post_title = jQuery('#post_title_' + post_id, this).html();
                    var post_content = jQuery('#post_content_' + post_id, this).html();
                    var page_index = jQuery(this).attr('data-page-index');

                    var bb_first_item = jQuery('#bb-menu-item-template').html();

                    jQuery(this).before(bb_first_item);

                    jQuery('#post_bg_first', '#flips').css('background-image', post_bg);
                    jQuery('#post_thumbnail_first', '#flips').attr('src', post_thumb);
                    jQuery('#post_title_first', '#flips').html(post_title);
                    jQuery('#post_content_first', '#flips').html(post_content);
                    jQuery('.bb-item.template', '#flips').attr('data-page-index', page_index);


                    /*jQuery('.portfolio-content', '.content-wrap').perfectScrollbar({
                        wheelSpeed: 1,
                        suppressScrollX: true
                    });*/

                    jQuery('.nav-next', '#flips .bb-item.template').click(function () {
                        var page_index = jQuery('#flips .bb-item.template').attr('data-page-index');
                        page_index = parseInt(page_index);
                        jQuery(Page.config.$bookBlock).bookblock('next');
                        jQuery('.bb-item.template', '#flips').remove();
                        jQuery(Page.config.$bookBlock).bookblock('update_current_index', page_index - 1);
                    });
                    Page.registerEventViewDetail();
                    jQuery(Page.config.$bookBlock).bookblock('update');
                    jQuery(Page.config.$bookBlock).bookblock('prev');
                    Page.initEntryHover();

                }
            });
        });

        jQuery('a', '#flips .bb-item .search').click(function () {
            jQuery('.bb-item', '#flips').each(function () {
                if (jQuery(this).css('display') == 'block') {
                    var post_id = jQuery(this).attr('data-post-id');
                    var post_bg = jQuery('#post_bg_' + post_id, this).css('background-image');
                    var post_thumb = jQuery('#post_thumbnail_' + post_id, this).attr('src');
                    var post_title = jQuery('#post_title_' + post_id, this).html();
                    var post_content = jQuery('#post_content_' + post_id, this).html();
                    var page_index = jQuery(this).attr('data-page-index');

                    var bb_first_item = jQuery('#bb-search-item-template').html();

                    jQuery(this).after(bb_first_item);

                    jQuery('#post_bg_last', '#flips').css('background-image', post_bg);
                    jQuery('#post_thumbnail_last', '#flips').attr('src', post_thumb);
                    jQuery('#post_title_last', '#flips').html(post_title);
                    jQuery('#post_content_last', '#flips').html(post_content);
                    jQuery('.bb-item.template', '#flips').attr('data-page-index', page_index);

                    jQuery('.nav-prev', '#flips .bb-item.template').click(function () {

                        var page_index = jQuery('#flips .bb-item.template').attr('data-page-index');
                        page_index = parseInt(page_index);
                        jQuery(Page.config.$bookBlock).bookblock('prev');
                        jQuery('.bb-item.template', '#flips').remove();
                        jQuery(Page.config.$bookBlock).bookblock('update_current_index', page_index - 1);
                    });

                    jQuery(document).ready(function () {
                        jQuery('.search-button', '.bb-custom-lastpage').click(function () {
                            var $icon = jQuery('i', this);
                            var $search_button = jQuery(this);
                            if ($icon.length == 0) {
                                Page.search(this);
                            } else {
                                if (jQuery($icon).hasClass('fa-close')) {
                                    Page.closeSearch();
                                }
                            }
                        })
                        jQuery('input[type="text"]', '.bb-custom-lastpage').on('keyup', function (event) {
                            var $el = jQuery('.search-button', jQuery(this).parent());
                            switch (event.which) {
                                case 13:
                                    if (jQuery(this).val() != '') {
                                        Page.search($el);
                                    }
                                    break;
                                case 27:
                                {
                                    Page.closeSearch();
                                    break;
                                }
                            }
                        });
                    });

                    Page.registerEventViewDetail();
                    jQuery(Page.config.$bookBlock).bookblock('update');
                    jQuery(Page.config.$bookBlock).bookblock('next');
                    Page.initEntryHover();
                    setTimeout(function () {
                        jQuery('input[type="text"]', '.bb-custom-lastpage').focus();
                    }, 1500);
                }
            });
        })
    },
    search: function ($el) {
        var text = jQuery($el).html();
        var keyword = jQuery('input[type="text"]', jQuery($el).parent()).val();
        jQuery($el).html('<i class="fa fa-spin fa-spinner"></i>');
        jQuery.ajax({
            type: 'POST',
            data: 'action=g5plus_framework_portfolio_search&keyword=' + keyword,
            url: Page.config.$ajaxUrl,
            success: function (data) {
                jQuery($el).html('<i class="fa fa-close"></i>');
                var $parent = jQuery($el).parent();
                var $search_result = jQuery('.search-result ul', $parent);
                var items = jQuery.parseJSON(data);
                if (items.length) {
                    var html = '';
                    if (items[0]['id'] == -1) {
                        html += '<li class="selected">' + items[0]['title'] + '</li>';
                        jQuery($search_result).css('height', '80px');
                    }
                    else {
                        for (var $i = 0; $i < items.length; $i++) {
                            if ($i == 0) {
                                html += '<li class="selected">';
                            }
                            else {
                                html += '<li>';
                            }
                            html += '<a class="secondary-font ladda-button" data-style="zoom-out"  data-post-id="' + items[$i]['id'] + '" href="javascript:;">';
                            html += items[$i]['title'] + '</a>';
                            html += '</li>';
                        }
                        jQuery($search_result).css('height', '200px');
                    }
                    jQuery($search_result).html('');
                    jQuery($search_result).append(html);

                    jQuery($search_result).perfectScrollbar({
                        wheelSpeed: 1,
                        suppressScrollX: true
                    });
                    jQuery('.search-result ul li a', '.bb-custom-lastpage').click(function () {
                        Page.initEventViewDetail(this);
                    });

                }

            }
        });

    },
    closeSearch: function () {
        var $search_button = jQuery('.search-button', '.bb-custom-lastpage');
        var $parent = jQuery($search_button).parent();
        var $search_result = jQuery('.search-result ul', $parent);
        jQuery($search_result).css('height', '0');
        jQuery($search_result).html('');
        jQuery('input[type="text"]', $parent).val('');
        jQuery('input[type="text"]', $parent).focus();
        jQuery($search_button).html(jQuery($search_button).attr('data-title'));
    },
    initEventViewDetail: function (elm) {
        var post_id = jQuery(elm).attr('data-post-id');
        var l = Ladda.create(elm);
        l.start();
        jQuery.ajax({
            type: 'POST',
            async: false,
            data: 'action=g5plus_framework_portfolio_get_detail&post_id=' + post_id,
            url: Page.config.$ajaxUrl,
            success: function (data) {
                l.stop();
                var section_detail = '#section-portfolio-detail';
                jQuery(section_detail).html(data);
                jQuery(section_detail).addClass('show');

                var $height = 500;
                var $wpadminbar = jQuery('#wpadminbar');
                var padding = 0;
                var windowWidth = jQuery(window).width();
                if ($wpadminbar.length > 0)
                    padding = $wpadminbar.height();
                if (jQuery(window).outerHeight() > $height)
                    $height = (jQuery(window).outerHeight() - padding);

                jQuery(".post-slideshow", section_detail).owlCarousel({
                    items: 1,
                    singleItem: true,
                    navigation: false,
                    slideSpeed: 600,
                    pagination: true
                });
                if (windowWidth > 768) {
                    jQuery(section_detail).css('height', $height);
                }
                var $itemInnerHeight = jQuery('.bb-item-inner.first-page',section_detail).height();
                var $titleHeight = jQuery('.portfolio-title',section_detail).outerHeight(true);
                var $logoHeight = jQuery('.logo',section_detail).outerHeight(true);
                var $copyrightHeight = jQuery('.copyright',section_detail).outerHeight(true);
                var $paddingTop = 80;
                var $paddingBottom = 50;
                var $contentHeight = $itemInnerHeight - $paddingTop - $paddingBottom - $logoHeight - $titleHeight - $copyrightHeight;
                jQuery('.firstpage-inner',section_detail).css('height',$contentHeight);
                jQuery('.firstpage-inner', section_detail).perfectScrollbar({
                    wheelSpeed: 1,
                    suppressScrollX: true
                });
                jQuery('#flips').fadeOut();
                jQuery(section_detail).fadeIn();
                jQuery('.close-popup-detail a', section_detail).click(function () {
                    jQuery(section_detail).fadeOut();
                    jQuery(section_detail).html('');
                    jQuery(section_detail).removeClass('show');
                    jQuery('#flips').fadeIn();
                });

            }
        });
    },
    registerEventViewDetail: function () {
        jQuery('a.view-detail', '.portfolio-wrapper').off();
        jQuery('a.view-detail', '.portfolio-wrapper').click(function () {
            Page.initEventViewDetail(this);
        });
    },
    getUrlVars: function () {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

}
