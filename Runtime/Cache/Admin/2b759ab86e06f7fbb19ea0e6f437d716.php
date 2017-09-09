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
        <input type="hidden" name="id" value="<?php echo ($info["AgentID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th width="100px"><i class="required"></i>账号</th>
                <td width="210px">
                    <input class="form-control" name="LoginName" value="<?php echo ($info["LoginName"]); ?>" style="width:120px;"<?php if(!empty($info["LoginName"])): ?>disabled='disabled'<?php endif; ?> >
                </td>
                <th>公司名称</th>
                <td>
                    <input class="form-control" name="CompanyName" value="<?php echo ($info["CompanyName"]); ?>" style="width:120px;">
                </td>
            </tr>

            <tr>
                <th>负责人</th>
                <td>
                    <input class="form-control" name="Principal" value="<?php echo ($info["Principal"]); ?>" style="width:120px;">
                </td>
                <th>联系电话</th>
                <td>
                    <input class="form-control" name="Telephone" value="<?php echo ($info["Telephone"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>手机</th>
                <td>
                    <input class="form-control" name="Mobile" value="<?php echo ($info["Mobile"]); ?>" style="width:120px;">
                </td>
                <th>邮箱</th>
                <td>
                    <input class="form-control" name="Email" value="<?php echo ($info["Email"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>微信号</th>
                <td>
                    <input class="form-control" name="Wechat" value="<?php echo ($info["Wechat"]); ?>" style="width:120px;">
                </td>
                <th>排序</th>
                <td>
                    <input class="form-control" name="Sort" value="<?php echo ($info["Sort"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>代理商要求</th>
                <td>
                    <select name="AgentRuleID" class="form-control">
                        <?php if(is_array($cus["ar"])): $i = 0; $__LIST__ = $cus["ar"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><option value="<?php echo ($o["RuleID"]); ?>" <?php if($info['AgentRuleID'] == $o['RuleID']): ?>selected<?php endif; ?> >
                            <?php echo ($o["RuleName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <th>返点类型</th>
                <td>
                    <select name="AgentRateID" class="form-control">
                        <?php if(is_array($cus["ae"])): $i = 0; $__LIST__ = $cus["ae"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><option value="<?php echo ($r["RateID"]); ?>" <?php if($info['RateID'] == $r['AgentRateID']): ?>selected<?php endif; ?> >
                            <?php echo ($r["RateName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
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