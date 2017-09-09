<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">实施详情</h4>
</div>
<div class="modal-body">
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <td>实施人</td>
                    <td><?php echo ($info["EmpName"]); ?></td>
                </tr>
                <tr>
                    <td>客户</td>
                    <td><?php echo ($info["CustomerName"]); ?></td>
                </tr>
                <tr>
                    <td>实施结果</td>
                    <td><?php echo ($info["Result"]); ?></td>
                </tr>
                <tr>
                    <td>内容</td>
                    <td><?php echo ($info["Content"]); ?></td>
                </tr>


            </table>
        </fieldset>
</div>