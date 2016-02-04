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
		//TP 传参到 Js 字符串需要加单引号    整形可直接传入  

		/**      处理构件                **/
		
		// 改变部件编辑按钮颜色
		var buttonclass=null;
		$(function(){
			$(".btn1 .btn").click(function(){
				if(buttonclass!=null){
					$(buttonclass).removeClass("btn-info");
				}
				$(this).addClass("btn-info");
				buttonclass=this;
			});
		});
		
		//  显示选种部件的构件
		function setbujian(bujian){			
			$.ajax({
	   	        type: "POST",
	   	        url: '<?php echo U('Pingding/setbujian');?>',
	   	        data: {bujian:bujian},   //  传入数组数据 
	   	        success: function (data){
	   	        	$("#goujian").fadeOut();	   	        	
	   	        	str='<div class="panel panel-success">\
	 					   <div class="panel-heading">\
	 					      <h3 class="panel-title">构件名称</h3>\
	 					   </div>\
	 					   <div class="panel-body">\
	 							<input id="goujianname" type="text" style="float:left;" placeholder="构件名">\
	 								<button class="btn btn-success" type="button" style="float:right;margin-right: 10px;" onclick="addgoujian()">添加</button>\
	 							<table class="table table-bordered" contenteditable="false">\
	 								<tbody id="tbodygoujian">';	   	        	
	   	        	var goujian=eval(data);   // json  转对象
	   	        	for(var i=0;i<goujian.length;i++){ 	   	        					   	        		
	   	        	   if(i%2==0){
	   	        	 str+='<tr class="info">\
							<td>\
								<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
								+goujian[i].name+
								'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
							</td>\
						</tr>';	   	        		
	   	        	   }else{
	   	        	str+='<tr class="warning">\
							<td>\
								<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
								+goujian[i].name+
								'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
							</td>\
						</tr>';
	   	        	   }    	 	        	 
	   	        	}	   	        	  		   	      							
							str+='</tbody>\
							</table>\
						</div>\
					</div>';	
					$("#goujian").html(str);					
	   				$("#goujian").fadeIn();
	   				$("#shuxin").fadeOut();	
	   	        }
	   	    });				
		}
		
		// 添加构件
		function addgoujian(){
			name=$("#goujianname").val().trim();
			if(name==""){
				alert("构件名不能为空！");
			}else{
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Pingding/addgoujian');?>',
		   	        data: {name:name},   //  传入数组数据 
		   	        success: function (data){
		   	        	if(data=="Error1"){
		   	        		alert("添加构件数量以达到上限，不能再添加了。");
		   	        	}else if(data=="Error"){
		   	        		alert("构件已存在！");
		   	        	}else{
		   	        		str="";
			   	        	var goujian=eval(data);   // json  转对象	   	        	
			   	        	for(var i=0;i<goujian.length;i++){ 
			   	        	   if(i%2==0){
			   	        	str+='<tr class="info">\
									<td>\
										<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
										+goujian[i].name+
										'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
									</td>\
								</tr>';	   	        		
			   	        	   }else{
			   	        	str+='<tr class="warning">\
									<td>\
										<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
										+goujian[i].name+
										'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
									</td>\
								</tr>';
			   	        	   }    	 	        	 
			   	        	}
			   	        	$("#goujianname").val("");
			   	        	$("#tbodygoujian").html(str);
		   	        	}		   	        	
		   	        }
				});
			}		
		}
		
		var removegid=null;		
		// 设置删除构件 id
		function deletegid(gid){
			removegid=gid;					
		}		
		// 删除构件
		function deletegoujian(gid){
			if(gid==1){
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Pingding/deletegoujian');?>',
		   	        data: {gid:removegid},   //  传入数组数据 
		   	        success: function (data){
		   	        	str="";
		   	        	var goujian=eval(data);   // json  转对象	   	        	
		   	        	for(var i=0;i<goujian.length;i++){ 
		   	        	   if(i%2==0){
		   	        	str+='<tr class="info">\
								<td>\
									<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
									+goujian[i].name+
									'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
								</td>\
							</tr>';	   	        		
		   	        	   }else{
		   	        	str+='<tr class="warning">\
								<td>\
									<input type="radio" style="cursor:pointer;" name="bid" onclick="setgoujian('+goujian[i].gid+')">'
									+goujian[i].name+
									'<a id="modal-1" href="#modal-container-1" role="button" style="float:right;" class="btn" data-toggle="modal"  onclick="deletegid('+goujian[i].gid+')">删除</a>\
								</td>\
							</tr>';
		   	        	   }    	 	        	 
		   	        	}
		   	        	$("#goujianname").val("");
		   	        	$("#tbodygoujian").html(str);	   	        	
		   	        }
				});
				$("#shuxin").fadeOut();	
			}else{
				removegid=null;
			}	
		}
		/**      处理构件属性                **/
				
		// 显示选种构件的属性
		function setgoujian(goujian){
			$.ajax({
	   	        type: "POST",
	   	        url: '<?php echo U('Pingding/setgoujian');?>',
	   	        data: {goujian:goujian},   //  传入数组数据 
	   	        success: function (data){
	   	        	$("#shuxin").fadeOut();	    	
	   	    	var shuxin=eval(data);   // json  转对象
	   	    	if(shuxin['info'][0]['weizhi']==null){
	   	    		shuxin['info'][0]['weizhi']="";
	   	    	}
	   	    	if(shuxin['info'][0]['jianyi']==null){
	   	    		shuxin['info'][0]['jianyi']="";
	   	    	}
	   	    	if(shuxin['info'][0]['time']==null){
	   	    		shuxin['info'][0]['time']="";
	   	    	}
	   	    	if(shuxin['info'][0]['score']==null){
	   	    		shuxin['info'][0]['score']="";
	   	    	}
	   	    	if(shuxin['img']==null){
	   	    		shuxin['img']="";
	   	    	}
		   	     str='<div class="panel panel-info">\
			   			<div class="panel-heading">\
		      			<h3 class="panel-title">构件信息</h3>\
						</div>\
							<div class="panel-body">\
								<div>\
					  				<div>\
										<img id="img" data-target="#modal-container-img4" data-toggle="modal" alt="未上传图片，请上传图片！" src="" class="img-rounded" />\
					  				</div>\
					  					<input id="fileToUpload" type="file" style="float:left;width: 240px;" name="photo"/>图片像素使用：560x316\
					  					<input class="btn btn-success"  type="button" style="float:right;margin-bottom: 20px;" value="提交" onclick="buttonUpload()" >\
					  				</div>\
								<table class="table table-bordered" id="showbinghai" contenteditable="false" style="margin-bottom: 10px;">\
					  				<tbody>\
					  					<tr class="success">\
											<td style="vertical-align:middle;">病害名称</td>\
											<td>\
												<ol contenteditable="false" id="binghainame" style="margin-top: 16px;width: 264px;">';
												if(shuxin['binghai'].length>=1){
													for(var i=0;i<shuxin['binghai'].length;i++){											
														  str+='<li>'+shuxin['binghai'][i].name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'\
														  			<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+shuxin['binghai'][i].dengji+'\
															 			<button class="btn" type="button" style="float:right;" onclick="deletebing('+shuxin['binghai'][i].bingid+')">删除</button>\
															 		</div>\
																</li>';
													}
												}			
										str+='</ol>\
											</td>\
										</tr>\
										<tr class="error">\
											<td>病害类型</td>\
											<td></td>\
										</tr>\
										<tr class="warning">\
											<td style="vertical-align:middle;">病害标度</td>\
											<td>\
												<ol contenteditable="false" class="unstyled">\
													<li></li>\
												</ol>\
											</td>\
										</tr>\
									</tbody>\
								</table>\
								<button class="btn btn-success" id="showbinghaibtn" type="button" style="float:right;margin-bottom: 20px;" onclick="binghai(1)">添加</button>\
								<table class="table table-bordered" id="updatabinghai" contenteditable="false" style="margin-bottom: 10px;display:none;">\
					  				<tbody>\
					  					<tr class="success">\
											<td style="vertical-align:middle;">病害名称</td>\
											<td>\
												<ol contenteditable="false" id="binghainame1" style="margin-top: 16px;width: 264px;">';																							
												if(shuxin['binghai'].length>=1){
													for(var i=0;i<shuxin['binghai'].length;i++){											
														  str+='<li>'+shuxin['binghai'][i].name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'\
														  			<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+shuxin['binghai'][i].dengji+'\
															 			<button class="btn" type="button" style="float:right;" onclick="deletebing('+shuxin['binghai'][i].bingid+')">删除</button>\
															 		</div>\
																</li>';
													}
												}
										str+='</ol>\
											</td>\
										</tr>\
										<tr class="error">\
											<td>病害类型</td>\
											<td>\
											 	<select id="leixing"  onchange="leixingchange(this.value)">\
												</select>\
											</td>\
										</tr>\
										<tr class="warning">\
											<td style="vertical-align:middle;">病害标度</td>\
											<td>\
												<ol contenteditable="false" class="unstyled" id="biaodu">\
													<li>\
													</li>\
												</ol>\
											</td>\
										</tr>\
									</tbody>\
								</table>\
								<button class="btn btn-success" id="savebinghaibtn" type="button" style="float:right;margin-bottom: 20px;display:none;" onclick="binghai(3)">保存</button>\
								<button class="btn" type="button" id="returnbinghaibtn" style="float:right;margin-bottom: 20px;margin-right: 50px;display:none;" onclick="binghai(2)">返回</button>\
								<table class="table table-bordered" id="showbinghaiinfo" contenteditable="false" style="margin-bottom: 10px;">\
					  				<tbody>\
										<tr class="info">\
											<td>病害位置</td>\
											<td id="weizhi">'
											+shuxin['info'][0]['weizhi']+
											'</td>\
										</tr>\
										<tr class="success">\
											<td style="vertical-align:middle;">维修方法</td>\
											<td>\
												<ul contenteditable="false" id="weixiu" style="width: 280px;">';
												if(shuxin['weixiu'].length>=1){
													for(var i=0;i<shuxin['weixiu'].length;i++){
														str+='<li style="margin-bottom: 10px;">'+shuxin['weixiu'][i].name+'</li>';
													}
												}		
										str+='</ul>\
											</td>\
										</tr>\
										<tr class="error">\
											<td>建议</td>\
											<td id="jianyi">'
											+shuxin['info'][0]['jianyi']+
											'</td>\
										</tr>\
										<tr class="warning">\
											<td>检查时间</td>\
											<td id="time">'
											+shuxin['info'][0]['time']+
										   '</td>\
										</tr>\
										<tr class="info">\
											<td>构件得分</td>\
											<td id="score">'
											+shuxin['info'][0]['score']+
										   '</td>\
										</tr>\
									</tbody>\
								</table>\
								<button class="btn btn-success" id="showbinghaiinfobtn" type="button" style="float:right;margin-bottom: 20px;" onclick="binghaiinfo(1)">编辑</button>\
					  			<table class="table table-bordered" id="updatebinghaiinfo" contenteditable="false" style="margin-bottom: 10px;display:none;">\
						  			<tbody>\
										<tr class="info">\
											<td>病害位置</td>\
											<td>\
												<input type="text" id="weizhi1" placeholder="" value="'+shuxin['info'][0]['weizhi']+'">\
											</td>\
										</tr>\
										<tr class="success">\
											<td style="vertical-align:middle;">维修方法</td>\
											<td>\
												<ul contenteditable="false" class="unstyled" id="weixiu1" style="width: 280px;">';
												if(shuxin['weixiu'].length>=1){
													for(var i=0;i<shuxin['weixiu'].length;i++){
														str+='<li style="margin-bottom: 10px;"><input type="checkbox">'+shuxin['weixiu'][i].name+'</li>';
													}
												}																																				
										 str+='</ul>\
											</td>\
										</tr>\
										<tr class="error">\
											<td>建议</td>\
											<td>\
												<input type="text" id="jianyi1" placeholder="" value="'+shuxin['info'][0]['jianyi']+'">\
											</td>\
										</tr>\
										<tr class="warning">\
											<td>检查时间</td>\
											<td>\
												<input type="text" id="time1" placeholder="" value="'+shuxin['info'][0]['time']+'">\
											</td>\
										</tr>\
										<tr class="info">\
											<td>构件得分</td>\
											<td>\
												<input type="text"  disabled="disabled" id="score1"   value="'+shuxin['info'][0]['score']+'">\
												<button class="btn" type="button" style="float:right;" onclick="gouscore()">计算</button>\
											</td>\
										</tr>\
									</tbody>\
								</table>\
								<button class="btn btn-success" id="savebinghaiinfobtn" type="button" style="float:right;margin-bottom: 20px;display:none;" onclick="binghaiinfo(3)">保存</button>\
				  			 	<button class="btn" type="button" id="returnbinghaiinfobtn" style="float:right;margin-bottom: 20px;margin-right: 50px;display:none;" onclick="binghaiinfo(2)">返回</button>\
				  			</div>\
						</div>';	   	        	
	   	        	$("#shuxin").html(str);
	   	        	Img="/Qiao/Application/Home/View/Public/img/"+shuxin['img'];
	   	        	$("#img").attr("src",Img);
	   	        	$("#img1").attr("src",Img);
	   				$("#shuxin").fadeIn();	
	   	        }
	   	    });		
		}
		
		// 病害类型显示   与   编辑切换
		function binghai(flag){
			if(flag==1){
				$("#showbinghai").hide();
				$("#showbinghaibtn").hide();
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Pingding/binghaileixing');?>',
		   	        data: {},   //  传入数组数据 
		   	        success: function(data){		   	        	
		   	        	var binghai=eval(data);
		   	        	str="";
		   	        	for(var i=0;i<binghai.length;i++){
		   	        		str+='<option value="'+binghai[i].dengji+","+binghai[i].score+","+binghai[i].bingid+'">'+binghai[i].name+'</option>';	
		   	        	}
		   	        	$("#leixing").html(str);
		   	        	str="";
		   	        	leixing=$("#leixing").val();
		   	        	biaodu=leixing.split(",");
		   	        	len=biaodu.length-1;
		   	        	cont=len/2;		   	        
		   	        	for(var i=0;i<cont;i++){
		   	        		//  value  病害 id ， 病害等级  ， 病害扣分            		type="radio"
		   	        		str+='<li><input type="checkbox" onchange="biaoducheck(this)"  value="'+biaodu[len]+","+biaodu[i]+","+biaodu[i+cont]+'">'+biaodu[i]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扣分："+biaodu[i+cont]+'</li>';
		   	        	}
		   	        	$("#biaodu").html(str);		   	        	
		   	        }
				});
				$("#updatabinghai").show();
				$("#savebinghaibtn").show();
				$("#returnbinghaibtn").show();				
			}else if(flag==2){
				obj=null; //返回后去掉之前所选择的    类型										
				$("#updatabinghai").hide();
				$("#savebinghaibtn").hide();
				$("#returnbinghaibtn").hide();
				
				// 返回后去掉    类型 和  标度	
				str="";				
				$("#leixing").html(str);
				$("#biaodu").html(str);	
				
				$("#showbinghai").show();
				$("#showbinghaibtn").show();					
			}else{				
			//添加病害          ajax 请求   后   数据刷新
				if(obj==null){
					alert("未选择病害标度！");
				}else{
					addbinghai=obj.value.split(",");				 	
					$.ajax({
			   	        type: "POST",
			   	        url: '<?php echo U('Pingding/addbinghai');?>',
			   	        data: {binghai:addbinghai},   //  传入数组数据 
			   	        success: function(data){
			   	        	if(data=="Error"){
			   	        		alert("该构件已添加过该病害。");
			   	        	}else{
			   	        	//  刷新病害信息
			   	        		str="";
			   	        		Binghai=eval(data);		   	        	
				   	        	if(Binghai.length>=1){				   	        		
									for(var i=0;i<Binghai.length;i++){	
										/*
									  str+='<li>'+Binghai[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+Binghai[i].dengji+'\
										 		<button class="btn" type="button" style="float:right;" onclick="deletebing('+Binghai[i].bingid+')">删除</button>\
											</li>';
											*/
											 str+='<li>'+Binghai[i].name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'\
									  			<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+Binghai[i].dengji+'\
										 			<button class="btn" type="button" style="float:right;" onclick="deletebing('+Binghai[i].bingid+')">删除</button>\
										 		</div>\
											</li>';
									}			   	        	       
				   	           }				   	        	
				   	        	$("#score").html("");
			   	        		$("#score1").val("");
			   	        		
				   	           $("#binghainame").html(str);
			   	        	   $("#binghainame1").html(str);
			   	        	   
			   	        	   // 返回到显示页面
				   	        	obj=null; //返回后去掉之前所选择的    类型										
								$("#updatabinghai").hide();
								$("#savebinghaibtn").hide();
								$("#returnbinghaibtn").hide();															
								str="";	// 返回后去掉    类型 和  标度			
								$("#leixing").html(str);
								$("#biaodu").html(str);								
								$("#showbinghai").show();
								$("#showbinghaibtn").show();			   	        	   
			   	        	}	
			   	        }
					});		
				}			
			}			
		}
		
		// 选择病害类型改变   更新标度
		function leixingchange(leixing){
			obj=null; //改变类型后去掉之前所选择的  类型
			str="";
			biaodu=leixing.split(",");
        	len=biaodu.length-1;
        	cont=len/2;		   	        
        	for(var i=0;i<cont;i++){
        		//  value  病害 id , 病害等级  , 病害扣分    		type="radio"
        		str+='<li><input type="checkbox" onchange="biaoducheck(this)"  value="'+biaodu[len]+","+biaodu[i]+","+biaodu[i+cont]+'">'+biaodu[i]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扣分："+biaodu[i+cont]+'</li>';
        	}
        	$("#biaodu").html(str);
		}
		// 获取标度      checkbox  实现单选(可选可不选)           checkbox失效使用   onchange 函数
		var obj=null;
		function biaoducheck(a){			
			if(obj!=null&&obj!=a){
				obj.checked=!obj.checked;				
			}
			if(obj!=a){
				obj=a;
			}else{
				obj=null;
			}			
		}				
		/*		
		checkbox  实现单选(可选也可不选)  checkbox失效使用   onchange 函数		
		var obj=null;
		function biaoducheck(a){			
			if(obj!=null&&obj!=a){
				obj.checked=!obj.checked;				
			}
			if(obj!=a){
				obj=a;
			}else{
				obj=null;
			}			
		}		
		
		checkbox  实现单选(必选一个)  checkbox失效使用   onchange 函数   
		var obj=null;
		function biaoducheck(a){			
			if(obj!=null){
				obj.checked=!obj.checked;				
			}
			obj=a;			
		}		
		*/
		// 病害信息显示   与   编辑切换
		function binghaiinfo(flag){
			if(flag==1){				
				$("#showbinghaiinfo").hide();
				$("#showbinghaiinfobtn").hide();												
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Pingding/weixiuleixing');?>',
		   	        data: {},   //  传入数组数据 
		   	        success: function(data){
		   	        	var weixiu=eval(data);
		   	        	str="";
		   	        	for(var i=0;i<weixiu.length;i++){
		   	        		if(weixiu[i].flag){
		   	        			str+='<li style="margin-bottom: 10px;"><input type="checkbox" value="'+weixiu[i].weixiuid+'" checked="'+weixiu[i].flag+'">'+weixiu[i].name+'</li>';
		   	        		}else{
		   	        			str+='<li style="margin-bottom: 10px;"><input type="checkbox" value="'+weixiu[i].weixiuid+'">'+weixiu[i].name+'</li>';
		   	        		}		   	        		
		   	        	}
		   	        	$("#weixiu1").html(str); 	
		   	        }
				});
				// 回到编辑前   填好之前的信息
				$("#weizhi1").val($("#weizhi").html());			
				$("#jianyi1").val($("#jianyi").html());
				$("#time1").val($("#time").html());
				$("#score1").attr("placeholder",$("#score").html());				
				//显示编辑信息样式
				$("#updatebinghaiinfo").show();				
				$("#savebinghaiinfobtn").show();
				$("#returnbinghaiinfobtn").show();				
			}else if(flag==2){
				$("#updatebinghaiinfo").hide();				
				$("#savebinghaiinfobtn").hide();
				$("#returnbinghaiinfobtn").hide();	
				$("#showbinghaiinfo").show();
				$("#showbinghaiinfobtn").show();					
			}else{				
			//  ajax 请求   后   刷新数据  并返回的显示信息界面
			
			/*			
				alert($("#weizhi1").val());			
				alert($("#jianyi1").val());
				alert($("#time1").val());
				
				#weixiu1  li input  选中的 value 值
	
				获取所有选中的  checkbox 是否选中 获取的是第一个 checkbox				
			    $("#weixiu1 input[type='checkbox']").is(':checked');
			    $("#weixiu1 :checkbox").is(':checked');
			    		    
			             获取所有选中的  checkbox 的  value
			    $("#weixiu1 input[type='checkbox']").attr('value');
			    $("#weixiu1 :checkbox").attr('value');
			    $("#weixiu1 :checkbox").val();
			     
			  	  获取所有选中的  checkbox 返回一个对象			  	  
			    $("#weixiu1 input:checkbox:checked");
			    $("#weixiu1 input:checkbox[name='name']:checked"); 
			    $("#weixiu1 :checkbox:checked");
			    
			    check=$("#weixiu1 :checkbox:checked");
			    check.length;
			    check[0].value;
			    
			    // 获取checkbox后的文本
			    check[i].nextSibling.nodeValue;
			    			    
			*/	
				var r=confirm("确认保存修改信息吗？");
				if(r==true){
					// 创建对象传输对象数据
					var data={weixiu:[],weizhi:"",jianyi:"",time:""};
					check=$("#weixiu1 :checkbox:checked");
					for(var i=0;i<check.length;i++){
						 data['weixiu'][i]=check[i].value;
						// alert(check[i].value);
					}				
					data['weizhi']=$("#weizhi1").val();
					data['jianyi']=$("#jianyi1").val();
					data['time']=$("#time1").val();
					$.ajax({
			   	        type: "POST",
			   	        url: '<?php echo U('Pingding/savebinghaiinfo');?>',
			   	        data: {data:data},   //  传入数组数据 
			   	        success: function(data){
			   	        	$("#weizhi").html(data['info'][0]['weizhi']);			
							$("#jianyi").html(data['info'][0]['jianyi']);
							$("#time").html(data['info'][0]['time']);
							$("#score").html(data['info'][0]['score']);
							str="";						
							if(data['weixiu'].length>=1){
								for(var i=0;i<data['weixiu'].length;i++){
									str+='<li style="margin-bottom: 10px;">'+data['weixiu'][i].name+'</li>';
								}
							}
							$("#weixiu").html(str);
							$("#updatebinghaiinfo").hide();				
							$("#savebinghaiinfobtn").hide();
							$("#returnbinghaiinfobtn").hide();	
							$("#showbinghaiinfo").show();
							$("#showbinghaiinfobtn").show();	
			   	        }
					});						
				}				
			}			
		}	
		
		//  删除病害    并    更新病害
		function deletebing(bingid){
			var r=confirm("确认删除该病害吗？");
			if(r==true){
				$.ajax({
		   	        type: "POST",
		   	        url: '<?php echo U('Pingding/deletebinghai');?>',
		   	        data: {bingid:bingid},   //  传入数组数据 
		   	        success: function (data){		   	        	
		   	        	str="";
		   	        	var binghai=eval(data);		   	        	
		   	        	if(binghai.length>=1){		   	        		
							for(var i=0;i<binghai.length;i++){	
								/*
							  str+='<li>'+binghai[i].name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+binghai[i].dengji+'\
								 		<button class="btn" type="button" style="float:right;" onclick="deletebing('+binghai[i].bingid+')">删除</button>\
									</li>';
									*/
							  str+='<li>'+binghai[i].name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+'\
					  			<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：'+binghai[i].dengji+'\
						 			<button class="btn" type="button" style="float:right;" onclick="deletebing('+binghai[i].bingid+')">删除</button>\
						 		</div>\
							</li>';
							}		   	        	        
		   	           }
		   	        	$("#score").html("");
	   	        		$("#score1").val("");
	   	        		
		   	        	$("#binghainame").html(str);
	   	        	 	$("#binghainame1").html(str);
				    }
		   	   });
			}			
		}	
		
		// 计算构件得分    并   更新得分
		function gouscore(){
			$.ajax({
	   	        type: "POST",
	   	        url: '<?php echo U('Pingding/goujiangrade');?>',
	   	        data: {},   //  传入数组数据 
	   	        success: function (data){
	   	        	if(data=="Error"){
	   	        		alert("构件还未添加病害,无法计算数据，请添加病害后在计算。");
	   	        	}else{
	   	        		$("#score").html(data['score']);
	   	        		$("#score1").val(data['score']);
	   	        	}	   	        	
	   	        }
			});
		}			
		//  图片上传
		function buttonUpload(){
			$.ajaxFileUpload({
		        url:'/Qiao/Home/Upimg/Uploadgouimg',//处理图片脚本
		        secureuri :false,
		        fileElementId :'fileToUpload',//file控件id	
		        dataType: 'text',
		        success : function (data){
			        	flag=data.split(",");
			        	if(flag[0]=="success"){
			        		Img="/Qiao/Application/Home/View/Public/img/"+flag[1];
		        			$("#img").attr("src",Img);
		        			$("#img1").attr("src",Img);			        			
		        		}else{
		        			alert(data);
		        		}	
			     	},
			     error: function(data){
			        alert("上传失败！");
			    }
			});
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
        .list-group{
	        margin-left: 0px;
	        text-align: center;
        }
        input{
			float:left;        
        }        
        .panel-body{
        	word-break: break-all;
       		word-wrap: break-word;       
    		padding-bottom: 6px;
        }
        ol li{        
    		margin-top: 6px;
    		margin-bottom: 4px;
    		 text-align: center;
             vertical-align: top;
             
        }
        ol li div{
        	height: 30px;        
    		margin-top: 0px;
    		padding-bottom: 6px;
    		border-bottom: 1px solid #228ACA;
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
					<li class="active">
						<a href="#">构件生成</a>
					</li>
					<li style="margin-top: 20px;">
						<a href="<?php echo U('Pingding/pingding');?>">计算评定</a>
					</li>
					<li style="margin-top: 20px;">
						<a href="<?php echo U('Index/index');?>">返回主页</a>
					</li>				
				</ul>   					               
        	</div>      
            <div class="span11" style="float: left;margin-bottom: 60px;">
                <div class="row-fluid">
					<div class="span3">						
						<div class="panel panel-info" contenteditable="false">
						   <div class="panel-heading">
						      <h3 class="panel-title">部件名称</h3>
						   </div>
						<div class="panel-body">
					   		<table class="table table-bordered">								
								<tbody>										
									 <?php if(is_array($pid1)): foreach($pid1 as $key=>$v): ?><tr class="success">
											<td class="btn1"><?php echo ($v["name"]); ?>
												<button class="btn" style="float: right;" type="button" onclick="setbujian('<?php echo ($v["bujian"]); ?>')">编辑</button>
											</td>
										</tr><?php endforeach; endif; ?>																																																	
								</tbody>
							</table>
							<table class="table table-bordered">								
								<tbody>																
									 <?php if(is_array($pid2)): foreach($pid2 as $key=>$v): ?><tr class="warning">
											<td class="btn1"><?php echo ($v["name"]); ?>
												<button class="btn"  style="float: right;" type="button" onclick="setbujian('<?php echo ($v["bujian"]); ?>')">编辑</button>
											</td>
										</tr><?php endforeach; endif; ?>																																	
								</tbody>
							</table>
							<table class="table table-bordered">								
								<tbody>																				
									 <?php if(is_array($pid3)): foreach($pid3 as $key=>$v): ?><tr class="info">
											<td class="btn1"><?php echo ($v["name"]); ?>
												<button class="btn" style="float: right;" type="button" onclick="setbujian('<?php echo ($v["bujian"]); ?>')">编辑</button>
											</td>
										</tr><?php endforeach; endif; ?>																																											
								</tbody>
							</table>									  
						   </div>
						    <button class="btn btn-success" type="button"style="margin-bottom: 16px;width: 212px;margin-left: 16px;height: 34px;" onclick="window.location.href='<?php echo U('Pingding/pingding');?>'">计算评定</button>
						</div>						
					</div>
					<div class="span4" id="goujian" style="display:none;"></div>					
					<div class="span5" id="shuxin" style="display:none;"></div>
						
									
					<!-- 显示更新合并 -->
					<!--  
					
					<div class="span5" id="shuxin" style="display:none;">
						<div class="panel panel-info">
				   			<div class="panel-heading">
				      			<h3 class="panel-title">构件信息</h3>
							</div>
							<div class="panel-body">								
								<div>
					  				<div>
					  					<img data-target="#modal-container-img4" data-toggle="modal" alt="140x140" src="/Qiao/Application/Home/View/Public/css/login.jpg" class="img-rounded" />
					  				</div>					  				
									<form action="/Qiao/Home/Upimg/index/img/4.html" enctype="multipart/form-data" method="post">
					  					<input type="file" style="float:left;width: 240px;" name="photo"/>图片像素使用：560x316
					  					<input class="btn btn-success" type="submit" style="float:right;margin-bottom: 20px;" value="提交" >
					  				</form>
		  						</div>			  					  			
								<table class="table table-bordered" id="showbinghai" contenteditable="false" style="margin-bottom: 10px;">
					  				<tbody>
					  					<tr class="success">
											<td style="vertical-align:middle;">病害名称</td>
											<td>
												<ol contenteditable="false" style="margin-top: 16px;" class="">
													<li style="height: 40px;">病害&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：1
													 	<button class="btn" type="button" style="float:right;" onclick="deletebing()">删除</button>
													</li>																				
												</ol>
											</td>
										</tr>
										<tr class="error">
											<td>病害类型</td>
											<td></td>
										</tr>
										<tr class="warning">
											<td style="vertical-align:middle;">病害标度</td>
											<td>
												<ol contenteditable="false" class="unstyled">
													<li></li>
												</ol>
											</td>
										</tr>
									</tbody>
								</table>				
								<button class="btn btn-success" id="showbinghaibtn" type="button" style="float:right;margin-bottom: 20px;" onclick="binghai(1)">添加</button>
								<table class="table table-bordered" id="updatabinghai" contenteditable="false" style="margin-bottom: 10px;display:none;">
					  				<tbody>
					  					<tr class="success">
											<td style="vertical-align:middle;">病害名称</td>
											<td>
												<ol contenteditable="false" style="margin-top: 16px;" class="">
													<li style="height: 40px;">病害&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;标度：1
													 	<button class="btn" type="button" style="float:right;" onclick="deletebing()">删除</button>
													</li>																				
												</ol>
											</td>
										</tr>
										<tr class="error">
											<td>病害类型</td>
											<td>
											 	<select>
													<option>Volvo</option>
													<option>Saab</option>
													<option>Fiat</option>
													<option>Audi</option>
												</select>
											</td>
										</tr>
										<tr class="warning">
											<td style="vertical-align:middle;">病害标度</td>
											<td>
												<ol contenteditable="false" class="unstyled">
													<li><input type="checkbox">新闻资讯</li>
												</ol>
											</td>
										</tr>
									</tbody>
								</table>
								<button class="btn btn-success" id="savebinghaibtn" type="button" style="float:right;margin-bottom: 20px;display:none;" onclick="binghai(3)">保存</button>								
								<button class="btn" type="button" id="returnbinghaibtn" style="float:right;margin-bottom: 20px;margin-right: 50px;display:none;" onclick="binghai(2)">返回</button>																	
								<table class="table table-bordered" id="showbinghaiinfo" contenteditable="false" style="margin-bottom: 10px;">
					  				<tbody>
										<tr class="info">
											<td>病害位置</td>
											<td>
												123
											</td>
										</tr>
										<tr class="success">
											<td style="vertical-align:middle;">维修方法</td>
											<td>
												<ul contenteditable="false" class="" style="width: 280px;">													
													<li style="margin-bottom: 10px;">伸缩缝装置有破损、失效，及时修理或更换</li>														
												</ul>
											</td>
										</tr>
										<tr class="error">
											<td>建议</td>
											<td>
												重修
											</td>
										</tr>
										<tr class="warning">
											<td>检查时间</td>
											<td>
												2015-12-12
											</td>
										</tr>
										<tr class="info">
											<td>构件得分</td>
											<td>
												78.5
											</td>
										</tr>
									</tbody>
								</table>
								<button class="btn btn-success" id="showbinghaiinfobtn" type="button" style="float:right;margin-bottom: 20px;" onclick="binghaiinfo(1)">编辑</button>
					  			<table class="table table-bordered" id="updatebinghaiinfo" contenteditable="false" style="margin-bottom: 10px;display:none;">
						  				<tbody>
											<tr class="info">
												<td>病害位置</td>
												<td>
													<input type="text" placeholder="" value="">
												</td>
											</tr>
											<tr class="success">
												<td style="vertical-align:middle;">维修方法</td>
												<td>
													<ul contenteditable="false" class="unstyled" style="width: 300px;">
														<li style="margin-bottom: 10px;"><input type="checkbox">混凝土构件有表面缺陷（蜂窝、麻面、剥落、掉角、磨损）时，应抹砂浆或灌筑混凝土封闭后进行水泥压浆处理</li>														
													</ul>
												</td>
											</tr>
											<tr class="error">
												<td>建议</td>
												<td>
													<input type="text" placeholder="" value="">
												</td>
											</tr>
											<tr class="warning">
												<td>检查时间</td>
												<td>
													<input type="text" placeholder="" value="">
												</td>
											</tr>
											<tr class="info">
												<td>构件得分</td>
												<td>
													<input type="text" disabled="disabled" placeholder="78.5">
													<button class="btn" type="button" style="float:right;" onclick="gouscore()">计算</button>
												</td>
											</tr>
										</tbody>
									</table>
									<button class="btn btn-success" id="savebinghaiinfobtn" type="button" style="float:right;margin-bottom: 20px;display:none;" onclick="binghaiinfo(3)">保存</button>
					  			 	<button class="btn" type="button" id="returnbinghaiinfobtn" style="float:right;margin-bottom: 20px;margin-right: 50px;display:none;" onclick="binghaiinfo(2)">返回</button> 					  			 				  			 	
				  			 </div>
						</div>
					</div>
			 		-->	


					 <!--  图片放大 -->
					 <div id="modal-container-img4" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<img id="img1" alt="未上传图片，请上传图片！" width="560" height="316" src="" class="img-rounded" />				
					 </div>
					 <!--  图片放大 -->
					 					 
					 <!--  构件删除模态框   --> 
					<div id="modal-container-1" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="deletegoujian(0)">×</button>
							<h3 id="myModalLabel">
								构件删除
							</h3>
						</div>
						<div class="modal-body">
							<p>
								确认删除该桥梁吗？如果删除该构件信息将全部删除。
							</p>
						</div>
						<div class="modal-footer">
							 <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="deletegoujian(0)">关闭</button> 
							 <button class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" onclick="deletegoujian(1)">确认</button>
						</div>
					</div>					 
					 <!--  构件删除模态框   -->
					 
				</div> 
			</div>
		</div>
	</div>       
</body>
</html>