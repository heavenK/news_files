<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(DEDEINC."/filter.inc.php");

	if($cfg_feedback_ck=='Y')
	{
		$validate = isset($vd) ? strtolower(trim($vd)) : '';
		$svali = strtolower(trim(GetCkVdValue()));
		if($validate != $svali || $svali=='')
		{
			ResetVdValue();
			echo 'false';
		}else
		{
			echo 'true';
		}
	}



?>