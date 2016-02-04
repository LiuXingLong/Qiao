<?php
namespace Home\Controller;
use Think\Controller;
class UpimgController extends BaseController {
    public function index(){ 
     	if(empty($_GET['img'])){
     		$this->error('非法操作'); exit();
     	}else{
    		$upload = new \Think\Upload();//  实例化上传类
    		$upload->maxSize = 3145728 ;//  设置附件上传大小
    		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
    		 
    		//  存取路径设置   		
    		$upload->rootPath ='C:/wamp/www/Qiao/Application/Home/View/Public/';
    		$upload->savePath = 'img/';
    		 
    		//  生成子目录
    		$upload->autoSub = true;
    		$upload->subName = md5($_SESSION['username'].$_SESSION['bid']);
    		    		
    		$upload->saveExt ="jpg";  // 设置文件后缀
    		
    		$upload->replace =true; // 同名文件覆盖
    		
    		// 生成文件名
    		$bridge=M("bridge");
    		$imgname=$bridge->where("bid=%d",$_SESSION['bid'])->select();
    		
    		
    		if($_GET['img']==1){
    			$img=$imgname[0]['img1']+1;   			
    			$imgfile="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$_SESSION['bid'])."/aimg".$imgname[0]['img1'].".jpg";    			
    			$upload->saveName = 'aimg'.$img;
    			$data['img1']=$img;
    			$img='aimg'.$img;
    		}else if($_GET['img']==2){   			
    			$img=$imgname[0]['img2']+1;
    			$imgfile="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$_SESSION['bid'])."/bimg".$imgname[0]['img2'].".jpg";
    			$upload->saveName = 'bimg'.$img;
    			$data['img2']=$img;
    			$img='bimg'.$img;
    		}else if($_GET['img']==3){   			
    			$img=$imgname[0]['img3']+1;   	
    			$imgfile="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$_SESSION['bid'])."/cimg".$imgname[0]['img3'].".jpg";
    			$upload->saveName = 'cimg'.$img;
    			$data['img3']=$img;
    			$img='cimg'.$img;
    		}   		 
    		$info = $upload->upload();  //  上传文件    	
    		if(!$info){   //  上传错误提示错误信息
				echo $upload->getError();    			
    		}else{//  上传成功
    			// 删除之前的图片        更新数据库  
    			unlink($imgfile);   			
    			$bridge->where("bid=%d",$_SESSION['bid'])->save($data);
    			echo "success,".md5($_SESSION['username'].$_SESSION['bid'])."/".$img.".jpg";
    		}   		
    	} 	
    }
    public function Uploadgouimg(){
    	if(IS_POST){
    		$upload = new \Think\Upload();//  实例化上传类
    		$upload->maxSize = 3145728 ;//  设置附件上传大小
    		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
    		    		
    		//  存取路径设置
    		$upload->rootPath ='C:/wamp/www/Qiao/Application/Home/View/Public/';  
    		$upload->savePath = 'img/'.md5($_SESSION['username'].$_SESSION['bid'])."/";
    		 
    		//  生成子目录
    		$upload->autoSub = true;
    		$upload->subName = md5($_SESSION['gid']);
    		
    		$upload->saveExt ="jpg";  // 设置文件后缀
    		
    		$upload->replace =true; // 同名文件覆盖
    		
    		// 生成文件名
    		$img=M('goujian');    		
    		$imgname=$img->field('img')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    		// 删除之前图片    		
    		$imgfile="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$_SESSION['bid'])."/".md5($_SESSION['gid'])."/img".$imgname[0]['img'].".jpg";   		
    		
    		// 更新数据库  和  文件名
    		$data['img']=$imgname[0]['img']+1;
    		    		
    		
    		// 上传图片名
    		$upload->saveName = 'img'.$data['img'];    		
    		$info = $upload->upload();  //  上传文件
    		
    		if(!$info){   //  上传错误提示错误信息
    			echo $upload->getError();	
    		}else{//  上传成功    	
    			
    			// 删除图片   必需上传成功后才能删除图片  和 数据库图片名称   			
    			unlink($imgfile);    	
    			
    			// 更新数据库图片名称    			
    			$img->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->save($data);   			
    			echo "success,".md5($_SESSION['username'].$_SESSION['bid'])."/".md5($_SESSION['gid'])."/img".$data['img'].".jpg";   			
    		}
    	}else{
    		$this->error('非法操作'); exit();
    	}    		
    }
}