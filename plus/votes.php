<?php
require(dirname(__FILE__)."/../include/common.inc.php");
require(DEDEINC."/dedevote.class.php");
if(empty($dopost)) $dopost = '';

$aid = (isset($aid) && is_numeric($aid)) ? $aid : 0;
if($aid==0) die(" Request Error! ");

if($aid==0)
{
	ShowMsg("没指定投票项目的ID！","-1");
	exit();
}
$selected = (isset($select) && is_numeric($select)) ? $select : 1;

if($dopost=='send')
{
	$db = new DedeSql(false);
	$sql = "UPDATE `dede_addonvotes` SET ".$selected."th_num = ".$selected."th_num + 1";
	if ($db->ExecuteNoneQuery($sql)) header('Location: '.$forward);

}

?>