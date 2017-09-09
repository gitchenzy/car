<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">收款计划</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>">
        <input type="hidden" id="ContractID" value="<?php echo ($_GET['id']); ?>" />
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <th>标题</th>
                    <th>收款金额</th>
                    <th>收款时间</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr type="<?php echo ($info["PlanID"]); ?>" class="edit">
                        <td>
                            <input  class="form-control" name="Title"  type="text" value="<?php echo ($info["Title"]); ?>" />
                        </td>
                        <td>
                            <input  class="form-control"  name="money" type="text" value="<?php echo ($info["money"]); ?>" />
                        </td>
                        <td>
                            <input  class="form-control time"  name="PlanTime" type="text" value="<?php echo ($info["PlanTime"]); ?>" />
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger del">删除</button>

                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td>
                        <input  class="form-control" id="Title" name="Title" type="text" value="" />
                    </td>
                    <td>
                        <input  class="form-control" id="money" name="money" type="text" value="" />
                    </td>
                    <td>
                        <input  class="form-control" id="PlanTime" name="PlanTime" type="text" value="" />
                    </td>

                    <td>
                        <button type="button" class="btn btn-primary" id="add">添加</button>
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
    $('#add').click(function(){
        var Title =  $('#Title').val();
        var money =  $('#money').val();
        var PlanTime =  $('#PlanTime').val();
        var ContractID =  $('#ContractID').val();

        var data = {'Title':Title,"PlanTime":PlanTime,'ContractID':ContractID,money:money,type:1};
        $.post('/admin/Market/plan',data,function(d){
            if(d.status == 1){
                alert(d.info);
               location.reload();
            }

        })
    })

    $('.edit').find('input').blur(function(){
        var v = $(this).val();
        var cid = $(this).parents('.edit').attr('type')
        var names = $(this).attr('name')
        var data = {'value':v,'cid':cid,'name':names,type:2}
       // alert(name);
        editCon(data);
    })

    function editCon(data){
        $.post('/admin/Market/plan',data,function(d){
            if(d.status == 1){
             //   alert(d.info);
              // location.reload();
            }
        })
    }

    //删除
    $('.del').click(function(){
        //alert(111)
        var cid = $(this).parents('.edit').attr('type')

        $.post('/admin/Market/plan',{'cid':cid,type:3},function(d){
            if(d.status == 1){
                alert(d.info);
                location.reload();
            }
        })

       // confirmDelete("/admin/Customer/delContacts",{'cid':cid},$table,$(this),"CustomerID",cid);

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