<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php if(empty($_GET['id'])): ?>新增<?php else: ?> 编辑<?php endif; ?>财务记录</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" name="id" value="<?php echo ($info["OrderID"]); ?>" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label">客户</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[CustomerID],$cInfo,"CustomerID","CustomerID","form-control","请选择客户");?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">选择产品</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[ProductID],$product,"ProductID","ProductID","form-control","请选择产品");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">付款状态</label>
                <div class="col-sm-4">
                    <input type="radio" name="Status" value="0" checked >未付款
                    <input type="radio" name="Status" value="1" <?php if($info['Status'] == 1): ?>checked<?php endif; ?> >已付款
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Amount">付款金额</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Amount" name="Amount"  value="<?php echo ($info["Amount"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Mobile">支付方式</label>
                <div class="col-sm-4">
                    <?php echo parse_dropdownlist($info[PayType],$paytype,"PayType","PayType","form-control","请选择支付");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Receipt">收款人</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Receipt" name="Receipt"  value="<?php echo ($info["Receipt"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="BeginTime">开始时间</label>
                <div class="col-sm-4">
                    <input class="form-control" id="BeginTime" name="BeginTime"  value="<?php echo ($info["BeginTime"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="FinishTime">到期时间</label>
                <div class="col-sm-4">
                    <input class="form-control" id="FinishTime" name="FinishTime"  value="<?php echo ($info["FinishTime"]); ?>" type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Note">备注</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Note" name="Note"  value="<?php echo ($info["Note"]); ?>" type="text" />
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
        $("#defaultForm").submit();
    })
    laydate({
        elem: '#BeginTime',
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        event: 'focus'
    });
    laydate({
        elem: '#FinishTime',
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        event: 'focus'
    });
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
                                $('#defaultForm').bootstrapValidator('resetForm', true);$('input').val('');$('#addCustomer').modal('hide');
                            });
                        }else{
                            toastr.warning(result.info);return false;
                        }
                    }, 'json');
                });
    });
</script>