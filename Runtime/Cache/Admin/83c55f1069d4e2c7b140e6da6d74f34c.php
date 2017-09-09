<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php if(empty($_GET['id'])): ?>新增<?php else: ?> 编辑<?php endif; ?>员工</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" name="id" value="<?php echo ($info["EmployeeID"]); ?>" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="EmployeeNum">账号</label>
                <div class="col-sm-4">
                    <input class="form-control" id="EmployeeNum" name="EmployeeNum" type="text"  <?php if($info["EmployeeNum"] == 'admin'): ?>disabled<?php endif; ?> value="<?php echo ($info["EmployeeNum"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Name">姓名</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Name" name="Name" type="text" value="<?php echo ($info["Name"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">性别</label>
                <div class="col-sm-4">
                    <input  name="Sex" type="radio" value="1" checked="checked" /> 男
                    <input  name="Sex" type="radio" value="2" <?php if($info['Sex'] == 2): ?>checked="checked"<?php endif; ?> /> 女
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >所属部门</label>
                <div class="col-sm-3">
                    <?php echo parse_dropdownlist($info[DepartmentNum],$dr,"DepartmentNum","DepartmentNum","form-control","请选择所属部门");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Position">职位</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Position" name="Position"  value="<?php echo ($info["Position"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Mobile">手机</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Mobile" name="Mobile"  value="<?php echo ($info["Mobile"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Email">邮箱</label>
                <div class="col-sm-4">
                    <input class="form-control" id="Email" name="Email"  value="<?php echo ($info["Email"]); ?>" type="text" />
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >是否为部门负责人</label>
                <div class="col-sm-4">
                    <input  name="isPriority" type="radio" value="1" checked="checked" /> 是
                    <input  name="isPriority" type="radio" value="2" <?php if($info['isPriority'] == 2): ?>checked="checked"<?php endif; ?> /> 否
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">用户组</label>
                <div class="col-sm-4">
                    <?php if(is_array($pr)): $i = 0; $__LIST__ = $pr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input name="duty[]" <?php if(!empty($vo["biaozhi"])): ?>checked="checked"<?php endif; ?> type="checkbox" value="<?php echo ($vo["ID"]); ?>"><?php echo ($vo["DutyName"]); endforeach; endif; else: echo "" ;endif; ?>

                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" >状态</label>
                <div class="col-sm-4">
                    <input  name="Status" type="radio" value="0" checked="checked" /> 正常
                    <input  name="Status" type="radio" value="1" <?php if($info['Status'] == 1): ?>checked="checked"<?php endif; ?> /> 锁定
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="Note">备注</label>
                <div class="col-sm-6">
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