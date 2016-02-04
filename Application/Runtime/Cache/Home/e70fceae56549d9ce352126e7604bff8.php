<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>公路桥梁检测评定系统</title>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-ui"></script>
	<link href="/Qiao/Application/Home/View/Public/bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/bootstrap.min.js"></script>	
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
					<a href="<?php echo U('Baobiao/index');?>">桥梁基本信息表</a>
				</li>
				<li class="active" style="margin-top: 20px;">
					<a href="#">桥梁技术状况评分表</a>
				</li>				
				<li style="margin-top: 20px;">
					<a href="<?php echo U('Baobiao/jilu');?>">桥梁检测记录表</a>
				</li>				
				<li style="margin-top: 20px;">
					<a href="<?php echo U('Index/index');?>">返回主页</a>
				</li>				
			</ul>   					               
		</div>      

		<div class="span10" style="float: left;margin-left:60px;">
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
								<td><?php echo ($data["t1"]); ?></td>
								<td><?php echo ($data1["t2"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="success">
								<td>上部结构</td>
								<td>2</td>
								<td>上部一般构件</td>
								<td>0.18</td>
								<td><?php echo ($data["t3"]); ?></td>
								<td><?php echo ($data1["t4"]); ?></td>
								<td><?php echo ($data1["j1"]); ?></td>
								<td></td>
							</tr>
							<tr class="success">
								<td></td>
								<td>3</td>
								<td>支座</td>
								<td>0.12</td>
								<td><?php echo ($data["t5"]); ?></td>
								<td><?php echo ($data1["t6"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>4</td>
								<td>翼墙耳墙</td>
								<td>0.02</td>
								<td><?php echo ($data["t7"]); ?></td>
								<td><?php echo ($data1["t8"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>5</td>
								<td>锥坡护坡</td>
								<td>0.01</td>
								<td><?php echo ($data["t9"]); ?></td>
								<td><?php echo ($data1["t10"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>6</td>
								<td>桥墩</td>
								<td>0.30</td>
								<td><?php echo ($data["t11"]); ?></td>
								<td><?php echo ($data1["t12"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td>下部结构</td>
								<td>7</td>
								<td>桥台</td>
								<td>0.30</td>
								<td><?php echo ($data["t13"]); ?></td>
								<td><?php echo ($data1["t14"]); ?></td>
								<td><?php echo ($data1["j2"]); ?></td>
								<td><?php echo ($data1["q"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>8</td>
								<td>墩台基础</td>
								<td>0.28</td>
								<td><?php echo ($data["t15"]); ?></td>
								<td><?php echo ($data1["t16"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>9</td>
								<td>河床</td>
								<td>0.07</td>
								<td><?php echo ($data["t17"]); ?></td>
								<td><?php echo ($data1["t18"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>10</td>
								<td>调治构造物</td>
								<td>0.02</td>
								<td><?php echo ($data["t19"]); ?></td>
								<td><?php echo ($data1["t20"]); ?></td>
								<td></td>
								<td></td>
							</tr>					
							<tr class="info">
								<td></td>
								<td>11</td>
								<td>桥面铺装</td>
								<td>0.40</td>
								<td><?php echo ($data["t21"]); ?></td>
								<td><?php echo ($data1["t22"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>12</td>
								<td>伸缩缝装置</td>
								<td>0.25</td>
								<td><?php echo ($data["t23"]); ?></td>
								<td><?php echo ($data1["t24"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="info">
								<td>桥面系</td>
								<td>13</td>
								<td>人行道</td>
								<td>0.10</td>
								<td><?php echo ($data["t25"]); ?></td>
								<td><?php echo ($data1["t26"]); ?></td>
								<td><?php echo ($data1["j3"]); ?></td>
								<td></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>14</td>
								<td>栏杆、护栏</td>
								<td>0.10</td>
								<td><?php echo ($data["t27"]); ?></td>
								<td><?php echo ($data1["t28"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>15</td>
								<td>排水系统</td>
								<td>0.10</td>
								<td><?php echo ($data["t29"]); ?></td>
								<td><?php echo ($data1["t30"]); ?></td>
								<td></td>
								<td></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>16</td>
								<td>照明、标志</td>
								<td>0.05</td>
								<td><?php echo ($data["t31"]); ?></td>
								<td><?php echo ($data1["t32"]); ?></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div style="height: 60px;"></div>
		</div>		
	</div>
</div>       
</body>
</html>