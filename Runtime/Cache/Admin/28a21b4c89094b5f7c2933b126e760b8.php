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


    <form class="form-main" id="form-main" action="">
        <input type="hidden" name="id" value="<?php echo ($info["FeedbackID"]); ?>">
        <table class="form-table" border="0">
            <tr>
                <th>问题类型</th>
                <td>
                    <?php echo ($info["type"]); ?>
                </td>

            </tr>

            <tr>
                <th>客户</th>
                <td>
                    <?php echo ($info["customerName"]); ?>
                </td>

            </tr>

            <tr>
                <th>问题标题</th>
                <td>
                    <?php echo ($info["Title"]); ?>
                </td>

            </tr>
            <tr>
                <th>问题描述</th>
                <td>
                    <?php echo ($info["Description"]); ?>
                </td>

            </tr>
            <tr>
                <th>优先级别</th>
                <td>
                    <?php echo ($info["FbPriorityName"]); ?>
                </td>
            </tr>
            <tr>
                <th>问题备注</th>
                <td>
                    <?php echo ($info["Note"]); ?>
                </td>
            </tr>
            <tr>
                <th>解决状态</th>
                <td>
                    <select name="FbStatusID" class="form-control">
                        <?php if(is_array($tInfo)): $i = 0; $__LIST__ = $tInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><option value="<?php echo ($t["FbStatusID"]); ?>">
                            <?php echo ($t["FbStatusName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>计划解决时间</th>
                <td>
                    <input class="form-control form-control-datetime" name="PlanTime" style="width:240px;">
                </td>
            </tr>
        </table>
    </form>
    <div class="dialog-button-container">
        <div id="dlg-buttons" class="dialog-button">
            <a href="javascript:doSubmit()" class="easyui-linkbutton c6" iconcls="icon-ok" style="width: 90px">领取</a>
            <a href="javascript:top.closeModal()" class="easyui-linkbutton" iconcls="icon-cancel" style="width: 90px">取消</a>
        </div>
    </div>


    <script type="text/javascript" src='/public/Static/My97DatePicker/WdatePicker.js'></script>
<script>
    var form_validate = $("#form-main").validate(
            {
                rules: {
                    Sort: { digits: true },
                    Content: { required: true},
                }
                , messages: {
                //name:'活动名称不能为空',
                //intro:'活动简介不能为空'
                Sort:'输入整数'
                }
            });
    //提交表单
    function doSubmit() {
        var form_data = $("#form-main").serializeArray();
        //form_data.push({name:"Remark",value:$("#ReMark").val()});
        //前台验证
        if (form_validate.form()) {
            $.post("<?php echo ($self); ?>", form_data, function (data) {
                show_alert(data.info);
                if (data.status == 1) {
                    top.closeModal();
                }
            }, 'json');
        }
    };
</script>

<script type="text/javascript">

</script>
</body>
</html>