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
        <input type="hidden" name="id" value="<?php echo ($info["ID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th width="100px"><i class="required"></i>用户组名称</th>
                <td>
                    <input class="form-control" name="DutyName" value="<?php echo ($info["DutyName"]); ?>">
                </td>
            </tr>
            <tr>
                <th>状态</th>
                <td>
                    <input type="radio" name="Status" value="1" checked />正常
                    <input type="radio" name="Status" value="0" <?php if($info['Status'] == 0): ?>checked<?php endif; ?> />禁用
                </td>
            </tr>
            <tr>
                <th>描述信息</th>
                <td>
                    <textarea rows="9" id="Description"  class="form-control form-control-xxl"><?php echo ($info["Description"]); ?></textarea>
                </td>
            </tr>
        </table>
    </form>
    <div class="dialog-button-container">
        <div id="dlg-buttons" class="dialog-button">
            <input type="hidden" id="type" value="<?php echo ($type); ?>">
            <a href="javascript:doSubmit()" class="easyui-linkbutton c6" iconcls="icon-ok" style="width: 90px">提交</a>
            <a href="javascript:top.closeModal()" class="easyui-linkbutton" iconcls="icon-cancel" style="width: 90px">取消</a>
        </div>
    </div>


    <script type="text/javascript">
        var form_validate = $("#form-main").validate(
                {
                    rules: {
                        DutyName:{  required: true, },
                    }
                    , messages: {
                    //name:'活动名称不能为空',
                    //intro:'活动简介不能为空'
                }
                });
        //提交表单
        function doSubmit() {
            //前台验证
            var form_data = $("#form-main").serializeArray();
            form_data.push({name:"Description",value:$("#Description").val()});
            if (form_validate.form()) {
                $.post("<?php echo ($self); ?>", form_data, function (data) {
                    show_alert(data.info);
                    if (data.status == 1) {
                        top.closeModal();
                    }
                }, 'json');
            }
        }
    </script>

<script type="text/javascript">

</script>
</body>
</html>