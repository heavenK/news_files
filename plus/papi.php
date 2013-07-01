<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");

$newstype = (isset($newstype) && is_numeric($newstype)) ? $newstype : 1;
$newsID = (isset($newsID) && is_numeric($newsID)) ? $newsID : 0;

if($newsID > 0) {
	if($newstype == 1) {
		$dsql->SetQuery("Select id,click From `#@__archives` WHERE id=".$newsID);
		$dsql->Execute();
		$row = $dsql->GetArray();
		$start = ' AND click<'.$row['click'];
	}
	else	$start = ' AND id<'.$newsID; 
}

if($newstype == 1) $wheres = ' WHERE ar.typeid IN (5,15,16)';
else if($newstype == 2) $wheres = ' WHERE ar.typeid=5';
else if($newstype == 3) $wheres = ' WHERE typeid IN (15,16)';
else if($newstype == 4) $wheres = ' WHERE typeid=1017';
else if($newstype == 5) $wheres = ' WHERE ar.typeid=869';

if($newstype == 1)	{
	$yesterday = strtotime("2012-09-05");
	$today = strtotime("2012-09-06");
	$one_day = $today - $yesterday;
	$times_fw = time() - $one_day;
}

if($newstype == 1) $orders = ' AND pubdate>' . $times_fw . ' ORDER BY click DESC';
else $orders = '  ORDER BY pubdate DESC';


if($newsID == 0 && ($newstype == 1 || $newstype ==4)){
	$dsql->SetQuery("Select id,title,litpic as imgURL From `#@__archives` ar" . $wheres." AND flag LIKE '%h%' ORDER BY pubdate DESC LIMIT 0,3");
	$dsql->Execute();
	while($row = $dsql->GetArray())
	{
		$res['hotnews'][] = $row;
	}
}

if($newstype == 5)	$dsql->SetQuery("Select ar.id as id,ar.title as title,ar.litpic as imgURL, ar.writer as writer,ad.xgjs as content From `#@__archives` ar LEFT JOIN `#@__addonarticle` ad ON ar.id=ad.aid".$wheres . $start . " AND flag NOT LIKE '%h%'". $orders ." LIMIT 0,10");
elseif($newstype == 2 || $newstype == 1)	$dsql->SetQuery("Select ar.id as id,ar.title as title,ar.litpic as imgURL, ar.description as content,ad.xcoord as v_flag From `#@__archives` ar LEFT JOIN `#@__addonarticle` ad ON ar.id=ad.aid".$wheres . $start . $orders ." LIMIT 0,10");
else	$dsql->SetQuery("Select id,title,litpic as imgURL,description as content From `#@__archives`".$wheres . $start . " AND flag NOT LIKE '%h%'". $orders ." LIMIT 0,10");
$dsql->Execute();
while($row = $dsql->GetArray())
{
	foreach($row as $keys => $val){
		if($keys == 'writer') {
			$row['content'] = str_replace('评论员介绍：','',$row['content']);
			$row['content'] = "新青年特约评论员：".$val."\n".$row['content'];
			unset($row['writer']);
		}
	}
	
	$res['news'][] = $row;
}
	
if(!$res) $res['hasmore'] = 0;
else $res['hasmore'] = 1;

if($test) var_dump($res);

foreach ($res['news'] as $key =>$news){
	foreach($news as $key1 => $value){
		$res['news'][$key][$key1] = iconv('gbk','utf-8',$value);
	}
}
foreach ($res['hotnews'] as $key =>$news){
	foreach($news as $key1 => $value){
		$res['hotnews'][$key][$key1] = iconv('gbk','utf-8',$value);
	}
}



echo json_encode($res);
	
?>