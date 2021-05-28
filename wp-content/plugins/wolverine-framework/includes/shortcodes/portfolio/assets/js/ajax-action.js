/**
 * Created by phuongth on 3/20/15.
 */
"use strict";
var PortfolioAjaxAction = {
    htmlTag:{
        load_more :'.load-more',
        portfolio_container: '#portfolio-'
    },
    vars:{
        ajax_url: ''
    },
    registerPagingEvent:function(){
        jQuery(PortfolioAjaxAction.htmlTag.load_more,'.portfolio').off();
        jQuery(PortfolioAjaxAction.htmlTag.load_more,'.portfolio').click(function(){
            var $this = jQuery(this).button('loading');
            var $section_id = $this.attr('data-section-id');
            var $data_source = $this.attr('data-source');
            var $category = $this.attr('data-category');
            var $portfolio_ids = $this.attr('data-portfolio-ids');
            var $current_page = $this.attr('data-current-page');
            var $offset = $this.attr('data-offset');
            var $post_per_page = $this.attr('data-post-per-page');
            var $overlay_style = $this.attr('data-overlay-style');
            var $column = $this.attr('data-column');
            var $padding = $this.attr('data-padding');
            var $layout_type = $this.attr('data-layout-type');
            var $order =  $this.attr('data-order');
            jQuery.ajax({
                url: PortfolioAjaxAction.vars.ajax_url,
                data: ({action : 'g5plusframework_portfolio_load_more', postsPerPage: $post_per_page, current_page: $current_page,
                    layoutType: $layout_type, overlayStyle: $overlay_style,
                    columns: $column, colPadding: $padding, offset: $offset, order: $order,
                    category: $category, dataSource : $data_source, portfolioIds : $portfolio_ids
                }),
                success: function(data) {
                    $this.button('reset');
                    var $container = jQuery('#portfolio-container-' + $section_id);
                    var $item = jQuery('.portfolio-item',data);
                    if(jQuery('.load-more',data)!=null && jQuery('.load-more',data).length > 0){
                        $this.attr('data-current-page',jQuery('.load-more',data).attr('data-current-page'));
                    }else
                        $this.parent().hide();
                    $container.append( $item ).isotope( 'appended', $item );
                    $container.imagesLoaded( function() {
                        jQuery('.portfolio-item > div').hoverdir('destroy');
                        jQuery('.portfolio-item > div').hoverdir('rebuild');

                        jQuery('a','#portfolio-' + $section_id + ' .portfolio-tabs ').removeClass('active');
                        jQuery('a[data-group="all"]').addClass('active');
                        $container.isotope({ filter: '*' });
                    });

                    PortfolioAjaxAction.registerPrettyPhoto();
                    jQuery('.portfolio-item > div.entry-thumbnail').hoverdir();


                }
            });
        });
    },
    registerPrettyPhoto:function(){
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto(
            {
                hook: 'data-rel',
                theme: 'light_rounded',
                slideshow: 5000,
                deeplinking: false,
                social_tools: false
            });
    },
    registerFilterByCategory:function(){
        jQuery('li','.portfolio.slider .portfolio-tabs').each(function(){
            jQuery('a',jQuery(this)).off();
            jQuery('a',jQuery(this)).click(function(){

                jQuery('a','.portfolio.slider .portfolio-tabs').off();

                var $this = jQuery(this);

                var l = Ladda.create(this);
                l.start();
                jQuery('a.bold-color-active', jQuery(this).parent().parent()).removeClass('bold-color-active');
                jQuery('li.bold-color-active', jQuery(this).parent().parent()).removeClass('bold-color-active');

                jQuery($this).parent().addClass('bold-color-active');
                jQuery($this).addClass('bold-color-active');
                var $section_id = $this.attr('data-section-id');
                var $current_page = 1;
                var $category  = $this.attr('data-group');
                var $offset = 0;
                var $post_per_page = 0;
                var $overlay_style = $this.attr('data-overlay-style');
                var $column = $this.attr('data-column');
                var $padding = '';
                var $order =  $this.attr('data-order');
                var $layout_type = $this.attr('data-layout-type');
                jQuery.ajax({
                    url: PortfolioAjaxAction.vars.ajax_url,
                    data: ({action : 'g5plusframework_portfolio_load_by_category', postsPerPage: $post_per_page, current_page: $current_page,
                        layoutType: $layout_type, overlayStyle: $overlay_style, category : $category,
                        columns: $column, colPadding: $padding, offset: 0, order: $order
                    }),
                    success: function(data) {
                        l.stop();
                        PortfolioAjaxAction.registerFilterByCategory();

                        var $container = jQuery('#portfolio-container-' + $section_id);
                        $container.fadeOut(400,function(){
                            $container.empty();
                            var $item = jQuery('.portfolio-item',data);
                            $container.append( $item );
                            PortfolioAjaxAction.registerPrettyPhoto();

                            var owl = jQuery($container).data('owlCarousel');
                            if(owl!=null && $item.length > 0 )
                                owl.destroy();
                            jQuery($container).owlCarousel({
                                items : $column,
                                pagination: false,
                                navigation: true,
                                navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
                            });
                            jQuery('.portfolio-item > div.entry-thumbnail').hoverdir();
                            $container.fadeIn();
                        });


                    },
                    error:function(){
                        PortfolioAjaxAction.registerFilterByCategory();
                    }
                });
            });
        });
    },
    wrapperContentResize:function(){
        jQuery('#wrapper-content').bind('resize', function(){
            var $container = jQuery('.portfolio-wrapper');
            var owl = jQuery('.portfolio-wrapper').data('owlCarousel');
            if(owl==null ){
                 $container.isotope({
                 itemSelector: '.portfolio-item'
                 }).isotope('layout');

            }
        });
    },
    init:function(ajax_url){
        PortfolioAjaxAction.vars.ajax_url = ajax_url;
        PortfolioAjaxAction.registerPagingEvent();
        PortfolioAjaxAction.registerPrettyPhoto();
        PortfolioAjaxAction.registerFilterByCategory();
        PortfolioAjaxAction.wrapperContentResize();
    }
}