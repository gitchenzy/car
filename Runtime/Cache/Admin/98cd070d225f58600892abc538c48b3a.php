<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>果园电商CRM系统</title>
    <meta name="keywords"/>
    <meta name="description"/>
    <link rel="stylesheet" href="/public/Admin/css/style.min.css">
    <link rel="stylesheet" href="/public/Static/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/Static/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="/public/Static/assets/bootstrap-table/src/bootstrap-editable.css">
    <link rel="stylesheet" href="/public/Static/assets/examples.css">
    <link rel="stylesheet" href="/public/Admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/Admin/css/custom.css">
    <link rel="stylesheet" href="/public/Admin/css/animate.min.css">
    <link rel="stylesheet" href="/public/Admin/css/huge.css">
    <link rel="stylesheet" href="/public/Admin/css/toastr.min.css">
    <link rel="stylesheet" href="/public/Admin/css/sweetalert.css">
    <link rel="stylesheet" href="/public/Admin/css/summernote.css">
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src="/public/admin/js/jquery.js"></script>
    <script>
        // 现在window.$和window.jQuery是1.11版本:
        console.log($().jquery); // => '1.11.0'
        var $jq = jQuery.noConflict(true);
        // 现在window.$和window.jQuery被恢复成1.5版本:
        console.log($().jquery); // => '1.5.0'
        // 可以通过$jq访问1.11版本的jQuery了
    </script>


    <link rel="stylesheet" href="/public/admin/css/jquery.autocomplete.css">
    <script type="text/javascript" src="/public/admin/js/jquery.bgiframe.min.js"></script>
    <script type="text/javascript" src="/public/admin/js/jquery.ajaxQueue.js"></script>
    <script type="text/javascript" src="/public/admin/js/jquery.autocomplete.js"></script>
    <script src="/public/Static/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/Static/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="/public/Static/assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="/public/Static/assets/tableExport.js"></script>
    <script src="/public/Static/assets/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js"></script>
    <script src="/public/Static/assets/bootstrap-table/src/bootstrap-editable.js"></script>
    <script src="/public/Admin/js/icheck.min.js"></script>
    <script src="/public/Admin/js/content.min.js"></script>
    <script src="/public/Admin/js/bootstrapValidator.js"></script>
    <script src="/public/Admin/js/toastr.min.js"></script>
    <script src="/public/Static/assets/analytics.js"></script>
    <script src="/public/Admin/js/sweetalert.min.js"></script>
    <script src="/public/Admin/js/layer/laydate/laydate.js"></script>
    <script type="text/javascript" src="/public/Static/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="/public/Admin/js/summernote.min.js"></script>
    <script type="text/javascript" src="/public/Admin/js/summernote-zh-CN.js"></script>
    <script src="/public/Admin/js/huge.js"></script>
    
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- 主体 -->
        
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php if(empty($_GET['id'])): ?>新增<?php else: ?> 编辑<?php endif; ?>合同信息</h5>
                </div>
                <div class="ibox-content">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" name="id" value="<?php echo ($info["ContractID"]); ?>" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span style="color: red;">*</span>&nbsp;客户简称</label>
                <div class="col-sm-3" style="position:relative;z-index:999;">
                    <!--<?php echo parse_dropdownlist($info[Identifier],$cInfo,"Identifier","Identifier","form-control","请选择客户");?>-->
                    <input class="form-control" id="Identifier" name="ShortName"  value="<?php echo ($info["ShortName"]); ?>" type="text" />
                    <div id="boxTxt" class="col-sm-10" style="display: none;position:absolute;background: #fff;border:1px solid #00b7ee;height:150px;overflow: scroll;">
                        <ul id="bodys">

                        </ul>
                    </div>
                </div>
                <label class="col-sm-2 control-label" ><span style="color: red;">*</span>&nbsp;购买产品</label>
                <div class="col-sm-3">
                    <?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><input name="productID[]" <?php echo ($pro["checked"]); ?> type="checkbox" value="<?php echo ($pro["ProductID"]); ?>"><?php echo ($pro["ProductName"]); endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >合同类型</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CttTypeID],$ttInfo,"CttTypeID","CttTypeID","form-control","请选择合同类型");?>
                </div>
                <label class="col-sm-2 control-label" >支付方式</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[PayTypeID],$pay,"PayTypeID","PayTypeID","form-control","请选择支付方式");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="CttNumber">合同编号</label>
                <div class="col-sm-3">
                    <input class="form-control" id="CttNumber" type="text" name="CttNumber" value="<?php echo ($info["CttNumber"]); ?>"/>
                </div>
                <label class="col-sm-2 control-label" for="Amount"><span style="color: red;">*</span>&nbsp;总金额</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Amount" type="text" name="Amount" value="<?php echo ($info["Amount"]); ?>"/>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="CtmPrincipal"><span style="color: red;">*</span>&nbsp;对方负责人</label>
                <div class="col-sm-3">
                    <input class="form-control" id="CtmPrincipal" name="CtmPrincipal"  value="<?php echo ($info["CtmPrincipal"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="OwnPrincipal">我方负责人</label>
                <div class="col-sm-3">
                    <input class="form-control" id="OwnPrincipal" name="OwnPrincipal"  value="<?php echo ($info["OwnPrincipal"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="CtmSign">系统对接人</label>
                <div class="col-sm-3">
                    <input class="form-control" id="CtmSign" name="CtmSign"  value="<?php echo ($info["CtmSign"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="OwnSign">我方签约人</label>
                <div class="col-sm-3">
                    <input class="form-control" id="OwnSign" name="OwnSign"  value="<?php echo ($info["OwnSign"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Charge"><span style="color: red;">*</span>&nbsp;维护费用</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Charge" name="Charge"  value="<?php echo ($info["Charge"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="SignTime"><span style="color: red;">*</span>&nbsp;签约时间</label>
                <div class="col-sm-3">
                    <input class="form-control" id="SignTime" name="SignTime"  value="<?php echo ($info["SignTime"]); ?>" type="text" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="BeginTime"><span style="color: red;">*</span>&nbsp;生效时间</label>
                <div class="col-sm-3">
                    <input class="form-control" id="BeginTime" name="BeginTime"  value="<?php echo ($info["BeginTime"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="FinishTime"><span style="color: red;">*</span>&nbsp;结束时间</label>
                <div class="col-sm-3">
                    <input class="form-control" id="FinishTime" name="FinishTime"  value="<?php echo ($info["FinishTime"]); ?>" type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Address"><span style="color: red;">*</span>&nbsp;客户地址</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Address" name="Address"  value="<?php echo ($info["Address"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="Telephone"><span style="color: red;">*</span>&nbsp;联系电话</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Telephone" name="Telephone"  value="<?php echo ($info["Telephone"]); ?>" type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><span style="color: red;">*</span>&nbsp;收款时间</label>
                <div class="col-sm-3">
                    <input class="form-control" id="PlanTime" name="PlanTime"  value="<?php echo ($info["PlanTime"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="SiteAddress"><span style="color: red;">*</span>&nbsp;域号</label>
                <div class="col-sm-2">
                    <input class="" id="SiteAddress" style="display: inline-block;" name="SiteAddress"  value="<?php echo ($info["SiteAddress"]); ?>" type="text" />.goooy.cn
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">收款备注</label>
                <div class="col-sm-3">
                    <input class="form-control" id="PlanContent" name="PlanContent"  value="<?php echo ($info["PlanContent"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="ScanID">合同扫描件</label>
                <div class="col-sm-3">
                    <input type="hidden" id="ScanID" name="ScanName" value="<?php echo ($info["ScanName"]); ?>" />
                    <img src="<?php echo ((isset($info["ScanName"]) && ($info["ScanName"] !== ""))?($info["ScanName"]):'/public/no_photo.png'); ?>"  id="photo_preview"  style="height:60px"/>
                    <div style="padding: 5px 0 0 0;">
                        <a href="javascript:void(0)" class="btn btn-default" id="btn-upload" data-options="iconCls:'icon-upload'">上传</a>
                    </div>
                </div>
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Introduce">合同说明</label>
                <div class="col-sm-8">
                    <!--
                    <input class="form-control" id="Introduce" name="Introduce"  value="<?php echo ($info["Introduce"]); ?>" type="text" />
                     <div class="summernote" id="Introduce" name="Introduce">合同说明的内容</div>
                    -->
                    <textarea id="Introduce" name="Introduce" style="width: 99.9%; height: 360px;"><?php echo (htmlspecialchars_decode($info["Introduce"])); ?></textarea>

                </div>
            </div>

        </fieldset>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary" type="submit" id="submit">保存内容</button>
                <button class="btn btn-white" type="button" id="close">取消</button>
            </div>
        </div>
    </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- /主体 -->
</div>
<!-- 底部 -->

<!-- /底部 -->



    <script type="text/javascript" src='/public/Static/Ueditor23578/ueditor.config.js'></script>
    <script type="text/javascript" src='/public/Static/Ueditor23578/ueditor.all.min.js'></script>
    <script type="text/javascript">
        getcustomer();
        var ue = UE.getEditor('Introduce');

        $(document).ready(function() {
            loadSomething();
            $('#defaultForm')
                    .bootstrapValidator({
                        message: 'This value is not valid',
                        feedbackIcons: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            LoginName: {
                                message: '账号不可用',
                                validators: {
                                    notEmpty: {
                                        message: '账号不能为空'
                                    },
                                    stringLength: {
                                        min: 6,
                                        max: 30,
                                        message: '账号长度6-30'
                                    },
                                    /*remote: {
                                     url: 'remote.php',
                                     message: '账号不可用'
                                     },*/
                                    regexp: {
                                        regexp: /^[a-zA-Z0-9_\.]+$/,
                                        message: '账号格式不正确'
                                    }
                                }
                            }
                        }
                    })
                    .on('success.form.bv', function(e) {
                        // Prevent form submission
                        e.preventDefault();
                        // Get the form instance
                        var $form = $(e.target);
                        // Get the BootstrapValidator instance
                        var bv = $form.data('bootstrapValidator');
                        // Use Ajax to submit form data
                        $.post($form.attr('action'), $form.serialize(), function(result) {
                            if(result.status==1){
                                swal({
                                    title:"操作成功！",
                                    text:result.info,
                                    type:"success"
                                },function(){
                                    location.href = result.url
                                    //$('#defaultForm').bootstrapValidator('resetForm', true);$('input').val('');$('#addCustomer').modal('hide');
                                });
                            }else{
                                toastr.warning(result.info);return false;
                            }
                        }, 'json');
                    });
        });
        function loadSomething(){
            //设置图片上传插件
            $("#btn-upload").uploadify({
                height: 25,
                swf: '/public/Static/uploadify/uploadify.swf',
                uploader: "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                width: 80,
                buttonClass: "btn-default",
                buttonText: $("#btn-upload").text(),
                onUploadSuccess: function (file, data, response) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $("#photo_preview").attr("src", data.data);
                        $("#ScanID").val(data.data);
                    }
                    else {
                        show_alert(data.info);
                    }
                }
            });

            $('.summernote').summernote({
                lang:"zh-CN",
                height: "150px",   //set editable area's height
            });

            laydate({elem: '#SignTime', format: 'YYYY-MM-DD hh:mm:ss',event: 'focus'});
            laydate({elem: '#FinishTime', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
            laydate({elem: '#BeginTime', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
            laydate({elem: '#PlanTime', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
        }
        $(document).ready(function(){
            //var customer = ['中国人', 'bear', 'dog', 'drink', 'elephant', 'fruit', 'bear', 'dog', 'drink', 'elephant', 'fruit', 'bear', 'dog', 'drink', 'elephant', 'fruit'];
            $jq("#Identifier").autocomplete('/admin/Common/getALLCustomer',{
                dataType:"json",
                minChars:0,
                max:10,
                parse: function(data) {
                    return $.map(data, function(row) {
                        return {
                            data: row,
                            value: row,
                            result: row
                        }
                    });
                },
                formatItem: function(item) {
                    return item;
                },
                matchSubset:false
            });
        });
        $('#close').click(function(){

            location.href='/admin/Market/contract'
        })
    </script>

</body>
</html>