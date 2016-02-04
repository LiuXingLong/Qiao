<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="utf-8">
<title>公路桥梁检测评定系统</title>
<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-ui"></script>
<link href="/Qiao/Application/Home/View/Public/bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/bootstrap.min.js"></script>	
<style type="text/css">
.panel-body{
     word-break: break-all;
     word-wrap: break-word;
 }
 .badge-success{
 	font-size:18px;
 	padding-top: 6px;
 	padding-bottom: 6px;
 }
 body {
	/* 加载背景图 */
	background-image: url(/Qiao/Application/Home/View/Public/css/body.jpg);
	
	/* 让背景图基于容器大小伸缩 */
	background-size: cover;

	/* 背景图垂直、水平均居中 */
	background-position: center center;

	/* 背景图不平铺 */
	/*background-repeat: no-repeat;*/

	/* 当内容高度大于图片高度时，背景图像的位置相对于viewport固定 */
	/*background-attachment: fixed;*/

	/* 设置背景颜色，背景图加载过程中会显示背景色 */
	/*background-color: #464646;*/	
}
</style>
</head>
<body>
 <div class="span12">
 	 <h3 style="background-color: #5CB85C;color:#EEE;border-radius: 6px;text-align:center;"><?php echo ($data["name"]); ?></h3>
 </div>                     
<div class="span12" id="showtable">               	
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">行政识别数据</h3>
		</div>
	<div class="panel-body">
		<table class="table table-bordered">						
			<tbody>
				<tr>
					<td>路线编号</td>
					<td><?php echo ($data[1]); ?></td>
					<td>路线名称</td>
					<td><?php echo ($data[2]); ?></td>
					<td>路线等级</td>
					<td><?php echo ($data[3]); ?></td>
				</tr>
				<tr class="success">
					<td>桥梁编号</td>
					<td><?php echo ($data[4]); ?></td>
					<td>桥梁名称</td>
					<td><?php echo ($data[5]); ?></td>
					<td>桥位桩号</td>
					<td><?php echo ($data[6]); ?></td>
				</tr>
				<tr class="error">
					<td>功能类型</td>
					<td><?php echo ($data[7]); ?></td>
					<td>下穿通道名</td>
					<td><?php echo ($data[8]); ?></td>
					<td>下穿通道桩号</td>
					<td><?php echo ($data[9]); ?></td>
				</tr>
				<tr class="warning">
					<td>设计荷载</td>
					<td><?php echo ($data[10]); ?></td>
					<td>通行载重</td>
					<td><?php echo ($data[11]); ?></td>
					<td>弯斜坡度</td>
					<td><?php echo ($data[12]); ?></td>
				</tr>
				<tr class="info">
					<td>桥面铺装</td>
					<td><?php echo ($data[13]); ?></td>
					<td>管养单位</td>
					<td><?php echo ($data[14]); ?></td>
					<td class="ml">建成年限</td>
					<td><?php echo ($data[15]); ?></td>
				</tr>
			</tbody>
		</table>
	</div>					
	</div>	
</div>
<div class="span12" id="showtable1">                	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				结构技术数据
			</h3>
		</div>
	<div class="panel-body">
		<table class="table table-bordered">						
			<tbody>
				<tr>
					<td>桥长(m)</td>
					<td><?php echo ($data[16]); ?></td>
					<td>桥面总宽(m)</td>
					<td><?php echo ($data[17]); ?></td>
					<td>车行道宽(m)</td>
					<td><?php echo ($data[18]); ?></td>
				</tr>
				<tr class="success">
					<td>桥面标高(m)</td>
					<td><?php echo ($data[19]); ?></td>
					<td>桥下净高(m)</td>
					<td><?php echo ($data[20]); ?></td>
					<td>桥上净高(m)</td>
					<td><?php echo ($data[21]); ?></td>
				</tr>
				<tr class="error">
					<td>引道总宽(m)</td>
					<td><?php echo ($data[22]); ?></td>
					<td>引道路面宽(m)</td>
					<td><?php echo ($data[23]); ?></td>
					<td>引道线形</td>
					<td><?php echo ($data[24]); ?></td>
				</tr>
				<tr class="warning">
					<td>桥梁跨数</td>
					<td><?php echo ($data[25]); ?></td>
					<td>主要跨径(m)</td>
					<td><?php echo ($data[26]); ?></td>
					<td>基础类型</td>
					<td><?php echo ($data[27]); ?></td>
				</tr>
				<tr class="info">
					<td>伸缩缝类型</td>
					<td><?php echo ($data[28]); ?></td>
					<td>支座形式</td>
					<td><?php echo ($data[29]); ?></td>
					<td>地震动峰值加速度系数</td>
					<td><?php echo ($data[30]); ?></td>
				</tr>
			</tbody>
		</table>
	</div>					
	</div>	
</div>
<div class="span4" style="margin-bottom: 20px;">
	<div class="panel panel-success">
		<div class="panel-heading" style="height: 20px;">
			<h3 class="panel-title">
				正面照									
			</h3>								
		</div>
		<div class="panel-body" style="padding-bottom: 20px;" >
			<div class="span3">
				<div>
					<img id="img1"  alt="未上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img1']); ?>" class="img-rounded" />
				</div>										
			</div>							
		</div>				
	</div>
 </div>	
 <div class="span4" style="margin-bottom: 20px;">
	<div class="panel panel-success">
		<div class="panel-heading" style="height: 20px;">
			<h3 class="panel-title">
				立面照									
			</h3>								
		</div>
		<div class="panel-body" style="padding-bottom: 20px;" >
			<div class="span3">
				<div>
					<img id="img2" alt="未上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img2']); ?>" class="img-rounded" />
				</div>										
			</div>							
		</div>				
	</div>
 </div>	
 <div class="span4" style="margin-bottom: 60px;">
	<div class="panel panel-success">
		<div class="panel-heading" style="height: 20px;">
			<h3 class="panel-title">
				结构简图								
			</h3>								
		</div>
		<div class="panel-body" style="padding-bottom: 20px;" >
			<div class="span3">
				<div>
					<img id="img3"  alt="未上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img3']); ?>" class="img-rounded" />
				</div>										
			</div>							
		</div>				
	</div>
 </div>		 
<div class="span12" style="margin-bottom: 60px;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title" contenteditable="false">桥梁技术状况评分表</h3>
		</div>
		<div class="panel-body" contenteditable="false">
			<table class="table table-bordered" id="showtable">
				<thead>
					<tr style="background-color: #77E596;">
						<th>部位</th>
						<th>类别</th>
						<th>评分部件</th>
						<th>权重</th>
						<th>调整后权重</th>
						<th>部件评分</th>
						<th>结构评分</th>
						<th>技术状况评分</th>
					</tr>
				</thead>
				<tbody>								
					<tr class="success">
						<td></td>
						<td>1</td>
						<td>上部承重构件</td>
						<td>0.70</td>
						<td><?php echo ($data1["t1"]); ?></td>
						<td><?php echo ($data1["t2"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="success">
						<td>上部结构</td>
						<td>2</td>
						<td>上部一般构件</td>
						<td>0.18</td>
						<td><?php echo ($data1["t3"]); ?></td>
						<td><?php echo ($data1["t4"]); ?></td>
						<td><?php echo ($data1["j1"]); ?></td>
						<td></td>
					</tr>
					<tr class="success">
						<td></td>
						<td>3</td>
						<td>支座</td>
						<td>0.12</td>
						<td><?php echo ($data1["t5"]); ?></td>
						<td><?php echo ($data1["t6"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>4</td>
						<td>翼墙耳墙</td>
						<td>0.02</td>
						<td><?php echo ($data1["t7"]); ?></td>
						<td><?php echo ($data1["t8"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>5</td>
						<td>锥坡护坡</td>
						<td>0.01</td>
						<td><?php echo ($data1["t9"]); ?></td>
						<td><?php echo ($data1["t10"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>6</td>
						<td>桥墩</td>
						<td>0.30</td>
						<td><?php echo ($data1["t11"]); ?></td>
						<td><?php echo ($data1["t12"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td>下部结构</td>
						<td>7</td>
						<td>桥台</td>
						<td>0.30</td>
						<td><?php echo ($data1["t13"]); ?></td>
						<td><?php echo ($data1["t14"]); ?></td>
						<td><?php echo ($data1["j2"]); ?></td>
						<td><?php echo ($data1["q"]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>8</td>
						<td>墩台基础</td>
						<td>0.28</td>
						<td><?php echo ($data1["t15"]); ?></td>
						<td><?php echo ($data1["t16"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>9</td>
						<td>河床</td>
						<td>0.07</td>
						<td><?php echo ($data1["t17"]); ?></td>
						<td><?php echo ($data1["t18"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>10</td>
						<td>调治构造物</td>
						<td>0.02</td>
						<td><?php echo ($data1["t19"]); ?></td>
						<td><?php echo ($data1["t20"]); ?></td>
						<td></td>
						<td></td>
					</tr>					
					<tr class="info">
						<td></td>
						<td>11</td>
						<td>桥面铺装</td>
						<td>0.40</td>
						<td><?php echo ($data1["t21"]); ?></td>
						<td><?php echo ($data1["t22"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>12</td>
						<td>伸缩缝装置</td>
						<td>0.25</td>
						<td><?php echo ($data1["t23"]); ?></td>
						<td><?php echo ($data1["t24"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td>桥面系</td>
						<td>13</td>
						<td>人行道</td>
						<td>0.10</td>
						<td><?php echo ($data1["t25"]); ?></td>
						<td><?php echo ($data1["t26"]); ?></td>
						<td><?php echo ($data1["j3"]); ?></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>14</td>
						<td>栏杆、护栏</td>
						<td>0.10</td>
						<td><?php echo ($data1["t27"]); ?></td>
						<td><?php echo ($data1["t28"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>15</td>
						<td>排水系统</td>
						<td>0.10</td>
						<td><?php echo ($data1["t29"]); ?></td>
						<td><?php echo ($data1["t30"]); ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>16</td>
						<td>照明、标志</td>
						<td>0.05</td>
						<td><?php echo ($data1["t31"]); ?></td>
						<td><?php echo ($data1["t32"]); ?></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="span12" style="margin-bottom: 60px;">
	<div class="panel panel-info">
	   <div class="panel-heading">
	      <h3 class="panel-title">桥梁检查记录表</h3>
	   </div>
	   <div class="panel-body">
	   		<table class="table table-bordered" style="background-color: #77E596;border-bottom-width: 0px;margin-bottom: 0px;border-bottom-right-radius:0px;border-bottom-left-radius:0px;" contenteditable="false">
				<thead>
					<tr>
						<th style="width: 120px;">管理单位</th>
						<th colspan="5"><?php echo ($data2[1]); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr class="warning">
						<td>路线编码</td>
						<td><?php echo ($data2[2]); ?></td>
						<td>路线名称</td>
						<td><?php echo ($data2[3]); ?></td>
						<td>桥位桩号</td>
						<td colspan="2"><?php echo ($data2[4]); ?></td>								
					</tr>
					<tr class="warning">
						<td>桥梁编码</td>
						<td><?php echo ($data2[5]); ?></td>
						<td>桥梁名称</td>
						<td><?php echo ($data2[6]); ?></td>
						<td>下穿通道名</td>
						<td colspan="2"><?php echo ($data2[7]); ?></td>								
					</tr>
					<tr class="warning">
						<td>桥长(m)</td>
						<td><?php echo ($data2[8]); ?></td>
						<td>主跨结构</td>
						<td><?php echo ($data2[9]); ?></td>
						<td>最大跨径(m)</td>
						<td colspan="2"><?php echo ($data2[10]); ?></td>								
					</tr>
					<tr class="warning">
						<td>管养单位</td>
						<td><?php echo ($data2[11]); ?></td>
						<td>建成年月</td>
						<td><?php echo ($data2[12]); ?></td>
						<td>上次大中修日期</td>
						<td colspan="2"><?php echo ($data2[13]); ?></td>								
					</tr>												
					<tr class="warning">
						<td>上次检查日期</td>
						<td><?php echo ($data2[14]); ?></td>
						<td>本次检查日期</td>
						<td><?php echo ($data2[15]); ?></td>
						<td colspan="2">气候</td>
						<td><?php echo ($data2[16]); ?></td>
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
						<td><?php echo ($data2[17]); ?></td>
						<td><?php echo ($data2[18]); ?></td>
						<td><?php echo ($data2[19]); ?></td>
						<td><?php echo ($data2[20]); ?></td>
						<td><?php echo ($data2[21]); ?></td>
					</tr>
					<tr class="success">
						<td>上部结构</td>
						<td>上部一般承重结构</td>
						<td><?php echo ($data2[22]); ?></td>
						<td><?php echo ($data2[23]); ?></td>
						<td><?php echo ($data2[24]); ?></td>
						<td><?php echo ($data2[25]); ?></td>
						<td><?php echo ($data2[26]); ?></td>
					</tr>
					<tr class="success">
						<td></td>
						<td>支座</td>
						<td><?php echo ($data2[27]); ?></td>
						<td><?php echo ($data2[28]); ?></td>
						<td><?php echo ($data2[29]); ?></td>
						<td><?php echo ($data2[30]); ?></td>
						<td><?php echo ($data2[31]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>翼墙耳墙</td>
						<td><?php echo ($data2[32]); ?></td>
						<td><?php echo ($data2[33]); ?></td>
						<td><?php echo ($data2[34]); ?></td>
						<td><?php echo ($data2[35]); ?></td>
						<td><?php echo ($data2[36]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>锥坡护坡</td>
						<td><?php echo ($data2[37]); ?></td>
						<td><?php echo ($data2[38]); ?></td>
						<td><?php echo ($data2[39]); ?></td>
						<td><?php echo ($data2[40]); ?></td>
						<td><?php echo ($data2[41]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>桥墩</td>
						<td><?php echo ($data2[42]); ?></td>
						<td><?php echo ($data2[43]); ?></td>
						<td><?php echo ($data2[44]); ?></td>
						<td><?php echo ($data2[45]); ?></td>
						<td><?php echo ($data2[46]); ?></td>
					</tr>
					<tr class="warning">
						<td>下部结构</td>
						<td>桥台</td>
						<td><?php echo ($data2[47]); ?></td>
						<td><?php echo ($data2[48]); ?></td>
						<td><?php echo ($data2[49]); ?></td>
						<td><?php echo ($data2[50]); ?></td>
						<td><?php echo ($data2[51]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>墩台基础</td>
						<td><?php echo ($data2[52]); ?></td>
						<td><?php echo ($data2[53]); ?></td>
						<td><?php echo ($data2[54]); ?></td>
						<td><?php echo ($data2[55]); ?></td>
						<td><?php echo ($data2[56]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>河床</td>
						<td><?php echo ($data2[57]); ?></td>
						<td><?php echo ($data2[58]); ?></td>
						<td><?php echo ($data2[59]); ?></td>
						<td><?php echo ($data2[60]); ?></td>
						<td><?php echo ($data2[61]); ?></td>
					</tr>
					<tr class="warning">
						<td></td>
						<td>调治构造物</td>
						<td><?php echo ($data2[62]); ?></td>
						<td><?php echo ($data2[63]); ?></td>
						<td><?php echo ($data2[64]); ?></td>
						<td><?php echo ($data2[65]); ?></td>
						<td><?php echo ($data2[66]); ?></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>桥面铺装</td>
						<td><?php echo ($data2[67]); ?></td>
						<td><?php echo ($data2[68]); ?></td>
						<td><?php echo ($data2[69]); ?></td>
						<td><?php echo ($data2[70]); ?></td>
						<td><?php echo ($data2[71]); ?></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>伸缩缝</td>
						<td><?php echo ($data2[72]); ?></td>
						<td><?php echo ($data2[73]); ?></td>
						<td><?php echo ($data2[74]); ?></td>
						<td><?php echo ($data2[75]); ?></td>
						<td><?php echo ($data2[76]); ?></td>
					</tr>
					<tr class="info">
						<td>桥面系</td>
						<td>人行道</td>
						<td><?php echo ($data2[77]); ?></td>
						<td><?php echo ($data2[78]); ?></td>
						<td><?php echo ($data2[79]); ?></td>
						<td><?php echo ($data2[80]); ?></td>
						<td><?php echo ($data2[81]); ?></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>栏杆护栏</td>
						<td><?php echo ($data2[82]); ?></td>
						<td><?php echo ($data2[83]); ?></td>
						<td><?php echo ($data2[84]); ?></td>
						<td><?php echo ($data2[85]); ?></td>
						<td><?php echo ($data2[86]); ?></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>排水系统</td>
						<td><?php echo ($data2[87]); ?></td>
						<td><?php echo ($data2[88]); ?></td>
						<td><?php echo ($data2[89]); ?></td>
						<td><?php echo ($data2[90]); ?></td>
						<td><?php echo ($data2[91]); ?></td>
					</tr>
					<tr class="info">
						<td></td>
						<td>照明标志</td>
						<td><?php echo ($data2[92]); ?></td>
						<td><?php echo ($data2[93]); ?></td>
						<td><?php echo ($data2[94]); ?></td>
						<td><?php echo ($data2[95]); ?></td>
						<td><?php echo ($data2[96]); ?></td>
					</tr>			
				</tbody>
		  </table>
		  <table class="table table-bordered" contenteditable="false" style="background-color: #FCF8E3;border-top-left-radius:0px;border-top-right-radius:0px;">
		  		<thead>
					<tr>
						<th style="width: 120px;">其他</th>						
						<th colspan="3"><?php echo ($data2[97]); ?></th>								
					</tr>
				</thead>
				<tbody>					
					<tr class="warning">
						<td>养护建议</td>						
						<td colspan="2"><?php echo ($data2[98]); ?></td>								
						<td>总体状况等级</td>						
						<td colspan="2"><?php echo ($data2[99]); ?></td>															
					</tr>
					<tr class="warning">
						<td>全桥清洁状况评分</td>						
						<td><?php echo ($data2[100]); ?></td>
						<td>保养小修状况评分</td>						
						<td><?php echo ($data2[101]); ?></td>
						<td>下次检测时间</td>						
						<td><?php echo ($data2[102]); ?></td>								
					</tr>
					<tr class="warning">
						<td>负责人</td>						
						<td><?php echo ($data2[103]); ?></td>
						<td>记录人</td>						
						<td><?php echo ($data2[104]); ?></td>
						<td>检测日期</td>						
						<td><?php echo ($data2[105]); ?></td>								
					</tr>
				</tbody>
		   </table>
		 </div>			   
	</div>			
</div>				    
</body>
</html>