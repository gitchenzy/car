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


    <link rel="stylesheet" href="/Public/Admin/css/zTreeStyle.css" type="text/css">

    <div class="content_wrap">
        <div class="zTreeDemoBackground left">
            <ul id="treeDemo" class="ztree"></ul>
        </div>

    </div>
    <input type="hidden" id="duty" value="<?php echo ($_GET['id']); ?>">
    <div class="dialog-button-container">
        <div id="dlg-buttons" class="dialog-button">
            <a href="javascript:doSubmit()" class="easyui-linkbutton c6" iconcls="icon-ok" style="width: 90px">提交</a>
            <a href="javascript:top.closeModal()" class="easyui-linkbutton" iconcls="icon-cancel" style="width: 90px">取消</a>
        </div>
    </div>


    <script type="text/javascript" src="/Public/Admin/js/jquery.ztree.core.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.ztree.excheck.js"></script>
    <SCRIPT type="text/javascript">
        <!--
        var setting = {
            check: {
                enable: true
            },
            data: {
                simpleData: {
                    enable: true
                }
            },
            treeNodeParentKey : "id",
        };

        var zNodes =<?php echo ($res); ?>

        var code;

        function setCheck() {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            zTree.setting.check.chkboxType = { "Y" : "ps", "N" : "ps" };

        }
        function showCode(str) {
            if (!code) code = $("#code");
            code.empty();
            code.append("<li>"+str+"</li>");
        }

        $(document).ready(function(){
            $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            setCheck();
        });
        //-->
        function doSubmit(){

            var treeObj = $.fn.zTree.getZTreeObj('treeDemo');
            var ids = [];
            var nodes = treeObj.getCheckedNodes(true);
            for(var i=0;i<nodes.length;i++)
            {
                ids[i] = nodes[i].id;

            }
            var id = $('#duty').val();
            $.post("/admin/Employee/modAuthority", {'dutyID':id,'ids':ids}, function (data) {
                show_alert(data.info);
                if (data.status == 1) {
                    top.closeModal();
                }
            }, 'json');
        }
    </SCRIPT>

<script type="text/javascript">

</script>
</body>
</html>