    <?php
        $add_channel_menu = array();
        //���Ϊ�οͷ��ʣ����������˵�
		
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
                //���õ�ģ��
                if($menurow['isshow']==0)
                {
                    continue;
                }
                //�������
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
      	<!-- �������Ĳ˵�-->
      	<?php
      	if($menutype == 'content')
      	{
      	?>
				<?php
				//�Ƿ�������Զ���ģ��Ͷ��
				if($cfg_mb_sendall=='Y')
				{
				?>
        <h2 class="menuTitle" onclick="menuShow('menuSec')" id="menuSec_t"><b></b>�Զ�������</h2>
        <ul id="menuSec">
					<?php
					foreach($add_channel_menu as $nnarr) {
					?>
					<li class="<?php echo $nnarr['nid'];?>"><a href="../member/content_info_list.php?channelid=<?php echo $nnarr['id'];?>" title="�ѷ�����<?php echo $nnarr['typename'];?>"><b></b><?php echo $nnarr['typename'];?></a><a href='archives_info_add.php?channelid=<?php echo $nnarr['id'];?>' class="act" title="����������">����</a></li>
					<?php
					} 
					}
					?>  
        </ul>
        
        <?php
      }
      ?>
        <!--<h2 class="menuTitle"><b class="showMenu"></b>�������˵���</h2> -->
      </div>
      <div class="buttomGr"></div>
    </div>
    <?php
    }
    ?>
    <!--�������˵��� -->