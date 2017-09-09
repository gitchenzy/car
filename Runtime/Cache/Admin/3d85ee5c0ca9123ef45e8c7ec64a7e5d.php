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
            <h5>合同信息</h5>
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
                        <?php if(display_menu('/admin/Market/addContract')){ ?>
                        <a class="btn btn-success J_menuItem" href="/admin/Market/addContract" >
                            新增
                        </a>
                        <?php } ?>
                        <?php if(display_menu('/admin/Market/editContract')){ ?>
                        <a id="edit" class="btn btn-primary  J_menuItem" disabled="true">
                            编辑
                        </a>
                        <!--button id="edit" class="btn btn-primary" disabled>
                            编辑
                        </button-->
                        <?php } ?>

                        <?php if(display_menu('/admin/Market/plan')){ ?>
                        <button id="plan" class="btn btn-primary" disabled>
                            收款计划
                        </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Market/seeContract')){ ?>
                        <button id="see" class="btn btn-primary" disabled>
                            查看合同
                        </button>
                        <?php } ?>

                        <?php if(display_menu('/admin/Market/delContract')){ ?>
                        <button id="remove" class="btn btn-danger" disabled>
                            <i class="glyphicon glyphicon-remove"></i> 删除
                        </button>
                        <?php } ?>

                        <label class="control-label">签约时间：</label>
                        <input class="form-control input-huge" id="TimeC" name="TimeC" value="" type="text" placeholder="签约时间"> -
                        <input class="form-control input-huge" id="TimeD" name="TimeD" value="" type="text" placeholder="签约时间">
                        <button id="searchButton" class="btn btn-success">
                            搜索
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
                           data-id-field="ContractID"
                           data-sort-name="SignTime"
                           data-detail-formatter="detailFormatter"
                           data-click-select = true
                           data-sort-order="desc"
                           data-page-size = "10"
                           data-page-number = "1"
                           data-page-list="[10,20,50,100,ALL]"
                           data-show-footer="false"
                           data-side-pagination="server"
                           data-url="/admin/Market/loadContract"
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
        var $plan = $('#plan');
        var $see = $('#see');
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
                        {field: 'CustomerName',title: '客户', align: 'left',halign:'center'},
                        {field: 'CttTypeName', title: '合同类型', align: 'center'},
                        {field: 'CttNumber', title: '合同编号', align: 'left',halign:'center'},
                        {field: 'ProductName', title: '购买产品', align: 'center'},
                        {field: 'Identifier', title: '客户编号', align: 'left',halign:'center'},
                        {field: 'Amount', title: '总金额', align: 'center'},
                        {field: 'Charge', title: '维护费用', align: 'center'},
                        {field: 'CtmSign', title: '客户签约人', align: 'center'},
                        {field: 'OwnSign', title: '我方签约人', align: 'center'},
                        {field: 'SignTime', title: '签约时间',align: 'center',sortable: true,},
                        {field: 'BeginTime', title: '生效时间', align: 'center'},
                        {field: 'FinishTime', title: '结束时间', align: 'center'},
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
                    $plan.prop('disabled',false);
                    $see.prop('disabled',false);
                    $edit.prop('disabled',false);
                  $edit.attr("href","/admin/Market/editContract?id="+getIdSelections());

                    $edit.removeAttr("disabled");
                    $edit.remove("disabled");
                }else{
                    $edit.removeAttr("disabled",true);
                    $see.prop('disabled',true);
              //      $edit.prop('disabled',true);
                    $plan.prop('disabled',true);
                }
                selections = getIdSelections();
            });
            $remove.click(function () {
                var ids = getIdSelections();
                var param = {ids:ids};
                confirmDelete("/admin/Market/delContract",param,$table,$remove,"ContractID",ids);
            });

        //    $edit.click(function(){
        //        $("#addCustomer").modal({
         //           remote: "/admin/Market/editContract?id=" + getIdSelections()+'&t=' + Math.random(1000)
        //        });
         //   });
            $plan.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Market/plan?id=" + getIdSelections()+'&t=' + Math.random(1000)
                });
            });
            $see.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Market/seeContract?id=" + getIdSelections()+'&t=' + Math.random(1000)
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
                return row.ContractID;
            });
        }
        $(function () {

            $('#addCustomer').on('hide.bs.modal', function () {
                $(this).removeData("bs.modal");
                $see.prop('disabled',true);
                $plan.prop('disabled',true);
                $remove.prop('disabled',true);
                $table.bootstrapTable('refresh', {silent: true});
            });
            eachSeries(getScript, initTable);
            laydate({elem: '#TimeC', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
            laydate({elem: '#TimeD', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
        });

        $('#searchButton').click(function(){
            search();
        })
        function search(){
            var timeC = $("#TimeC").val();
            var timeD = $("#TimeD").val();
            var str =  '/admin/Market/loadContract?timeC='+timeC+"&timeD="+timeD

            $table.bootstrapTable('refresh', {url: str});
        }
    </script>

</body>
</html>