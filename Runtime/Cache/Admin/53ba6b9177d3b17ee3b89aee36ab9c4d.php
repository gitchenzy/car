<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>果园电商CRM后台系统</title>
    <meta name="keywords"/>
    <meta name="description"/>
    <link rel="stylesheet" href='/public/Admin/css/rester.css' />
    <link rel="stylesheet" href='/public/Admin/css/style.css' />
    <link rel="stylesheet" href='/public/Static/Superfish/superfish.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/default/easyui.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/icon.css' />
    <link rel="stylesheet" href='/public/Admin/css/style.css' />
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/jquery.easyui.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/locale/easyui-lang-zh_CN.js'></script>
    <script type="text/javascript" src='/public/Static/Superfish/jquery.superfish.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.guoyuan.js' id="guoyuan_script"></script>
</head>

<body class="easyui-layout gy-layout">
<!--头部以及主菜单-->
<div data-options="region:'north',border:false" class="page-header" style="height:80px;">
    <div class="sf-menu-container">
        <ul class="sf-menu" id="example">
            
            <li>
                <a href="javascript:;">客户管理</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/" data-url-type="1">客户信息</a></li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Market/contract" data-url-type="1">合同信息</a> </li>

                    <li>
                        <a href="javascript:;" class="menu-item" data-url="" data-url-type="1">基本信息</a>
                        <ul>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/payType" data-url-type="1">支付方式</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Market/contractType" data-url-type="1">合同类型</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/customerstatus" data-url-type="1">客户状态</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/customerRank" data-url-type="1">客户等级</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/customerRole" data-url-type="1">角色关系</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/customerClose" data-url-type="1">亲密程度</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/demandState" data-url-type="1">问题状态</a></li>
                            <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/demandPriority" data-url-type="1">问题优先级</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Customer/demand" data-url-type="1">客户问题需求</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">实施信息</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Maintain/index" data-url-type="1">实施记录</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">财务信息</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/OrderInfo/index" data-url-type="1">财务记录</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">市场信息</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Market/index" data-url-type="1">市场记录</a> </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;">代理信息</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Agent/index" data-url-type="1">代理管理</a> </li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Agent/agentRule" data-url-type="1">代理规则</a> </li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Agent/agentRate" data-url-type="1">代理返点</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">产品管理</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Product/index" data-url-type="1">产品信息</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">员工管理</a>
                <ul>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Employee/index" data-url-type="1">员工信息</a> </li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Employee/department" data-url-type="1">部门信息</a> </li>
                    <li><a href="javascript:;" class="menu-item" data-url="/admin/Employee/userGroup" data-url-type="1">用户组管理</a> </li>
                </ul>
            </li>

            <?php if(is_array($AuthorityInfo)): $i = 0; $__LIST__ = $AuthorityInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><li>
                    <a href="javascript:;"><?php echo ($o["ModuleName"]); ?></a>
                        <?php if(count($o[children]) > 0): ?><ul>
                            <?php foreach($o['children'] as $oc){ ?>
                            <li>
                                <a href="javascript:;" class="menu-item" data-url="<?php echo ($oc[OpenUrl]); ?>" data-mid="<?php echo ($oc[ModuleID]); ?>" data-url-type="1"><?php echo ($oc["ModuleName"]); ?></a>
                                <?php if(count($oc[children]) > 0): ?><ul>
                                        <?php foreach($oc['children'] as $od){ ?>
                                        <li  data-options="">
                                            <a href="javascript:;" class="menu-item" data-url="<?php echo ($od[OpenUrl]); ?>" data-mid="<?php echo ($od[ModuleID]); ?>"  data-url-type="1"><?php echo ($od["ModuleName"]); ?></a>
                                            <?php if(count($od[children]) > 0): ?><ul>
                                                    <?php foreach($od['children'] as $oe){ ?>
                                                    <li data-options="">
                                                        <a href="javascript:;" class="menu-item" data-url="<?php echo ($oe[OpenUrl]); ?>" data-mid="<?php echo ($oe[ModuleID]); ?>" data-url-type="1"><?php echo ($oe["ModuleName"]); ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul><?php endif; ?>
                                        </li>
                                        <?php } ?>
                                    </ul><?php endif; ?>
                            </li>
                            <?php } ?>
                            </ul><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <a class="logo" href="/" title="果园电商云服务平台" target="_blank">
        <img src="/logo.png" />
    </a>
    <div class="user_login">
        <span><?php echo ($user["EmployeeNum"]); ?>&nbsp∨</span><br />
        <input type="hidden" id="UserGroup" value="<?php echo ($UserGroup); ?>">
        <div  class="ddd">
            <ul>
                <li onclick="quit()">退出系统</li>
                <li onclick="modifyPwd()">修改密码</li>
            </ul>
        </div>
    </div>
</div>

<!--主区域-->
<div data-options="region:'center',title:''">

    <!--tab container-->
    <div id="main-tab" class="easyui-tabs" data-options="tools:'#main-tab-tools',plain:true,fit:true" style="">

    </div>

    <!--tab helper-->
    <div id="main-tab-tools">
        <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-remove'" title="全部关闭" onclick="link_close_all()"></a>
    </div>

</div>


<div id="mm" class="easyui-menu" style="width:120px;">
    <div onclick="link_close_current()">关闭当前</div>
    <div class="menu-sep"></div>
    <div onclick="link_refresh_current()">刷新页面</div>
    <div class="menu-sep"></div>
    <div onclick="link_close_all()">关闭全部</div>
    <div onclick="link_close_right()">关闭右侧</div>
    <div onclick="link_close_left()">关闭左侧</div>
</div>
<script type="text/javascript">

    var root_path = '/admin/';
    var content_target;
    $(function() {

        //桌面
        addTab(root_path + "index/dash", "我的桌面",0, {closable: false, iconCls: 'icon-home'});

        // initialise plugin
        var example = $('#example').superfish({
            delay: 0,
            speed: 50,
            speedOut: 50
        });

        $("#main-tab .tabs").bind('contextmenu', function (e) {
            e.preventDefault();
            content_target = $($(e.target).parents("li").get(0));//获取当前被点击的对象
            if (content_target) {
                $('#mm').menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            }
            /*$('#mm').menu('show', {
             left: e.pageX,
             top: e.pageY
             });*/
        });
    });

    ///关闭当前tab
    function link_close_current() {
        if (content_target && content_target.index() > 0) {
            $('#main-tab').tabs("close", content_target.index());
        }
    }

    ///刷新当前页面
    function link_refresh_current() {
        if (content_target && content_target.index() >= 0) {
            var tab = $('#main-tab').tabs("getTab", content_target.index());
            $("iframe", tab).get(0).contentWindow.location.reload();
        }
    }

    //删除所有tab
    function link_close_all() {
        var all_tabs = $('#main-tab').tabs("tabs");
        if (all_tabs.length > 1 && confirm("是否确定关闭所有页面？")) {
            for (var i = all_tabs.length - 1 ; i > 0; i--) {
                $('#main-tab').tabs("close", i);
            }
        }
    }

    //关闭右侧
    function link_close_right() {
        if (content_target && content_target.index() >= 0) {
            $('#main-tab').tabs("tabs", content_target.index());
            var all_tabs = $('#main-tab').tabs("tabs");
            var current_index = content_target.index();
            for (var i = all_tabs.length - 1 ; i > current_index; i--) {
                $('#main-tab').tabs("close", i);
            }
        }
    }

    //关闭左侧
    function link_close_left() {
        if (content_target && content_target.index() > 0) {
            $('#main-tab').tabs("tabs", content_target.index());
            var all_tabs = $('#main-tab').tabs("tabs");
            var current_index = content_target.index();
            for (var i = current_index - 1 ; i > 0; i--) {
                $('#main-tab').tabs("close", i);
            }
        }
    }
    ///右上角的站内信闪动按钮
    var le_i=0;
    window.setInterval(function () {
        le_i++;
        var obj = $('#index-letter');
        var color1 = '#F25D03';
        var color2 = '#FF9400';
        var background = obj.css('background-color');

        //如果未读信息少于1，就不闪动了
        if (parseInt(obj.html()) < 1) {
            $('.div-letter').css("display", "none");
            return;
        }
        else {
            $('.div-letter').css("display", "block");
            if (le_i % 2 == 0) {
                obj.css('background-color', color1);
            }
            else {
                obj.css('background-color', color2);
            }

        }


    }, 500);
    //右上角的信息，隔指定时间检查是否有消息
    var oo = $('#index-letter');
    var time = parseInt(oo.attr('date-time')) * 1000;

    //鼠标经过用户名
    $('.user_login span').hover(function () {
        $('.user_login div').show();
    }, function () {

        $('.user_login div').hide();
    });
    //鼠标经过用户名
    $('.user_login div').hover(function () {
        $('.user_login div').show();
    }, function () {

        $('.user_login div').hide();
    });
    function quit() {
        $.get('/admin/Account/logout', function () {
            location.replace('/admin/account/login');
        });
    }
    function modifyPwd(){
        top.showModal(
                '/admin/Employee/modifyPwd',
                '设置密码' ,
                {
                    width: 500,
                    height: 200, //窗口高度
                    callBack: function () {
                        //窗口关闭回调函数中重新加载列表
                        $("#tg_main").datagrid("reload");
                    }
                }
        );
    }
    //修改密码，打开模态框。模态框关闭时在回调函数中重新加载列表
    function btnPassword_Click() {
        top.showModal(
                '/Account/CheckPassWordAuth', //使用C#生成url
                '修改密码', //调用语言来设置标题
                {
                    height: 380, //窗口高度
                    width: 500,
                    callBack: function () {
                        //窗口关闭回调函数中重新加载列表
                        $("#tg_main").datagrid("reload");
                    }
                }
        );
    }
    //个人资料
    //编辑按钮点击，打开模态框。模态框关闭时在回调函数中重新加载列表
    function btnEmp_Click(row_id) {

        top.showModal(
                '/Home/Edit',
                '我的资料', //调用语言来设置标题
                {
                    height: 480, //窗口高度
                    width: 800,
                    callBack: function () {
                        //窗口关闭回调函数中重新加载列表
                        $("#tg_main").datagrid("reload");
                    }
                }
        );

    }
    $(function () {
        $(".sf-menu .menu-item").click(function () {
            var data = $(this);
            //根据url类型打开url
            switch (data.data('url-type')) {
                case 1:
                    //打开tab
                    if (data.data('url')) {
                        addTab(data.data('url'), data.text(), data.data('mid'));
                    }
                    break;
            }
        });
    });

    function showMenu(title) {
        if ($(".layout-panel-west").css("display") == "none") {
            $("body").layout("expand", 'west');
        }
        $("#layout-west>div").accordion("select" , title);
    }

    var modal_stack = Array();

    //打开模态框
    function showModal(url , title , option) {
        option = $.extend({ title: title, width: 600, height: 450, url: url }, option);
        var max_height = $(window).height() - 40;
        var max_width = $(window).width() - 40;
        if (option.width > max_width) {
            option.width = max_width;
        }
        if (option.height > max_height) {
            option.height = max_height;
        }
        var html = "<div class=\"easyui-dialog easyui-dialog-guoyuan\" title=\"" + option.title + "\" style=\"width:" + option.width + "px;height:" + option.height + "px;\" data-options=\"iconCls:'icon-save',resizable:true,modal:true\">"
                + "<iframe width='100%' height='100%' frameborder='0' allowtransparency='true'></iframe>"
                + "</div>";
        var dia = $(html).dialog({
            closed: false,
            cache: false,
            modal: true,
            onClose: function () {
                if (typeof  option.callBack == "function") {
                    option.callBack();
                }
                //尽量降低页面加载的html。 这里在modal关闭后把相关html一并删除
                var dialog_container = dia.parent();
                dialog_container.next(".window-shadow").remove();
                dialog_container.next(".window-mask").remove();
                dialog_container.remove();
                modal_stack.pop(); //取出最后进入堆栈的数据
            }
        });
        $("iframe", dia).attr("src" , option.url);
        modal_stack.push(dia);
    }

    //post方式打开模态框
    function postModal(url, title, data, option) {
        option = $.extend({ title: title, width: 600, height: 450, url: url }, option);
        var frame_id = "iframe_" + Date.parse(new Date());
        var html = "<div class=\"easyui-dialog easyui-dialog-guoyuan\" title=\"" + option.title + "\" style=\"width:" + option.width + "px;height:" + option.height + "px;\" data-options=\"iconCls:'icon-save',resizable:true,modal:true\">"
                + "<iframe width='100%' height='100%' frameborder='0' allowtransparency='true' name='" + frame_id + "' id='" + frame_id + "'></iframe>"
                + "</div>";
        html_form = "<form name='form-modal-temp' id='form-modal-temp' method='post' action='" + url + "' target='" + frame_id + "'>";
        for (var perpertyName in data) {
            html_form += "<input type='hidden' name='" + perpertyName + "' value=\"" + data[perpertyName] + "\"/>";
        }
        html_form += "</form>";
        var dia = $(html).dialog({
            closed: false,
            cache: false,
            modal: true,
            onClose: function () {
                if (typeof option.callBack == "function") {
                    option.callBack();
                }
                //尽量降低页面加载的html。 这里在modal关闭后把相关html一并删除
                var dialog_container = dia.parent();
                dialog_container.next(".window-shadow").remove();
                dialog_container.next(".window-mask").remove();
                dialog_container.remove();
                modal_stack.pop(); //取出最后进入堆栈的数据
            }
        });
        modal_stack.push(dia);
        //开始POST
        var form = $(html_form).appendTo("body");
        form.submit();
        form.remove();
    }

    //关闭
    function closeModal() {
        var dia = modal_stack[modal_stack.length - 1]; //取出最后进入堆栈的数据
        dia.dialog('close');
    }

    //打开tab
    function addTab(url , title , mid , option) {
        if ($('#main-tab').tabs('exists',title)) {
            $('#main-tab').tabs('select', title);
        }
        else {
            var option = $.extend({ title : "" , closable: true} , option);
            var gid = $("#UserGroup").val();
            $('#main-tab').tabs('add', {
                title: title,
                content: '<div class="auto" data-options="fit:true" style="height:100%; overflow: hidden"><iframe name="test" width="100%" height="100%" frameborder="0" allowtransparency="true" src="' + url + '" ></iframe></div>',
                closable:  option.closable,
                iconCls : option.iconCls
            });
        }
        $('#example').superfish("hide");
    }

    //关闭tab
    function closeTab(title) {
        $('#main-tab').tabs("close", title);
    }

    //打开一个进度条，并返回Dom
    function showLoading(processID, option) {
        var option = $.extend({ title: "进度", closable: true, freq: 1000, skip_max: 10 }, option);
        var loading = $("<div class='process-loading'><div class='process'></div><div class='title'></div></div>").appendTo("body");
        var window_loading = $(loading).window({
            width: 400,
            height: 100,
            modal: true,
            collapsible: false,
            minimizable: false,
            maximizable: false,
            resizable: false,
            closable: option.closable,
            title: option.title,
            onClose: function () {
                if (typeof option.callBack == "function") {
                    option.callBack();
                }
            }
        });
        $(".process", loading).progressbar({
            value: 0
        });
        this.changeProcess = function (process , text) {
            $(".process", window_loading).progressbar({
                value: process
            });
            $(".title", window_loading).html(text);
        };
        this.close = function () {
            window_loading.window("close");
        }
        if (processID) {
            var sender = this;
            var skip_count = 0;
            var skip_count_temp = 0;
            var handler = window.setInterval(function () {
                if (skip_count_temp++ < skip_count || skip_count > option.skip_max) {
                    return;
                }
                skip_count++;
                skip_count_temp = 0;
                $.post("/Home/GetProcessStatus", { processID : processID , time :  Date.parse(new Date())} , function(data){
                    if (data) {
                        sender.changeProcess(data.CurrentProcess, data.Message);
                        if (data.CurrentProcess >= 100) {
                            //当前进度已完成，则停止并关闭
                            window.clearInterval(handler);
                            //sender.close();
                        }
                    }
                }, 'json');
            }, option.freq);
        }
        //
    }
</script>
</body>
</html>