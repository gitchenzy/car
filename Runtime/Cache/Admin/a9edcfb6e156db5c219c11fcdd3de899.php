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
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src="/public/admin/js/jquery.js"></script>
    <script>
        // 现在window.$和window.jQuery是1.11版本:
        console.log($().jquery); // => '1.11.0'
        var $jq = jQuery.noConflict(true);
        // 现在window.$和window.jQuery被恢复成1.5版本:
        console.log($().jquery); // => '1.5.0'
        // 可以通过$jq访问1.11版本的jQuery了
    </script>


    <link rel="stylesheet" href="/public/admin/css/jquery.autocomplete.css">
    <script type="text/javascript" src="/public/admin/js/jquery.bgiframe.min.js"></script>
    <script type="text/javascript" src="/public/admin/js/jquery.ajaxQueue.js"></script>
    <script type="text/javascript" src="/public/admin/js/jquery.autocomplete.js"></script>
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
            <h5>客户信息</h5>
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
                        <?php if(display_menu('/admin/Customer/addMOCustomer')){ ?>
                          <!--  <a class="btn btn-success" data-toggle="modal" data-target="#addCustomer" data-remote="/admin/Customer/addMoCustomer" >
                                新增
                            </a>-->
                            <button id="addform" class="btn btn-success">
                                新增
                            </button>
                        <?php } ?>

                        <?php if(display_menu('/admin/Customer/editCustomer')){ ?>
                            <button id="edit" class="btn btn-primary" disabled>
                                编辑
                            </button>
                        <?php } ?>

                        <?php if(display_menu('/admin/Customer/customerInfo')){ ?>
                        <a id="cusInfo" class="btn btn-primary  J_menuItem" disabled="true" >
                            查看信息
                        </a>
                        <?php } ?>
                        <?php if(display_menu('/admin/Customer/contacts')){ ?>
                        <button id="Contacts" class="btn btn-success" disabled>
                            联系人
                        </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Customer/allotMoCustomer')){ ?>
                        <button id="Allot" class="btn btn-success" disabled>
                            分配
                        </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Customer/collectMoCustomer')){ ?>
                        <button id="Collect" class="btn btn-primary" disabled>
                           领取
                        </button>
                        <?php } ?>
                        <button id="Import" class="btn btn-primary">
                            导入
                        </button>

                    </div>
                    <table id="table"
                           data-toolbar="#toolbar"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-columns="true"
                           data-show-export="true"
                           data-minimum-count-columns="5"
                           data-pagination="true"
                           data-id-field="CustomerID"
                           data-sort-name="Sort"
                           data-detail-formatter="detailFormatter"
                           data-click-select = true
                           data-order="asc"
                           data-page-size = "10"
                           data-page-number = "1"
                           data-page-list="[10,20,50,100,ALL]"
                           data-show-footer="false"
                           data-side-pagination="server"
                           data-url="/admin/Customer/loadMoCustomer"
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
        var $table = $('#table'), $edit=$('#edit'); var selections = [];
        var $adc = $('#Contacts');
        var $allot = $('#Allot');
        var $collect = $('#Collect');
        var $Import = $('#Import');
        var $cusInfo = $('#cusInfo');
        var $add = $('#addform');
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
                        {field: 'LoginName',title: '账号', align: 'center'},
                        {field: 'ShortName', title: '简称', align: 'center'},
                        {field: 'FullName', title: '全称', align: 'left', halign:'center'},
                        {field: 'Identifier', title: '客户编号', align: 'center',sortable: true,},
                        {field: 'CtmStatusName', title: '客户状态', align: 'center'},
                        {field: 'CtmRankName', title: '客户等级', align: 'center'},
                        {field: 'Contacter', title: '联系人', align: 'center'},
                        {field: 'CtmRoleName', title: '联系人角色', align: 'center'},
                        {field: 'DeveloperName', title: '客户归属', align: 'center'},
                        {field: 'Sources', title: '来源', align: 'center'},
                        {field: 'Telephone', title: '电话', align: 'center'},
                        {field: 'Mobile', title: '手机', align: 'center'},
                        {field: 'Email', title: '邮箱', align: 'center'},
                        {field: 'WeChat', title: '微信号', align: 'center'},
                        {field: 'Status', title: '状态', align: 'center'},
                        {field: 'CreateTime', title: '创建时间', align: 'center'},
                    ]
                ]
            });
            // sometimes footer render error.
            setTimeout(function () {
                $table.bootstrapTable('resetView');
            }, 200);
            $table.on('check.bs.table uncheck.bs.table ' +
                    'check-all.bs.table uncheck-all.bs.table', function () {
                $allot.prop('disabled', !$table.bootstrapTable('getSelections').length);
                $collect.prop('disabled', !$table.bootstrapTable('getSelections').length);
                var checkLen = $table.bootstrapTable('getSelections').length;
                if(checkLen == 1){
                    //$edit.attr("data-remote",""+getIdSelections()+'&t=' + Math.random(1000) );
                    $edit.prop('disabled',false);
                    $adc.prop('disabled',false);
                    $cusInfo.attr("href","/admin/Customer/customerInfo?id="+getIdSelections());
                    $cusInfo.removeAttr("disabled");
                }else{
                    //$edit.attr("data-remote","javascript:void(0);");
                    $edit.prop('disabled',true);
                    $adc.prop('disabled',true);
                    $cusInfo.attr("href","");
                    $cusInfo.attr("disabled","");
                }
                selections = getIdSelections();
            });
            $allot.click(function () {
                $("#addCustomer").modal({
                    remote: "/admin/Customer/allotMoCustomer?id=" + getIdSelections()+'&t=' + Math.random(1000)
                });
            });
            $Import.click(function () {
                $("#addCustomer").modal({
                    remote: "/admin/Customer/importMoCustomer?&t=" + Math.random(1000)
                });
            });
            $collect.click(function () {
                var ids = getIdSelections();
                $.post('/admin/Customer/collectMoCustomer',{'ids':ids},function(data){
                    if(data.status ==1){
                        alert(data.info);
                        location.reload();
                    }
                })
            });
            $add.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Customer/addMoCustomer"
                    ,backdrop: 'static'
                    ,keyboard: false
                });
            });
            $edit.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Customer/editMoCustomer?id=" + getIdSelections()+'&t=' + Math.random(1000)
                    ,backdrop: 'static'
                    ,keyboard: false
                });
            });

            $adc.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Customer/contacts?id=" + getIdSelections()+'&t=' + Math.random(1000)
                    ,backdrop: 'static'
                    ,keyboard: false
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
                return row.CustomerID;
            });
        }
        //$("#model").on("hidden.bs.model",function(e){$(this).removeData();});
        $(function () {
            $("#addCustomer").on("hidden.bs.modal", function() {
                $(this).removeData("bs.modal");
                $edit.prop('disabled',true);
                $adc.prop('disabled',true);

                $cusInfo.prop("disabled",true);
                $table.bootstrapTable('refresh', {silent: true});
            });
            eachSeries(getScript, initTable);
        });
    </script>

</body>
</html>