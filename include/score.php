<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");


$action =$_REQUEST['action'];
$articleid =intval($_REQUEST['articleid']);


$d = $dsql->GetOne("Select * From #@__score where articleid = ".$articleid);
//$v = mysql_fetch_array($d);

//$v = $dsql->GetOne("Select * From #@__score");
//var_dump($v);
		
if ($action =='show'){
	//8.4ָƽ���÷�=������/�ܴ�����558��ָ�����ִ���
	//�����mysql�н������ֶ����洢�����ֺ��ܴ���
	$pingjun = number_format($d['score'] / $d['clicked'],"2");
	echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
	
	
}elseif($action =='add'){
	if(intval($_COOKIE['TEST']) <>$articleid ){
	
		$score =intval($_REQUEST['score']);
		
		//�������ݿ�
		if($d)
		{
			$d['clicked']++;
			$d['score'] += $score;
			//$sqlstr = "UPDATE my_score SET score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid;
			$dsql->ExecuteNoneQuery("Update `#@__score` set score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid);
			//mysql_query($sqlstr,$con) or die("����");
			
			$pingjun = number_format($d['score'] / $d['clicked'],"2");
		}
		else
		{
			//$sqlstr = "insert into my_score(articleid,score,clicked) values(".$articleid.",".$score.",1)";
			//mysql_query($sqlstr,$con) or die("����");
			$dsql->ExecuteNoneQuery("insert into `#@__score` (articleid,score,clicked) values(".$articleid.",".$score.",1)");
			
			$pingjun = $score;
			$d['clicked'] = 1;			
		}
		setcookie("TEST", $articleid, time()+3600);/*expire 1 hour*/
		echo "alert('��л���Ĳ��룡');";
		echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
		echo "scoreinit();";
	}else{
		//echo "alert('�����ظ�����');";
		//echo $_COOKIE['TEST'];
		
		
		//�������ݿ�,��ʱ
		$score =intval($_REQUEST['score']);
		if($d)
		{
			$d['clicked']++;
			$d['score'] += $score;
			//$sqlstr = "UPDATE my_score SET score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid;
			//mysql_query($sqlstr,$con) or die("����");
			$dsql->ExecuteNoneQuery("Update `#@__score` set score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid);
			
			$pingjun = number_format($d['score'] / $d['clicked'],"2");
		}
		else
		{
			//$sqlstr = "insert into my_score(articleid,score,clicked) values(".$articleid.",".$score.",1)";
			//mysql_query($sqlstr,$con) or die("����");
			$dsql->ExecuteNoneQuery("insert into `#@__score` (articleid,score,clicked) values(".$articleid.",".$score.",1)");
			
			$pingjun = $score;
			$d['clicked'] = 1;			
		}
		setcookie("TEST", $articleid, time()+3600);/*expire 1 hour*/
		echo "alert('��л���Ĳ��룡');";
		echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
		echo "scoreinit();";
		
		
		
	}
}





mysql_close($con);exit;

?>