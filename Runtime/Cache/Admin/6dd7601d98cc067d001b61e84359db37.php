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
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-edit" plain="true" onclick="btnEdit_Click()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-remove" plain="true" onclick="btnRemove_Click()">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton " iconcls="icon-edit" plain="true" onclick="btnEditAuth_Click()">权限管理</a>
    </div>
    <table id="tg_main"
           class="easyui-datagrid easyui-datagrid-auto"
           style="width:100%; height: 300px;"
           data-offset="0"
           url='<?php echo U("loadUserGroup");?>'
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
            <th field="ID" checkbox="true"></th>
            <th field="StatusName" sortable="true"  align="center">状态</th>
            <th field="DutyName" sortable="true" >用户组名称</th>
            <th field="Description" sortable="true" >描述信息</th>
        </tr>
        </thead>
    </table>


    <script type="text/javascript">
        ///双击行执行编辑
        $("#tg_main").datagrid({
            onDblClickRow: function (index, row) {
                btnEdit_Click(row.ID);
            }
        });
        //编辑按钮点击，打开模态框。模态框关闭时在回调函数中重新加载列表
        function btnEdit_Click(row_id) {
            //获取选中行的id
            if (!row_id) {
                row_id = get_checked_row("#tg_main", "ID");
            }
            if (row_id) {
                top.showModal(
                        '/admin/Employee/editGroup?id=' + row_id,
                        '编辑', //调用语言来设置标题
                        {
                            width: 570,
                            height: 338, //窗口高度
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
                    '/admin/Employee/addGroup'  , //使用C#生成url
                    '新增' , //调用语言来设置标题
                    {
                        width: 570,
                        height: 338, //窗口高度
                        callBack : function() {
                            //窗口关闭回调函数中重新加载列表
                            $("#tg_main").datagrid("reload");
                        }
                    }
            );
        }
        //编辑权限
        function btnEditAuth_Click() {
            //获取选中行的id
            row_id = get_checked_row("#tg_main", "ID");
            if (row_id) {
                top.showModal(
                        '/admin/Employee/editAuthority?id='+row_id,
                        '权限管理' ,
                        {
                            width: 800,
                            height: 800, //窗口高度
                            callBack: function () {
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
            var row_ids = get_checked_rows("#tg_main", "ID");
            if (row_ids && confirm_delete()) {
                $.post(
                        '/admin/Employee/delGroup' ,
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
    </script>

<script type="text/javascript">

</script>
</body>
</html>