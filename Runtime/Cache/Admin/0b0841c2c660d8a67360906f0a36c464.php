<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php if(empty($_GET['id'])): ?>新增<?php else: ?> 编辑<?php endif; ?>客户</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" name="id" value="<?php echo ($info["CustomerID"]); ?>" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="LoginName" >账号</label>
                <div class="col-sm-4">
                    <input  class="form-control" id="LoginName" name="LoginName" type="text" value="<?php echo ($info["LoginName"]); ?>" <?php if(!empty($info["LoginName"])): ?>disabled='disabled'<?php endif; ?> />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Website">网址</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Website" type="text" name="Website" value="<?php echo ($info["Website"]); ?>"/>
                </div>
                <label for="CtmCloseID"  class="col-sm-2 control-label">亲密程度</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CtmCloseID],$cus[co],"CtmCloseID","CtmCloseID","form-control","请选择亲密程度");?>

                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="ShortName"><span style="color: red;">*</span>&nbsp;简称</label>
                <div class="col-sm-4">
                    <input class="form-control" id="ShortName" name="ShortName"  value="<?php echo ($info["ShortName"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label">账号状态</label>
                <div class="col-sm-3" style="padding-top:4px;">
                    <input type="radio" value="0" checked="checked" name="Status">
                    正常
                    <input type="radio" value="1" <?php if($info['Status'] == 1): ?>checked="checked"<?php endif; ?> name="Status">
                    锁定
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="FullName"><span style="color: red;">*</span>&nbsp;全称</label>
                <div class="col-sm-4">
                    <input class="form-control" id="FullName" name="FullName"  value="<?php echo ($info["FullName"]); ?>" type="text" />
                </div>
                <label  class="col-sm-2 control-label">客户状态</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CtmStatusID],$cus[cs],"CtmStatusID","CtmStatusID","form-control","请选择客户状态");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Contacter"><span style="color: red;">*</span>&nbsp;联系人</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Contacter" name="Contacter"  value="<?php echo ($info["Contacter"]); ?>" type="text" />
                </div>
                <label class="col-sm-2 control-label">联系人角色</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CtmRoleID],$cus[cr],"CtmRoleID","CtmRoleID","form-control","请选择联系人角色");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Mobile"><span style="color: red;">*</span>&nbsp;手机</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Mobile" name="Mobile"  value="<?php echo ($info["Mobile"]); ?>" type="text" />
                </div>
                <label for="Telephone"  class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Telephone" name="Telephone"  value="<?php echo ($info["Telephone"]); ?>" type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Email"><span style="color: red;">*</span>&nbsp;邮箱</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Email" name="Email"  value="<?php echo ($info["Email"]); ?>" type="text" />
                </div>
                <label for="Qq"  class="col-sm-2 control-label"><span style="color: red;">*</span>&nbsp;qq</label>
                <div class="col-sm-3">
                    <input class="form-control" id="Qq" type="text" name="Qq" value="<?php echo ($info["Qq"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="WeChat">微信号</label>
                <div class="col-sm-4">
                    <input class="form-control" id="WeChat" name="WeChat"  value="<?php echo ($info["WeChat"]); ?>" type="text" />
                </div>
                <label for="CtmRankID"  class="col-sm-2 control-label">客户等级</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CtmRankID],$cus[ck],"CtmRankID","CtmRankID","form-control","请选择客户等级");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Address">地址</label>
                <div class="col-sm-6">
                    <input class="form-control" id="Address" name="Address"  value="<?php echo ($info["Address"]); ?>" type="text" />
                </div>
                <label class="col-sm-1 control-label" for="Sort">排序</label>
                <div class="col-sm-2">
                    <input class="form-control" id="Sort" name="Sort"  value="<?php echo ($info["Sort"]); ?>" type="text" />
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">关闭</button>
    <button type="button" class="btn btn-primary" id="submit">保存</button>
</div>

<script type="text/javascript">

    $("#submit").click(function(){
        var qq = $('#Qq').val();
        var ShortName = $('#ShortName').val();
        var FullName = $('#FullName').val();
        var Contacter = $('#Contacter').val();
        var Mobiles = $('#Mobile').val();
        var Email = $('#Email').val();
        if(!ShortName){
            alert('简称不能为空！')
            return false;
        }
        if(!FullName){
            alert('全称不能为空！')
            return false;
        }
        if(!Contacter){
            alert('联系人不能为空！')
            return false;
        }
        if(!Mobiles){
            alert('手机不能为空！')
            return false;
        }
        if(!qq || !Email){
            alert('qq和邮箱不能为空！')
            return false;
        }
        $("#defaultForm").submit();
    })
    $(document).ready(function() {
        $('#defaultForm')
                .bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {

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
                                $('#defaultForm').bootstrapValidator('resetForm', true);$('input').val('');$('#addCustomer').modal('hide');
                            });
                        }else{
                            toastr.warning(result.info);return false;
                        }
                    }, 'json');
                });
    });
</script>