<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");


$action =$_REQUEST['action'];
$articleid =intval($_REQUEST['articleid']);


$d = $dsql->GetOne("Select * From #@__score where articleid = ".$articleid);
//$v = mysql_fetch_array($d);

//$v = $dsql->GetOne("Select * From #@__score");
//var_dump($v);
		
if ($action =='show'){
	//8.4指平均得分=总评分/总次数，558是指总评分次数
	//在你的mysql中建立两字段来存储总评分和总次数
	$pingjun = number_format($d['score'] / $d['clicked'],"2");
	echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
	
	
}elseif($action =='add'){
	if(intval($_COOKIE['TEST']) <>$articleid ){
	
		$score =intval($_REQUEST['score']);
		
		//插入数据库
		if($d)
		{
			$d['clicked']++;
			$d['score'] += $score;
			//$sqlstr = "UPDATE my_score SET score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid;
			$dsql->ExecuteNoneQuery("Update `#@__score` set score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid);
			//mysql_query($sqlstr,$con) or die("错误");
			
			$pingjun = number_format($d['score'] / $d['clicked'],"2");
		}
		else
		{
			//$sqlstr = "insert into my_score(articleid,score,clicked) values(".$articleid.",".$score.",1)";
			//mysql_query($sqlstr,$con) or die("错误");
			$dsql->ExecuteNoneQuery("insert into `#@__score` (articleid,score,clicked) values(".$articleid.",".$score.",1)");
			
			$pingjun = $score;
			$d['clicked'] = 1;			
		}
		setcookie("TEST", $articleid, time()+3600);/*expire 1 hour*/
		echo "alert('感谢您的参与！');";
		echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
		echo "scoreinit();";
	}else{
		//echo "alert('请勿重复评分');";
		//echo $_COOKIE['TEST'];
		
		
		//插入数据库,临时
		$score =intval($_REQUEST['score']);
		if($d)
		{
			$d['clicked']++;
			$d['score'] += $score;
			//$sqlstr = "UPDATE my_score SET score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid;
			//mysql_query($sqlstr,$con) or die("错误");
			$dsql->ExecuteNoneQuery("Update `#@__score` set score = ".$d['score'].",clicked = ".$d['clicked']." WHERE articleid = ".$articleid);
			
			$pingjun = number_format($d['score'] / $d['clicked'],"2");
		}
		else
		{
			//$sqlstr = "insert into my_score(articleid,score,clicked) values(".$articleid.",".$score.",1)";
			//mysql_query($sqlstr,$con) or die("错误");
			$dsql->ExecuteNoneQuery("insert into `#@__score` (articleid,score,clicked) values(".$articleid.",".$score.",1)");
			
			$pingjun = $score;
			$d['clicked'] = 1;			
		}
		setcookie("TEST", $articleid, time()+3600);/*expire 1 hour*/
		echo "alert('感谢您的参与！');";
		echo "document.getElementById('scoredata').innerHTML='".$pingjun."|".$d['clicked']."';";
		echo "scoreinit();";
		
		
		
	}
}





mysql_close($con);exit;

?>