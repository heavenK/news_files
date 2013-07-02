<?php
require_once(dirname(__FILE__)."/config_info.php");
if(empty($dopost))
{
	$dopost = '';
}
$aid = isset($aid) && is_numeric($aid) ? $aid : 0;
$channelid = isset($channelid) && is_numeric($channelid) ? $channelid : 1;

/*--------------------
function delArchives()
删除文章
--------------------*/
if($dopost=="delArc")
{
	//CheckRank(0,0);
	include_once(DEDEMEMBER."/inc/inc_batchup.php");
	$ENV_GOBACK_URL = empty($_COOKIE['ENV_GOBACK_URL']) ? 'content_list.php?channelid=' : $_COOKIE['ENV_GOBACK_URL'];


	$equery = "Select arc.channel,arc.senddate,arc.arcrank,ch.maintable,ch.addtable,ch.issystem,ch.arcsta From `#@__arctiny` arc
	           left join `#@__channeltype` ch on ch.id=arc.channel where arc.id='$aid' ";

	$row = $dsql->GetOne($equery);
	if(!is_array($row))
	{
		ShowMsg("你没有权限删除这篇文档！","-1");
		exit();
	}
	if(trim($row['maintable'])=='') $row['maintable'] = '#@__archives';
	if($row['issystem']==-1)
	{
		$equery = "Select mid from `{$row['addtable']}` where aid='$aid' And mid='".$cfg_ml->M_ID."' ";
	}
	else
	{
		$equery = "Select mid,litpic from `{$row['maintable']}` where id='$aid' And mid='".$cfg_ml->M_ID."' ";
	}
	$arr = $dsql->GetOne($equery);
	
	
	
	
	@session_start();
	$uname = $_SESSION["Zend_Auth"]['storage']->username;
	
	if ($uname == '') {
           header("location: http://passport.we54.com/Index/login?forward=http://news.we54.com/member/content_info_list.php?channelid=-8");
	exit();
           }

	//$uname = 'lyhj0001';
	$uquery = "SELECT username FROM `#@__infop` WHERE aid='$aid' AND username='".$uname."' ";
	$userflag = $dsql->GetOne($uquery);
	if(!is_array($userflag))
	{
		ShowMsg("你没有权限删除这篇文档！","-1");
		exit();
	}
	
	
	
	
	
		
	if(!is_array($arr))
	{
		ShowMsg("你没有权限删除这篇文档！","-1");
		exit();
	}

	if($row['arcrank']>=0)
	{
		$dtime = time();
		$maxtime = $cfg_mb_editday * 24 *3600;
		if($dtime - $row['senddate'] > $maxtime)
		{
			ShowMsg("这篇文档已经锁定，你不能再删除它！","-1");
			exit();
		}
	}

	$channelid = $row['channel'];
	$row['litpic'] = (isset($arr['litpic']) ? $arr['litpic'] : '');

	//删除文档
	if($row['issystem']!=-1) $rs = DelArc($aid);
	else $rs = DelArcSg($aid);
	
	$dsql->ExecuteNoneQuery("Delete From `#@__infop` where aid='$aid'");
	

	//删除缩略图
	if(trim($row['litpic'])!='' && ereg("^".$cfg_user_dir."/{$cfg_ml->M_ID}",$row['litpic']))
	{
		$dsql->ExecuteNoneQuery("Delete From `#@__uploads` where url like '{$row['litpic']}' And mid='{$cfg_ml->M_ID}' ");
		@unlink($cfg_basedir.$row['litpic']);
	}

	if($ENV_GOBACK_URL=='content_list.php?channelid=')
	{
		$ENV_GOBACK_URL = $ENV_GOBACK_URL.$channelid;
	}
	if($rs)
	{
		//更新用户记录
		//countArchives($channelid);
		//扣除积分
		//$dsql->ExecuteNoneQuery("Update `#@__member` set scores=scores-{$cfg_sendarc_scores} where mid='".$cfg_ml->M_ID."' And (scores-{$cfg_sendarc_scores}) > 0; ");
		ShowMsg("成功删除一篇文档！",$ENV_GOBACK_URL);
		exit();
	}
	else
	{
		ShowMsg("删除文档失败！",$ENV_GOBACK_URL);
	  exit();
	}
	exit();
}
?>