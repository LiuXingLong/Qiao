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
        input{
        	  width: 120px;
        } 
	</style>
	<script>
		function info(flag){
			if(flag==1){
				$("#showtable").hide();
				$("#updatebutton").hide();							
				$("#updatetable").show();
				$("#modal-1").show();
				$("#returnbutton").show();	
			}else if(flag==2){	
				$("#updatetable").hide();
				$("#modal-1").hide();
				$("#returnbutton").hide();
				$("#showtable").show();
				$("#updatebutton").show();				
			}else{
				/*  保存修改信息    */				
				//  alert("确认修改信息");
				var data=new Array();
				for(var i=1,j=2;j<33;j+=2){						
					data[i++]=$("#data"+j).val().trim();						
				}			
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Info/update2');?>',
		   	        data: {data:data},   //  传入数组数据 
		   	        success: function (data){		   	        	
		   	        	if(data=="Error"){ 
		   	            	alert("修改失败！");	    	            	
		   	            }else{
		   	            	window.location.href ="<?php echo U('Info/info');?>";
		   	            }			
		   	        }
		   	    });	
			}
		}
	</script>
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
							<a href="<?php echo U('Info/index');?>">桥梁基本信息</a>
						</li>
						<li class="active" style="margin-top: 20px;">
							<a href="#">结构组成</a>
						</li>
						<li style="margin-top: 20px;">
							<a href="<?php echo U('Index/index');?>">返回主页</a>
						</li>				
					</ul>   					               
              </div>  
                                
          <div class="span8" style="float: left;margin-left: 120px;">
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title" contenteditable="false">构件组成</h3>
				</div>
				<div class="panel-body" contenteditable="false">
					<table class="table table-bordered" id="showtable">
						<thead>
							<tr style="background-color: #77E596;">
								<th>部位</th>
								<th>部件</th>
								<th>权重</th>
								<th>修改后权重</th>
								<th>构件数量</th>
							</tr>
						</thead>
						<tbody>								
							<tr class="success">
								<td></td>
								<td>上部承重构件</td>
								<td>0.70</td>
								<td><?php echo ($data["t1"]); ?></td>
								<td><?php echo ($data["t2"]); ?></td>
							</tr>
							<tr class="success">
								<td>上部结构</td>
								<td>上部一般构件</td>
								<td>0.18</td>
								<td><?php echo ($data["t3"]); ?></td>
								<td><?php echo ($data["t4"]); ?></td>
							</tr>
							<tr class="success">
								<td></td>
								<td>支座</td>
								<td>0.12</td>
								<td><?php echo ($data["t5"]); ?></td>
								<td><?php echo ($data["t6"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>翼墙耳墙</td>
								<td>0.02</td>
								<td><?php echo ($data["t7"]); ?></td>
								<td><?php echo ($data["t8"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>锥坡护坡</td>
								<td>0.01</td>
								<td><?php echo ($data["t9"]); ?></td>
								<td><?php echo ($data["t10"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>桥墩</td>
								<td>0.30</td>
								<td><?php echo ($data["t11"]); ?></td>
								<td><?php echo ($data["t12"]); ?></td>
							</tr>
							<tr class="warning">
								<td>下部结构</td>
								<td>桥台</td>
								<td>0.30</td>
								<td><?php echo ($data["t13"]); ?></td>
								<td><?php echo ($data["t14"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>墩台基础</td>
								<td>0.28</td>
								<td><?php echo ($data["t15"]); ?></td>
								<td><?php echo ($data["t16"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>河床</td>
								<td>0.07</td>
								<td><?php echo ($data["t17"]); ?></td>
								<td><?php echo ($data["t18"]); ?></td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>调治构造物</td>
								<td>0.02</td>
								<td><?php echo ($data["t19"]); ?></td>
								<td><?php echo ($data["t20"]); ?></td>
							</tr>					
							<tr class="info">
								<td></td>
								<td>桥面铺装</td>
								<td>0.40</td>
								<td><?php echo ($data["t21"]); ?></td>
								<td><?php echo ($data["t22"]); ?></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>伸缩缝装置</td>
								<td>0.25</td>
								<td><?php echo ($data["t23"]); ?></td>
								<td><?php echo ($data["t24"]); ?></td>
							</tr>
							<tr class="info">
								<td>桥面系</td>
								<td>人行道</td>
								<td>0.10</td>
								<td><?php echo ($data["t25"]); ?></td>
								<td><?php echo ($data["t26"]); ?></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>栏杆、护栏</td>
								<td>0.10</td>
								<td><?php echo ($data["t27"]); ?></td>
								<td><?php echo ($data["t28"]); ?></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>排水系统</td>
								<td>0.10</td>
								<td><?php echo ($data["t29"]); ?></td>
								<td><?php echo ($data["t30"]); ?></td>
							</tr>
							<tr class="info">
								<td></td>
								<td>照明、标志</td>
								<td>0.05</td>
								<td><?php echo ($data["t31"]); ?></td>
								<td><?php echo ($data["t32"]); ?></td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered" id="updatetable" style="display:none;">
						<thead>
							<tr style="background-color: #77E596;">
								<th>部位</th>
								<th>部件</th>
								<th>权重</th>
								<th>修改后权重</th>
								<th>构件数量</th>
							</tr>
						</thead>
						<tbody>								
							<tr class="success">
								<td></td>
								<td>上部承重构件</td>
								<td>0.7</td>
								<td>
									<?php echo ($data['t1']); ?>
								</td>
								<td>
									<input id="data2" type="text" placeholder="" value="<?php echo ($data['t2']); ?>">
								</td>
							</tr>
							<tr class="success">
								<td>上部结构</td>
								<td>上部一般构件</td>
								<td>0.18</td>
								<td>
									<?php echo ($data['t3']); ?>
								</td>
								<td>
									<input id="data4" type="text" placeholder="" value="<?php echo ($data['t4']); ?>">
								</td>
							</tr>
							<tr class="success">
								<td></td>
								<td>支座</td>
								<td>0.12</td>
								<td>
									<?php echo ($data['t5']); ?>
								</td>
								<td>
									<input id="data6" type="text" placeholder="" value="<?php echo ($data['t6']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>翼墙耳墙</td>
								<td>0.02</td>
								<td>
									<?php echo ($data['t7']); ?>
								</td>
								<td>
									<input id="data8" type="text" placeholder="" value="<?php echo ($data['t8']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>锥坡护坡</td>
								<td>0.01</td>
								<td>
									<?php echo ($data['t9']); ?>
								</td>
								<td>
									<input id="data10" type="text" placeholder="" value="<?php echo ($data['t10']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>桥墩</td>
								<td>0.30</td>
								<td>
									<?php echo ($data['t11']); ?>
								</td>
								<td>
									<input id="data12" type="text" placeholder="" value="<?php echo ($data['t12']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td>下部结构</td>
								<td>桥台</td>
								<td>0.30</td>
								<td>
									<?php echo ($data['t13']); ?>
								</td>
								<td>
									<input id="data14" type="text" placeholder="" value="<?php echo ($data['t14']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>墩台基础</td>
								<td>0.28</td>
								<td>
									<?php echo ($data['t15']); ?>
								</td>
								<td>
									<input id="data16" type="text" placeholder="" value="<?php echo ($data['t16']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>河床</td>
								<td>0.07</td>
								<td>
									<?php echo ($data['t17']); ?>
								</td>
								<td>
									<input id="data18" type="text" placeholder="" value="<?php echo ($data['t18']); ?>">
								</td>
							</tr>
							<tr class="warning">
								<td></td>
								<td>调治构造物</td>
								<td>0.02</td>
								<td>
									<?php echo ($data['t19']); ?>
								</td>
								<td>
									<input id="data20" type="text" placeholder="" value="<?php echo ($data['t20']); ?>">
								</td>
							</tr>					
							<tr class="info">
								<td></td>
								<td>桥面铺装</td>
								<td>0.40</td>
								<td>
									<?php echo ($data['t21']); ?>
								</td>
								<td>
									<input id="data22" type="text" placeholder="" value="<?php echo ($data['t22']); ?>">
								</td>
							</tr>
							<tr class="info">
								<td></td>
								<td>伸缩缝装置</td>
								<td>0.25</td>
								<td>
									<?php echo ($data['t23']); ?>
								</td>
								<td>
									<input id="data24" type="text" placeholder="" value="<?php echo ($data['t24']); ?>">
								</td>
							</tr>
							<tr class="info">
								<td>桥面系</td>
								<td>人行道</td>
								<td>0.10</td>
								<td>
									<?php echo ($data['t25']); ?>
								</td>
								<td>
									<input id="data26" type="text" placeholder="" value="<?php echo ($data['t26']); ?>">
								</td>
							</tr>
							<tr class="info">
								<td></td>
								<td>栏杆、护栏</td>
								<td>0.10</td>
								<td>
									<?php echo ($data['t27']); ?>
								</td>
								<td>
									<input id="data28" type="text" placeholder="" value="<?php echo ($data['t28']); ?>">
								</td>
							</tr>
							<tr class="info">
								<td></td>
								<td>排水系统</td>
								<td>0.10</td>
								<td>
									<?php echo ($data['t29']); ?>
								</td>
								<td>
									<input id="data30" type="text" placeholder="" value="<?php echo ($data['t30']); ?>">
								</td>
							</tr>
							<tr class="info">
								<td></td>
								<td>照明、标志</td>
								<td>0.05</td>
								<td>
									<?php echo ($data['t31']); ?>
								</td>
								<td>
									<input id="data32" type="text" placeholder="" value="<?php echo ($data['t32']); ?>">
								</td>
							</tr>
						</tbody>
					</table>			
		           	<button class="btn btn-success" id="updatebutton" style="float: right;margin-bottom: 20px;display:<?php echo ($data['info2flag']); ?>;" type="button" onclick="info(1)">编辑信息</button>
		           	<button class="btn" id="returnbutton" style="float: right;margin-bottom: 20px; display:none;" type="button" onclick="info(2)">取消返回</button>          	
		           	<a id="modal-1" href="#modal-container-1" role="button" style="float:right;margin-bottom: 20px;margin-right: 40px; display:none;" class="btn" data-toggle="modal">保存信息</a>
				</div>
			</div>
			<div style="height: 60px;"></div>
			<div id="modal-container-1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						构件数量编辑提示！
					</h3>
				</div>
				<div class="modal-body">
					<p>
						注意：一但确定就不能再修改，需从新建桥！
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> 
					 <button class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" onclick="info(3)">确认</button>
				</div>
			</div>
			</div> 
			
			
        </div> 
   	</div>       
</body>
</html>