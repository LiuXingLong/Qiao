<?php
namespace Home\Controller;
use Think\Controller;
class BaobiaoController extends BaseController {
    public function index(){
    /**
		 *   $_GET['bid']  和    $_SESSION['bid']  都为空   和  都不为空           时   非法操作
		 *   $_GET['bid'] 的  bid 不是该该用户的数据时  非法操作 
		 *   
		 *   注意：这里必须保证    bid  只能是该用户的    否则将可能导致后面的数据别其他用户非法获取
		 */
		$get=I('get.');
		$info1=M('info1');
		$bridge=M('bridge');
		if(empty($get['bid'])&&empty($_SESSION['bid'])){
			$this->error('非法操作');	exit();					
		}else if(!empty($get['bid'])&&!empty($_SESSION['bid'])){
			if($get['bid']!=$_SESSION['bid']){
				$this->error('非法操作');	exit();
			}else{				
				$data=$info1->where("bid=%d",$_SESSION['bid'])->select();
				$data1=$bridge->where("bid=%d",$_SESSION['bid'])->select();
				$data[0]['img1']=md5($_SESSION['username'].$_SESSION['bid'])."/aimg".$data1[0]['img1'].".jpg";
				$data[0]['img2']=md5($_SESSION['username'].$_SESSION['bid'])."/bimg".$data1[0]['img2'].".jpg";
				$data[0]['img3']=md5($_SESSION['username'].$_SESSION['bid'])."/cimg".$data1[0]['img3'].".jpg";				
				$this->data=$data[0];
				$this->display();
			}
		}else{			
			if(!empty($get['bid'])&&empty($_SESSION['bid'])){
				$user=M('bridge');
				$flag=$user->field('user')->where('bid=%d',$get['bid'])->select();				
				if($flag[0]['user']!=$_SESSION['username']){
					$this->error('非法操作');	exit();
				}else{
					session('bid',$get['bid']);					
					$data=$info1->where("bid=%d",$_SESSION['bid'])->select();
					$data1=$bridge->where("bid=%d",$_SESSION['bid'])->select();
					$data[0]['img1']=md5($_SESSION['username'].$_SESSION['bid'])."/aimg".$data1[0]['img1'].".jpg";
					$data[0]['img2']=md5($_SESSION['username'].$_SESSION['bid'])."/bimg".$data1[0]['img2'].".jpg";
					$data[0]['img3']=md5($_SESSION['username'].$_SESSION['bid'])."/cimg".$data1[0]['img3'].".jpg";										
					$this->data=$data[0];
					$this->display();
				}
			}else{								
				$data=$info1->where("bid=%d",$_SESSION['bid'])->select();
				$data1=$bridge->where("bid=%d",$_SESSION['bid'])->select();
				$data[0]['img1']=md5($_SESSION['username'].$_SESSION['bid'])."/aimg".$data1[0]['img1'].".jpg";
				$data[0]['img2']=md5($_SESSION['username'].$_SESSION['bid'])."/bimg".$data1[0]['img2'].".jpg";
				$data[0]['img3']=md5($_SESSION['username'].$_SESSION['bid'])."/cimg".$data1[0]['img3'].".jpg";				
				$this->data=$data[0];		
				$this->display();				
			}
		}
    }
    public function pingfen(){
    	if(empty($_SESSION['bid'])){
    		$this->error('非法操作');	exit();
    	}else{
    		$info2=M('info2');
    		$pingfen=M('pingfen');
    		$data=$info2->where("bid=%d",$_SESSION['bid'])->select();
    		$data1=$pingfen->where("bid=%d",$_SESSION['bid'])->select();
    		$this->data=$data[0];
    		$this->data1=$data1[0];
    		$this->display(pingfen);
    	}    	
    }
    public function jilu(){
    	if(empty($_SESSION['bid'])){
    		$this->error('非法操作');	exit();
    	}else{
    		$jilu=M('jilu');
    		$jilu2=M('jilu2');
    		$data1=$jilu->where('bid=%d',$_SESSION['bid'])->select();
    		$data2=$jilu2->where('bid=%d',$_SESSION['bid'])->select();
    		for($i=1;$i<106;$i++){
    			if($i<86){
    				$data[$i]=$data1[0]['t'.$i];
    			}else{
    				$data[$i]=$data2[0]['t'.$i];
    			}	
    		}
    		$this->data=$data;
    		$this->display(jilu);
    	} 	
    }
    public function updatajilu(){
    	if(IS_POST){
    		$data['bid']=$_SESSION['bid'];
    		for($i=1;$i<86;$i++){
    			$data["t".$i]=$_POST['data'][$i];
    		}
    		$data2['bid']=$_SESSION['bid'];
    		for($i=86;$i<106;$i++){
    			$data2["t".$i]=$_POST['data'][$i];
    		}
    		$jilu=M('jilu');
    		$jilu2=M('jilu2');
   		
    		$flag=$jilu->field('bid')->where('bid=%d',$_SESSION['bid'])->select();
			if(empty($flag[0]['bid'])){
    			// 添加   			
    			$jilu->add($data);
    			$jilu2->add($data2);
    		}
    		else{
    			$jilu->where('bid=%d',$_SESSION['bid'])->save($data);
    			$jilu2->where('bid=%d',$_SESSION['bid'])->save($data2);
    		}
    	}else{
    		$this->error('非法操作');	exit();
    	}
    }
}