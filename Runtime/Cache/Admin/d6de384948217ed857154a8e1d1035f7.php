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
        <input type="hidden" name="id" value="<?php echo ($info["ContractID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th width="100px"><i class="required"></i>客户</th>
                <td width="210px">
                    <select name="Identifier" class="form-control">
                        <?php if(is_array($cInfo)): $i = 0; $__LIST__ = $cInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c["Identifier"]); ?>" <?php if($info['Identifier'] == $c['Identifier']): ?>selected<?php endif; ?> >
                            <?php echo ($c["FullName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <th>合同类型</th>
                <td>
                    <select name="CttTypeID" class="form-control">
                        <?php if(is_array($ttInfo)): $i = 0; $__LIST__ = $ttInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><option value="<?php echo ($t["CttTypeID"]); ?>" <?php if($info['CttTypeID'] == $t['CttTypeID']): ?>selected<?php endif; ?> >
                            <?php echo ($t["CttTypeName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>合同编号</th>
                <td>
                    <input class="form-control" name="CttNumber" value="<?php echo ($info["CttNumber"]); ?>" style="width:120px;">
                </td>
                <th>购买产品</th>
                <td>
                    <select name="CttProductID" class="form-control">
                        <?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option value="<?php echo ($p["ProductID"]); ?>" <?php if($info['CttProductID'] == $p['ProductID']): ?>selected<?php endif; ?> >
                            <?php echo ($p["ProductName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>对方负责人</th>
                <td>
                    <input class="form-control" name="CtmPrincipal" value="<?php echo ($info["CtmPrincipal"]); ?>" style="width:120px;">
                </td>
                <th>我方负责人</th>
                <td>
                    <input class="form-control" name="OwnPrincipal" value="<?php echo ($info["OwnPrincipal"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>对方签约人</th>
                <td>
                    <input class="form-control" name="CtmSign" value="<?php echo ($info["CtmSign"]); ?>" style="width:120px;">

                </td>

                <th>我方签约人</th>
                <td>
                    <input class="form-control" name="OwnSign" value="<?php echo ($info["OwnSign"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>总金额</th>
                <td>
                    <input class="form-control" name="Amount" value="<?php echo ($info["Amount"]); ?>" style="width:120px;">
                </td>
                <th>维护费用</th>
                <td>
                    <input class="form-control" name="Charge" value="<?php echo ($info["Charge"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>签约时间</th>
                <td>

                    <input class="form-control form-control-datetime" name="SignTime" value="<?php echo ($info["SignTime"]); ?>" style="width:120px;">
                </td>
                <th>合同扫描件</th>
                <td>
                    <input class="form-control" name="ScanID" value="<?php echo ($info["ScanID"]); ?>" style="width:120px;">
                </td>
            </tr>

            <tr>
                <th>生效时间</th>
                <td>
                    <input class="form-control form-control-datetime" name="BeginTime" value="<?php echo ($info["BeginTime"]); ?>" style="width:120px;">
                </td>
                <th>结束时间</th>
                <td>
                    <input class="form-control form-control-datetime" name="FinishTime" value="<?php echo ($info["FinishTime"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>支付方式</th>
                <td colspan="3">
                    <select name="PayTypeID" class="form-control">
                        <?php if(is_array($pay)): $i = 0; $__LIST__ = $pay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><option value="<?php echo ($a["PayID"]); ?>" <?php if($info['PayTypeID'] == $a['PayID']): ?>selected<?php endif; ?> >
                            <?php echo ($a["PayName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

            </tr>

            <tr>
                <th>合同说明</th>
                <td colspan="3">
                    <input class="form-control" name="Introduce" value="<?php echo ($info["Introduce"]); ?>" style="width:500px;">
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


    <script type="text/javascript" src='/public/Static/My97DatePicker/WdatePicker.js'></script>
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