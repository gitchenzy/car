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
        <table class="form-table" border="0">
            <tr>
                <th>问题类型</th>
                <td>
                    <input type="radio" name="FBtype" checked value="1">系统新功能
                    <input type="radio" name="FBtype" value="2">系统漏洞
                </td>

            </tr>
            <?php if(empty($CustomerID)): ?><tr>
                    <th>选择客户</th>
                    <td>
                        <select name="CustomerID" class="form-control">
                            <?php if(is_array($cInfo)): $i = 0; $__LIST__ = $cInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c["CustomerID"]); ?>">
                                <?php echo ($c["FullName"]); ?>
                                </option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>

                </tr><?php endif; ?>
            <tr>
                <th>问题标题</th>
                <td>
                    <input class="form-control" name="Title" style="width:120px;">

                </td>

            </tr>
            <tr>
                <th>问题描述</th>
                <td>

                    <textarea class="form-control" name="Description"></textarea>
                </td>

            </tr>
            <tr>
                <th>优先级别</th>
                <td>
                    <select name="FbPriority" class="form-control">
                        <?php if(is_array($Priority)): $i = 0; $__LIST__ = $Priority;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><option value="<?php echo ($f["FbPriorityID"]); ?>">
                            <?php echo ($f["FbPriorityName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>问题备注</th>
                <td>
                    <input class="form-control" name="Note" style="width:240px;">
                </td>

            </tr>
        </table>
    </form>
    <div class="dialog-button-container">
        <div id="dlg-buttons" class="dialog-button">
            <a href="javascript:doSubmit()" class="easyui-linkbutton c6" iconcls="icon-ok" style="width: 90px">提交</a>
            <a href="javascript:top.closeModal()" class="easyui-linkbutton" iconcls="icon-cancel" style="width: 90px">取消</a>
        </div>
    </div>


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