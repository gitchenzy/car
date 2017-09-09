<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">统计数据</h4>
</div>
<div class="modal-body">
        <fieldset>
            <table class="table table-bordered" id="table">
                <tr>
                    <td>所属人</td>
                    <td><?php echo ($eName); ?></td>
                </tr>
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($v["CtmStatusName"]); ?></td>
                        <td><?php echo ($v["count"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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