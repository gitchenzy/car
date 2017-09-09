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
        <input type="hidden" name="id" value="<?php echo ($info["EmployeeID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th width="100px"><i class="required"></i>姓名</th>
                <td width="210px">
                    <input class="form-control" name="Name" value="<?php echo ($info["Name"]); ?>" style="width:120px;">
                </td>
                <th>性别</th>
                <td>
                    <label><input  name="Sex" type="radio" value="1" checked="checked" /> 男</label>
                    <label><input  name="Sex" type="radio" value="2" <?php if($info['Sex'] == 2): ?>checked="checked"<?php endif; ?> /> 女</label>

                </td>
            </tr>

            <tr>
                <th>所属部门</th>
                <td>
                    <select name="DepartmentNum" class="form-control">
                        <?php if(is_array($dr)): $i = 0; $__LIST__ = $dr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><option value="<?php echo ($r["DepartmentNum"]); ?>" <?php if($info['DepartmentNum'] == $r['DepartmentNum']): ?>selected<?php endif; ?> >
                            <?php echo ($r["DepartmentName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <th>职务</th>
                <td>
                    <input class="form-control" name="Position" value="<?php echo ($info["Position"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>手机</th>
                <td>
                    <input class="form-control" name="Mobile" value="<?php echo ($info["Mobile"]); ?>" style="width:120px;">
                </td>
                <th>是否为部门负责人 </th>
                <td>
                    <label><input  name="isPriority" type="radio" value="1" checked="checked" /> 是</label>
                    <label><input  name="isPriority" type="radio" value="2" <?php if($info['isPriority'] == 2): ?>checked="checked"<?php endif; ?> /> 否</label>
                </td>
            </tr>
            <tr>
                <th>用户组</th>
                <td>
                    <select name="DutyID" class="form-control">
                        <?php if(is_array($pr)): $i = 0; $__LIST__ = $pr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option value="<?php echo ($p["ID"]); ?>" <?php if($info['DutyID'] == $p['ID']): ?>selected<?php endif; ?> >
                            <?php echo ($p["DutyName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <th>状态</th>
                <td >
                    <label><input  name="Status" type="radio" value="0" checked="checked" /> 正常</label>
                    <label><input  name="Status" type="radio" value="1" <?php if($info['Status'] == 1): ?>checked="checked"<?php endif; ?> /> 锁定</label>

                </td>

            </tr>
            <tr>
                <th>备注</th>
                <td colspan="3">
                    <input class="form-control" name="Note" value="<?php echo ($info["Note"]); ?>" style="width:500px;">
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


<script>
    var form_validate = $("#form-main").validate(
            {
                rules: {
                    Sort: { digits: true },
                    LoginName: { required: true},
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
                    if($("#type").val()=="add")show_alert("该用户的初始密码为："+data.url);
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