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
    
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- 主体 -->
        
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>问题优先级</h5>
            <div class="ibox-tools" style="display:none;">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">选项1</a>
                    </li>
                    <li><a href="#">选项2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <div id="toolbar">
                        <?php if(display_menu('/admin/Customer/addDemandPriority')){ ?>
                            <a class="btn btn-success" data-toggle="modal" data-target="#addCustomer" data-remote="/admin/Customer/addDemandPriority" >
                                新增
                            </a>
                        <?php } ?>
                        <?php if(display_menu('/admin/Customer/editDemandPriority')){ ?>
                            <button id="edit" class="btn btn-primary" disabled>
                                编辑
                            </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Customer/delDemandPriority')){ ?>
                            <button id="remove" class="btn btn-danger" disabled>
                                <i class="glyphicon glyphicon-remove"></i> 删除
                            </button>
                        <?php } ?>
                    </div>
                    <table id="table"
                           data-toolbar="#toolbar"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-columns="true"
                           data-show-export="true"
                           data-minimum-count-columns="5"
                           data-pagination="true"
                           data-id-field="FbPriorityID"
                           data-sort-name="Sort"
                           data-detail-formatter="detailFormatter"
                           data-click-select = true
                           data-order="asc"
                           data-page-size = "5"
                           data-page-number = "1"
                           data-page-list="[10,20,50,100,ALL]"
                           data-show-footer="false"
                           data-side-pagination="server"
                           data-url="/admin/Customer/loadDemandPriority"
                           data-response-handler="responseHandler">
                    </table>

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


    <script type="text/javascript">
        var $table = $('#table'), $edit=$('#edit');$remove = $('#remove'), selections = [];
        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                clickToSelect:true,
                formatLoadingMessage:function(){
                    return '正在加载，请稍候...';
                },
                formatShowingRows: function (pageFrom, pageTo, totalRows) {
                    return '第 ' + pageFrom + ' - ' + pageTo + ' 记录，共 ' + totalRows + ' 条记录';
                },
                formatRecordsPerPage:function(pageNumber){
                    return '每页 '+pageNumber + ' 记录';
                },
                //queryParams: queryParams, //参数
                columns: [
                    [
                        //{field: 'Number', title: 'Number', formatter: function (value, row, index) {return index + 1;}},
                        {checkbox: true, align: 'center', valign: 'middle'},
                        //{field: 'Sort',title: '排序', align: 'center', valign: 'middle', sortable: true,},
                        {field: 'FbPriorityName',title: '优先级名称', align: 'center'},
                        {field: 'OperatorName', title: '操作人', align: 'center'},
                        {field: 'ModifyTime', title: '操作时间', align: 'center'},
                        {field: 'Sort', title: '排序', align: 'center',sortable: true,},
                    ]
                ]
            });
            // sometimes footer render error.
            setTimeout(function () {
                $table.bootstrapTable('resetView');
            }, 200);
            $table.on('check.bs.table uncheck.bs.table ' +
                    'check-all.bs.table uncheck-all.bs.table', function () {
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
                var checkLen = $table.bootstrapTable('getSelections').length;
                if(checkLen == 1){
                  //  $edit.attr("href","/admin/Market/editContractType?id="+getIdSelections());
                    $edit.prop('disabled',false);
                }else{
                   // $edit.attr("href","javascript:void(0);");
                    $edit.prop('disabled',true);
                }
                selections = getIdSelections();
            });
            $remove.click(function () {
                var ids = getIdSelections();
                var param = {ids:ids};
                confirmDelete("/admin/Customer/delDemandPriority",param,$table,$remove,"FbPriorityID",ids);
            });
            $edit.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Customer/editDemandPriority?id=" + getIdSelections()+'&t=' + Math.random(1000)
                });
            });
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        function getIdSelections(param) {
            return $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.FbPriorityID;
            });
        }
        $(function () {
            $('#addCustomer').on('hide.bs.modal', function () {
                $(this).removeData("bs.modal");
                $edit.prop('disabled',true);
                $remove.prop('disabled',true);
                $table.bootstrapTable('refresh', {silent: true});
            });
            eachSeries(getScript, initTable);
        });
    </script>

</body>
</html>