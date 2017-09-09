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
            <h5>市场记录</h5>
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
                        <?php if(display_menu('/admin/Market/addMarket')){ ?>
                            <!--<a class="btn btn-success" data-toggle="modal" data-target="#addCustomer" data-remote="/admin/Market/addMarket" >
                                新增
                            </a>-->
                            <button id="addform" class="btn btn-success">
                                新增
                            </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Market/editMarket')){ ?>
                            <button id="edit" class="btn btn-primary" disabled>
                                编辑
                            </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Market/seeMarket')){ ?>
                            <button id="See" class="btn btn-primary" disabled>
                                查看
                            </button>
                        <?php } ?>
                        <?php if(display_menu('/admin/Market/delMarket')){ ?>
                            <button id="remove" class="btn btn-danger" disabled>
                                <i class="glyphicon glyphicon-remove"></i> 删除
                            </button>
                        <?php } ?>
                        <input type="text" id="GenName" size="14" placeholder="请输入跟进人名字">
                        <label class="control-label">拜访时间：</label>
                        <input class="form-control input-huge" id="TimeC" name="TimeC" value="" type="text" placeholder="拜访时间"> -
                        <input class="form-control input-huge" id="TimeD" name="TimeD" value="" type="text" placeholder="拜访时间">
                        <label class="control-label">创建时间：</label>
                        <input class="form-control input-huge" id="TimeA" name="TimeA" value="" type="text" placeholder="创建时间"> -
                        <input class="form-control input-huge" id="TimeB" name="TimeB" value="" type="text" placeholder="创建时间">
                        <button id="searchButton" class="btn btn-success">
                            时间搜索
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
                           data-id-field="MarketID"
                           data-sort-name="GenTime"
                           data-detail-formatter="detailFormatter"
                           data-click-select = true
                           data-sort-order="desc"
                           data-page-size = "10"
                           data-page-number = "1"
                           data-page-list="[10,20,50,100,ALL]"
                           data-show-footer="false"
                           data-side-pagination="server"
                           data-url="/admin/Market/loadMarket"
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
    <div class="modal fade" id="addCustomer1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>


    <script type="text/javascript" src='/public/Static/Ueditor23578/ueditor.config.js'></script>
    <script type="text/javascript" src='/public/Static/Ueditor23578/ueditor.all.min.js'></script>
    <script type="text/javascript">
        var $table = $('#table'), $edit=$('#edit');$remove = $('#remove'), selections = [];
        var $see=$('#See');
        var $add=$('#addform');
        function initTable() {
            $table.bootstrapTable({
                height: getHeight(),
                formatSearch:function(){return '请输入客户名称'},
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
                        {field: 'CustomerName',title: '客户',align: 'left', halign:'center'},
                        {field: 'Identifier', title: '客户编号', align: 'center'},
                        {field: 'EmpName', title: '跟进人', align: 'center'},
                        {field: 'Content', title: '跟进内容',align: 'left', halign:'center' },
                        {field: 'Result', title: '跟进结果',align: 'left', halign:'center'},
                        {field: 'GenTime', title: '拜访时间', align: 'center',sortable: true},
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
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
                var checkLen = $table.bootstrapTable('getSelections').length;
                if(checkLen == 1){
                    //$edit.attr("data-remote",""+getIdSelections()+'&t=' + Math.random(1000) );
                    $edit.prop('disabled',false);
                    $see.prop('disabled',false);
                }else{
                    //$edit.attr("data-remote","javascript:void(0);");
                    $edit.prop('disabled',true);
                    $see.prop('disabled',true);
                }
                selections = getIdSelections();
            });
            $remove.click(function () {
                var ids = getIdSelections();
                var param = {ids:ids};
                confirmDelete("/admin/Market/delMarket",param,$table,$remove,"MarketID",ids);
            });
            $add.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Market/addMarket"
                    ,backdrop: 'static'
                    ,keyboard: false
                });
            });
            $edit.click(function(){
                $("#addCustomer").modal({
                    remote: "/admin/Market/editMarket?id=" + getIdSelections()+'&t=' + Math.random(1000)
                    ,backdrop: 'static'
                    ,keyboard: false
                });
            });
            $see.click(function(){
                $("#addCustomer1").modal({
                    remote: "/admin/Market/seeMarket?id=" + getIdSelections()+'&t=' + Math.random(1000)
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
                return row.MarketID;
            });
        }
        //$("#model").on("hidden.bs.model",function(e){$(this).removeData();});
        $(function () {
            $("#addCustomer").on("hidden.bs.modal", function() {
                $(this).removeData("bs.modal");
                $edit.prop('disabled',true);
                $remove.prop('disabled',true);
                $see.prop('disabled',true);
                $table.bootstrapTable('refresh', {silent: true});
                location.reload();
            });
            eachSeries(getScript, initTable);
            laydate({elem: '#TimeA', format: 'YYYY-MM-DD hh:mm:ss',event: 'focus'});
            laydate({elem: '#TimeB', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
            laydate({elem: '#TimeC', format: 'YYYY-MM-DD hh:mm:ss',event: 'focus'});
            laydate({elem: '#TimeD', format: 'YYYY-MM-DD hh:mm:ss', event: 'focus'});
        });
        $(function () {
            $("#addCustomer1").on("hidden.bs.modal", function() {
                $(this).removeData("bs.modal");
                $see.prop('disabled',true);
                $edit.prop('disabled',true);
                $remove.prop('disabled',true);
                $table.bootstrapTable('refresh', {silent: true});

            });
            eachSeries(getScript, initTable);
        });

        //用跟进人搜索
        $('#GenName').keyup(function(){
            search();
        })
        $('#searchButton').click(function(){
            search();
        })


        function search(){
            var TimeA =$('#TimeA').val();
            var values =$('#GenName').val();
            var TimeB =$('#TimeB').val();
            var TimeC =$('#TimeC').val();
            var TimeD =$('#TimeD').val();
            var str =  '/admin/Market/loadMarket?empName='+values+'&TimeA='+TimeA+'&TimeB='+TimeB+'&TimeC='+TimeC+'&TimeD='+TimeD
            $table.bootstrapTable('refresh', {url: str});

        }
    </script>

</body>
</html>