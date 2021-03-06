<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">审核申请售前</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" value="<?php echo ($info["SupportID"]); ?>" name="id">
        <fieldset>

            <div class="form-group">
                <label class="col-sm-2 control-label">客户</label>
                <div class="col-sm-3">
                    <!--<?php echo parse_dropdownlist($info[Identifier],$cInfo,"Identifier","Identifier","form-control","请选择客户");?>-->
                    <input class="form-control" disabled value="<?php echo ($info["ShortName"]); ?>" type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">发起人</label>
                <div class="col-sm-3">
                    <input class="form-control" value="<?php echo ($info["SponsorName"]); ?>" disabled type="text" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">发起人</label>
                <div class="col-sm-3">

                    <input value="1" name="Status" type="radio" checked />批准
                    <input value="2" name="Status" type="radio" />驳回
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
</script>