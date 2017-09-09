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
        
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">合同信息</div>
                    <div class="ibox-content">
                        <div class="vertical-container dark-timeline type2">
                            <table border="1" class="table table-striped">
                                <tr><td>生效时间</td><td><?php echo ($pinfo["BeginTime"]); ?></td></tr>
                                <tr><td>结束时间</td><td><?php echo ($pinfo["FinishTime"]); ?></td></tr>
                                <tr><td>对接人</td><td><?php echo ($pinfo["CtmSign"]); ?></td></tr>
                                <tr><td>联系电话</td><td><?php echo ($pinfo["Telephone"]); ?></td></tr>
                                <tr><td>购买产品</td><td><?php echo ($pinfo["PName"]); ?></td></tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">申请实施信息</div>
                    <div class="ibox-content">
                        <div class="vertical-container dark-timeline type3">
                            <table border="1" class="table table-striped">
                                <tr><td>市场人员</td><td><?php echo ($info["MName"]); ?></td></tr>
                                <tr><td>客服人员</td><td><?php echo ($info["SName"]); ?></td></tr>
                                <tr><td>实施状态</td><td><?php echo ($info["StatusName"]); ?></td></tr>
                                <tr><td>实施主管</td><td><?php echo ($info["EName"]); ?></td></tr>
                                <tr><td>实施人员</td><td><?php echo ($info["FName"]); ?></td></tr>
                                <tr><td>实施时间</td><td><?php echo ($info["ForceTime"]); ?></td></tr>
                                <tr><td>实施超时时间</td><td><?php echo ($info["OutForceTime"]); ?></td></tr>
                                <tr><td>实施完成时间</td><td><?php echo ($info["FinishTime"]); ?></td></tr>
                                <tr><td>备注</td><td><?php echo ($info["Note"]); ?></td></tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">实施信息</div>
                    <div class="ibox-content">
                        <div class="vertical-container dark-timeline type2">
                            <?php if(is_array($main_info)): $i = 0; $__LIST__ = $main_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mainfo): $mod = ($i % 2 );++$i;?><div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon blue-bg">
                                        <i class="fa fa-file-text"></i>
                                    </div>

                                    <div class="vertical-timeline-content">
                                        <h2><?php echo ($mainfo["Result"]); ?></h2>
                                        <p>
                                            <?php echo ($mainfo["Content"]); ?>
                                        </p>
                                                <span class="vertical-date">
                                            实施人:<?php echo ($mainfo["EmpName"]); ?>  <br>
                                            <small><?php echo ($mainfo["TraceTime"]); ?></small>
                                        </span>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="spiner-example loadingB" style="display:none;">
                            <div class="sk-spinner sk-spinner-chasing-dots">
                                <div class="sk-dot1"></div>
                                <div class="sk-dot2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- /主体 -->
</div>
<!-- 底部 -->

<!-- /底部 -->


    <script type="text/javascript">
        var current_loading = false;
        var page_container_object =  $("body").get(0);
        var time=1;
        $(window).scroll(function(){
            var scroll_interval = page_container_object.scrollHeight - page_container_object.scrollTop - page_container_object.clientHeight;
            if (scroll_interval <= 100 && !current_loading) {
                current_loading = true;
                $(".loadingA").add(".loadingB").add(".loadingC").show();
                loadMore(time,1);
                 loadMore(time,2);
                  loadMore(time,3);
            }

        });

        //"向服务器请求数据"
        function loadMore(te,type) {
            var id = "<?php echo ($_GET['id']); ?>";
            $.get("/admin/Customer/loadMoreCusInfo/",{ time : te,type:type,id:id } , function(data) {
                if(data.status==0){
                    $(".loadingA").add(".loadingB").add(".loadingC").hide();

                }else{
                    $(".type" + type).append(data.info);
                    current_loading =false;
                    time++;
                }
            });
        }
    </script>

</body>
</html>