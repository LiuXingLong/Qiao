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
		str="该桥得分为："+<?php echo ($data["score"]); ?>+"&nbsp;&nbsp;&nbsp;&nbsp;评分等级为："+<?php echo ($data["level"]); ?>+"类桥";
		$("p").html(str);		
		$('#modal-container-1').modal('show');
	});
	function pingding(){
		check=$(":checkbox:checked");
		str="";
		if(check.length>0){
			str="该桥得分为："+<?php echo ($data["score"]); ?>+"&nbsp;&nbsp;&nbsp;&nbsp;评分等级为：5类桥<br/><br/>";	
		}else{
			str="该桥得分为："+<?php echo ($data["score"]); ?>+"&nbsp;&nbsp;&nbsp;&nbsp;评分等级为："+<?php echo ($data["level"]); ?>+"类桥";
		}
		for(var i=0;i<check.length;i++){
			str+=check[i].nextSibling.nodeValue+"<br/><br/>";
		}
		$("p").html(str);
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
       		word-break: break-all;
       		word-wrap: break-word;
        }
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
					<a href="<?php echo U('Pingding/index');?>">构件生成</a>
				</li>
				<li style="margin-top: 20px;" class="active">
					<a href="#">计算评定</a>
				</li>
				<li style="margin-top: 20px;">
					<a href="<?php echo U('Index/index');?>">返回主页</a>
				</li>				
			</ul>   					               
        </div>      
		<div class="span11" style="float: left;">
			<div class="span9">
				<div class="panel panel-primary" style="margin-bottom: 60px;">
					<div class="panel-heading">
						<h3 class="panel-title" contenteditable="false">计算评定</h3>
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">上部结构有落梁；或有梁、板梁裂的现象				
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">梁式桥上部承重构件控制截面出现全截面开裂；或组合结构上部承重构件结合面开裂贯通，造成成截面组合作用严重降低
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">梁式桥上部承重构件有严重的异常位移，存在失稳定现象				
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">结构出现永久变形，变形大于规范值
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">关键部位混凝土出现压碎或杆件失稳倾向；或桥面板出现严重塌陷				
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">扩大基础冲刷尝试大于设计值，部空面积达20%以上
					</div>
					<div class="panel-body" contenteditable="false">
						<input type="checkbox">桥墩（桥台或基础）不稳定，出现严重滑动、下沉、位移、倾斜等现象				
					</div>
					<div class="panel-body" contenteditable="false">
						<button data-toggle="modal" id="modal-code" href="#modal-container-code" class="btn btn-success" type="button" style="margin-left: 30px;">生成报表二维码</button>
						<button class="btn btn-success"	type="button" style="margin-left: 30px;" onclick="window.location.href='<?php echo U('Baobiao/index');?>'">报表生成查看</button>
						<button data-toggle="modal" id="modal-1" href="#modal-container-1" class="btn btn-success" style="margin-top: 0px;margin-bottom: 20px;float:right;"  type="button"  onclick="pingding()">评分</button>						
					</div>					 
				</div>
			</div>
		</div>			
		<div id="modal-container-1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">
					桥梁等级评分
				</h3>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> 
				 <button class="btn btn-primary"  data-dismiss="modal" aria-hidden="true">确认</button>
			</div>
		</div>
		<!-- 二维码显示 -->
		<div id="modal-container-code" style="left: 500px;margin-left: 20px;width:316px; height:316px;" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<img alt="未上传图片，请上传图片！"  src="/Qiao/Application/Home/View/Public/<?php echo ($data['qrcode']); ?>" class="img-rounded" />								
		 </div>
		 <!-- 二维码显示 -->
	</div>
</div>       
</body>
</html>