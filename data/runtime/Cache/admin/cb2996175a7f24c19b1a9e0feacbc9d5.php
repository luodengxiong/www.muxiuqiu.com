<?php if (!defined('THINK_PATH')) exit();?><!doctype html><html><head><meta charset="utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><link href="__STATIC__/css/admin/style.css" rel="stylesheet"/><title><?php echo L('website_manage');?></title><script>	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?></script></head><body><div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div><?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav"><div class="content_menu ib_a blue line_x"><?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a>　<?php endif; if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?><a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo L($val['name']);?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?></div></div><?php endif; ?><!--商品地址批量添加--><div class="subnav"><h1 class="title_2 line_x">淘宝评论采集</h1></div><div class="pad_lr_10"><form id="J_info_form" action="<?php echo U('cmt_taobao/setting');?>" method="post"><table width="100%" cellspacing="0" class="table_form"><tr><th width="150">采集分类 :</th><td><select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>"></select></td></tr><tr><th>优先级 :</th><td><select name="priority"><option value="add_time">发布时间</option><option value="likes">喜欢数</option><option value="hits">访问量</option><option value="rates">佣金比率</option></select></td></tr><tr><th>每批商品数量 :</th><td><input type="text" name="pagesize" size="4" class="input-text" value="10" /></td></tr><tr><th>每个商品评论数量 :</th><td><input type="text" name="cmt_num" size="4" class="input-text" value="20" /></td></tr><tr><th>采集马甲 :</th><td><select name="auid"><?php if(is_array($auto_user)): $i = 0; $__LIST__ = $auto_user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?></select></td></tr><tr><th></th><td><input type="submit" value="<?php echo L('submit');?>" name="dosubmit" class="btn btn_submit"></td></tr></table><input type="hidden" name="cate_id" id="J_cate_id" value="0" /></form></div><script src="__STATIC__/js/jquery/jquery.js"></script><script src="__STATIC__/js/jquery/plugins/jquery.tools.min.js"></script><script src="__STATIC__/js/jquery/plugins/formvalidator.js"></script><script src="__STATIC__/js/pinphp.js"></script><script src="__STATIC__/js/admin.js"></script><script>//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script><?php if(isset($list_table)): ?><script src="__STATIC__/js/jquery/plugins/listTable.js"></script><script>$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?><script>$(function(){
    var collect_url = "<?php echo U('cmt_taobao/collect');?>";

    $('#J_info_form').ajaxForm({beforeSubmit:cmtcheck, success:complete, dataType:'json'});
    function cmtcheck(){
        if($('#J_cate_id').val()=='0'){
            $.pinphp.tip({content:lang.please_select+lang.item_cate, icon:'alert'});
            return false;
        }
        if($('#J_auid').val()=='0'){
            $.pinphp.tip({content:lang.please_select+lang.auto_user, icon:'alert'});
            return false;
        }
    }
    var p = 1;
    function complete(result){
        if(result.status == 1){
            //开始采集
            $.dialog({id:'cmt_taobao', title:result.msg, content:result.data, padding:'', lock:true});
            p = 1;
            collect_page();
        } else {
            $.pinphp.tip({content:result.msg, icon:'alert'});
        }
    }
    function collect_page(){
        $.getJSON(collect_url, {p:p}, function(result){
            if(result.status == 1){
                $.dialog.get('cmt_taobao').content(result.data);
                p++;
                collect_page(p);
            }else{
                $.dialog.get('cmt_taobao').close();
                $.pinphp.tip({content:result.msg});
            }
        });
    }
    //分类联动
    $('.J_cate_select').cate_select({field:'J_cate_id'});
});
</script></body></html>