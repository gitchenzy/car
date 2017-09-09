<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php if(empty($_GET['id'])): ?>新增<?php else: ?> 编辑<?php endif; ?>客户状态</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" name="id" value="<?php echo ($info["RateID"]); ?>" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="RateName">返点名称</label>
                <div class="col-sm-4">
                    <input class="form-control" id="RateName" name="RateName" type="text" value="<?php echo ($info["RateName"]); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >返点类型</label>
                <div class="col-sm-4">
                    <input type="radio" name="RateType" checked value="1">现金
                    <input type="radio" <?php if($info['RateType'] == 2): ?>checked<?php endif; ?> name="RateType" value="2">比例
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Amount">返点金额</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Amount" name="Amount" type="text" value="<?php echo ($info["Amount"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Amount">佣金类型</label>
                <div class="col-sm-4">
                    <input type="radio" name="CommissionType" checked value="1">一次性
                    <input type="radio" <?php if($mInfo['CommissionType'] == 2): ?>checked<?php endif; ?> name="CommissionType" value="2">周期
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="BeginTime">周期开始时间</label>
                <div class="col-sm-4">
                    <input class="form-control" id="BeginTime" name="BeginTime" type="text" value="<?php echo ($info["BeginTime"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="FinishTime">周期结束时间</label>
                <div class="col-sm-4">
                    <input class="form-control" id="FinishTime" name="FinishTime" type="text" value="<?php echo ($info["FinishTime"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Amount">支付方式</label>
                <div class="col-sm-4">
                    <?php echo parse_dropdownlist($info[PayType],$paytype,"PayTypePayType","PayType","form-control","请选择支付方式");?>
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
    $("#submit").click(function(){
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