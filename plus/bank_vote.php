<?php
require(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

function votes($db , $select , $id){
		$sql = "UPDATE bank_votes SET s".$select."=s".$select."+1 WHERE id=".$id;
		if(!$db->ExecuteNoneQuery($sql)) { echo $id."出错了！"; exit(); }
	}


$db = new DedeSql(false);


$ip = $_SERVER["REMOTE_ADDR"];
$date = GetMkTime(time());
$dayst = GetMkTime("2008-1-1 1:0:0") - GetMkTime("2008-1-1 0:0:0");
$sql = "SELECT * FROM bank_check WHERE ip='".$ip."'";

if ($arr = $db->GetOne($sql)) { 
	$check_time = $arr['pubdate'] + $dayst; 
	if ($check_time > $date) {
		echo "1小时内只能发表一次！谢谢合作！";
		exit();
	}
	else {
		$sql = "UPDATE bank_check SET pubdate='".$date."' WHERE ip='".$ip."'";	
		if (!$db->ExecuteNoneQuery($sql)) { echo "出错了！"; exit(); }
	}
}
else {
	$sql = "INSERT INTO bank_check values('','".$ip."','".$date."')";
	if (!$db->ExecuteNoneQuery($sql)) { echo "出错了！"; exit(); }
}


votes($db , $select_a , '1');
votes($db , $select_b , '2');
votes($db , $select_c , '3');
votes($db , $select_d , '4');

foreach($select_e as $n){
		votes($db , $n , '5');
	}
foreach($select_f as $n){
		votes($db , $n , '6');
	}

votes($db , $select_g , '7');
votes($db , $select_h , '8');


echo "发表成功了！！";

?>