<?php if (!defined('THINK_PATH')) exit();?> <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="vertical-timeline-block">
        <div class="vertical-timeline-icon <?php echo ($class["yanse"]); ?>">
            <i class="fa <?php echo ($class["tubiao"]); ?>"></i>
        </div>

        <div class="vertical-timeline-content">
            <h2><?php echo ($data["Result"]); ?></h2>
            <p><?php echo (htmlspecialchars_decode($data["Content"])); ?></p>
            <span class="vertical-date">
                             跟进人:<?php echo ($data["EmpName"]); ?>                <br>
                                            <small><?php echo ($data["time"]); ?></small>
            </span>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>