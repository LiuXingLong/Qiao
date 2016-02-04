<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
	public function index(){
		$flag=$_GET['flag'];				
		$bridge=M('bridge');
		$data=$bridge->field('bid')->where("api='%s'",$flag)->select();
		if(!empty($data[0])){
			$_SESSION['bid']=$data[0]['bid'];
		}
		$this->display();
	}
    public function api(){
    	if(empty($_SESSION['bid'])){
    		$this->error("非法操作"); exit();
    	}else{   	
    		//基本数据   		
    		$info1=M('info1');
    		$bridge=M('bridge');
    		$daa=$info1->where("bid=%d",$_SESSION['bid'])->select();
    		$daa1=$bridge->where("bid=%d",$_SESSION['bid'])->select();
    		$data['name']=$daa1[0]['name'];
    		$data['img1']=md5($daa1[0]['user'].$_SESSION['bid'])."/aimg".$daa1[0]['img1'].".jpg";
    		$data['img2']=md5($daa1[0]['user'].$_SESSION['bid'])."/bimg".$daa1[0]['img2'].".jpg";
    		$data['img3']=md5($daa1[0]['user'].$_SESSION['bid'])."/cimg".$daa1[0]['img3'].".jpg";
    		for($i=1;$i<31;$i++){
    			$data[$i]=$daa[0]['t'.$i];
    		}
    		$this->data=$data;
    		 
    		//评分数据
    		$info2=M('info2');
    		$pingfen=M('pingfen');
    		$dat=$info2->where("bid=%d",$_SESSION['bid'])->select();
    		$dat1=$pingfen->where("bid=%d",$_SESSION['bid'])->select();
    		for($i=1;$i<33;$i++){
    			if($i%2==1){
    				$data1['t'.$i]=$dat[0]['t'.$i];
    			}else{
    				$data1['t'.$i]=$dat1[0]['t'.$i];
    			}
    		}
    		$data1['q']=$dat1[0]['q'];
    		$data1['j1']=$dat1[0]['j1'];
    		$data1['j2']=$dat1[0]['j2'];
    		$data1['j3']=$dat1[0]['j3'];
    		$this->data1=$data1;
    		 
    			
    		//记录数据
    		$jilu=M('jilu');
    		$jilu2=M('jilu2');
    		$da1=$jilu->where('bid=%d',$_SESSION['bid'])->select();
    		$da2=$jilu2->where('bid=%d',$_SESSION['bid'])->select();
    		for($i=1;$i<106;$i++){
    			if($i<86){
    				$data2[$i]=$da1[0]['t'.$i];
    			}else{
    				$data2[$i]=$da2[0]['t'.$i];
    			}
    		}
    		$this->data2=$data2;
    		$this->display(api);
    	}    	
    }  
}