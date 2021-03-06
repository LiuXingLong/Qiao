<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>公路桥梁检测评定系统</title>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-ui"></script>
	<link href="/Qiao/Application/Home/View/Public/bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/bootstrap.min.js"></script>	
	<script type="text/javascript">
		$(function(){
			<?php for($i=1;$i<106;$i++){ if(($i==100||$i==102)&&$data[$i]==""){ $str="$("."'"."#t".$i."'".").html("."'"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."'".");"; }else{ $str="$("."'"."#t".$i."'".").html("."'".$data[$i]."'".");"; } echo $str; } ?>
		});
		function showdata(){
			$("#setbtn").show();
			$("#savebtn").hide();
			$("#returnbtn").hide();
			<?php for($i=1;$i<106;$i++){ if(($i==100||$i==102)&&$data[$i]==""){ $str="$("."'"."#t".$i."'".").html("."'"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."'".");"; }else{ $str="$("."'"."#t".$i."'".").html("."'".$data[$i]."'".");"; } echo $str; } ?>		
		}
		function setdata(){
			$("#setbtn").hide();
			$("#savebtn").show();
			$("#returnbtn").show();
			<?php for($i=1;$i<106;$i++){ $str="$("."'"."#t".$i."'".").html("."'"."<input id=".'"'."data".$i.'"'."   type=".'"'."text".'"'."    value=".'"'.$data[$i].'"'.">"."'".");"; echo $str; } ?>
		}
		function savedata(){
			var r=confirm("确认保存修改信息吗？");
			if(r==true){			
				var data=new Array();
				for(var i=1;i<106;i++){
					data[i]=$('#data'+i).val().trim();	
				}
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Baobiao/updatajilu');?>',
		   	        data: {data:data},   //  传入数组数据 
		   	        success: function (data){
		   	        	if(data=="Error"){ 
		   	            	alert("修改失败！");	    	            	
		   	            }else{
		   	            	window.location.href ="<?php echo U('Baobiao/jilu');?>";
		   	            }			   	        	
		   	        }
		   	    });	
			}			
		}
	</script>
	<style type="text/css">
		.table th, .table td {
    		 padding: 8px;
   			 line-height: 20px;
   			 text-align: center;
             vertical-align: top;
             border-top: 1px solid #dddddd;           
        }
        .panel-body{
        	/* 子元素不超过该元素的宽度  */
       		word-break: break-all;
       		word-wrap: break-word;
        }        
        input{
        	width: 120px;
        } 
        /*
        	<input type="text" placeholder="">
        */              
	</style>
</head>
<body style="background:url(/Qiao/Application/Home/View/Public/css/body.jpg);background-attachment:fixed;background-repeat:no-repeat;">
<div>
	<div>                   
		<div style="margin-top: 50px;">
			<div style="float: right;margin-right: 60px;  color: #08c;">
				<span><?php echo ($_SESSION['username']); ?>,欢迎您！</span>                             
				<button class="btn btn-success" type="button" onclick="window.location.href='<?php echo U('Login/logout');?>'">退出</button>
			</div> 
			<h3 class="text-center text-success" style="margin-left: 200px;">公路桥梁检测评定系统</h3>
		</div>                 
	</div>
    <div  style="margin-top: 60px;">
		<div class="span2" >                
			<ul class="nav nav-stacked nav-pills">
				<li>
					<a href="<?php echo U('Baobiao/index');?>">桥梁基本信息表</a>
				</li>
				<li style="margin-top: 20px;">
					<a href="<?php echo U('Baobiao/pingfen');?>">桥梁技术状况评分表</a>
				</li>				
				<li class="active" style="margin-top: 20px;">
					<a href="#">桥梁检测记录表</a>
				</li>			
				<li style="margin-top: 20px;">
					<a href="<?php echo U('Index/index');?>">返回主页</a>
				</li>								
			</ul>   					               
		</div>      
		<div class="span11" style="float: left;">
			<div class="panel panel-info">
			   <div class="panel-heading">
			      <h3 class="panel-title">桥梁检查记录表</h3>
			   </div>
			   <div class="panel-body">
			   		<table class="table table-bordered" style="background-color: #77E596;border-bottom-width: 0px;margin-bottom: 0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;" contenteditable="false">
						<thead style="">
							<tr>
								<th style="width: 120px;">管理单位</th>
								<th colspan="5" id="t1"></th>
							</tr>
						</thead>
						<tbody>
							<tr class="warning">
								<td>路线编码</td>
								<td id="t2"></td>
								<td>路线名称</td>
								<td id="t3"></td>
								<td>桥位桩号</td>
								<td colspan="2" id="t4"></td>								
							</tr>
							<tr class="warning">
								<td>桥梁编码</td>
								<td id="t5"></td>
								<td>桥梁名称</td>
								<td id="t6"></td>
								<td>下穿通道名</td>
								<td colspan="2" id="t7"></td>								
							</tr>
							<tr class="warning">
								<td>桥长(m)</td>
								<td id="t8"></td>
								<td>主跨结构</td>
								<td id="t9"></td>
								<td>最大跨径(m)</td>
								<td colspan="2" id="t10"></td>								
							</tr>
							<tr class="warning">
								<td>管养单位</td>
								<td id="t11"></td>
								<td>建成年月</td>
								<td id="t12"></td>
								<td>上次大中修日期</td>
								<td colspan="2" id="t13"></td>								
							</tr>												
							<tr class="warning">
								<td>上次检查日期</td>
								<td id="t14"></td>
								<td>本次检查日期</td>
								<td id="t15"></td>
								<td colspan="2">气候</td>
								<td id="t16"></td>
							</tr>						
							<tr class="warning">
								<td>桥梁组成</td>
								<td>部件名称</td>
								<td>缺损状况及位置</td>
								<td>维修范围</td>
								<td>维修方式</td>
								<td>维修时间</td>							
								<td>费用(元)</td>
							</tr>						
							<tr class="success">
								<td></td>
								<td>上部主要承重结构</td>
								<td id="t17"></td>
								<td id="t18"></td>
								<td id="t19"></td>
								<td id="t20"></td>
								<td id="t21"></td>
							</tr>
							<tr class="success">
								<td>上部结构</td>
								<td>上部一般承重结构</td>
								<td id="t22"></td>
								<td id="t23"></td>
								<td id="t24"></td>
								<td id="t25"></td>
								<td id="t26"></td>
							</tr>
							<tr class="success">
								<td></td>
								<td>支座</td>
								<td id="t27"></td>
								<td id="t28"></td>
								<td id="t29"></td>
								<td id="t30"></td>
								<td id="t31"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>翼墙耳墙</td>
								<td id="t32"></td>
								<td id="t33"></td>
								<td id="t34"></td>
								<td id="t35"></td>
								<td id="t36"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>锥坡护坡</td>
								<td id="t37"></td>
								<td id="t38"></td>
								<td id="t39"></td>
								<td id="t40"></td>
								<td id="t41"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>桥墩</td>
								<td id="t42"></td>
								<td id="t43"></td>
								<td id="t44"></td>
								<td id="t45"></td>
								<td id="t46"></td>
							</tr>
							<tr class="warning">
								<td>下部结构</td>
								<td>桥台</td>
								<td id="t47"></td>
								<td id="t48"></td>
								<td id="t49"></td>
								<td id="t50"></td>
								<td id="t51"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>墩台基础</td>
								<td id="t52"></td>
								<td id="t53"></td>
								<td id="t54"></td>
								<td id="t55"></td>
								<td id="t56"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>河床</td>
								<td id="t57"></td>
								<td id="t58"></td>
								<td id="t59"></td>
								<td id="t60"></td>
								<td id="t61"></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>调治构造物</td>
								<td id="t62"></td>
								<td id="t63"></td>
								<td id="t64"></td>
								<td id="t65"></td>
								<td id="t66"></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>桥面铺装</td>
								<td id="t67"></td>
								<td id="t68"></td>
								<td id="t69"></td>
								<td id="t70"></td>
								<td id="t71"></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>伸缩缝</td>
								<td id="t72"></td>
								<td id="t73"></td>
								<td id="t74"></td>
								<td id="t75"></td>
								<td id="t76"></td>
							</tr>
							<tr class="info">
								<td>桥面系</td>
								<td>人行道</td>
								<td id="t77"></td>
								<td id="t78"></td>
								<td id="t79"></td>
								<td id="t80"></td>
								<td id="t81"></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>栏杆护栏</td>
								<td id="t82"></td>
								<td id="t83"></td>
								<td id="t84"></td>
								<td id="t85"></td>
								<td id="t86"></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>排水系统</td>
								<td id="t87"></td>
								<td id="t88"></td>
								<td id="t89"></td>
								<td id="t90"></td>
								<td id="t91"></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>照明标志</td>
								<td id="t92"></td>
								<td id="t93"></td>
								<td id="t94"></td>
								<td id="t95"></td>
								<td id="t96"></td>
							</tr>			
						</tbody>
				  </table>
				  <table class="table table-bordered" contenteditable="false" style="background-color: #FCF8E3;border-top-left-radius:0px;border-top-right-radius:0px;">
				  		<thead>
							<tr>
								<th style="width: 120px;">其他</th>						
								<th colspan="3" id="t97"></th>								
							</tr>
						</thead>
						<tbody>					
							<tr class="warning">
								<td>养护建议</td>						
								<td colspan="2" id="t98"></td>								
								<td>总体状况等级</td>						
								<td colspan="2" id="t99"></td>															
							</tr>
							<tr class="warning">
								<td>全桥清洁状况评分</td>						
								<td id="t100"></td>
								<td>保养小修状况评分</td>						
								<td id="t101"></td>
								<td>下次检测时间</td>						
								<td id="t102"></td>								
							</tr>
							<tr class="warning">
								<td>负责人</td>						
								<td id="t103"></td>
								<td>记录人</td>						
								<td id="t104"></td>
								<td>检测日期</td>						
								<td id="t105"></td>								
							</tr>
						</tbody>
				   </table>
				   <button class="btn btn-success" id="setbtn" type="button" style="float:right;margin-bottom:20px;" onclick="setdata()">编辑</button>
				   <button class="btn btn-success" id="savebtn" type="button" style="float:right;display:none;margin-bottom:20px;" onclick="savedata()">保存</button>
				   <button class="btn btn-success" id="returnbtn" type="button" style="float:right;display:none;margin-bottom:20px;margin-right: 40px;" onclick="showdata()">返回</button>  			  
			   </div>			   
			</div>			
		</div>
	</div>
</div>       
</body>
</html>