<?php

if(!defined('DEDEINC')) exit('Request Error!');

function ch_specialtopic($noteinfo, $arcTag, $refObj, $fname='')
{
	require_once(DEDEINC.'/taglib/arclist.lib.php');
	if($noteinfo=='') return '';
	$noteid = $arcTag->GetAtt('noteid');
	$rvalue = '';
	$tempStr = GetSysTemplets('channel_spec_note.htm');
	$dtp = new DedeTagParse();
	$dtp->LoadSource($noteinfo);
	if(is_array($dtp->CTags))
	{
		foreach($dtp->CTags as $k=>$ctag)
		{
			$notename = $ctag->GetAtt('name');
			//指定名称的专题节点
			if($noteid != '' && $ctag->GetAtt('noteid') != $noteid)
			{
				continue;
			}
			$isauto = $ctag->GetAtt('isauto');
			$idlist = trim($ctag->GetAtt('idlist'));
			$rownum = trim($ctag->GetAtt('rownum'));
                                // 读取自定义的系统节点容器模板，模板必须位于 templets/system 下面。 by heavenK
                                $notetemplet = trim($ctag->GetAtt('notetemplet'));
                                if ($notetemplet)
                                {
                                  $notetemplet = substr($notetemplet,strpos($notetemplet,'/')+1);
                                  $tempStr = GetSysTemplets($notetemplet);
                                }
                                else
                                {
                                  $tempStr = GetSysTemplets("channel_spec_note.htm");
                                }

			$keywords = '';
			$stypeid = 0;
			if(empty($rownum)) $rownum = 40;

			//通过关键字和栏目ID自动获取模式
			if($isauto==1)
			{
				$idlist = '';
				$keywords = trim($ctag->GetAtt('keywords'));
				$stypeid = $ctag->GetAtt('typeid');
			}

			$listTemplet = trim($ctag->GetInnerText())!='' ? $ctag->GetInnerText() : GetSysTemplets('spec_arclist.htm');
			
			$idvalue = lib_arclistDone
			          (
			            $refObj, $ctag, $stypeid, $rownum, $ctag->GetAtt('col'), $ctag->GetAtt('titlelen'),$ctag->GetAtt('infolen'),
			            $ctag->GetAtt('imgwidth'), $ctag->GetAtt('imgheight'), 'all', 'default', $keywords, $listTemplet, 0, $idlist,
			            $ctag->GetAtt('channel'), '', $ctag->GetAtt('att')
			          );
			$notestr = str_replace('~notename~', $notename, $tempStr);
			$notestr = str_replace('~spec_arclist~', $idvalue, $notestr);
			$rvalue .= $notestr;
			if($noteid != '' && $ctag->GetAtt('noteid')==$noteid) break;
		}
	}
	$dtp->Clear();
	return $rvalue;
}

?>