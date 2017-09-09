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
            <div class="ibox-title">
                <a class="btn btn-primary" href="javascript:history.go(-1);" style="float:left;">返回</a>
                <h3 style="height:36px;line-height:36px;text-align:center;margin:0;padding:0;"><?php echo ($title); ?></h3>
            </div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        市场信息
                    </div>
                    <div class="ibox-content" id="">
                        <div class="vertical-container dark-timeline type1">
                             <?php if(is_array($market_info)): $i = 0; $__LIST__ = $market_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$minfo): $mod = ($i % 2 );++$i;?><div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon lazur-bg">
                                        <i class="fa fa-coffee"></i>
                                    </div>

                                    <div class="vertical-timeline-content">
                                        <h2><?php echo ($minfo["Result"]); ?></h2>
                                        <p>
                                            <?php echo ($minfo["Content"]); ?>
                                        </p>
                                        <span class="vertical-date">
                                            跟进人:<?php echo ($minfo["EmpName"]); ?><br>
                                            <small><?php echo ($minfo["GenTime"]); ?></small>
                                        </span>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="spiner-example loadingA" style="display:none;">
                            <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div>
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
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">问题信息</div>
                    <div class="ibox-content">
                        <div class="vertical-container dark-timeline type3">
                            <?php if(is_array($feed_info)): $i = 0; $__LIST__ = $feed_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fInfo): $mod = ($i % 2 );++$i;?><div class="vertical-timeline-block">
                                    <div class="vertical-timeline-icon navy-bg">
                                        <i class="fa fa-briefcase"></i>
                                    </div>

                                    <div class="vertical-timeline-content">
                                        <h2><?php echo ($fInfo["statusName"]); ?></h2>
                                        <p>
                                            <?php echo ($fInfo["Description"]); ?>
                                        </p>
                                                <span class="vertical-date">
                                            提报人:<?php echo ($fInfo["EmpName"]); ?> <br>
                                            <small><?php echo ($fInfo["FbTime"]); ?></small>
                                        </span>
                                    </div>
                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="spiner-example loadingC" style="display:none;">
                            <div class="sk-spinner sk-spinner-three-bounce">
                                <div class="sk-bounce1"></div>
                                <div class="sk-bounce2"></div>
                                <div class="sk-bounce3"></div>
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