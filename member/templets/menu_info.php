    <?php
        $add_channel_menu = array();
        //如果为游客访问，不启用左侧菜单
		
		@session_start();
		$uname = $_SESSION["Zend_Auth"]['storage']->username;
		
		if ($uname == '') {
           header("location: http://passport.we54.com/Index/login?forward=http://news.we54.com/member/content_info_list.php?channelid=-8");
	exit();
}

		
		
		//$uname = 'lyhj0001';
		
        if(!empty($uname))
        {
            $channelInfos = array();
            $dsql->Execute('addmod',"SELECT id,nid,typename,useraddcon,usermancon,issend,issystem,usertype,isshow FROM `#@__channeltype` ");	
            while($menurow = $dsql->GetArray('addmod'))
            {
                $channelInfos[$menurow['nid']] = $menurow;
                //禁用的模型
                if($menurow['isshow']==0)
                {
                    continue;
                }
                //其它情况
                if($menurow['issend']!=1 || $menurow['issystem']==1 
                || ( !ereg($cfg_ml->M_MbType, $menurow['usertype']) && trim($menurow['usertype'])!='' ) )
                {
                    continue;
                }
                $menurow['ddcon'] = empty($menurow['useraddcon']) ? 'archives_add.php' : $menurow['useraddcon'];
                $menurow['list'] = empty($menurow['usermancon']) ? 'content_list.php' : $menurow['usermancon'];
                $add_channel_menu[] = $menurow;
            }
            unset($menurow);
		?>
    <div id="mcpsub">
      <div class="topGr"></div>
      <div id="menuBody">
      	<!-- 内容中心菜单-->
      	<?php
      	if($menutype == 'content')
      	{
      	?>
				<?php
				//是否允许对自定义模型投稿
				if($cfg_mb_sendall=='Y')
				{
				?>
        <h2 class="menuTitle" onclick="menuShow('menuSec')" id="menuSec_t"><b></b>自定义内容</h2>
        <ul id="menuSec">
					<?php
					foreach($add_channel_menu as $nnarr) {
					?>
					<li class="<?php echo $nnarr['nid'];?>"><a href="../member/content_info_list.php?channelid=<?php echo $nnarr['id'];?>" title="已发布的<?php echo $nnarr['typename'];?>"><b></b><?php echo $nnarr['typename'];?></a><a href='archives_info_add.php?channelid=<?php echo $nnarr['id'];?>' class="act" title="发表新文章">发表</a></li>
					<?php
					} 
					}
					?>  
        </ul>
        
        <?php
      }
      ?>
        <!--<h2 class="menuTitle"><b class="showMenu"></b>操作主菜单项</h2> -->
      </div>
      <div class="buttomGr"></div>
    </div>
    <?php
    }
    ?>
    <!--左侧操作菜单项 -->