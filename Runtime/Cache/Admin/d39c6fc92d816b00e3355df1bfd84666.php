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
        <input type="hidden" name="id" value="<?php echo ($Info["OrderID"]); ?>" />
        <table class="form-table" border="0">
            <tr>
                <th>客户</th>
                <td>
                    <select name="CustomerID" class="form-control">
                        <?php if(is_array($cInfo)): $i = 0; $__LIST__ = $cInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c["CustomerID"]); ?>" <?php if($c['CustomerID'] == $Info['CustomerID']): ?>selected<?php endif; ?>>
                                <?php echo ($c["FullName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

            </tr>
            <tr>
                <th>选择产品</th>
                <td>
                    <select name="ProductID" class="form-control">
                        <?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option value="<?php echo ($p["ProductID"]); ?>" <?php if($p['ProductID'] == $Info['ProductID']): ?>selected<?php endif; ?>>
                            <?php echo ($p["ProductName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

            </tr>
            <tr>
                <th>付款状态</th>
                <td>
                    <input type="radio" name="Status" value="0" checked >未付款
                    <input type="radio" name="Status" value="1" <?php if($Info['Status'] == 1): ?>checked<?php endif; ?> >已付款
                </td>

            </tr>
            <tr>
                <th>付款金额</th>
                <td>
                    <input class="form-control" name="Amount" value="<?php echo ($Info["Amount"]); ?>" style="width:120px;">
                </td>

            </tr>
            <tr>
                <th>支付方式</th>
                <td>

                    <select name="PayType" class="form-control">
                        <?php if(is_array($paytype)): $i = 0; $__LIST__ = $paytype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pt["PayID"]); ?>" <?php if($pt['PayID'] == $Info['paytype']): ?>selected<?php endif; ?>>
                            <?php echo ($pt["PayName"]); ?>
                            </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>

            </tr>
            <tr>
                <th>收款人</th>
                <td>
                    <input class="form-control" name="Receipt" value="<?php echo ($Info["Receipt"]); ?>" style="width:120px;">
                </td>

            </tr>
            <tr>
                <th>开始时间</th>
                <td>
                    <input class="form-control form-control-datetime" name="BeginTime" value="<?php echo ($Info["BeginTime"]); ?>" style="width:120px;">
                </td>

            </tr>
            <tr>
                <th>到期时间</th>
                <td>
                    <input class="form-control form-control-datetime" name="FinishTime" value="<?php echo ($Info["FinishTime"]); ?>" style="width:120px;">
                </td>
            </tr>
            <tr>
                <th>备注</th>
                <td>
                    <input class="form-control" name="Note" value="<?php echo ($Info["Note"]); ?>" style="width:120px;">
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