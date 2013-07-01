<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");

$newsID = (isset($newsID) && is_numeric($newsID)) ? $newsID : exit;

$dsql->SetQuery("Select ar.id as id,channel,addtable From `#@__archives` ar LEFT JOIN `#@__channeltype` ct ON ar.channel=ct.id WHERE ar.id=".$newsID);
$dsql->Execute();
$row = $dsql->GetArray();

if($row){
	$dsql->SetQuery("Select ar.id as newsID, ar.title as title,ad.imgurls as imgurls From `#@__archives` ar LEFT JOIN `".$row['addtable']."` ad ON ar.id = ad.aid WHERE ar.id=".$newsID);
	$dsql->Execute();
	$res = $dsql->GetArray();

    $reg_url = "/'}(.)*{\//isU";
	$reg_content = "/text='(.)*' width/isU";

	$imgurls = $res['imgurls'];
	
	
	preg_match_all($reg_url,$imgurls,$match_url);
	preg_match_all($reg_content,$imgurls,$match_content);
	
	$title = iconv('gbk','utf-8',$res['title']);
	
	foreach($match_url[0] as $key => $value){
		$value = str_replace("'} ","",$value);
		$news[$key]['imgURL'] = str_replace("{/","",$value);
		
		$news[$key]['title'] = $title;
		
		$content = str_replace("text='","",$match_content[0][$key]);
		$content = str_replace("' width","",$content);
		$news[$key]['content']= iconv('gbk','utf-8',$content);
	}
	
	$img_res['newsID'] = $res['newsID'];
	$img_res['news'] = $news;
	

	
	echo json_encode($img_res);
}
else exit;
	
?>