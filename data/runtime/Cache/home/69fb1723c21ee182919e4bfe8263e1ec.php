<?php if (!defined('THINK_PATH')) exit();?><ul id="J_focus_img" class="focus_img fr">
    <?php if(is_array($ad_list)): $i = 0; $__LIST__ = $ad_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad): $mod = ($i % 2 );++$i;?><li class="big_slide"><?php echo ($ad["html"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<ul id="J_focus" class="focus_desc">
    <?php if(is_array($ad_list)): $i = 0; $__LIST__ = $ad_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad): $mod = ($i % 2 );++$i;?><li>
        <img src="__UPLOAD__/advert/<?php echo ($ad["extimg"]); ?>">
        <h3><?php echo ($ad["name"]); ?></h3>
        <p><?php echo ($ad["desc"]); ?></p>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>