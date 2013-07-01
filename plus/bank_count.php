<style>
ol,ul,li	{ list-style-type:none;}
.inside1,
.inside2,
.inside3,
.inside4,
.inside5 {
background:url("/images/vote_mini_icon_bg.gif") repeat-x scroll 0 0 transparent;
border-left:1px solid #000000;
border-right:1px solid #000000;
height:11px;
width:1px;
}

	.charts	{ width:600px; float:left;}
	.charts ul li	{ width:552px; float:left;}
		.outside	{ background:none repeat scroll 0 0 #EDEDED; float:left; height:11px; margin-right:10px; overflow:hidden; width:552px;}
		.inside1	{ background-position:0 -99px; border-left-color:#BF2146; border-right-color:#BF2146; }
		.inside2	{ background-position:0 0; border-left-color:#EA7211; border-right-color:#EA7211; }
		.inside3	{ background-position:0 -11px; border-left-color:#AABF00; border-right-color:#AABF00; }
		.inside4	{ background-position:0 -22px; border-left-color:#8B2A00; border-right-color:#8B2A00; }
		.inside5	{ background-position:0 -33px; border-left-color:#8B2A00; border-right-color:#8B2A00; }


.vv	{ float:left; margin:2px; height:40px;}
</style>
<script language="javascript" src="/js/jquery-1.4.2.js"></script>
<script>
	
	function tt_f(n){

	
		var v1 = arguments[1];
		var v2 = arguments[2];
		var v3 = arguments[3];
		var v4 = arguments[4];
		var v5 = arguments[5];
		
		if (v1 == undefined) v1 = 0;
		if (v2 == undefined) v2 = 0;
		if (v3 == undefined) v3 = 0;
		if (v4 == undefined) v4 = 0;
		if (v5 == undefined) v5 = 0;

		
		var sum = parseInt(v1) + parseInt(v2) + parseInt(v3) + parseInt(v4) + parseInt(v5);
		
		
		var s1 = v1 / sum * 100;
		var s2 = v2 / sum * 100;
		var s3 = v3 / sum * 100;
		var s4 = v4 / sum * 100;
		var s5 = v5 / sum * 100;
		

		
		$(".inside1_"+n).animate({width: s1+"%"	}, 1000 ); 
		$(".inside2_"+n).animate({width: s2+"%"	}, 1000 ); 
		$(".inside3_"+n).animate({width: s3+"%"	}, 1000 ); 
		$(".inside4_"+n).animate({width: s4+"%"	}, 1000 );
		$(".inside5_"+n).animate({width: s5+"%"	}, 1000 );		
		$("#values1_"+n).html(v1+" (" + s1.toFixed(2) + "%) ");
		$("#values2_"+n).html(v2+" (" + s2.toFixed(2) + "%) ");
		$("#values3_"+n).html(v3+" (" + s3.toFixed(2) + "%) ");
		$("#values4_"+n).html(v4+" (" + s4.toFixed(2) + "%) ");
		$("#values5_"+n).html(v5+" (" + s5.toFixed(2) + "%) ");
	}
	
	
	
	
	$(document).ready(function(){
		tt_f('1' ,$("input[name=q1_1]").val() ,$("input[name=q1_2]").val());
		tt_f('2' ,$("input[name=q2_1]").val() ,$("input[name=q2_2]").val() ,$("input[name=q2_3]").val());
		tt_f('3' ,$("input[name=q3_1]").val() ,$("input[name=q3_2]").val() ,$("input[name=q3_3]").val() ,$("input[name=q3_4]").val());
		tt_f('4' ,$("input[name=q4_1]").val() ,$("input[name=q4_2]").val() ,$("input[name=q4_3]").val() ,$("input[name=q4_4]").val() ,$("input[name=q4_5]").val());
		tt_f('5' ,$("input[name=q5_1]").val() ,$("input[name=q5_2]").val() ,$("input[name=q5_3]").val() ,$("input[name=q5_4]").val() ,$("input[name=q5_5]").val());
		tt_f('6' ,$("input[name=q6_1]").val() ,$("input[name=q6_2]").val() ,$("input[name=q6_3]").val() ,$("input[name=q6_4]").val());
		tt_f('7' ,$("input[name=q7_1]").val() ,$("input[name=q7_2]").val() ,$("input[name=q7_3]").val() ,$("input[name=q7_4]").val());
		tt_f('8' ,$("input[name=q8_1]").val() ,$("input[name=q8_2]").val());
		
	});
	

</script>
<body>
<?php
	require(dirname(__FILE__)."/../include/common.inc.php");

	$db = new DedeSql(false);
	$sql = "SELECT * FROM bank_votes";
	$db->Execute('me',$sql);
	$i = 0;
	while($arr = $db->GetArray())
	{
		$i++;
		echo "<input type='hidden' name='q".$i."_1' value='".$arr['s1']."' />";
		echo "<input type='hidden' name='q".$i."_2' value='".$arr['s2']."' />";
		echo "<input type='hidden' name='q".$i."_3' value='".$arr['s3']."' />";
		echo "<input type='hidden' name='q".$i."_4' value='".$arr['s4']."' />";
		echo "<input type='hidden' name='q".$i."_5' value='".$arr['s5']."' />";
	}
	
?>
<div class="charts">
	<h1>1.您是否持有大连银行信用卡？</h1>
	<ul>
    	<li  class="vv">1·是</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_1 inside1"></div></div>
        		<div id="values1_1"></div>
        	</div>
        </li>
    	<li class="vv">2·否</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_1 inside2"></div></div>
        		<div id="values2_1"></div>
        	</div>
        </li>
    </ul>
	<h1>2.您目前持有信用卡的张数？</h1>
	<ul>
    	<li  class="vv">1·1-2张</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_2 inside1"></div></div>
        		<div id="values1_2"></div>
        	</div>
        </li>
    	<li class="vv">2·3-5张</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_2 inside2"></div></div>
        		<div id="values2_2"></div>
        	</div>
        </li>
		<li class="vv">3·5张以上</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside3_2 inside3"></div></div>
        		<div id="values3_2"></div>
        	</div>
        </li>
    </ul>
	<h1>3.您使用过大连银行信用卡自动代缴费业务和分期付款业务吗</h1>
	<ul>
    	<li  class="vv">1·仅使用过分期付款业务</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_3 inside1"></div></div>
        		<div id="values1_3"></div>
        	</div>
        </li>
    	<li class="vv">2·仅使用过自动代缴费业务</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_3 inside2"></div></div>
        		<div id="values2_3"></div>
        	</div>
        </li>
		<li  class="vv">3·有所了解，但未曾使用</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside3_3 inside3"></div></div>
        		<div id="values3_3"></div>
        	</div>
        </li>
    	<li class="vv">4·两项功能均使用过</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside4_3 inside4"></div></div>
        		<div id="values4_3"></div>
        	</div>
        </li>
    </ul>
	<h1>4.您对大连银行信用卡的满意度如何？</h1>
	<ul>
    	<li  class="vv">1·很满意</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_4 inside1"></div></div>
        		<div id="values1_4"></div>
        	</div>
        </li>
    	<li class="vv">2·满意</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_4 inside2"></div></div>
        		<div id="values2_4"></div>
        	</div>
        </li>
		<li  class="vv">3·一般</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside3_4 inside3"></div></div>
        		<div id="values3_4"></div>
        	</div>
        </li>
    	<li class="vv">4·不满意</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside4_4 inside4"></div></div>
        		<div id="values4_4"></div>
        	</div>
        </li>
		<li class="vv">5·很不满意</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside5_4 inside5"></div></div>
        		<div id="values5_4"></div>
        	</div>
        </li>
    </ul>
	<h1>5.您通过何种方式了解信用卡的相关信息？</h1>
	<ul>
    	<li  class="vv">1·银行人员</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_5 inside1"></div></div>
        		<div id="values1_5"></div>
        	</div>
        </li>
    	<li class="vv">2·电视</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_5 inside2"></div></div>
        		<div id="values2_5"></div>
        	</div>
        </li>
		<li  class="vv">3·报刊</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside3_5 inside3"></div></div>
        		<div id="values3_5"></div>
        	</div>
        </li>
    	<li class="vv">4·网络</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside4_5 inside4"></div></div>
        		<div id="values4_5"></div>
        	</div>
        </li>
		<li class="vv">5·广告宣传单</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside5_5 inside5"></div></div>
        		<div id="values5_5"></div>
        	</div>
        </li>
    </ul>
	<h1>6.您觉得不办理信用卡的原因是？</h1>
	<ul>
    	<li  class="vv">1·信用卡办理手续麻烦</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_6 inside1"></div></div>
        		<div id="values1_6"></div>
        	</div>
        </li>
    	<li class="vv">2·信用卡需要交年费</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_6 inside2"></div></div>
        		<div id="values2_6"></div>
        	</div>
        </li>
		<li  class="vv">3·信用卡使用不够方便</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside3_6 inside3"></div></div>
        		<div id="values3_6"></div>
        	</div>
        </li>
    	<li class="vv">4·信用卡使用不够安全</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside4_6 inside4"></div></div>
        		<div id="values4_6"></div>
        	</div>
        </li>
    </ul>
	<h1>7.您的月收入？</h1>
	<ul>
    	<li  class="vv">1·1000-3000元</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_7 inside1"></div></div>
        		<div id="values1_7"></div>
        	</div>
        </li>
    	<li class="vv">2·3000-5000元</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_7 inside2"></div></div>
        		<div id="values2_7"></div>
        	</div>
        </li>
		<li  class="vv">3·5000-8000元</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside3_7 inside3"></div></div>
        		<div id="values3_7"></div>
        	</div>
        </li>
    	<li class="vv">4·8000元以上</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside4_7 inside4"></div></div>
        		<div id="values4_7"></div>
        	</div>
        </li>
    </ul>
	<h1>8.针对信用卡预借现金的优惠措施，您更青睐哪种方案？</h1>
	<ul>
    	<li  class="vv">1·减免1%的手续费（原为收取预借现金额度的1%）</li>
    	<li  class="vv">
        	<div>
        		<div class="outside"><div class="inside1_8 inside1"></div></div>
        		<div id="values1_8"></div>
        	</div>
        </li>
    	<li class="vv">2·预借现金额度每月按10%还款（原为预借现金额度每月按照100%还款）</li>
        <li class="vv">
        	<div>
        		<div class="outside"><div class="inside2_8 inside2"></div></div>
        		<div id="values2_8"></div>
        	</div>
        </li>
    </ul>
</div>
</body>