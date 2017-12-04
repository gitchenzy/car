<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/Admin/css/zTreeStyle.css" type="text/css">

<div class="content_wrap">
    <div class="zTreeDemoBackground left">
        <ul id="treeDemo" class="ztree"></ul>
    </div>

</div>
<input type="hidden" id="duty" value="<?php echo ($_GET['id']); ?>">
<div class="dialog-button-container">
    <!--<div id="dlg-buttons" class="dialog-button">
        <a href="javascript:doSubmit()" class="btn btn-default" iconcls="icon-ok" style="width: 90px">提交</a>
        <a href="javascript:top.closeModal()" class="btn btn-primary" iconcls="icon-cancel" style="width: 90px">取消</a>
    </div>-->
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close" onclick="javascript:top.closeModal()">关闭</button>
        <button type="button" class="btn btn-primary" id="submit" onclick="javascript:doSubmit();">保存</button>
    </div>
</div>
<script type="text/javascript" src="/Public/Admin/js/jquery.ztree.core.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.ztree.excheck.js"></script>
<script type="text/javascript">
    <!--
    var setting = {
        check: {
            enable: true
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        treeNodeParentKey : "id",
    };

    var zNodes =<?php echo ($res); ?>

    var code;

    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = { "Y" : "ps", "N" : "ps" };

    }
    function showCode(str) {
        if (!code) code = $("#code");
        code.empty();
        code.append("<li>"+str+"</li>");
    }

    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        setCheck();
    });
    //-->
    function doSubmit(){

        var treeObj = $.fn.zTree.getZTreeObj('treeDemo');
        var ids = [];
        var nodes = treeObj.getCheckedNodes(true);
        for(var i=0;i<nodes.length;i++)
        {
            ids[i] = nodes[i].id;

        }
        var id = $('#duty').val();
        $.post("/admin/Employee/modAuthority", {'dutyID':id,'ids':ids}, function (data) {
           alert(data.info);
            if (data.status == 1) {
                //top.closeModal();
                //window.parent.closeModal();
                $("#addCustomer").modal('hide');
            }
        }, 'json');
    }
</script>