<?php
/**
 * 日志列表
 *
 * @version        $Id: log_list.php 1 8:48 2010年7月13日Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/datalistcp.class.php");
require_once(DEDEINC."/common.func.php");

$sql = $where = "";

if(empty($adminid)) $adminid = 0;
if(empty($aid)) $aid = "";
if(empty($dtime)) $dtime = 0;
if($adminid>0) $where .= " AND #@__edit_log.adminid='$adminid' ";
if($aid!="") $where .= " AND #@__edit_log.aid='$aid'";

if($dtime>0)
{
    $nowtime = time();
    $starttime = $nowtime - ($dtime*24*3600);
    $where .= " AND #@__edit_log.time>'$starttime' ";
}


$sql = "SELECT #@__edit_log.*,#@__admin.userid,#@__archives.title FROM #@__edit_log
     LEFT JOIN #@__admin ON #@__admin.id=#@__edit_log.adminid
	 LEFT JOIN #@__archives ON #@__edit_log.aid=#@__archives.id
     WHERE 1=1 $where ORDER BY #@__edit_log.aid DESC";
$adminlist = "";
$dsql->SetQuery("SELECT id,uname FROM #@__admin");
$dsql->Execute('admin');
while($myrow = $dsql->GetObject('admin'))
{
    $adminlist .="<option value='{$myrow->id}'>{$myrow->uname}</option>\r\n";
}
$dlist = new DataListCP();
$dlist->pageSize = 20;
$dlist->SetParameter("adminid",$adminid);
$dlist->SetTemplate(DEDEADMIN."/templets/editlog_list.htm");
$dlist->SetSource($sql);
$dlist->Display();