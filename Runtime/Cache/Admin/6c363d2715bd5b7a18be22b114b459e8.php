<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>果园电商CRM后台系统</title>
    <meta name="keywords"/>
    <meta name="description"/>
    <link rel="stylesheet" href='/public/Admin/css/rester.css' />
    <link rel="stylesheet" href='/public/Static/Superfish/superfish.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/default/easyui.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/icon.css' />
    <link rel="stylesheet" href='/public/Admin/css/style.css' />
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/jquery.easyui.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/locale/easyui-lang-zh_CN.js'></script>
    <script type="text/javascript" src='/public/Static/Superfish/jquery.superfish.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.guoyuan.js?16' id="guoyuan_script"></script>
    <script type="text/javascript" src='/public/Static/jquery.validate.min.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.validate_cn.js'></script>
</head>
<body class="<?php echo ($body_css); ?>">
<div class="panel-header-container <?php echo ($crumbs_hide); ?>">
    <div class="panel-header breadcrumb">
        <a class="fr" href="javascript:top.showHelp('')">
            <i class="icon icon-help"></i>
        </a>
        当前位置：<a href=""><span class="text">系统</span></a><span class="splitter"> > </span><a><span class="text"><?php echo ($crumbs_title); ?></span></a>
    </div>
</div>


    <div class="panel-dashboard-container">
        <div class="panel-dashboard" id="panel-dashboard">
            <div class="column-1" style="width: 32%">

            </div>
            <div class="column-2" style="width: 35%">

            </div>
            <div class="column-3" style="width: 32%">

            </div>
        </div>
    </div>
    <script type="text/javascript" src='/public/Static/EasyUI/jquery.portal.js'></script>
    <script type="text/javascript">

        //定义所有的小工具
        var panels = [
            {
                id: 'p1', title: '销售走势图', height: 430, href: '/index.php/Admin/Portal/SalesTrends', tools: [{
                iconCls: 'icon-refresh',
                handler: function () {
                    $('#p1').panel('refresh');
                }
            }]
            },
            {
                id: 'p2', title: '最近订单', height: 250, href: '/index.php/Admin/Portal/OrderRecent', tools: [{
                iconCls: 'icon-refresh',
                handler: function () {
                    $('#p2').panel('refresh');
                }
            }]
            },
            {
                id: 'p3', title: '桌面导航', href: '/index.php/Admin/Portal/QuickLink', tools: [{
                iconCls: 'icon-edit',
                handler: function () { doSetQuickLink(); }
            }]
            },
            { id: 'p4', title: '订单分析', href: '/index.php/Admin/Portal/MapFull', height: 330 , tools: [{
                iconCls: 'icon-full',
                handler: function () { window.open('/index.php/Admin/Portal/MapFull'); }
            }, {
                iconCls: 'icon-refresh',
                handler: function () {
                    $('#p4').panel('refresh');
                }
            }]
            },
            {
                id: 'p5', title: '销售排行', height: 430, href: '/index.php/Admin/Portal/SaleRank', tools: [{
                iconCls: 'icon-refresh',
                handler: function () {
                    $('#p5').panel('refresh');
                }
            }]
            }
        ];

        //获取cookie
        function getCookie(name){
            var cookies = document.cookie.split(';');
            if (!cookies.length) return '';
            for(var i=0; i<cookies.length; i++){
                var pair = cookies[i].split('=');
                if ($.trim(pair[0]) == name){
                    return $.trim(pair[1]);
                }
            }
            return '';
        }

        //
        function getPanelOptions(id){
            for(var i=0; i<panels.length; i++){
                if (panels[i].id == id){
                    return panels[i];
                }
            }
            return undefined;
        }

        //获取小工具状态
        function getPortalState(){
            var aa = [];
            for(var columnIndex=0; columnIndex<3; columnIndex++){
                var cc = [];
                var panels = $('#panel-dashboard').portal('getPanels', columnIndex);
                for(var i=0; i<panels.length; i++){
                    cc.push(panels[i].attr('id'));
                }
                aa.push(cc.join(','));
            }
            return aa.join(':');
        }

        //添加一个Panel
        function addPanels(portalState){
            var columns = portalState.split(':');
            for(var columnIndex=0; columnIndex<columns.length; columnIndex++){
                var cc = columns[columnIndex].split(',');
                for(var j=0; j<cc.length; j++){
                    var options = getPanelOptions(cc[j]);
                    if (options){
                        var p = $('<div/>').attr('id',options.id).appendTo('body');
                        p.panel(options);
                        $('#panel-dashboard').portal('add',{
                            panel:p,
                            columnIndex:columnIndex
                        });
                    }
                }
            }

        }

        $(function(){
            $('#panel-dashboard').portal({
                onStateChange:function(){
                    var state = getPortalState();
                    var date = new Date();
                    date.setTime(date.getTime() + 24*3600*1000);
                    document.cookie = 'portal-state='+state+';expires='+date.toGMTString();
                }
            });
            var state = getCookie('portal-state');
            if (!state){
                state = 'p1,p2:p3,p4:p5,p6';    // the default portal state
            }
            addPanels(state);
            $('#panel-dashboard').portal('resize');

            //当窗口大小改变时重新设置portal大小
            $(window).resize(function(){
                $('#panel-dashboard').portal('resize');
            });

            ////用于测试任务
            //var processId = Date.parse(new Date());//时间戳作为任务ID
            //$.post("/Home/DemoTask" ,
            //    {
            //        processId: processId
            //    }
            //    , function (data) {

            //    });

            ////临时测试
            //var loading = new top.showLoading(processId);
        });
    </script>


<script type="text/javascript">

</script>
</body>
</html>