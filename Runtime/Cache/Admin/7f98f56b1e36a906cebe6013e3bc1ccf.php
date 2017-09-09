<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">员工资料</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" id="CustomerID" value="<?php echo ($_GET['id']); ?>" />
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <th>名字</th>
                    <th>性别</th>
                    <th>电话</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr type="<?php echo ($info["EmployeeID"]); ?>" class="edit">
                        <td>
                            <?php echo ($info["Name"]); ?>
                        </td>
                        <td>
                            <?php if($info['Sex'] == 1): ?>男<?php else: ?> 女<?php endif; ?>
                        </td>
                        <td>
                            <?php echo ($info["Mobile"]); ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary defau">分配给他</button>

                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td>
                        计划解决时间
                    </td>
                    <td colspan="3">
                        <input class="form-control" id="PlanTime" name="PlanTime"  value="<?php echo ($info["PlanTime"]); ?>" type="text" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    laydate({
        elem: '#PlanTime',
        format: 'YYYY-MM-DD hh:mm:ss', //日期格式
        event: 'focus'
    });
    $("#submit").click(function(){
        $("#defaultForm").submit();
    })
    var $table = $('#table');

    //分配
    $('.defau').click(function(){
        var cid = $(this).parents('.edit').attr('type');
        var id = "<?php echo ($_GET['id']); ?>";
        var plan = $('#PlanTime').val();
        $.post('/admin/Customer/editAllottedDemand',{'cid':cid,'ids':id,'planTime':plan},function(d){
            if(d.status == 1){
                alert(d.info);
                $('#defaultForm').bootstrapValidator('resetForm', true);$('input').val('');$('#addCustomer').modal('hide');
            }
        })
    })

       // confirmDelete("/admin/Customer/delContacts",{'cid':cid},$table,$(this),"CustomerID",cid);

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