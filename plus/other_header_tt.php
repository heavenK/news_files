<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="/styles/hellodalian_third/end.css" rel="stylesheet" type="text/css"/>
<link href="/styles/hellodalian_third/reset_ttt.css" rel="stylesheet" type="text/css"/>
<link href="/styles/hellodalian_third/tonglan02.css" rel="stylesheet" type="text/css"/>
<script src="/js/hellodalian_third/jquery-1.4.2.js" type="text/javascript"></script>
<SCRIPT src="/js/hellodalian_third/tbhb.js" type=text/javascript></SCRIPT>
<LINK href="/styles/hellodalian_third/css.css" type=text/css rel=stylesheet>
</head>

<body>
	<style>
    	#all_channel_header					{ width:980px; line-height:16px; height:28px; float:left;}
		#all_channel_header dt				{ height:28px; float:right;}
		#all_channel_header dt i			{ height:15px; margin:11px 2px 0; display:inline; color:#666666; float:right;}
		#all_channel_header dt em			{ height:15px; margin:11px 2px 0; display:inline; color:#0035a0; float:right;}
		#all_channel_header dt a			{ height:15px; margin:11px 0 0 0; display:inline; color:#0035a0; float:right;}
		#all_channel_header dt span			{ width:77px; height:31px; margin:5px 3px 0 0; display:inline; position:relative; float:right;}
		#all_channel_header dt span em		{ width:65px; height:14px; margin:0; padding:0 0 0 12px; background:url(/images/hellodalian_third/all_channel_header_pic.gif) no-repeat 0 5px; color:#ff7f00; position:absolute; top:6px; left:9px; z-index:3000; cursor:pointer; float:none;}
		#all_channel_header dt span b		{ width:75px; height:30px; background:#FFF; border:#bfbfbf 1px solid; border-bottom:none; position:absolute; top:0px; left:0px; z-index:2000;}
		#all_channel_header dt span i		{ width:366px; height:118px; background:#FFF; border:#bfbfbf 1px solid; position:absolute; top:19px; left:-2px; z-index:1000;}
		#all_channel_header dt span ul		{ width:366px; height:107px; margin:8px 0 0 0; display:inline; background:url(/images/hellodalian_third/all_channel_header_box_bg.gif); float:left;}
		#all_channel_header dt span ul li	{ width:366px; height:25px; padding:11px 13px 0 13px; overflow:hidden; float:left;}
		#all_channel_header dt span ul li pre{ height:15px; background:url(/images/hellodalian_third/all_channel_header_pic_02.gif) no-repeat 0 3px; overflow:hidden; float:left;}
		#all_channel_header dt span ul li a	{ margin:0 13px; display:inline; color:#0035a0; float:left;}
		#all_channel_header dd				{ height:36px; float:right;}
		#all_channel_header dd a			{ margin:11px 13px 0 0; display:inline; float:right;}
		#all_channel_header dd span			{ width:77px; height:31px; margin:5px 3px 0 0; display:inline; position:relative; float:right;}
		#all_channel_header dd span em		{ width:65px; height:14px; padding:0 0 0 12px; font-style:normal; background:url(/images/hellodalian_third/all_channel_header_pic.gif) no-repeat 0 5px; color:#ff7f00; position:absolute; top:6px; left:9px; z-index:3000; cursor:pointer;}
		#all_channel_header dd span b		{ width:75px; height:30px; background:#FFF; border:#bfbfbf 1px solid; border-bottom:none; position:absolute; top:0px; left:0px; z-index:2000;}
		#all_channel_header dd span i		{ width:366px; height:118px; font-style:normal; background:#FFF; border:#bfbfbf 1px solid; position:absolute; top:30px; left:0; z-index:1000;}
		#all_channel_header dd span ul		{ width:366px; height:107px; margin:8px 0 0 0; display:inline; background:url(/images/hellodalian_third/all_channel_header_box_bg.gif); float:left;}
		#all_channel_header dd span ul li	{ width:360px; height:25px; padding:11px 13px 0 13px; overflow:hidden; float:left;}
		#all_channel_header dd span ul li pre{ height:16px; background:url(/images/hellodalian_third/all_channel_header_pic_02.gif) no-repeat 0 3px; overflow:hidden; float:left;}
		#all_channel_header dd span ul li a	{ margin:0 13px; display:inline; color:#0035a0; float:left;}
		#all_channel_head					{width:391px; height:27px; overflow:hidden; float:right; text-align:right; line-height:27px;}
		#all_channel_head a					{color:#016599}
    </style>
    
    <div id="box" style="width:980px;">   
    <dl id="all_channel_header"><!--频道通用头部-->
    	<div class="all_channel_logo" style="width:150px; overflow:hidden; float:left;"><!--xg-->
    		<a href="http://www.we54.com/" target="_blank" style=" margin:0 0 0 0px; display:inline; overflow:hidden; float:left;"><img src="/images/hellodalian_third/new_logo.jpg" /></a>
        	<em style="line-height:28px; "><a href="http://www.we54.com/" target="_blank" style="color:#999999;"> 返回首页</a></em>
        </div>
        
        <div id="all_channel_head" style="color:#9f9f9f;">
        		<?php
				require_once(dirname(__FILE__)."/../include/common.inc.php");
				require_once(DEDEINC."/filter.inc.php");
				
				session_start();
				if($_SESSION["Zend_Auth"]['storage']->nickname) { 
				 
							 echo "<a href=\"http://bbs.we54.com/memcp.php\" target=\"_blank\" style=\" height:18px; margin:8px 3px 0 0; padding:3px 0 0 13px; color:#0035a0;\">您好！".$_SESSION["Zend_Auth"]['storage']->nickname." </a><a href=\"http://bbs.we54.com/pm.php\" target=\"_blank\" style=\" height:18px; margin:8px 13px 0 0; padding:3px 0 0 8px; border-left:#d5d5d5 1px solid; color:#0035a0;\">短消息</a><a href=\"http://passport.we54.com/Index/logout?forward=".$_GET['forward']."\" style=\" color:#0035a0; margin:0 7px 0 0;\">退出</a><a href=\"http://passport.we54.com/index/we54vip\" target=\"_blank\" style=\" color:#ff7f00; margin:0 7px 0 0;\">申请认证</a><a href=\"http://bbs.we54.com/memcp.php\" target=\"_blank\" style=\" color:#0035a0;\">用户中心</a>";
							 }else	{ 
											
									echo "<i>您好！请 </i><a href=\"http://passport.we54.com/Index/login?forward=".$_GET['forward']."\" target=\"_parent\">登录</a><i> 或 </i><a href=\"http://passport.we54.com/Index/register\" target=\"_blank\">注册</a><i> | </i>";
									}
									                       
				?>
                <a title="http://www.we54.com" onclick=this.style.behavior="url(#default#homepage)";this.setHomePage("http://www.we54.com");return false; style="cursor:hand">设为首页</a>
        </div>
    </dl>
    
   
    
    <div class="main_nav"><!--顶部主导航-->
		<ul class="nav_a">
			<li><a href="http://news.we54.com" target="_blank" style="font-weight:bold;">资讯</a></li>
			<li><a href="http://news.we54.com/we54/dlnhzt/wq" target="_blank">专题</a></li>
			<li><a href="http://pic.we54.com" target="_blank">图片</a></li>
			<li><a href="http://news.we54.com/opinion" target="_blank" style="color:#ff0000;">评论</a></li>
            <li><a href="http://video.we54.com" target="_blank" style="font-weight:bold;">视频</a></li>
            <li><a href="http://news.we54.com/plus/list.php?tid=469" target="_blank">独家</a></li>
            <li><a href="http://news.we54.com/plus/list.php?tid=899" target="_blank">娱乐</a></li>
            <li><a href="http://news.we54.com/plus/list.php?tid=864" target="_blank">访谈</a></li>
		</ul>
		<h1><img src="/images/hellodalian_third/top_line.jpg" width="1" height="64" border="0" /></h1>
		<ul class="nav_b">
			<li><a href="http://moda.we54.com/" target="_blank" style="font-weight:bold;">美达</a></li>
			<li><a href="http://54class.we54.com/" target="_blank">五年四班</a></li>
			<li><a href="http://lichi.we54.com/" target="_blank">荔枝先生</a></li>
			<li><a href="http://bbs.we54.com/forumdisplay.php?fid=898&page=1" target="_blank" style="font-weight:bold; color:#ff0000;">活动</a></li>
            <li><a href="http://news.we54.com/xqnsppd/pdwshsp/index.html" target="_blank">原创节目</a></li>
            <li><a href="http://pub.we54.com/" target="_blank">非常夜店</a></li>
		</ul>
		<h1><img src="/images/hellodalian_third/top_line.jpg" width="1" height="64" border="0" /></h1>
		<ul class="nav_c">
			<li><a href="http://house.we54.com/" target="_blank" style="font-weight:bold; color:#ff0000;">房产</a></li>
			<li><a href="http://licai.we54.com/" target="_blank">理财</a></li>
			<li><a href="http://abroad.we54.com/" target="_blank">镀金时代</a></li>
            <li><a href="http://edu.we54.com/" target="_blank" style="font-weight:bold;">职场充电</a></li>
            <li><a href="http://learning.we54.com/" target="_blank">人在学途</a></li>
            <li><a href="http://baby.we54.com/" target="_blank">天才宝贝</a></li>
            <li><a href="http://auto.we54.com/" target="_blank" style="font-weight:bold;">爱车</a></li>
			<li><a href="http://uni.we54.com/" target="_blank">高校</a></li>
			<li><a href="http://eat.we54.com/" target="_blank">美食探店</a></li>
			<li><a href="http://wanka.we54.com/" target="_blank" style="font-weight:bold;">心随我动</a></li>
            <li><a href="http://travel.we54.com" target="_blank">故地新游</a></li>
            <li><a href="http://playdl.we54.com" target="_blank" style="color:#ff0000;">玩转大连</a></li>
		</ul>
		<h1><img src="/images/hellodalian_third/top_line.jpg" width="1" height="64" border="0" /></h1>
        <ul class="nav_d">
			<li><a href="http://bbs.we54.com/" target="_blank" style="font-weight:bold; color:#ff0000;">论坛</a></li>
			<li><a href="http://bbs.we54.com/forumdisplay.php?fid=743" target="_blank">大连你好</a></li>
			<li><a href="http://bbs.we54.com/forumdisplay.php?fid=900" target="_blank" >不惜泡吧</a></li>
			<li><a href="http://bbs.we54.com/forumdisplay.php?fid=269" target="_blank" >偶秀偶拍</a></li>
            <li><a href="http://blog.we54.com/" target="_blank" style="font-weight:bold;">博客</a></li>
            <li><a href="http://bbs.we54.com/forumdisplay.php?fid=747" target="_blank" >纯粹女人</a></li>
            <li><a href="http://bbs.we54.com/forumdisplay.php?fid=974" target="_blank" >亲亲宝贝</a></li>
            <li><a href="http://bbs.we54.com/forumdisplay.php?fid=960" target="_blank" >视频社区</a></li>
		</ul>
		<div class="new_logo">
        	<img src="/images/hellodalian_third/new_logo.gif" width="30" height="14" border="0" />
        </div>
	</div>
    
    
</body>
</html>
