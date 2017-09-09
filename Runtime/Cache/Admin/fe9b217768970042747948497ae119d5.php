<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">问题详情</h4>
</div>
<div class="modal-body">
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <td>类型</td>
                    <td><?php echo ($info["typeName"]); ?></td>
                </tr>
                <tr>
                    <td>标题</td>
                    <td><?php echo ($info["Title"]); ?></td>
                </tr>
                <tr>
                    <td>解决人</td>
                    <td><?php echo ($info["EmpName"]); ?></td>
                </tr>

                <tr>
                    <td>备注</td>
                    <td><?php echo ($info["Note"]); ?></td>
                </tr>
                <tr>
                    <td>描述</td>
                    <td class="col-sm-10 ws"><?php echo ($info["Description"]); ?></td>
                </tr>

            </table>
                <div class="log">
                    <ul>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><li><?php echo ($d["Content"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
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