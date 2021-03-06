<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">导入公共客户</h4>
</div>
<div class="modal-body">
    <a href="/index.php/Admin/Customer/download">下载模板</a>
    <form class="form-horizontal" role="form" id="defaultForm" method="post" action="<?php echo ($self); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="11" />
        <fieldset>
            <div class="form-group">
                <label class="col-sm-2 control-label" >选择文件</label>
                <div class="col-sm-4">
                    <input name="path" type="hidden" id="path">
                    <input name="import" type="file" id="import" />
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">关闭</button>
    <button type="button" class="btn btn-primary" id="submit">导入</button>
</div>
<script language="javascript" src="/public/Static/uploadify/jquery.uploadify.min.js"></script>
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
    $("#import").uploadify({
        "height"          : 30,
        "swf"             : "/public/Static/uploadify/uploadify.swf",
        "fileObjName"     : "Filedata",
        "buttonText"      : "上传",
        "uploader"        : "<?php echo U('file/uploadPicture');?>",
        "width"           : 80,
        'removeTimeout'	  : 1,
        'fileTypeExts'	  : '*.xls',
        "onUploadSuccess" : uploadPicture_small
    });
    function uploadPicture_small(file,text){
        var json = $.parseJSON(text);
        if(json.status){

            $("#path").val(json.data);

        }else {
            alert(json.info);
        }
    }
</script>