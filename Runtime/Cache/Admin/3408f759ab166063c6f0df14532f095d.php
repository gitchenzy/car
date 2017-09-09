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
    <script src="/public/Static/assets/jquery.min.js"></script>
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
    

    <link rel="stylesheet" href="/public/Admin/css/summernote.css">
    <link rel="stylesheet" href="/public/Admin/css/summernote-bs3.css">

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- 主体 -->
        
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content no-padding">

                    <input id="Birthday" name="Birthday" class="laydate-icon">
                    <input id="Birthday2" name="Birthday" class="laydate-icon">
                    <th>属性图片</th>
                    <td>
                        <input type="hidden" id="AttrImage" name="AttrImage" value="<?php echo ($info["AttrImage"]); ?>" />
                        <img src="<?php echo ((isset($info["AttrImage"]) && ($info["AttrImage"] !== ""))?($info["AttrImage"]):'/public/no_photo.png'); ?>"  id="photo_preview"  style="height:60px"/>
                        <div style="padding: 5px 0 0 0;">
                            <a href="javascript:void(0)" class="easyui-linkbutton" id="btn-upload" data-options="iconCls:'icon-upload'">上传</a>
                        </div>
                    </td>
                    <div class="summernote"><p>Hello World</p></div>
                    <a class="btn btn-success" data-toggle="modal" data-target="#addCustomer" data-remote="/admin/Huge/modal" >
                        新增
                    </a>
                    <a class="J_menuItem" href="/admin/Huge/modal" data-index="0">客户信息</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Wyswig Summernote 富文本编辑器</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_editors.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_editors.html#">选项1</a>
                            </li>
                            <li><a href="form_editors.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content no-padding">

                    <div class="summernote">


                    </div>
<a id="test">test</a>
                </div>
            </div>
        </div>
    </div>


    <!-- /主体 -->
</div>
<!-- 底部 -->

<!-- /底部 -->

    <div class="modal fade" id="addCustomer" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>


    <script type="text/javascript" src="/public/Static/uploadify/jquery.uploadify.min.js"></script>
    <script type="text/javascript">
        laydate({elem: '#Birthday',istime: true,format: 'YYYY-MM-DD hh:mm:ss'});
        laydate({elem: '#Birthday2',istime: true,format: 'YYYY-MM-DD hh:mm:ss'});
        $(function () {
            //设置图片上传插件
            $("#btn-upload").uploadify({
                height: 25,
                swf: '/public/Static/uploadify/uploadify.swf',
                uploader: "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                width: 80,
                buttonClass: "l-btn",
                buttonText: $("#btn-upload").text(),
                onUploadSuccess: function (file, data, response) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $("#photo_preview").attr("src", data.data);
                        $("#AttrImage").val(data.data);
                    }
                    else {
                        show_alert(data.info);
                    }
                }
            });
            $(".summernote").summernote({lang:"zh-CN"});
            $(".modal-backdrop").hide();
        });
        $(function () {

            $('#addCustomer').on('hide.bs.modal', function () {
                $(this).removeData("bs.modal");

            });
        });
        $("#test").click(function(){
            var sHTML = $('.summernote').code();alert(sHTML);
        })
    </script>

</body>
</html>