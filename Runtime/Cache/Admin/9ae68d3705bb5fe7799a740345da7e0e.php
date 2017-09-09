<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible"content="IE=9; IE=8; IE=7; IE=EDGE">
    <title>果园电商CRM后台管理</title>
    <meta name="keywords"/>
    <meta name="description"/>
    <link rel="stylesheet" href="/public/Admin/css/login.css" />
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/jquery.easyui.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/locale/easyui-lang-zh_CN.js'></script>
    <script type="text/javascript" src='/public/Static/Superfish/jquery.superfish.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.guoyuan.js' id="guoyuan_script"></script>
    <script type="text/javascript" src='/public/Static/jquery.validate.min.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.validate_cn.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.show.js'></script>
    <script type="text/javascript" src="/public/Static/cookie.js"></script>
</head>
<body>
<div class="login-header">
    <a class="logo">
        <img src="" style=" max-height: 124px;">
    </a>
    <span class="header">果园电商CRM后台登录</span>
</div>
<div class="login-panel">

    <div id="slideBox" class="slideBox">
        <!--<div class="hd">-->
        <!--<ul><li></li><li></li><li></li></ul>-->
        <!--</div>-->
        <div class="bd">
            <ul>
                <li style="display: none;"><a href="javascript:void(0);" target="_blank"><img src="/public/Admin/images/account/logo_slider01.png"></a></li>
            </ul>
        </div>
    </div>
    <div class="login-tab" id="login-tab">


        <div class="bd">
            <h3 class="title">登&nbsp;录</h3>
            <div class="panel">
                <div class="form-login">
                    <form action="DoLogin" method="post" name="form-login" id="form-login">
                        <div class="form-group">
                            <label class="control-label-username"></label>
                            <input class="form-control" type="text" id="LoginName" name="LoginName" required="required" placeholder="请输入账号">
                        </div>
                        <div class="form-group form-group-password">
                            <label class="control-label-password"></label>
                            <input class="form-control" type="password" id="Password" name="Password" required="required" placeholder="请输入密码">
                        </div>
                        <div class="form-group form-group-valid" style="  width: 194px;left: -45px;">
                            <label class="control-label-valid"></label>
                            <input class="form-control" type="text" id="VerifyCode" name="VerifyCode" required="required" placeholder="请输入验证码" maxlength="4">
                            <a href="javascript:refreshValid()" class="command" style="  right: -85px;">
                                <img id="validImg" align="absMiddle" src="/verify.php?Tue Dec 22 2015 15:43:29 GMT+0800 (中国标准时间)" alt="验证码"></a>
                        </div>
                        <div class="form-group-command">

                            <input type="button" class="btn-login" id="login_sub" onclick="doLogin(this)" style="  margin-top: 22px;" value="登录">
                        </div>
                        <div class="error-container">
                        </div>
                    </form>
                </div>
                <div class="account-info">

                    <div style="color:#B3B4B4;text-align: center;">
                        <!--<a  href='@Url.Content("~/Account/Register")'>分销注册</a>｜<span>忘记密码</span>｜<span>意见反馈</span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p style="color:#B3B4B4;text-align:center;padding-top:57px;">技术支持：果园科技</p>
<script type="text/javascript" language="javascript" src="/public/Static/jquery.md5.js"></script>
<script type="text/javascript" language="javascript" src="/public/Static/jquery.SuperSlide.2.1.1.js"></script>
<script language="javascript" type="text/javascript">
    jQuery(".slideBox").slide({ mainCell: ".bd ul", autoPlay: true });
    $(function () {
        refreshValid();
        //$('body').height($(window).height());
    });

    //刷新验证码
    function refreshValid() {
        $('#validImg').attr("src", "/verify.php?"+ new Date());
    }


    $(function () {
        //鼠标放在文本框上面即放置焦点
        $(".form-group").click(function () {
            $("input", this).focus();
        });
        $("#LoginName").focus();

        $(".form-control").keydown(function (e) {
            if (e.which == 13) {
                doLogin();
            }
        });
    });


    //登录界面
    function doLogin() {

        if (!$('#LoginName').val())
        {
            _popup("请填写用户名！");
            return;
        }
        var Password = $('#Password').val();
        if (!Password) {
            _popup("请填写密码！");
            return;
        }
        if (!$('#VerifyCode').val()) {
            _popup("请填写验证码！");
            return;
        }

        var obj = $('#login_sub');


        ongoing($('#login_sub'),'登录中...',true);
        $.post("Login", { LoginName: $('#LoginName').val(), Password: Password, VerifyCode: $('#VerifyCode').val(),}, function (data) {
            if (!data.status) {
                _popup(data.info);
                ongoing($('#login_sub'), '登录', false);
                refreshValid();
                return;
            }
            else{
                $.cookie('LoginName',$('#LoginName').val(),{ expires: 865, path: '/' });
                location.href = data.url;
            }

        }, 'json');

    }

    function ongoing(obj, msg, bool) {

        var ba_yc = obj.css('background-color');
        if (bool == true) {
            obj.attr('disabled', 'disabled');
            obj.val(msg).css('background-color', '#777');
        }
        else {
            obj.removeAttr('disabled');
            obj.val(msg).css('background-color', "#00A0E9");
        }


    }
</script>
</body>
</html>