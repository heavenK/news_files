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
ɾ������
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
		ShowMsg("��û��Ȩ��ɾ����ƪ�ĵ���","-1");
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
		ShowMsg("��û��Ȩ��ɾ����ƪ�ĵ���","-1");
		exit();
	}
	
	
	
	
	
		
	if(!is_array($arr))
	{
		ShowMsg("��û��Ȩ��ɾ����ƪ�ĵ���","-1");
		exit();
	}

	if($row['arcrank']>=0)
	{
		$dtime = time();
		$maxtime = $cfg_mb_editday * 24 *3600;
		if($dtime - $row['senddate'] > $maxtime)
		{
			ShowMsg("��ƪ�ĵ��Ѿ��������㲻����ɾ������","-1");
			exit();
		}
	}

	$channelid = $row['channel'];
	$row['litpic'] = (isset($arr['litpic']) ? $arr['litpic'] : '');

	//ɾ���ĵ�
	if($row['issystem']!=-1) $rs = DelArc($aid);
	else $rs = DelArcSg($aid);
	
	$dsql->ExecuteNoneQuery("Delete From `#@__infop` where aid='$aid'");
	

	//ɾ������ͼ
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
		//�����û���¼
		//countArchives($channelid);
		//�۳�����
		//$dsql->ExecuteNoneQuery("Update `#@__member` set scores=scores-{$cfg_sendarc_scores} where mid='".$cfg_ml->M_ID."' And (scores-{$cfg_sendarc_scores}) > 0; ");
		ShowMsg("�ɹ�ɾ��һƪ�ĵ���",$ENV_GOBACK_URL);
		exit();
	}
	else
	{
		ShowMsg("ɾ���ĵ�ʧ�ܣ�",$ENV_GOBACK_URL);
	  exit();
	}
	exit();
}
?>