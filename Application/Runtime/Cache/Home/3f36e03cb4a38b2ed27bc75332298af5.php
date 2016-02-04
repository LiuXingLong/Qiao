<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>公路桥梁检测评定系统</title>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-ui"></script>
	<link href="/Qiao/Application/Home/View/Public/bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/bootstrap.min.js"></script>		
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/js/ajaxfileupload.js"></script>
	<script type="text/javascript">
		function info(flag){
			if(flag==1){
				$("#showtable").hide();
				$("#showtable1").hide();
				$("#updatebutton").hide();					
				$("#updatetable").show();
				$("#updatetable1").show();
				$("#modal-1").show();
				$("#returnbutton").show();
			}else if(flag==2){	
				$("#updatetable").hide();
				$("#updatetable1").hide();
				$("#modal-1").hide();
				$("#returnbutton").hide();	
				$("#showtable").show();
				$("#showtable1").show();
				$("#updatebutton").show();				
			}else{
				/*  保存修改信息     alert("确认修改信息"); */						
				var data=new Array();
				for(var i=1;i<31;i++){					
					data[i]=$("#data"+i).val().trim();					
				}
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Info/update1');?>',
		   	        data: {data:data},   //  传入数组数据 
		   	        success: function (data){
		   	        	if(data=="Error"){ 
		   	            	alert("修改失败！");	    	            	
		   	            }else{
		   	            	window.location.href ="<?php echo U('Info/index');?>";
		   	            }			   	        	
		   	        }
		   	    });					
			}
		}
		
		//  图片上传
		function buttonUpload(fg){			
			fileToUpload="fileToUpload"+fg;
			$.ajaxFileUpload({
		        url:"<?php echo U(MODULE_NAME.'/Upimg/index/img/"+fg+"');?>",//处理图片脚本
		        type: 'post',
		        secureuri :false,
		        fileElementId :fileToUpload,//file控件id	
		        dataType: 'text',
		        success : function (data){
			        	flag=data.split(",");
			        	if(flag[0]=="success"){
			        		Img="/Qiao/Application/Home/View/Public/img/"+flag[1];
			        		
		        			$("#img"+fg).attr("src",Img);
		        			$("#img"+fg+fg).attr("src",Img);
		        			
		        		}else{
		        			alert(data);
		        		}	
			     	},
			     error: function(data){
			        alert("上传失败！");
			    }
			});	
	   }	
		$(function(){
			td=$('td').toArray()
			for(i=0;i<td.length;i++){
				text=td[i].innerHTML;
				if(text==""){					
					if(i<30){
						td[i].innerHTML="&nbsp&nbsp&nbsp&nbsp";	
					}else{
						td[i].innerHTML="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";	
					}	
				}
			}
			
			/*			
			遍历所有的  td  标签  （1）
			
			td=$('td').toArray()
			for(i=0;i<td.length;i++){
				td[i].innerHTML;
			}
			
			遍历所有的  td  标签  （2）
			
			$('td').each(function(key,value){
				$(this).val();							
			});
			
			*/			
		});
	</script>
	<style type="text/css">
		.table th, .table td {
    		 padding: 8px;
   			 line-height: 20px;
   			 text-align: center;
             vertical-align: top;
             border-top: 1px solid #dddddd;
             
        }
        .ml{
        	color: rgba(0, 61, 255, 0.78);
        	font-weight:600;
        } 
        .badge-success{
        	font-size:18px;
        	padding-top: 6px;
        	padding-bottom: 6px;
        }
        .panel-body{
       		word-break: break-all;
       		word-wrap: break-word;
        }
        .panel-body button{	
   			 margin-top: 110px;
   			 margin-left: 30px;
        }
        input{
        	  width: 120px;
        }
        #updatetable, #updatetable1{
        	display:none;
        }
        img{
        	cursor: pointer;
        } 
        
        /*
          css  获取  class 用 .  获取class下的子class 中间用空格隔开   如：   .a .b{}
          	         获取  id 用 #  获取id下的子id 中间用空格隔开   如：   #a #b{}
          	   class 下子 id 如： .a #id{}
          	   id 下子 class 如： #a .id{}
          	         标签直接用   如 ：  button{} 
          	         
          	body 背景图不随滚动调滚动     跟浏览器定位         
 			.background{
          		background:url(/Qiao/Application/Home/View/Public/css/body.jpg);
          		background-attachment:fixed;
          		background-repeat:no-repeat;"
          	}         
          	
          	button 使用 onclick 会刷新界面   还有函数传入的参数 不要使用特殊    字符
          	                   	                
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
						<li class="active">
							<a href="#">桥梁基本信息</a>
						</li>
						<li style="margin-top: 20px;">
							<a href="<?php echo U('Info/info');?>">结构组成</a>
						</li>
						<li style="margin-top: 20px;">
							<a href="<?php echo U('Index/index');?>">返回主页</a>
						</li>				
					</ul>   					               
                </div>                     
             <div class="span11">                        
                <div class="span10" id="showtable">                                             	
                	<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">
								行政识别数据
							</h3>
						</div>
					<div class="panel-body">					 					
						<table class="table table-bordered">						
						<tbody>
							<tr>
								<td class="ml">路线编号</td>
								<td><?php echo ($data['t1']); ?></td>
								<td class="ml">路线名称</td>
								<td><?php echo ($data['t2']); ?></td>
								<td class="ml">路线等级</td>
								<td><?php echo ($data['t3']); ?></td>
							</tr>
							<tr class="success">
								<td class="ml">桥梁编号</td>
								<td><?php echo ($data['t4']); ?></td>
								<td class="ml">桥梁名称</td>
								<td><?php echo ($data['t5']); ?></td>
								<td class="ml">桥位桩号</td>
								<td><?php echo ($data['t6']); ?></td>
							</tr>
							<tr class="error">
								<td class="ml">功能类型</td>
								<td><?php echo ($data['t7']); ?></td>
								<td class="ml">下穿通道名</td>
								<td><?php echo ($data['t8']); ?></td>
								<td class="ml">下穿通道桩号</td>
								<td><?php echo ($data['t9']); ?></td>
							</tr>
							<tr class="warning">
								<td class="ml">设计荷载</td>
								<td><?php echo ($data['t10']); ?></td>
								<td class="ml">通行载重</td>
								<td><?php echo ($data['t11']); ?></td>
								<td class="ml">弯斜坡度</td>
								<td><?php echo ($data['t12']); ?></td>
							</tr>
							<tr class="info">
								<td class="ml">桥面铺装</td>
								<td><?php echo ($data['t13']); ?></td>
								<td class="ml">管养单位</td>
								<td><?php echo ($data['t14']); ?></td>
								<td class="ml">建成年限</td>
								<td><?php echo ($data['t15']); ?></td>
							</tr>
						</tbody>
					</table>
					</div>					
				</div>	
				</div>
				<div class="span10" id="showtable1">                	
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
								<td class="ml">桥长(m)</td>
								<td><?php echo ($data['t16']); ?></td>
								<td class="ml">桥面总宽(m)</td>
								<td><?php echo ($data['t17']); ?></td>
								<td class="ml">车行道宽(m)</td>
								<td><?php echo ($data['t18']); ?></td>
							</tr>
							<tr class="success">
								<td class="ml">桥面标高(m)</td>
								<td><?php echo ($data['t19']); ?></td>
								<td class="ml">桥下净高(m)</td>
								<td><?php echo ($data['t20']); ?></td>
								<td class="ml">桥上净高(m)</td>
								<td><?php echo ($data['t21']); ?></td>
							</tr>
							<tr class="error">
								<td class="ml">引道总宽(m)</td>
								<td><?php echo ($data['t22']); ?></td>
								<td class="ml">引道路面宽(m)</td>
								<td><?php echo ($data['t23']); ?></td>
								<td class="ml">引道线形</td>
								<td><?php echo ($data['t24']); ?></td>
							</tr>
							<tr class="warning">
								<td class="ml">桥梁跨数</td>
								<td><?php echo ($data['t25']); ?></td>
								<td class="ml">主要跨径(m)</td>
								<td><?php echo ($data['t26']); ?></td>
								<td class="ml">基础类型</td>
								<td><?php echo ($data['t27']); ?></td>
							</tr>
							<tr class="info">
								<td class="ml">伸缩缝类型</td>
								<td><?php echo ($data['t28']); ?></td>
								<td class="ml">支座形式</td>
								<td><?php echo ($data['t29']); ?></td>
								<td class="ml">地震动峰值加速度系数</td>
								<td><?php echo ($data['t30']); ?></td>
							</tr>
						</tbody>
					</table>
					</div>					
				</div>	
				</div>
				<div class="span10" id="updatetable">               	
                	<div class="panel panel-success">
						<div class="panel-heading">
						<h3 class="panel-title">
							行政识别数据
						</h3>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">						
						<tbody>
							<tr>
								<td class="ml">路线编号</td>
								<td>
									<input id="data1" type="text" placeholder="" value="<?php echo ($data['t1']); ?>">
								</td>
								<td class="ml">路线名称</td>
								<td>
									<input id="data2" type="text" placeholder="" value="<?php echo ($data['t2']); ?>">
								</td>
								<td class="ml">路线等级</td>
								<td>
									<input id="data3" type="text" placeholder="" value="<?php echo ($data['t3']); ?>">
								</td>
							</tr>
							<tr class="success">
								<td class="ml">桥梁编号</td>
								<td>
									<input id="data4" type="text" placeholder="" value="<?php echo ($data['t4']); ?>" >
								</td>
								<td class="ml">桥梁名称</td>
								<td>
									<input id="data5" type="text" placeholder="" value="<?php echo ($data['t5']); ?>" >
								</td>
								<td class="ml">桥位桩号</td>
								<td>
									<input id="data6" type="text" placeholder="" value="<?php echo ($data['t6']); ?>" >
								</td>
							</tr>
							<tr class="error">
								<td class="ml">功能类型</td>
								<td>
									<input id="data7" type="text" placeholder="" value="<?php echo ($data['t7']); ?>" >
								</td>
								<td class="ml">下穿通道名</td>
								<td>
									<input id="data8" type="text" placeholder="" value="<?php echo ($data['t8']); ?>" >
								</td>
								<td class="ml">下穿通道桩号</td>
								<td>
									<input id="data9" type="text" placeholder="" value="<?php echo ($data['t9']); ?>" >
								</td>
							</tr>
							<tr class="warning">
								<td class="ml">设计荷载</td>
								<td>
									<input id="data10" type="text" placeholder="" value="<?php echo ($data['t10']); ?>">
								</td>
								<td class="ml">通行载重</td>
								<td>
									<input id="data11" type="text" placeholder="" value="<?php echo ($data['t11']); ?>" >
								</td>
								<td class="ml">弯斜坡度</td>
								<td>
									<input id="data12" type="text" placeholder="" value="<?php echo ($data['t12']); ?>" >
								</td>
							</tr>
							<tr class="info">
								<td class="ml">桥面铺装</td>
								<td>
									<input id="data13" type="text" placeholder="" value="<?php echo ($data['t13']); ?>" >
								</td>
								<td class="ml">管养单位</td>
								<td>
									<input id="data14" type="text" placeholder="" value="<?php echo ($data['t14']); ?>" >
								</td>
								<td class="ml">建成年限</td>
								<td>
									<input id="data15" type="text" placeholder="" value="<?php echo ($data['t15']); ?>" >
								</td>
							</tr>
						</tbody>
					</table>
					</div>					
				</div>	
				</div>
				<div class="span10" id="updatetable1">               	
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
								<td class="ml">桥长(m)</td>
								<td>
									<input id="data16" type="text" placeholder="" value="<?php echo ($data['t16']); ?>" >
								</td>
								<td class="ml">桥面总宽(m)</td>
								<td>
									<input id="data17" type="text" placeholder="" value="<?php echo ($data['t17']); ?>" >
								</td>
								<td class="ml">车行道宽(m)</td>
								<td>
									<input id="data18" type="text" placeholder="" value="<?php echo ($data['t18']); ?>" >
								</td>
							</tr>
							<tr class="success">
								<td class="ml">桥面标高(m)</td>
								<td>
									<input id="data19" type="text" placeholder="" value="<?php echo ($data['t19']); ?>" >
								</td>
								<td class="ml">桥下净高(m)</td>
								<td>
									<input id="data20" type="text" placeholder="" value="<?php echo ($data['t20']); ?>" >
								</td>
								<td class="ml">桥上净高(m)</td>
								<td>
									<input id="data21" type="text" placeholder="" value="<?php echo ($data['t21']); ?>" >
								</td>
							</tr>
							<tr class="error">
								<td class="ml">引道总宽(m)</td>
								<td>
									<input id="data22" type="text" placeholder="" value="<?php echo ($data['t22']); ?>" >
								</td>
								<td class="ml">引道路面宽(m)</td>
								<td>
									<input id="data23" type="text" placeholder="" value="<?php echo ($data['t23']); ?>" >
								</td>
								<td class="ml">引道线形</td>
								<td>
									<input id="data24" type="text" placeholder="" value="<?php echo ($data['t24']); ?>" >
								</td>
							</tr>
							<tr class="warning">
								<td class="ml">桥梁跨数</td>
								<td>
									<input id="data25" type="text" placeholder="" value="<?php echo ($data['t25']); ?>" >
								</td>
								<td class="ml">主要跨径(m)</td>
								<td>
									<input id="data26" type="text" placeholder="" value="<?php echo ($data['t26']); ?>" >
								</td>
								<td class="ml">基础类型</td>
								<td>
									<input id="data27" type="text" placeholder="" value="<?php echo ($data['t27']); ?>" >
								</td>
							</tr>
							<tr class="info">
								<td class="ml">伸缩缝类型</td>
								<td>
									<input id="data28" type="text" placeholder="" value="<?php echo ($data['t28']); ?>" >
								</td>
								<td class="ml">支座形式</td>
								<td>
									<input id="data29" type="text" placeholder="" value="<?php echo ($data['t29']); ?>" >
								</td>
								<td class="ml">地震动峰值加速度系数</td>
								<td>
									<input id="data30" type="text" placeholder="" value="<?php echo ($data['t30']); ?>" >
								</td>
							</tr>
						</tbody>
					</table>
					</div>					
				</div>	
				</div>
				<div class="span10">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title">
									<span class="label badge-success" contenteditable="false" style="margin-left: 60px;">正面照</span> 
									<span class="label badge-success" contenteditable="false" style="margin-left: 254px;">立面照</span> 
									<span class="label badge-success" contenteditable="false" style="margin-left: 244px;">结构简图</span> 								
								</h3>								
							</div>
							<div class="panel-body" style="padding-bottom: 0px;" >
								<div class="span3" style="float:left; margin-left:18px;">
									<div>
										<img id="img1" data-target="#modal-container-img1" data-toggle="modal"  alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img1']); ?>" class="img-rounded" />
									</div>
										<input type="file" id="fileToUpload1" name="photo"/>图片像素使用：560x316
										<input class="btn btn-success" type="button" style="margin-left: 220px;" value="提交" onclick="buttonUpload(1)">
								</div>
								<div class="span3" style="float:left;margin-left:58px;">
									<div>
										<img id="img2" data-target="#modal-container-img2" data-toggle="modal"  alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img2']); ?>" class="img-rounded" />
									</div>
										<input type="file" id="fileToUpload2" name="photo"/>图片像素使用：560x316
										<input class="btn btn-success" type="button" style="margin-left: 220px;" value="提交" onclick="buttonUpload(2)">
									<!--  
									
									<form action="<?php echo U('Upimg/index?img=2');?>" enctype="multipart/form-data" method="post" >						
										<input type="file" name="photo"/>图片像素使用：560x316
										<input class="btn btn-success" type="submit" style="margin-left: 220px;" value="提交" >
									</form>
									
									-->					
								</div>
								<div class="span3" style="float:left; margin-left:52px;">
									<div>
										<img id="img3" data-target="#modal-container-img3" data-toggle="modal" alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img3']); ?>" class="img-rounded" />
									</div>
										<input type="file" id="fileToUpload3" name="photo"/>图片像素使用：560x316
										<input class="btn btn-success" type="button" style="margin-left: 220px;" value="提交" onclick="buttonUpload(3)">									
								</div>						
							</div>				
						</div>
					</div>				
				  <button class="btn btn-success" id="updatebutton" type="button" style="float: right;margin-right: 68px;margin-bottom: 80px;" onclick="info(1)">修改信息</button> 
				  <button class="btn" id="returnbutton" style="float: right;margin-bottom: 80px;margin-right: 70px; display:none;" type="button" onclick="info(2)">取消返回</button>          	
           		  
           		  <a id="modal-1" href="#modal-container-1" role="button" style="float:right;margin-bottom: 80px;margin-right: 40px; display:none;" class="btn" data-toggle="modal">保存信息</a>     		  
		          <div id="modal-container-1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">
							信息修改提示！
						</h3>
					</div>
					<div class="modal-body">
						<p>
							确认修改信息吗？
						</p>
					</div>
					<div class="modal-footer">
						 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button> 
						 <button class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" onclick="info(3)">确认</button>
					</div>
				 </div>				 
				 <!-- 图片放大 -->	
				 			 				
				 <div id="modal-container-img1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<img id="img11" alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img1']); ?>" class="img-rounded" />				
				 </div>
				 
				 <div id="modal-container-img2" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<img id="img22" alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img2']); ?>" class="img-rounded" />				
				 </div>
				 
				 <div id="modal-container-img3" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<img id="img33" alt="未上传图片，请上传图片！" width="560" height="316" src="/Qiao/Application/Home/View/Public/img/<?php echo ($data['img3']); ?>" class="img-rounded" />				
				 </div>
				 
				 <!-- 图片放大 -->				 	 
			</div>        
         </div>                
      </div>       
</body>
</html>