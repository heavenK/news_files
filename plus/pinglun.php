<?php

header('Cache-Control: post-check=0, pre-check=0');
header('Pragma: no-cache');
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

$aid = $_GET['aid'];
$dsql = new DedeSql(false);
$arr = $db->GetOne("SELECT source FROM `#@__archives` WHERE id=".$aid);
//$arr = $db->GetArray();
$con = mysql_connect("192.168.1.9","js_read","reloadJS123");
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("bbsup", $con);
//var_dump($arr['title']);
$result = mysql_query("SELECT views,replies FROM cdb_threads WHERE tid=".$arr['source']);
//$row = mysql_fetch_array($result);
while($row = mysql_fetch_array($result)){
  //echo $row['views'] . " " . $row['replies'];
  echo "document.write('<i><img src=\"/images/bbs_jinghua/btn_a.jpg\" width=\"13\" height=\"13\" border=\"0\" /><em>".$row['replies']."</em></i><i><img src=\"/images/bbs_jinghua/btn_b.jpg\" width=\"13\" height=\"13\" border=\"0\" /><em>".$row['views']."</em></i>')";
}

?>

