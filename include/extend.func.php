<?php
function litimgurls($imgid=0){
   global $lit_imglist;
   //��ȡͼƬ���ӱ�imgurls�ֶ����ݽ��д���
   $dsql = new DedeSql(false);
   $row = $dsql->GetOne("Select imgurls From #@__addonimages where aid='$imgid'");
   //����inc_channel_unit.php��ChannelUnit��
   $ChannelUnit = new ChannelUnit(2,$imgid);
   //����ChannelUnit����GetlitImgLinks������������ͼ
   $lit_imglist = $ChannelUnit->GetlitImgLinks($row['imgurls']);
   //���ؽ��
   return $lit_imglist;
}

//��ȡ��Ŀ���ĵ���
function getTypeNum($tid=0){
	$db = new DedeSql(false);
	$sql = "SELECT count(*) as num FROM `#@__addoninfos` WHERE typeid=".$tid." AND arcrank>-1";
	if ($arr = $db->GetOne($sql)) {
			return $arr['num'];
	}
	else return 0;
}
/**************** 
function GetOneImgUrl 
@@ ���ܣ���ȡ�Զ����ֶ�ͼƬ��ַ 
*****************/
function GetOneImgUrl($img,$ftype=1){ 
preg_match_all("/href='([^']+)/i", $img, $match);
$urls = $match[1];
$img=$urls[0];
return $img; 
}
?>