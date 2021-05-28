/**
 * Created by phuongth on 9/10/15.
 */
"use strict";
var GalleryAjaxAction = {
    htmlTag:{
        load_more :'.load-more'
    },
    vars:{
        ajax_url: '',
        dataSectionId:''
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
    processFilter:function(elm){
        var $this = jQuery(elm);

        var l = Ladda.create(elm);
        l.start();
        var $filterType = $this.attr('data-load-type');
        var $overlay_style = $this.attr('data-overlay-style');
        var $section_id = $this.attr('data-section-id');
        var $data_source = $this.attr('data-source');
        var $data_GalleryIds = $this.attr('data-gallery-ids');
        var $data_show_paging = $this.attr('data-show-paging');
        var $current_page =  $this.attr('data-current-page');
        var $category  = $this.attr('data-category');
        var $offset = 0;
        var $post_per_page = $this.attr('data-post-per-page');
        var $column = $this.attr('data-column');
        var $padding = '';
        var $order =  $this.attr('data-order');
        var $layout_type = $this.attr('data-layout-type');

        if($filterType=='filter'){
            jQuery('a.active', jQuery(elm).parent().parent()).removeClass('active');
            jQuery('li.active', jQuery(elm).parent().parent()).removeClass('active');
            jQuery($this).parent().addClass('active');
            jQuery($this).addClass('active');
        }else{
            $category = jQuery('a.active', jQuery(elm).parent().parent()).attr('data-category');
        }

        jQuery.ajax({
            url: GalleryAjaxAction.vars.ajax_url,
            data: ({action : 'g5plusframework_gallery_load_by_category', postsPerPage: $post_per_page, current_page: $current_page,
                layoutType: $layout_type,category : $category,
                columns: $column, colPadding: $padding, offset: 0, order: $order,
                data_source  : $data_source, galleryIds: $data_GalleryIds, data_show_paging: $data_show_paging,
                overlay_style: $overlay_style
            }),
            success: function(data) {
                l.stop();
                GalleryAjaxAction.registerFilterByCategory();

                if($data_show_paging=='1'){
                    jQuery('#load-more-' + GalleryAjaxAction.vars.dataSectionId).empty();
                    if(jQuery('.paging',data).length>0){
                        var $loadButton = jQuery('.paging a',data);
                        $loadButton.attr('data-section-id',GalleryAjaxAction.vars.dataSectionId);
                        jQuery('#load-more-' + GalleryAjaxAction.vars.dataSectionId).append($loadButton);
                        GalleryAjaxAction.registerLoadmore();
                    }
                }

                var $container = jQuery('#g5plus-gallery-container-' + $section_id);

                var $item = jQuery('.g5plus-gallery-item',data);



                if($filterType=='filter'){
                    $container.fadeOut();
                    $container.empty();
                    $item.css('transition','all 0.3s');
                    $item.css('-webkit-transition','all 0.3s');
                    $item.css('-moz-transition','all 0.3s');
                    $item.css('-ms-transition','all 0.3s');
                    $item.css('-o-transition','all 0.3s');
                    $item.css('opacity',0);
                }else{
                    $item.fadeOut();
                }
                $container.append( $item );
                GalleryAjaxAction.registerPrettyPhoto();

                var owl = jQuery($container).data('owlCarousel');
                if(owl!=null && $item.length > 0 ){
                    owl.destroy();
                    jQuery($container).owlCarousel({
                        items : $column,
                        pagination: false,
                        navigation: true,
                        navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
                    });
                }
                jQuery('.g5plus-gallery-item > div.entry-thumbnail').hoverdir();
                if($filterType=='filter'){
                    $container.fadeIn(10,function(){
                        $item.css('opacity',1);
                    });
                }else{
                    $item.fadeIn();
                }

            },
            error:function(){
                GalleryAjaxAction.registerFilterByCategory();
            }
        });
    },
    registerFilterByCategory:function(){
        jQuery('li','.g5plus-gallery .g5plus-gallery-tabs').each(function(){
            jQuery('a',jQuery(this)).off();
            jQuery('a',jQuery(this)).click(function(){
                jQuery('a','.g5plus-gallery .g5plus-gallery-tabs').off();
                GalleryAjaxAction.processFilter(this);
            });
        });
    },
    registerLoadmore:function(){
        jQuery('a','#load-more-' + GalleryAjaxAction.vars.dataSectionId).off();
        jQuery('a','#load-more-' + GalleryAjaxAction.vars.dataSectionId).click(function(){
            GalleryAjaxAction.processFilter(this);
        });
    },
    init:function(ajax_url, sectionid){
        GalleryAjaxAction.vars.dataSectionId = sectionid;
        GalleryAjaxAction.vars.ajax_url = ajax_url;
        GalleryAjaxAction.registerPrettyPhoto();
        GalleryAjaxAction.registerFilterByCategory();
        GalleryAjaxAction.registerLoadmore();
    }
}
