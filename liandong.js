/*果园自定义级联下拉插件*/
(function ($) {
    $.fn.cascade = function (option) {
        option = $.extend({ onChange: null, selectBy: 'value', url: '', rootParentValue: "1", emptyDeep: 100 }, option);
        $(this).each(function (i) {
            var container = $(this);
            var base_url = option.url;
            $(container).on("change", "select", function () {
                var parentSelect = $(this);
                if (typeof option.onChange == "function") {
                    //获取到当前选择的所有数据
                    var array_text = [];
                    var array_value = [];
                    $("select", container).each(function (i) {
                        array_text.push($("option:selected", this).text());
                        array_value.push($(this).val());
                    });
                    option.onChange(array_value, array_text);
                }
                if (!parentSelect.val()) {
                    $("select:gt(" + parentSelect.index() + ")", container).remove();//删除多余的
                    return;
                }
                $.getJSON(base_url + parentSelect.val(), function (data_list) {
                    if (data_list.length <= 0) {
                        $("select:gt(" + parentSelect.index() + ")", container).remove();//删除多余的
                        return;
                    }
                    var currentSelect = $($("select", container).get(parentSelect.index() + 1));
                    if (currentSelect.size() <= 0) {
                        container.append(" ");
                        currentSelect = $("<select></select>").appendTo(container);
                    }
                    currentSelect.empty();

                    if (currentSelect.index() >= option.emptyDeep) {
                        currentSelect.append("<option></option>");
                    }
                    $.each(data_list, function (i, data) {
                        var html_option = "";
                        var current_select = currentSelect.data("select");
                        var data_text = data.Text;
                        if (current_select && current_select.length > 2) {
                            current_select = current_select.substr(0, 2);
                        }
                        if (data_text && data_text.length > 2) {
                            data_text = data_text.substr(0, 2);
                        }
                        if (option.selectBy == "text" && current_select == data_text
                        || option.selectBy == "value" && data.Value == currentSelect.data("select")
                        ) {
                            html_option = "<option value=\"" + data.Value + "\" selected='selected'>" + data.Text + "</option>";
                        }
                        else {
                            html_option = "<option value=\"" + data.Value + "\">" + data.Text + "</option>";
                        }
                        currentSelect.append(html_option);
                    });
                    currentSelect.change();
                });
            });
            //获取并设置第一个下拉框
            $.getJSON(base_url + option.rootParentValue, function (data_list) {
                var sender_select = $("select:eq(0)", container);//触发第一个下拉框
                sender_select.empty();
                if (option.emptyDeep <= 0) {
                    sender_select.append("<option></option>");
                }
                $.each(data_list, function (i, data) {
                    var html_option = "";
                    var current_select = sender_select.data("select");
                    var data_text = data.Text;
                    if (current_select && current_select.length > 2) {
                        current_select = current_select.substr(0, 2);
                    }
                    if (data_text && data_text.length > 2) {
                        data_text = data_text.substr(0, 2);
                    }
                    if (option.selectBy == "text" && current_select == data_text
                        || option.selectBy == "value" && data.Value == sender_select.data("select")
                    ) {
                        html_option = "<option value=\"" + data.Value + "\" selected='selected'>" + data.Text + "</option>";
                    }
                    else {
                        html_option = "<option value=\"" + data.Value + "\">" + data.Text + "</option>";
                    }
                    sender_select.append(html_option);
                });
                sender_select.change();
            });
        });
    };
})(jQuery);