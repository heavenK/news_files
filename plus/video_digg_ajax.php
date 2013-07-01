<?php
/**
 *
 * 文档digg处理ajax文件
 *
 * @version        $Id: digg_ajax.php 1 21:17 2010年7月8日Z tianya $
 * @package        DedeCMS.Plus
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/../include/common.inc.php");

$action = isset($action) ? trim($action) : '';
$id = empty($id)? 0 : intval(preg_replace("/[^\d]/",'', $id));

if($id < 1)
{
    exit();
}
$maintable = '#@__archives';
if($action == 'good')
{
    $dsql->ExecuteNoneQuery("UPDATE `$maintable` SET scores = scores + {$cfg_caicai_add},goodpost=goodpost+1,lastpost=".time()." WHERE id='$id'");
}
else if($action=='bad')
{
    $dsql->ExecuteNoneQuery("UPDATE `$maintable` SET scores = scores - {$cfg_caicai_sub},badpost=badpost+1,lastpost=".time()." WHERE id='$id'");
}
$digg = '';
$row = $dsql->GetOne("SELECT goodpost,badpost,scores FROM `$maintable` WHERE id='$id' ");
if(!is_array($row)) exit();

if($row['goodpost'] + $row['badpost'] == 0)
{
    $row['goodper'] = $row['badper'] = 0;
}
else
{
    $row['goodper'] = number_format($row['goodpost'] / ($row['goodpost'] + $row['badpost']), 3) * 100;
    $row['badper'] = 100 - $row['goodper'];
}

if(empty($formurl)) $formurl = '';
if($formurl=='caicai')
{
    if($action == 'good') $digg = $row['goodpost'];
    if($action == 'bad') $digg  = $row['badpost'];
}
else
{
    $row['goodper'] = trim(sprintf("%4.2f", $row['goodper']));
    $row['badper'] = trim(sprintf("%4.2f", $row['badper']));
    $digg = '<div class="support"><span class="like"><a href="javascript:"  onclick="javascript:postDigg(\'good\','.$id.')"><em>顶</em><b>'.$row['goodpost'].'</b></a></span></div>

				<div class="support" ><span class="unlike"><a href="javascript:"  onclick="javascript:postDigg(\'bad\','.$id.')"><em>踩</em><b>'.$row['badpost'].'</b></a></span></div>';
}
AjaxHead();
echo $digg;
exit();
