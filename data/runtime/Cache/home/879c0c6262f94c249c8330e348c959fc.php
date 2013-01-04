<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo ($page_seo["title"]); ?> - Powered by PinPHP</title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>" />
<meta name="description" content="<?php echo ($page_seo["description"]); ?>" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/default/base.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/default/style.css" />
<script src="__STATIC__/js/jquery/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/default/album.css" />
</head>
<body>
<!--头部开始-->
<div class="header_wrap pt10">
    <div id="J_m_head" class="m_head clearfix">
        <div class="head_logo fl"><a href="__ROOT__/" class="logo_b fl" title="<?php echo C('pin_site_name');?>"><?php echo C('pin_site_name');?></a></div>
        <div class="head_user fr">
            <?php if(!empty($visitor)): ?><ul class="head_user_op">
                <li class="mr10"> 
                    <a class="J_shareitem_btn share_btn" href="javascript:;" title="<?php echo L('share');?>"><?php echo L('share');?></a>
                </li>
                <li class="J_down_menu_box mb_info pos_r">
                    <a href="<?php echo U('space/index', array('uid'=>$visitor['id']));?>" class="mb_name">
                        <img class="mb_avt r3" src="<?php echo avatar($visitor['id'], 24);?>">
                        <?php echo ($visitor["username"]); ?>
                    </a>
                    <ul class="J_down_menu s_m pos_a">
                        <li><a href="<?php echo U('space/index');?>"><?php echo L('cover');?></a></li>
                        <li><a href="<?php echo U('user/index');?>"><?php echo L('personal_settings');?></a></li>
                        <li><a href="<?php echo U('user/bind');?>"><?php echo L('user_bind');?></a></li>
                        <li><a href="<?php echo U('user/logout');?>"><?php echo L('logout');?></a></li>
                    </ul>
                </li>
                <li><a class="libg feed" href="<?php echo U('space/me');?>"><?php echo L('feed');?></a></li>
                <li><a class="libg album" href="<?php echo U('space/album');?>"><?php echo L('album');?></a></li>
                <li><a class="libg like" href="<?php echo U('space/like');?>"><?php echo L('like');?></a></li>
                <li class="J_down_menu_box my_shotcuts pos_r">
                    <a class="libg msg" href="javascript:;"><?php echo L('message');?><span id="J_msgtip"></span></a>
                    <ul class="J_down_menu s_m n_m pos_a">
                        <li><a href="<?php echo U('space/atme');?>"><?php echo L('talk');?><span id="J_atme"></span></a></li>
                        <li><a href="<?php echo U('message/index');?>"><?php echo L('my_msg');?><span id="J_msg"></span></a></li>
                        <li><a href="<?php echo U('message/system');?>"><?php echo L('system_msg');?><span id="J_system"></span></a></li>
                        <li><a href="<?php echo U('space/fans');?>"><?php echo L('my_fans');?><span id="J_fans"></span></a></li>
                    </ul>
                </li>
            </ul>
            <?php else: ?>
            <ul class="login_mod">
                <li class="local fl">
                    <a href="<?php echo U('user/register');?>"><?php echo L('register');?></a>
                    <a href="<?php echo U('user/login');?>"><?php echo L('login');?></a>
                </li>
                <li class="other_login fl">
                    <?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U('oauth/index', array('mod'=>$val['code']));?>" class="login_bg weibo_login"><img src="__STATIC__/images/oauth/<?php echo ($val["code"]); ?>/icon.png" /><?php echo ($val["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </li>
            </ul><?php endif; ?>
        </div>
    </div>
    <div id="J_m_nav" class="clearfix">
        <ul class="nav_list fl">
            <li <?php if($nav_curr == 'index'): ?>class="current"<?php endif; ?>><a href="__ROOT__/"><?php echo L('index_page');?></a></li>

            <?php $tag_nav_class = new navTag;$data = $tag_nav_class->lists(array('type'=>'lists','style'=>'main','cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="split <?php if($nav_curr == $val['alias']): ?>current<?php endif; ?>"><a href="<?php echo ($val["link"]); ?>" <?php if($val["target"] == 1): ?>target="_blank"<?php endif; ?>><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            <li class="top_search">
                <form action="__ROOT__/" method="get" target="_blank">
                <input type="hidden" name="m" value="search">
                <input type="text" autocomplete="off" def-val="<?php echo C('pin_default_keyword');?>" value="<?php echo C('pin_default_keyword');?>" class="ts_txt fl" name="q">
                <input type="submit" class="ts_btn" value="<?php echo L('search');?>">
                </form>
            </li>
        </ul>
    </div>
</div>
<div class="main_wrap">

    <div class="album_nav pt10">
        <span><a href="<?php echo U('album/index');?>"><?php echo L('album');?></a></span>/
        <span><a href="<?php echo U('space/album', array('uid'=>$album['uid']));?>"><?php echo ($album["uname"]); echo L('for_album');?></a></span>
    </div>

    <div class="album_cover r3" <?php if(!empty($album['banner'])): ?>style="background:url(<?php echo attach($album['banner'], 'album');?>);"<?php endif; ?>>
        <div class="album_title_info rr5"><h1 class="album_title fl"><?php echo ($album["title"]); ?></h1></div>
    </div>
    <?php if($album['uid'] == $visitor['id']): ?><div class="J_album_item add_album_content" data-aid="<?php echo ($album["id"]); ?>">
        <a href="javascript:;" class="J_shareitem_btn fl add_album_content_btn" data-aid="<?php echo ($album["id"]); ?>"><?php echo L('album_add_item');?></a>
        <a href="javascript:;" class="J_edit fl edit"><?php echo L('edit');?></a>
        <a href="javascript:;" class="J_del fl delete"><?php echo L('delete');?></a>
    </div><?php endif; ?>
    <div class="wall_wrap clearfix">
        <div id="J_waterfall" class="wall_container album_item_list clearfix" data-uri="__ROOT__/?m=album&a=detail_ajax&id=<?php echo ($album["id"]); ?>&p=<?php echo ($p); ?>" data-distance="1200">
            <div class="J_item album_info">
                <div class="user_info clearfix">
                    <a href="<?php echo U('space/index', array('uid'=>$album['uid']));?>" target="_blank"><img src="<?php echo avatar($album['uid'], '48');?>" class="J_card fl r3" data-uid="<?php echo ($album["uid"]); ?>" alt="<?php echo ($album["uname"]); ?>"></a>
                    <div class="user_name">
                        <a href="<?php echo U('space/index', array('uid'=>$album['uid']));?>" class="J_card clr6 bold" data-uid="<?php echo ($album["uid"]); ?>" target="_blank"><?php echo ($album["uname"]); ?></a>
                        <?php if($album['uid'] != $visitor['id']): ?><div class="J_follow_bar" data-uid="<?php echo ($album["uid"]); ?>">
                            <?php if($author_ship == 0): ?><a href="javascript:;" class="J_fo_u fo_u_btn"><?php echo L('follow');?></a>
                            <?php elseif($author_ship == 1): ?>
                            <span class="fo_u_ok"><?php echo L('followed');?></span><a href="javascript:;" class="J_unfo_u green"><?php echo L('cancel');?></a>
                            <?php elseif($author_ship == 2): ?>
                            <span class="fo_u_all"><?php echo L('follow_mutually');?></span><a href="javascript:;" class="J_unfo_u green"><?php echo L('cancel');?></a><?php endif; ?>
                        </div><?php endif; ?>
                    </div>
                    <div class="user_collect_info">
                        <span><?php echo L('item');?><b><?php echo ($album["items"]); ?></b></span>
                        <span><?php echo L('like');?><b><?php echo ($album["likes"]); ?></b></span>
                        <span><?php echo L('follow');?><b><?php echo ($album["follows"]); ?></b></span>
                    </div>
                </div>
                <?php if(!empty($album['intro'])): ?><div class="album_intro"><?php echo ($album["intro"]); ?></div><?php endif; ?>
                <div class="more_albums">
                    <h3><a href="<?php echo U('space/album', array('uid'=>$album['uid']));?>" class="all" target="_blank"><?php echo L('show_all');?></a><?php echo L('author_more_album');?></h3>
                    <ul>
                        <?php $tag_album_class = new albumTag;$data = $tag_album_class->lists(array('type'=>'lists','num'=>'10','uid'=>$album['uid'],'cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('album/detail', array('id'=>$val['id']));?>" target="_blank"><span class="num"><?php echo ($val["items"]); echo L('item');?></span><?php echo ($val["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <?php if(is_array($item_list)): $i = 0; $__LIST__ = $item_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="J_item wall_item">

        <?php if(isset($like_manage)): ?><a href="javascript:;" class="J_unlike del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>"></a><?php endif; ?>

        <?php if(isset($album_manage)): if($album['uid'] == $visitor['id']): ?><a href="javascript:;" class="J_delitem del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>" data-aid="<?php echo ($album["id"]); ?>"></a><?php endif; ?>
        <?php else: ?>
        <?php if($item['uid'] == $visitor['id']): ?><a href="javascript:;" class="J_delitem del_item" title="<?php echo L('delete');?>" data-id="<?php echo ($item["id"]); ?>"></a><?php endif; endif; ?>

        <!--图片-->
        <ul class="pic">
            <li>
                <a href="<?php echo U('item/index', array('id'=>$item['id']));?>" title="<?php echo ($item["title"]); ?>" target="_blank"><img alt="<?php echo ($item["title"]); ?>" class="J_img J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($item['img'], '_m'), 'item'));?>"></a>
                <span class="p">¥<?php echo ($item["price"]); ?></span>
                <a href="javascript:;" class="J_joinalbum addalbum_btn" data-id="<?php echo ($item["id"]); ?>"></a>
            </li>
        </ul>
        <!--操作-->
        <div class="favorite"> 
            <a href="javascript:;" class="J_likeitem like" data-id="<?php echo ($item["id"]); ?>" <?php if(isset($album)): ?>data-aid="<?php echo ($album["id"]); ?>"<?php endif; ?>><?php echo L('like');?></a>
            <div class="J_like_n like_n <?php if($item['likes'] == 0): ?>hide<?php endif; ?>"><a href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank"><?php echo ($item["likes"]); ?></a><i></i></div>
            
            <?php if($item['comments'] > 0): ?><span class="creply_n">(<a href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank"><?php echo ($item["comments"]); ?></a>)</span><?php endif; ?>
            <a class="creply" href="<?php echo U('item/index', array('id'=>$item['id']));?>" target="_blank"><?php echo L('comment');?></a> 
        </div>
        <!--作者-->
        <?php if(!empty($item['uname'])): ?><div class="author clearfix">
            <a href="<?php echo U('space/index', array('uid'=>$item['uid']));?>" target="_blank">
                <img class="J_card avt fl r3" src="<?php echo avatar($item['uid'], '32');?>" data-uid="<?php echo ($item["uid"]); ?>" />
            </a>
            <div>
                <a href="<?php echo U('space/index', array('uid'=>$item['uid']));?>" class="J_card clr6 bold" target="_blank" data-uid="<?php echo ($item["uid"]); ?>"><?php echo ($item["uname"]); ?></a><br>
            </div>
        </div><?php endif; ?>
        <!--说明-->
        <p class="intro clr6"><?php echo ($item["intro"]); ?></p>
        <!--评论-->
        <?php if(!empty($item['comment_list'])): ?><ul class="rep_list">
            <?php $__FOR_START_21740__=0;$__FOR_END_21740__=C('pin_item_cover_comments');for($i=$__FOR_START_21740__;$i < $__FOR_END_21740__;$i+=1){ if(!empty($item['comment_list'][$i])): ?><li class="rep_f">
                <a href="<?php echo U('space/index', array('uid'=>$item['comment_list'][$i]['uid']));?>" target="_blank">
                    <img src="<?php echo avatar($item['comment_list'][$i]['uid'], 24);?>" class="J_card avt fl r3" alt="<?php echo ($item['comment_list'][$i]['uname']); ?>" data-uid="<?php echo ($item['comment_list'][$i]['uid']); ?>">
                </a>
                <p class="rep_content"><a href="<?php echo U('space/index', array('uid'=>$item['comment_list'][$i]['uid']));?>" class="J_card n" target="_blank" data-uid="<?php echo ($item['comment_list'][$i]['uid']); ?>"><?php echo ($item['comment_list'][$i]['uname']); ?></a>  <?php echo ($item['comment_list'][$i]['info']); ?></p>
            </li><?php endif; } ?>
        </ul><?php endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php if(isset($show_load)): ?><div id="J_wall_loading" class="wall_loading tc gray"><span><?php echo L('loading');?></span></div><?php endif; ?>
        
        <?php if(isset($page_bar)): ?><div id="J_wall_page" class="wall_page" <?php if(isset($show_page)): ?>style="display:block;"<?php endif; ?>>
            <div class="page_bar"><?php echo ($page_bar); ?></div>
        </div><?php endif; ?>
    </div>

    <div class="album_about">
        <div id="J_albumcmt_area" class="album_pub fl" data-aid="<?php echo ($album["id"]); ?>">
            <h3><?php echo L('album_cmt_title');?></h3>
            <div class="pub_area">
                <div class="pub_area_bd">
                    <textarea id="J_albumcmt_content" class="pub_txt" def-val="<?php echo L('album_cmt_def');?>"><?php echo L('album_cmt_def');?></textarea>
                </div>
                <div class="pub_area_ft">
                    <a href="javascript:;" id="J_albumcmt_submit" class="btn fr"><?php echo L('ok');?></a>
                </div>
            </div>  
            <div class="note_comment">
                <ul id="J_albumcmt_list" class="c_l rb5">
                    <?php if(is_array($cmt_list)): $i = 0; $__LIST__ = $cmt_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li> 
                        <a href="<?php echo U('space/index', array('uid'=>$val['uid']));?>" target="_blank"><img src="<?php echo avatar($val['uid'], 48);?>" class="J_card avt" data-uid="<?php echo ($val["uid"]); ?>" /></a>
                        <p><a href="<?php echo U('space/index', array('uid'=>$val['uid']));?>" class="J_card n" data-uid="<?php echo ($val["uid"]); ?>" target="_blank"><?php echo ($val["uname"]); ?></a></p>
                        <p><?php echo ($val["info"]); ?><span>&nbsp;&nbsp;&nbsp;<?php echo (fdate($val["add_time"])); ?></span></p>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div id="J_albumcmt_page" class="page_bar"><?php echo ($cmt_page_bar); ?></div>
            </div>
        </div>
        <div class="album_reco fl">
            <h3><?php echo L('album_follow_title');?></h3>
            <div class="album_look">
                <?php if(isset($is_followed)): ?><a href="javascript:;" class="J_unfollow_album album_unlook_link fl" data-aid="<?php echo ($album["id"]); ?>"><?php echo L('unfollow_album');?></a> 
                <?php else: ?>
                <a href="javascript:;" class="J_follow_album album_look_link fl" data-aid="<?php echo ($album["id"]); ?>"><?php echo L('follow_album');?></a><?php endif; ?>
                <p class="fl"><span id="J_afn_<?php echo ($album["id"]); ?>"><?php echo ($album["follows"]); ?></span>人</p>
            </div>
            <div class="album_share">
            <h3><?php echo L('album_share_title');?>：</h3>
                <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
                <a class="bds_tsina"></a>
                <a class="bds_qzone"></a>
                <a class="bds_tqq"></a>
                <a class="bds_renren"></a>
                <span class="bds_more"></span>
                </div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->
            </div>
        </div>
        <div class="album_guess fl">
            <h3><a target="_blank" href="<?php echo U('album/index');?>" class="all fr"><?php echo L('show_all');?></a><?php echo L('album_guess_title');?></h3>
            <ul class="album_guess_list">
                <?php if(is_array($album_guess)): $i = 0; $__LIST__ = $album_guess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="J_album_item album_item">
                    <div class="album_author">
                        <a target="_blank" href="<?php echo U('space/index', array('uid'=>$val['uid']));?>">
                        <img src="<?php echo avatar($val['uid'], '32');?>" class="J_card avt fl " data-uid="<?php echo ($val["uid"]); ?>" alt="<?php echo ($val["uname"]); ?>">
                        </a>
                        <div class="album_info">
                            <p><a title="<?php echo ($val["title"]); ?>" href="<?php echo U('album/detail', array('id'=>$val['id']));?>" class="album_title" target="_blank"><?php echo ($val["title"]); ?></a></p>
                            <p class="u_link"><a href="<?php echo U('space/index', array('uid'=>$val['uid']));?>" class="J_card n" data-uid="<?php echo ($val["uid"]); ?>" target="_blank"><?php echo ($val["uname"]); ?></a></p>
                        </div>
                    </div>
                    <ul>
                        <?php $__FOR_START_16565__=0;$__FOR_END_16565__=C('pin_album_cover_items');for($i=$__FOR_START_16565__;$i < $__FOR_END_16565__;$i+=1){ ?><li class="<?php if($i == 0): ?>big<?php elseif($i == 1): ?>left small<?php else: ?>small<?php endif; ?>">
                            <?php if(isset($val['cover'][$i])): if($i == 0): ?><img class="J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($val['cover'][$i]['img'], '_m'), 'item'));?>" />
                            <?php else: ?>
                            <img class="J_decode_img" data-uri="<?php echo base64_encode(attach(get_thumb($val['cover'][$i]['img'], '_s'), 'item'));?>" /><?php endif; endif; ?>
                        </li><?php } ?>
                    </ul>
                    <a href="<?php echo U('album/detail', array('id'=>$val['id']));?>" class="album_link" target="_blank"></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

</div>
<div class="w960"><?php echo R('advert/index', array(11), 'Widget');?></div>
<div class="footer_wrap rt10">
    <a href="__APP__" class="foot_logo"></a>
    <div class="foot_links clearfix">
        <dl class="foot_nav fl">
            <dt><?php echo L('site_nav');?></dt>
            <?php $tag_nav_class = new navTag;$data = $tag_nav_class->lists(array('type'=>'lists','style'=>'bottom','cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dd><a href="<?php echo ($val["link"]); ?>" <?php if($val["target"] == 1): ?>target="_blank"<?php endif; ?>><?php echo ($val["name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>
        <dl class="aboutus fl">
            <dt><?php echo L('aboutus');?></dt>
            <?php $tag_article_class = new articleTag;$data = $tag_article_class->cate(array('type'=>'cate','cateid'=>'1','cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dd><a href="<?php echo U('aboutus/index', array('id'=>$val['id']));?>" target="_blank"><?php echo ($val["name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>
        <dl class="flinks fr">
            <dt><?php echo L('flink');?></dt>
            <?php $data = S('36cd2015820ec8da2a165ad5dfc0c797');if (false === $data) { $tag_flink_class = new flinkTag;$data = $tag_flink_class->lists(array('cache'=>'3600','num'=>'5','return'=>'data','type'=>'lists',));S('36cd2015820ec8da2a165ad5dfc0c797', $data, 3600); } if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dd><a href="<?php echo ($val["url"]); ?>" target="_blank"><?php echo ($val["name"]); ?></a></dd><?php endforeach; endif; else: echo "" ;endif; ?>
            <dd><a href="<?php echo U('aboutus/flink');?>" class="more" target="_blank"><?php echo L('more');?>...</a></dd>
        </dl>
        <?php echo R('advert/index', array(8), 'Widget');?>
    </div>
    <p class="pt20">Powered by <a href="http://www.pinphp.com/" class="tdu clr6" target="_blank">PinPHP <?php echo (PIN_VERSION); ?> <?php echo (PIN_RELEASE); ?></a> &copy;Copyright 2010-2012 <a href="__ROOT__/" class="tdu clr6" target="_blank"><?php echo C('pin_site_name');?></a> (<a href="http://www.miibeian.gov.cn" class="tdu clr6" target="_blank"><?php echo C('pin_site_icp');?></a>)<?php echo C('pin_statistics_code');?></p>
</div>
<div id="J_returntop" class="return_top"></div>

<script>
var PINER = {
    root: "__ROOT__",
    uid: "<?php echo $visitor['id'];?>", 
    async_sendmail: "<?php echo $async_sendmail;?>",
    config: {
        wall_distance: "<?php echo C('pin_wall_distance');?>",
        wall_spage_max: "<?php echo C('pin_wall_spage_max');?>"
    },
    //URL
    url: {}
};
//语言项目
var lang = {};
<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__STATIC__/js/jquery/plugins/jquery.tools.min.js,__STATIC__/js/jquery/plugins/jquery.masonry.js,__STATIC__/js/jquery/plugins/formvalidator.js,__STATIC__/js/fileuploader.js,__STATIC__/js/pinphp.js,__STATIC__/js/front.js,__STATIC__/js/dialog.js,__STATIC__/js/wall.js,__STATIC__/js/item.js,__STATIC__/js/user.js,__STATIC__/js/album.js','cache'=>'0','return'=>'data',));?>
<script src="__STATIC__/js/albumcmt.js"></script>
</body>
</html>