<?php

/**
 *
 * ��������Ȩ�����õ�˵��
 * ����Ȩ������������ʽ���£�
 * ���ָ���˻�Ա�ȼ�����ô���뵽������ȼ��������
 * ���ָ���˽�ң����ʱ���ָ��ĵ������������¼���û�ҵ���¼��
 * �������ͬʱָ������ô����ͬʱ������������
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

//����Ķ�Ȩ��
$needMoney = $arc->Fields['money'];
$needRank = $arc->Fields['arcrank'];

//������Ȩ�����Ƶ�����
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
	
	//��Ա������
	if(($needRank>1 && $cfg_ml->M_Rank < $needRank && $arc->Fields['mid']!=$cfg_ml->M_ID))
	{
		$dsql->Execute('me' , "Select * From `#@__arcrank` ");
		while($row = $dsql->GetObject('me'))
		{
			$memberTypes[$row->rank] = $row->membername;
		}
		$memberTypes[0] = "�οͻ�ûȨ�޻�Ա";
		$msgtitle = "��û��Ȩ������ĵ���{$arctitle} ��";
		$moremsg = "��ƪ�ĵ���Ҫ <font color='red'>".$memberTypes[$needRank]."</font> ���ܷ��ʣ���Ŀǰ�ǣ�<font color='red'>".$memberTypes[$cfg_ml->M_Rank]."</font> ��";
		include_once(DEDETEMPLATE.'/plus/view_msg.htm');
		exit();
	}

	//��Ҫ��ҵ����
	if($needMoney > 0  && $arc->Fields['mid'] != $cfg_ml->M_ID)
	{
		$sql = "Select aid,money From `#@__member_operation` where buyid='ARCHIVE".$aid."' And mid='".$cfg_ml->M_ID."'";
		$row = $dsql->GetOne($sql);
		//δ�����������
		if(!is_array($row))
		{
			if($cfg_ml->M_Money=='' || $needMoney > $cfg_ml->M_Money)
	 		{
					$msgtitle = "��û��Ȩ������ĵ���{$arctitle} ��";
					$moremsg = "��ƪ�ĵ���Ҫ <font color='red'>".$needMoney." ���</font> ���ܷ��ʣ���Ŀǰӵ�н�ң�<font color='red'>".$cfg_ml->M_Money." ��</font> ��";
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
								showmsg('����ʧ��, �뷵��', -1);
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
		
							showmsg('����ɹ�������۵㲻���ؿ۽�ң�лл��', '/plus/view.php?aid='.$aid);
							exit;
		
						 } else {
							showmsg('����ʧ��, �뷵��', -1);
							exit;
						 }
					}
					
					$msgtitle = "�۽�ҹ����Ķ���";
					$moremsg = "�Ķ����ĵ�������Ҫ���ѣ�<br>��ƪ�ĵ���Ҫ <font color='red'>".$needMoney." ���</font> ���ܷ��ʣ���Ŀǰӵ�н�� <font color='red'>".$cfg_ml->M_Money." </font>����<br>ȷ���Ķ���� [<a href='/plus/view.php?aid=".$aid."&dopost=buy' target='_blank'>ȷ�ϸ����Ķ�</a>]" ;
					include_once($cfg_basedir.$cfg_templets_dir."/plus/view_msg.htm");
					$arc->Close();
					exit();
					}
		}
	}//��Ҵ�������
	
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.shyqxw.com/' target='_blank'>�ټ���</a>(<a href='http://www.bm55.com/' target='_blank'>������</a>)�ټ�����רҵȨ��������������ַ������ȫѶ�����ټ��֡�������ַ������ͨ���������ŵĲ�����վwww.shyqxw.com</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.111722.com/' target='_blank'>������</a>(<a href='http://www.qcxp.net/' target='_blank'>����ͨ</a>)������(www.111722.com)��ȫѶ�������ټ���{www.111722.com}ȫѶ������һ��������ȫ���򵼺���վ</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.txtku.net/' target='_blank'>�ټ���</a>(<a href='http://www.126bct.com/' target='_blank'>������</a>)ȫѶ��(www.txtku.net)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.txtku.net</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.898869.com/' target='_blank'>�ټ���</a>(<a href='http://www.htybct.com/' target='_blank'>����ͨ</a>)ȫѶ��(www.898869.com)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.898869.com</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.8603.net/' target='_blank'>ȫѶ��</a>(<a href='http://www.126qxw.com/' target='_blank'>ȫѶ��</a>)������(www.8603.net)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.8603.net</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.4bocai.com/' target='_blank'>������</a>(<a href='http://www.dzbc.cc/' target='_blank'>����ͨ</a>)������(www.4bocai.com)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.qcxp.net</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.4bocai.com/' target='_blank'>������</a>(<a href='http://www.189bct.com/' target='_blank'>����ͨ</a>)������(www.4bocai.com)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.4bocai.com</td></tr></table>";
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
	echo "<table class=top_tdbgall style='WORD-BREAK: break-all' cellSpacing=0 cellPadding=0 width=754 align=center border=0>    <tr><td class=top_top align='center'><a href='http://www.789167.com/' target='_blank'>ȫѶ��</a>(<a href='http://www.811101.com/' target='_blank'>�ټ���</a>)ȫѶ��(www.811101.com)�ʹ������ֽ�Ͷע���������첩������ʱ�����ټ���,����ͨ,̫���ǿ���,�ʹ���www.789167.com</td></tr></table>";
}
?>