<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">问题详情</h4>
</div>
<div class="modal-body">
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <td>客户</td>
                    <td><?php echo ($info["ShortName"]); ?></td>
                </tr>
                <tr>
                    <td>合同类型</td>
                    <td><?php echo ($info["CttTypeName"]); ?></td>
                </tr>
                <tr>
                    <td>合同编号</td>
                    <td><?php echo ($info["CttNumber"]); ?></td>
                </tr>

                <tr>
                    <td>购买产品</td>
                    <td><?php echo ($info["ProductName"]); ?></td>
                </tr>
                <tr>
                    <td>总金额</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Amount"]); ?></td>
                </tr>
                <tr>
                    <td>维护金额</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Charge"]); ?></td>
                </tr>
                <tr>
                    <td>我方签约人</td>
                    <td class="col-sm-10 ws"><?php echo ($info["OwnSign"]); ?></td>
                </tr>
                <tr>
                    <td>对方签约人</td>
                    <td class="col-sm-10 ws"><?php echo ($info["CtmSign"]); ?></td>
                </tr>
                <tr>
                    <td>我方负责人</td>
                    <td class="col-sm-10 ws"><?php echo ($info["OwnPrincipal"]); ?></td>
                </tr>
                <tr>
                    <td>对方负责人</td>
                    <td class="col-sm-10 ws"><?php echo ($info["CtmPrincipal"]); ?></td>
                </tr>
                <tr>
                    <td>客户地址</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Address"]); ?></td>
                </tr>
                <tr>
                    <td>联系电话</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Telephone"]); ?></td>
                </tr>

                <tr>
                    <td>收款时间</td>
                    <td class="col-sm-10 ws"><?php echo ($info["PlanTime"]); ?></td>
                </tr>
                <tr>
                    <td>签约时间</td>
                    <td class="col-sm-10 ws"><?php echo ($info["SignTime"]); ?></td>
                </tr>
                <tr>
                    <td>生效时间</td>
                    <td class="col-sm-10 ws"><?php echo ($info["BeginTime"]); ?></td>
                </tr>
                <tr>
                    <td>结束时间</td>
                    <td class="col-sm-10 ws"><?php echo ($info["FinishTime"]); ?></td>
                </tr>
                <tr>
                    <td>合同内容</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Introduce"]); ?></td>
                </tr>
            </table>

        </fieldset>

</div>
<div class="modle">

    <img id="modle" src="" alt="暂无图片">
</div>
<style>

    .modle{position: absolute;top: 150px;left: 0;z-index: 9999999999999;display: none;width:80%;}
    .ws img{max-width:800px;}
</style>
<script>
var obj = $('#modle');
    $('img').click(function(){
        if($(this).hasClass('select')){
            $('.modle').hide();
            $(this).removeClass('select')
        }else{
            $('.modle').show();
            var src = $(this).attr('src');
            obj.attr('src',src);
            $(this).addClass('select')
          //  alert(src)
        }

    })
    </script>