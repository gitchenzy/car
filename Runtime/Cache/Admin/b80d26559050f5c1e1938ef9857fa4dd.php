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
        <input type="hidden" name="id" value="<?php echo ($info["CustomerID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th width="100px"><i class="required"></i>账号</th>
                <td width="210px">
                    <input class="form-control" name="LoginName" value="<?php echo ($info["LoginName"]); ?>" style="width:120px;"<?php if(!empty($info["LoginName"])): ?>disabled='disabled'<?php endif; ?> >
                </td>
                <th>网址</th>
                <td>
                    <input class="form-control" name="Website" value="<?php echo ($info["Website"]); ?>" style="width:120px;">
                </td>
            </tr>

            <tr>
                <th>简称</th>
                <td>
                    <input class="form-control" name="ShortName" value="<?php echo ($info["ShortName"]); ?>" style="width:120px;">
                </td>
                <th>全称</th>
                <td>
                    <input class="form-control" name="FullName" value="<?php echo ($info["FullName"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>微信号</th>
                <td>
                    <input class="form-control" name="WeChat" value="<?php echo ($info["WeChat"]); ?>" style="width:120px;">
                </td>
                <th>客户来源</th>
                <td>
                    <label><input  name="Sources" type="radio" value="1" checked="checked" /> 直营</label>
                    <label><input  name="Sources" type="radio" value="2" <?php if($info['Sources'] == 2): ?>checked="checked"<?php endif; ?> /> 代理</label>
                </td>
            </tr>
            <tr>
                <th>联系人角色</th>
                <td>
                    <select name="CtmRoleID" class="form-control">
                        <?php if(is_array($cus["cr"])): $i = 0; $__LIST__ = $cus["cr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><option value="<?php echo ($r["CtmRoleID"]); ?>" <?php if($info['CtmRoleID'] == $r['CtmRoleID']): ?>selected<?php endif; ?> >
                            <?php echo ($r["CtmRoleName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

                <th>亲密程度</th>
                <td>
                    <select name="CtmCloseID" class="form-control">
                        <?php if(is_array($cus["co"])): $i = 0; $__LIST__ = $cus["co"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><option value="<?php echo ($o["CtmCloseID"]); ?>" <?php if($info['CtmCloseID'] == $o['CtmCloseID']): ?>selected<?php endif; ?> >
                            <?php echo ($o["CtmCloseName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>客户状态</th>
                <td>

                    <select name="CtmStatusID" class="form-control">
                        <?php if(is_array($cus["cs"])): $i = 0; $__LIST__ = $cus["cs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><option value="<?php echo ($s["CtmStatusID"]); ?>" <?php if($info['CtmStatusID'] == $s['CtmStatusID']): ?>selected<?php endif; ?> >
                            <?php echo ($s["CtmStatusName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <th>客户等级</th>
                <td>
                    <select name="CtmRankID" class="form-control">
                        <?php if(is_array($cus["ck"])): $i = 0; $__LIST__ = $cus["ck"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><option value="<?php echo ($k["CtmRankID"]); ?>" <?php if($info['CtmRankID'] == $k['CtmRankID']): ?>selected<?php endif; ?> >
                            <?php echo ($k["CtmRankName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>联系人</th>
                <td>
                    <input class="form-control" name="Contacter" value="<?php echo ($info["Contacter"]); ?>" style="width:120px;">
                </td>
                <th>邮箱</th>
                <td>
                    <input class="form-control" name="Email" value="<?php echo ($info["Email"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>手机</th>
                <td>
                    <input class="form-control" name="Mobile" value="<?php echo ($info["Mobile"]); ?>" style="width:120px;">
                </td>
                <th>联系电话</th>
                <td>
                    <input class="form-control" name="Telephone" value="<?php echo ($info["Telephone"]); ?>" style="width:120px;">
                </td>
            </tr>

            <tr>
                <th>排序</th>
                <td>
                    <input class="form-control" name="Sort" value="<?php echo ($info["Sort"]); ?>" style="width:120px;">
                </td>
                <th>账号状态</th>
                <td>
                    <label><input  name="Status" type="radio" value="0" checked="checked"<?php if($info['Status'] == 0): ?>checked="checked"<?php endif; ?> /> 正常</label>
                    <label><input  name="Status" type="radio" value="1" <?php if($info['Status'] == 1): ?>checked="checked"<?php endif; ?> /> 锁定</label>
                </td>
            </tr>
            <tr>
                <th>地址</th>
                <td colspan="3">
                    <input class="form-control" name="Address" value="<?php echo ($info["Address"]); ?>" style="width:500px;">
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