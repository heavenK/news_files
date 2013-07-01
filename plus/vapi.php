<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");

$newsID = (isset($newsID) && is_numeric($newsID)) ? $newsID : 0;

if($newsID > 0) {
	$start = ' AND id<'.$newsID; 
}

$wheres = ' WHERE typeid=909';


$orders = '  ORDER BY pubdate DESC';


if($newsID == 0){
	$dsql->SetQuery("Select id,title,litpic as imgURL From `#@__archives`" . $wheres." AND flag LIKE '%h%' ORDER BY pubdate DESC LIMIT 0,3");
	$dsql->Execute();
	while($row = $dsql->GetArray())
	{
		$res['hotnews'][] = $row;
	}
}

$dsql->SetQuery("Select id,title,litpic as imgURL,description as content From `#@__archives`".$wheres . $start . " AND flag NOT LIKE '%h%'". $orders ." LIMIT 0,10");
$dsql->Execute();
while($row = $dsql->GetArray())
{
/*	foreach($row as $keys => $val){
		if($keys == 'writer') {
			$row['content'] = str_replace('评论员介绍：','',$row['content']);
			$row['content'] = "新青年特约评论员：".$val."\n".$row['content'];
			unset($row['writer']);
		}
	}
	*/
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