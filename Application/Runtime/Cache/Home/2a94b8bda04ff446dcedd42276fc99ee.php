<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>公路桥梁检测评定系统</title>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-2.0.0.min.js"></script>
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/jquery-ui"></script>
	<link href="/Qiao/Application/Home/View/Public/bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="/Qiao/Application/Home/View/Public/bootstrap/js/bootstrap.min.js"></script>	
	<script>
		function add(){
			$("#bridgeName").val("");
			$("#bridgePlace").val("");
			$('#showBridge').css("display","none");
			$('#addBridge').css("display","block");
		}
		function showBridge(){
			$("#bridgeName").val("");
			$("#bridgePlace").val("");			
			window.location.href ="<?php echo U('Index/index');?>";
		}
		function addBridge(){
			var bridgeName=$("#bridgeName").val();  
			var bridgePlace=$("#bridgePlace").val();  
	    	if(bridgeName==""){
	    		alert("桥梁名称不能为空！");
	    	}else if(bridgePlace==""){
	    		alert("详细位置不能为空！");
	    	}else{
	    		$.ajax({
	    	        type: "POST",
	    	        url: '<?php echo U('Index/add');?>',
	    	        data: { name:bridgeName,place:bridgePlace},
	    	        success: function (data){
	    	        	if(data=="Cz"){	
	    	        		alert("该桥已存在！");	    	        		
	    	        	}else if(data=="Error"){ 
	    	            	alert("添加失败！");	    	            	
	    	            }else{                
	    	            	alert("添加成功");	 
	    	            	window.location.href ="<?php echo U('Index/index');?>";
	    	            }	    	        	
	    	        }
	    	    });	
	    	}
		}
		var removebid=null;
		function savebid(bid){
			removebid=bid;
		}
		function remove1(flag){	
			if(flag==1){
				removebid=null;
			}else{
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Index/remove');?>',
		   	        data: { bid:removebid},
		   	        success: function (data){
		   	        	if(data=="Error"){ 
		   	            	alert("删除失败！");	    	            	
		   	            }	
		   	        	window.location.href ="<?php echo U('Index/index');?>";
		   	        }
		   	    });				
			}					
		}
		var id=null;
		function radio(bid){			
		    if(id==bid){
		    	id=null;
		    	document.getElementById(bid).checked=false;		    								
			}else{
				id=bid;
			}		
		}
		function select1(test){	
			if(id==null){
				alert("请您选择一种桥、、、、");	
			}else{	
				 if(test==test1){						 
					 window.location.href ="<?php echo U(MODULE_NAME.'/Info/index/bid/"+id+"');?>";
				 }else if(test==test2){
					 window.location.href ="<?php echo U(MODULE_NAME.'/Pingding/index/bid/"+id+"');?>"; 
				 }else{
					 window.location.href ="<?php echo U(MODULE_NAME.'/Baobiao/index/bid/"+id+"');?>";		 
				 }	 
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
	<div style="margin-top: 60px;">           
		<div class="span2" >                          
			<ul class="nav nav-stacked nav-pills">
				<li class="active" id="test">
					<a href="#" >项目管理</a>
				</li>
				<li id="test1" style="margin-top: 20px;">
					<a href="#" onclick="select1(test1)">基本信息管理</a>
				</li>
				<li id="test2" style="margin-top: 20px;">
					<a href="#" onclick="select1(test2)">桥梁技术状况评定</a>
				</li>
				<li id="test3" style="margin-top: 20px;">
					<a href="#" onclick="select1(test3)">报表管理</a>
				</li>				
			</ul>   															               
    	</div>      
		<div class="span11" style="float: left;"> 
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title" contenteditable="false">项目管理</h3>
				</div>
				<div class="panel-body" contenteditable="false">
					<div id="showBridge" style="display: block;">					
					<table class="table table-bordered" style="text-align: center;">
						<thead>
							<tr style="background-color: #77E596;">
								<td>桥梁名称</td>
		                        <td>桥梁类型</td>                            
		                        <td>详细位置</td>
		                        <td>桥梁等级</td>
		                        <td>技术状况得分</td>
		                        <td>操作</td>
							</tr>
						</thead>
						<tbody>
						<?php $flag = '0'; ?>						
						<?php if(is_array($bridge)): foreach($bridge as $key=>$v): if(($flag) == "0"): $flag = '1'; ?>
							<tr class="warning">		                        				                          	                                               
				                   <td style="text-align: left;"><input type="radio" style="margin-left: 20px;margin-right: 30px;cursor:pointer;" name="bid" id="<?php echo ($v["bid"]); ?>" onclick="radio(<?php echo ($v["bid"]); ?>)"><?php echo ($v["name"]); ?></td>
				                   <td><?php echo ($v["type"]); ?></td>
				                   <td><?php echo ($v["place"]); ?></td>
				                   <td><?php echo ($v["level"]); ?></td>
				                   <td><?php echo ($v["score"]); ?></td>
				                   <td>
				                      <a href="<?php echo U('Info/index',array('bid'=>$v['bid']));?>" style="float:left;">编辑</a>
				                      <a href="<?php echo U('Pingding/index',array('bid'=>$v['bid']));?>">评定计算</a>		                    
				                      <a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal" onclick="savebid(<?php echo ($v["bid"]); ?>)">删除</a>				                       
				                   </td>
							</tr>	                    			
							<?php else: ?>
								<?php $flag = '0'; ?>
								<tr class="info">		                        				                          	                                               
				                   <td style="text-align: left;"><input type="radio" style="margin-left: 20px;margin-right: 30px;cursor:pointer;" name="bid" id="<?php echo ($v["bid"]); ?>" onclick="radio(<?php echo ($v["bid"]); ?>)"><?php echo ($v["name"]); ?></td>
				                   <td><?php echo ($v["type"]); ?></td>
				                   <td><?php echo ($v["place"]); ?></td>
				                   <td><?php echo ($v["level"]); ?></td>
				                   <td><?php echo ($v["score"]); ?></td>
				                   <td>
				                      <a href="<?php echo U('Info/index',array('bid'=>$v['bid']));?>" style="float:left;">编辑</a>
				                      <a href="<?php echo U('Pingding/index',array('bid'=>$v['bid']));?>">评定计算</a>		                    
				                      <a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="savebid(<?php echo ($v["bid"]); ?>)">删除</a>				                       
				                   </td>
				               	</tr><?php endif; endforeach; endif; ?>
						</tbody>
		            </table>
		            <div class="Page" style="border-top-width: 20px;margin-top: 20px;margin-left: 800px;"><?php echo ($page); ?></div>
		            <button class="btn btn-primary" type="button" style="margin-bottom: 3px;margin-top: 2px;"  onclick="add()">增加</button>		            		          
		            </div>
		            <div class="form-horizontal" id="addBridge" style="display: none;">
						<div class="control-group">
					    	<label class="control-label" for="inputEmail">桥梁类别</label>
								<div class="controls">
								 	<select>
								 		<option>梁式桥</option>
								 	</select>
								</div>
						</div>
						<div class="control-group">
					 		<label class="control-label" for="inputEmail">桥梁名称</label>
							<div class="controls">
								<input type="text" id="bridgeName" name="bridgeName" />
							</div>
						</div>
					    <div class="control-group">
						 	<label class="control-label" for="inputPassword">详细位置</label>
							<div class="controls">
								<input type="text" id="bridgePlace" name="bridgePlace" />
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								  <button type="button" class="btn"  onclick="addBridge()">确认</button>
								  <button type="button" class="btn"  onclick="showBridge()">返回</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="modal-container-1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="remove1(1)">×</button>
					<h3 id="myModalLabel">
						桥梁删除
					</h3>
				</div>
				<div class="modal-body">
					<p>
						确认删除该桥梁吗？如果删除该桥的信息将全部删除。
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="remove1(1)">关闭</button> 
					 <button class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" onclick="remove1()">确认</button>
				</div>
			</div>
		</div>				   					                  
	</div>
 </div>              
</body>
</html>