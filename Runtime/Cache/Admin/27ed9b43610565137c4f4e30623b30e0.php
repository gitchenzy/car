<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>果园电商CRM后台系统</title>
    <meta name="keywords"/>
    <meta name="description"/>
    <link rel="stylesheet" href='/public/Admin/css/rester.css' />
    <link rel="stylesheet" href='/public/Static/Superfish/superfish.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/default/easyui.css' />
    <link rel="stylesheet" href='/public/Static/EasyUI/themes/icon.css' />
    <link rel="stylesheet" href='/public/Admin/css/style.css' />
    <script type="text/javascript" src='/public/Static/jquery-1.11.2.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/jquery.easyui.min.js'></script>
    <script type="text/javascript" src='/public/Static/EasyUI/locale/easyui-lang-zh_CN.js'></script>
    <script type="text/javascript" src='/public/Static/Superfish/jquery.superfish.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.guoyuan.js?16' id="guoyuan_script"></script>
    <script type="text/javascript" src='/public/Static/jquery.validate.min.js'></script>
    <script type="text/javascript" src='/public/Static/jquery.validate_cn.js'></script>
</head>
<body class="<?php echo ($body_css); ?>">
<div class="panel-header-container <?php echo ($crumbs_hide); ?>">
    <div class="panel-header breadcrumb">
        <a class="fr" href="javascript:top.showHelp('')">
            <i class="icon icon-help"></i>
        </a>
        当前位置：<a href=""><span class="text">系统</span></a><span class="splitter"> > </span><a><span class="text"><?php echo ($crumbs_title); ?></span></a>
    </div>
</div>


    <div id="toolbar" class="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-add" plain="true" onclick="btnAdd_Click()">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-edit" plain="true" onclick="btnEdit_Click()">查看编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-edit" plain="true" onclick="btnReceive_Click()">领取问题</a>
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-remove" plain="true" onclick="btnRemove_Click()">删除</a>
    </div>
    <div class="search-bar" id="search-bar">
        <table>
            <tr>
                <th width="100px">
                    <select id="search_key" name="search_key" style=" width: 100px">
                        <option selected="selected" value="Title">问题标题</option>
                    </select>
                </th>
                <td width="300px">
                    <input class="" id="search_value" name="search_value" type="text" value="" />
                    <a id="btn-search" href="javascript:doSearch()" class="easyui-linkbutton" data-options="iconCls:'icon-search'">搜索</a>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
    <table id="tg_main"
           class="easyui-datagrid easyui-datagrid-auto"
           style="width:100%; height: 300px;"
           data-offset="0"
           url='<?php echo U("loadDemand");?>'
           title=""
           iconCls="icon-list"
           rownumbers="true"
           sortName="Sort"
           sortOrder="asc"
           pagination="true"
           pageSize="20"
           pageList="[10,20,50,100,200]">
        <thead>
        <tr>
            <th field="FeedbackID" checkbox="true"></th>
            <th field="CustomerName" sortable="true"  align="center">客户</th>
            <th field="Title" sortable="true" >问题标题</th>
            <th field="FbPriorityName" sortable="true" >问题优先级</th>
            <th field="Description" sortable="true" >问题描述</th>
            <th field="type" sortable="true" >问题类型</th>
            <th field="Note" sortable="true" >问题备注</th>
            <th field="FbTime"  >提交时间</th>

        </tr>
        </thead>
    </table>


    <script type="text/javascript">
        ///双击行执行编辑
        $("#tg_main").datagrid({
            onDblClickRow: function (index, row) {
                btnEdit_Click(row.FeedbackID);
            }
        });
        //编辑按钮点击，打开模态框。模态框关闭时在回调函数中重新加载列表
        function btnEdit_Click(row_id) {
            //获取选中行的id
            if (!row_id) {
                row_id = get_checked_row("#tg_main", "FeedbackID");
            }
            if (row_id) {
                top.showModal(
                        '/admin/Customer/editDemand?id=' + row_id,
                        '编辑', //调用语言来设置标题
                        {
                            width: 870,
                            height: 590, //窗口高度
                            callBack : function() {
                                //窗口关闭回调函数中重新加载列表
                                $("#tg_main").datagrid("reload");
                            }
                        }
                );
            }
        }

        //新增按钮点击，打开模态框。模态框关闭时在回调函数中重新加载列表
        function btnAdd_Click() {
            top.showModal(
                    '/admin/Customer/addDemand'  , //使用C#生成url
                    '新增' , //调用语言来设置标题
                    {
                        width: 870,
                        height: 590, //窗口高度
                        callBack : function() {
                            //窗口关闭回调函数中重新加载列表
                            $("#tg_main").datagrid("reload");
                        }
                    }
            );
        }
        //领取问题
        function btnReceive_Click(){
            var row_id = get_checked_row("#tg_main", "FeedbackID");
            if(row_id){
                top.showModal(
                        '/admin/Customer/receiveDemand'  , //使用C#生成url
                        '领取问题' , //调用语言来设置标题
                        {
                            width: 870,
                            height: 590, //窗口高度
                            callBack : function() {
                                //窗口关闭回调函数中重新加载列表
                                $("#tg_main").datagrid("reload");
                            }
                        }
                );
            }

        }

        //删除点击
        function btnRemove_Click() {
            //获取当前勾选的所有行id
            var row_ids = get_checked_rows("#tg_main", "FeedbackID");
            if (row_ids && confirm_delete()) {
                $.post(
                        '/admin/Customer/delDemand' ,
                        {
                            ids : row_ids
                        },
                        function(data) {
                            if (data.status == 0) {
                                show_alert(data.info);//删除失败弹出提示
                            }
                            $("#tg_main").datagrid("reload");
                        } ,
                        'json'
                );
            }
        }
        function doSearch() {
            //搜索的键值对，这里将search-bar里面的所有输入框和下拉框的值转化成数组
            var map_search = $("input,select", "#search-bar").serializeObject();
            //促发加载时间，并传入搜索值
            $('#tg_main').datagrid('load', map_search);
        }
    </script>

<script type="text/javascript">

</script>
</body>
</html>