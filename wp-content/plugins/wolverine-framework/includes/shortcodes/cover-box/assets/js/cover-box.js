/**
 * Created by trungpq on 15/09/2015.
 */
(function ($) {
    "use strict";
    var G5PlusCoverBox = {
        init: function() {
            if($('.wolverine-cover-box').length) {
                $('.wolverine-cover-box').each(function() {
                    var parent=this;
                    var i_act=$(this).data('act');
                    if($('.box-image',parent).length)
                    {
                        var number_col=$('.box-image',parent).length+1;
                        var col_width=100;
                        if(i_act>(number_col-1) || i_act<1 || i_act=='')
                        {
                            i_act=1;
                        }
                        if ($(window).outerWidth() > 768) {
                            col_width=100/number_col;
                        }
                        else
                        {
                            col_width=100;
                        }
                        var i=0;
                        if(col_width<100)
                        {
                            $('.box-image',parent).each(function() {
                                $(this).attr('style','width:'+col_width+'%');
                                var w=$(this).width();
                                $('.box-content-inner',$(this).next()).width(w);
                                $(this).next().attr('style','width:0');
                                i++;
                                if(i==i_act)
                                {
                                    $(this).next().addClass('act');
                                    $(this).next().attr('style','width:'+col_width+'%');
                                }
                                $(this).hover(function(){
                                    $('.box-content',parent).each(function() {
                                        $(this).removeClass('act');
                                        $(this).attr('style','width:0');
                                    });
                                    $(this).next().addClass('act');
                                    $(this).next().attr('style','width:'+col_width+'%');
                                })
                            });
                        }
                        else
                        {
                            i=0;
                            $('.box-image',parent).each(function() {
                                $(this).attr('style','width:100%;');
                                $(this).next().attr('style','width:100%;height:0');
                                $('.box-content-inner',$(this).next()).width('100%');
                                i++;
                                if(i==i_act)
                                {
                                    $(this).next().addClass('act');
                                    $(this).next().attr('style','width:100%;height:247px');
                                }
                                $(this).hover(function(){
                                    $('.box-content',parent).each(function() {
                                        $(this).removeClass('act');
                                        $(this).attr('style','width:100%;height:0');
                                    });
                                    $(this).next().addClass('act');
                                    $(this).next().attr('style','width:100%;height:247px');
                                })
                            });
                        }
                    }
                })
            }
        }
    };
    $(document).ready(G5PlusCoverBox.init);
    $(window).resize(G5PlusCoverBox.init);
})(jQuery);