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
    function login(){
    	var username=$("#username").val().trim();
    	var password=$("#password").val().trim();
    	var code=$("#txtCode").val().trim();
    	if(username==""){
    		alert("用户名不能为空！");
    	}else if(password==""){
    		alert("密码不能为空！");
    	}else if(code==""){
    		alert("验证码不能为空！");
    	}else{
    		$.ajax({
    	        type: "POST",
    	        url: '<?php echo U('Login/login');?>',
    	        data: { username:username ,password:password,code:code },
    	        success: function (data) {
    	        	if (data == "ErrorCode"){ 
    	            	alert("验证码错误！");
    	            	$("#vcode").click();
    	            }else if (data == "Error"){                
    	            	alert("用户名或密码错误！");
    	            }else {
    	                window.location.href ="<?php echo U('Index/index');?>";
    	            }
    	        }
    	    });	
    	}
    }
    function register(){
    	var username=$("#username1").val();
    	var password=$("#password1").val();
    	var code=$("#txtCode1").val();
    	if(username==""){
    		alert("用户名不能为空！");
    	}else if(password==""){
    		alert("密码不能为空！");
    	}else if(code==""){
    		alert("验证码不能为空！");
    	}else{
    		$.ajax({
    	        type: "POST",
    	        url: '<?php echo U('Login/register');?>',
    	        data: { username:username ,password:password,code:code },
    	        success: function (data) {
    	        	if (data == "ErrorCode"){                
    	            	alert("验证码错误！");
    	            	$("#vcode").click();
    	            }else if (data == "Error"){                
    	            	alert("用户名已存在！");
    	            }else {
    	                window.location.href ="<?php echo U('Index/index');?>";
    	            }    	        	
    	        }
    	    });	
    	}
    }
    function showregister(){
    	 $("#register").show();
    	 $("#login").hide();
    }
    function returnlogin(){
    	$("#login").show();
    	$("#register").hide();   	 	
    }
    </script>
	<style type="text/css">
		input{
    		width: 160px;   		
		}	
		.control-label{
			width: 100px;
		}		
		.controls{
			margin-left: 130px;
		}
		.text-center{
			color：#002AFF;
		}
	</style>
</head>
<body style="background:url(/Qiao/Application/Home/View/Public/css/login.jpg);background-attachment:fixed;background-repeat:no-repeat;">
   <div style="margin-top: 50px;">      
       <h3 class="text-center">公路桥梁检测评定系统</h3> 
   </div>
   <div class="span5" id="login" style="margin-top: 60px;margin-left: 490px;float:left;width: 380px;display:block;">
   		<div class="panel panel-success">
		   <div class="panel-heading" style="padding-bottom: 5px;">
		      <h3 class="panel-title">登入系统</h3>
		   </div>
		   <div class="panel-body" style="padding-bottom: 5px;">
		   	<div class="form-horizontal">
				<div class="control-group" style="margin-bottom: 14px;">
					<label class="control-label" for="inputName"  style="width: 86px;">用户名</label>
					<div class="controls" style="margin-left: 104px;">
						<input  id="username" name="username" value="" placeholder="" type="text">
					</div>
				</div>
				<div class="control-group" style="margin-bottom: 14px;">
					<label class="control-label" for="inputPassword" style="width: 86px;">密码</label>
					<div class="controls" style="margin-left: 104px;">
						<input id="password" name="password" value="" placeholder="" type="password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword" style="width: 86px;">验证码</label>
					<div class="controls" style="margin-left: 104px;">
						<input id="txtCode" name="txtcode" value="" placeholder="" type="text" style="width: 76px;">
						<img src="<?php echo U('Code/getCode');?>" onclick="javascript:this.src='<?php echo U('Code/getCode?+Math.random()');?>';" id="vcode">
					</div>
				</div>
				<div class="control-group">
					<div class="controls" style="margin-left: 100px;">
						<button type="button" class="btn btn-success" style="width: 66px;" onclick="showregister()">注册</button>						
						<button type="button" class="btn btn-success" style="margin-left: 28px;width: 66px;" onclick="login()">登陆</button>
					</div>
				</div>	
		   </div>
		   </div>
		</div>
   </div> 
   <div class="span5" id="register" style="margin-top: 60px;margin-left: 490px;float:left;width: 380px;display:none;">
   		<div class="panel panel-info">
		   <div class="panel-heading" style="padding-bottom: 5px;">
		      <h3 class="panel-title">注册系统</h3>
		   </div>
		   <div class="panel-body" style="padding-bottom: 5px;">
		   	<div class="form-horizontal">
				<div class="control-group" style="margin-bottom: 14px;">
					<label class="control-label" for="inputName" style="width: 86px;">用户名</label>
					<div class="controls" style="margin-left: 104px;">
						<input  id="username1" name="username1" value="" placeholder="" type="text">
					</div>
				</div>
				<div class="control-group" style="margin-bottom: 14px;">
					<label class="control-label" for="inputPassword" style="width: 86px;">密码</label>
					<div class="controls" style="margin-left: 104px;">
						<input id="password1" name="password1" value="" placeholder="" type="password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword" style="width: 86px;">验证码</label>
					<div class="controls" style="margin-left: 104px;">
						<input id="txtCode1" name="txtcode1" value="" placeholder="" type="text" style="width: 76px;">
						<img src="<?php echo U('Code/getCode');?>" onclick="javascript:this.src='<?php echo U('Code/getCode?+Math.random()');?>';" id="vcode">
					</div>
				</div>
				<div class="control-group">
					<div class="controls" style="margin-left: 100px;">
						<button type="button" class="btn btn-success" style="width: 66px;" onclick="returnlogin()">返回</button>						
						<button type="button" class="btn btn-success" style="margin-left: 28px;width: 66px;" onclick="register()">注册</button>
					</div>
				</div>	
		   </div>
		   </div>
		</div>
   </div>
</body>
</html>