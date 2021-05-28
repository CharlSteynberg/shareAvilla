/**
 * Created by Administrator on 5/29/2015.
 */
(function($){
    "use strict";
    var AdminAPP = {
        initialize: function() {
            AdminAPP.meta_box_tab();
            AdminAPP.process_post_format();
            AdminAPP.required_field();
            AdminAPP.widget_select2_process();
        },
        meta_box_tab: function() {
            //var tabBoxes = $('#masonry_thumbnail_meta_box,#masonry_thumbnail_meta_box1');
            var tabBoxes = $(meta_box_ids);
            $('#normal-sortables').after('<div class="g5plus-meta-tabs-wrap postbox"><div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Pages Options</span></h3><div id="g5plus-tabbed-meta-boxes"></div></div>');

            $(tabBoxes).appendTo('#g5plus-tabbed-meta-boxes');
            $(tabBoxes).hide().removeClass('hide-if-no-js');

            for (var a = 0, b = tabBoxes.length; a < b; a++ ) {
                var newClass = 'editor-tab' + a;
                $(tabBoxes[a]).addClass(newClass);
            }

            var menu_html = '<ul id="g5plus-meta-box-tabs" class="clearfix">\n';
            var total_hidden = 0;
            for (var i = 0, n = tabBoxes.length; i < n; i++ ) {
                var target_id = $(tabBoxes[i]).attr('id');
                var tab_name = $(tabBoxes[i]).find('.hndle > span').text();
                var tab_class = "";

                if ($(tabBoxes[i]).hasClass('hide-if-js')) {
                    total_hidden++;
                }

                menu_html = menu_html + '\n<li id="li-'+ target_id +'" class="'+tab_class+'"><a href="#" rel="editor-tab' + i + '">' + tab_name + '</a></li>';
            }
            menu_html = menu_html + '\n</ul>';

            $('#g5plus-tabbed-meta-boxes').before(menu_html);
            $('#g5plus-meta-box-tabs a:first').addClass('active');

            $('.editor-tab0').addClass('active').show();

            $('.g5plus-meta-tabs-wrap').on('click', '.handlediv', function() {
                var metaBoxWrap = $(this).parent();
                if (metaBoxWrap.hasClass('closed')) {
                    metaBoxWrap.removeClass('closed');
                } else {
                    metaBoxWrap.addClass('closed');
                }
            });

            $('#g5plus-meta-box-tabs li').on('click', 'a', function() {
                $(tabBoxes).removeClass('active').hide();
                $('#g5plus-meta-box-tabs a').removeClass('active');

                var target = $(this).attr('rel');

                $(this).addClass('active');
                $('.' + target).addClass('active').show();

                return false;
            });
        },
        get_input_val: function($input) {
            var val = $input.val();
            if ($input.is(':checkbox')) {
                if ($input.prop('checked')) {
                    val = $input.val();
                }
                else {
                    val = '0';
                }
            }
            return val;
        },
        requiredGetApplyFiled: function(required) {
            var arrInput = [];
            var index = 0;
            if (typeof (required[0]) == 'object') {
                for (var i = 0; i < required.length; i++) {
                    var arrFieldChild = required[i];
                    if (typeof (arrFieldChild[0]) == 'object') {
                        for (var j = 0; j < arrFieldChild.length; j++) {
                            arrInput[index++] = arrFieldChild[j][0];
                            if (arrFieldChild[j][1].substr(0, 1) == '&') {
                                arrInput[index++] = arrFieldChild[j][2];
                            }
                        }
                    }
                    else {
                        arrInput[index++] = arrFieldChild[0];
                        if (arrFieldChild[1].substr(0, 1) == '&') {
                            arrInput[index++] = arrFieldChild[2];
                        }
                    }
                }
            }
            else {
                arrInput[index++] = required[0];
                if (required[1].substr(0, 1) == '&') {
                    arrInput[index++] = required[2];
                }
            }
            return arrInput;
        },
        process_post_format: function () {
            setTimeout(function () {
                $('.editor-post-format select').trigger('change');
                $('[name="post_format"]:checked').trigger('change')
            },1000);

            $(document).on('change','.editor-post-format select',function (event) {
                AdminAPP.switch_post_format_content($(this).val());
            });

            $('[name="post_format"]').on('change',function(){
                AdminAPP.switch_post_format_content($(this).val());
            });

        },

        switch_post_format_content : function($post_format) {
            $('[id^="g5plus_meta_box_post_format_"]').hide();
            $('#g5plus_meta_box_post_format_' + $post_format).show();
        },

        requiredToggle: function($this, required, toggle) {
            var isInputOk = true;
            if (typeof (required[0]) == 'object') {
                for (var i = 0; i < required.length; i++) {
                    var required_AND = required[i];
                    if (typeof (required_AND[0]) == 'object') {
                        var isOR = false;

                        for (var j = 0; j < required_AND.length; j++) {
                            var required_OR = required_AND[j];
                            isOR = AdminAPP.requiredFieldProcess(required_OR);
                            if (isOR) {
                                break;
                            }
                        }
                        isInputOk = isOR;
                    }
                    else {
                        isInputOk = AdminAPP.requiredFieldProcess(required_AND);
                    }
                    if (!isInputOk) {
                        break;
                    }
                }
            }
            else {
                isInputOk = AdminAPP.requiredFieldProcess(required);
            }
            if (isInputOk) {
                if (toggle) {
                    $this.slideDown();
                }
                else {
                    $this.show();
                }

            }
            else {
                if (toggle) {
                    $this.slideUp();
                }
                else {
                    $this.hide();
                }
            }
        },
        requiredFieldProcess: function(required) {
            var data_ref = required[0];
            var data_op  = required[1];
            var data_val = required[2];
            var val = AdminAPP.get_input_val($('#' + data_ref));
            if (typeof (data_val) == "object") {
                if (((data_op == '=') && (data_val.indexOf(val) != -1)) || ((data_op == '<>') && (data_val.indexOf(val) == -1))) {
                    return true;
                }
                return false;
            }
            if (data_op.substr(0, 1) == '&') {
                data_val = AdminAPP.get_input_val($('#' + data_val));
                data_op = data_op.substr(1);
            }

            if (((data_op == '=') && (data_val == val)) || ((data_op == '<>') && (data_val != val))) {
                return true;
            }
            return false;
        },
        required_field: function() {
            var arrInput = [];

            $('[data-required]').each(function () {
                var $this = $(this);
                var required = JSON.parse($this.attr('data-required'));
                if (typeof (required[0]) == 'object') {
                    for (var i = 0; i < required.length; i++) {
                        var arrFieldChild = required[i];
                        if (typeof (arrFieldChild[0]) == 'object') {
                            for (var j = 0; j < arrFieldChild.length; j++) {
                                arrInput[arrFieldChild[j][0]] = true;
                                if (arrFieldChild[j][1].substr(0, 1) == '&') {
                                    arrInput[arrFieldChild[j][2]] = true;
                                }
                            }
                        }
                        else {
                            arrInput[arrFieldChild[0]] = true;
                            if (arrFieldChild[1].substr(0, 1) == '&') {
                                arrInput[arrFieldChild[2]] = true;
                            }
                        }
                    }
                }
                else {
                    arrInput[required[0]] = true;
                    if (required[1].substr(0, 1) == '&') {
                        arrInput[required[2]] = true;
                    }
                }

                AdminAPP.requiredToggle($this, required, false);
            });

            for (var input in arrInput) {
                $('#' + input).change(function() {
                    var $this = $(this);

                    $('[data-required]').each(function () {
                        var $thisRequired = $(this);
                        var required = JSON.parse($thisRequired.attr('data-required'));
                        var reqInputs = AdminAPP.requiredGetApplyFiled(required);
                        var thisInput = $this.attr('id');
                        if (reqInputs.indexOf(thisInput) == -1) {
                            return;
                        }
                        AdminAPP.requiredToggle($thisRequired, required, true);
                    });
                });
            }
        },
        widget_select2: function(event, widget) {
            if (typeof (widget) == "undefined") {
                $('#widgets-right select.widget-select2:not(.select2-ready)').each(function(){
                    AdminAPP.widget_select2_item(this);
                });
            }
            else {
                $('select.widget-select2:not(.select2-ready)', widget).each(function(){
                    AdminAPP.widget_select2_item(this);
                });
            }
        },
        widget_select2_item: function(target){
            $(target).addClass('select2-ready');
            $(target).select2({width : '100%'});
            var $multiple = $(target).attr('multiple');
            if (typeof($multiple) != 'undefined') {
                var data_value = $(target).attr('data-value').split(',');
                for (var i = 0; i < data_value.length; i++) {
                    var $element = $(target).find('option[value="'+ data_value[i] +'"]');
                    $element.detach();
                    $(target).append($element);
                }
                $(target).val(data_value).trigger('change');
                $(target).on('select2:selecting',function(e){
                    var ids = $('input',$(this).parent()).val();
                    if (ids != "") {
                        ids +=",";
                    }
                    ids += e.params.args.data.id;
                    $('input',$(this).parent()).val(ids);
                }).on('select2:unselecting',function(e){
                    var ids = $('input',$(this).parent()).val();
                    var arr_ids = ids.split(",");
                    var newIds = "";
                    for(var i = 0 ; i < arr_ids.length; i++) {
                        if (arr_ids[i] != e.params.args.data.id){
                            if (newIds != "") {
                                newIds +=",";
                            }
                            newIds += arr_ids[i];
                        }
                    }
                    $('input',$(this).parent()).val(newIds);
                }).on('select2:select',function(e){
                    var element = e.params.data.element;
                    var $element = $(element);

                    $element.detach();
                    $(this).append($element);
                    $(this).trigger("change");
                });
            }
        },
        widget_select2_process: function() {
            $(document).on('widget-added', AdminAPP.widget_select2);
            $(document).on('widget-updated', AdminAPP.widget_select2);
            AdminAPP.widget_select2();
        }
    };
    $(document).ready(function(){
        AdminAPP.initialize();
    });
})(jQuery);