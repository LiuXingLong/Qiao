<?php
namespace Home\Controller;
use Think\Controller;
class InfoController extends BaseController {
	Public function index(){
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
	public function info(){
		if(empty($_SESSION['bid'])){
			$this->error('非法操作'); exit();	
		}else{
			$info2=M('info2');
			$data=$info2->where("bid=%d",$_SESSION['bid'])->select();
			if($data[0]['flag']==1){
				$data[0]['info2flag']="none";				
			}else{
				$data[0]['info2flag']="block";				
			}
			$this->data=$data[0];			
			$this->display(info);
		}
	}
	public function update1(){
		if(IS_POST){
			$data['bid']=$_SESSION['bid'];
			for($i=1;$i<31;$i++){
				$data["t".$i]=$_POST['data'][$i];
			}	
			$info1=M('info1');		
			$flag=$info1->field('bid')->where('bid=%d',$_SESSION['bid'])->select();
			if(empty($flag[0]['bid'])){	
				// 添加				
				$info1->create($data);
				$info1->add();				
			}			
			else{											  
				 $info1->where('bid=%d',$_SESSION['bid'])->save($data);					
			}	
		}else{
			$this->error('非法操作'); 
		}	
	}
	public function update2(){
		if(IS_POST){
			$data['bid']=$_SESSION['bid'];
			$flag[1]=0.70;   $flag[2]=0.18;  $flag[3]=0.12;
			$flag[4]=0.02;  $flag[5]=0.01;  $flag[6]=0.30;  $flag[7]=0.30;  $flag[8]=0.28;  $flag[9]=0.07; $flag[10]=0.02;
			$flag[11]=0.40; $flag[12]=0.25; $flag[13]=0.10; $flag[14]=0.10; $flag[15]=0.10; $flag[16]=0.05;			
			$flg1=$flg2=$flg3=0;
			for($i=1;$i<17;$i++){
				if($i<4){
					if($_POST['data'][$i]!=0){
						$flg1+=$flag[$i];
					}
				}else if($i<11){
					if($_POST['data'][$i]!=0){
						$flg2+=$flag[$i];
					}
				}else{
					if($_POST['data'][$i]!=0){
						$flg3+=$flag[$i];
					}
				}	
			}			
			for($i=1;$i<17;$i++){
				if($i<4){
					if($flg1==0){
						$flag[$i]=0;
					}else{
						if($_POST['data'][$i]==0){
							$flag[$i]=0;
						}else{
							$flag[$i]=(1-$flg1)*$flag[$i]/$flg1+$flag[$i];
						}
					}						
				}else if($i<11){
					if($flg2==0){
						$flag[$i]=0;
					}else{
						if($_POST['data'][$i]==0){
							$flag[$i]=0;
						}else{
							$flag[$i]=(1-$flg2)*$flag[$i]/$flg2+$flag[$i];
						}
					}						
				}else{
					if($flg3==0){
						$flag[$i]=0;
					}else{
						if($_POST['data'][$i]==0){
							$flag[$i]=0;
						}else{
							$flag[$i]=(1-$flg3)*$flag[$i]/$flg3+$flag[$i];
						}	
					}					
				}
			}
			/*
			  $a=floor(3.149569*100)/100;  保留两位小数不四舍五入         floor();取整数部分
			  round($flag[$j],2);   保留两位小数
			  number_format($number, 2, '.', '');
			  sprintf("%.2f", $num); 
			 
			 */			
			for($i=1,$j=1;$i<33;$i++){
				if($i%2==1){
					if($flag[$j]!=0){
						$data["t".$i]=sprintf("%.3f", $flag[$j]);
					}else{
						$data["t".$i]=$flag[$j];
					}
				}else{
					$data["t".$i]=$_POST['data'][$j++];
				}	
			}			
			$info2=M('info2');
			$fag=$info2->field('bid')->where('bid=%d',$_SESSION['bid'])->select();
			if(empty($fag[0]['bid'])){
				// 添加
				$data['flag']=1;
				$info2->create($data);
				$info2->add();
			}else{
				echo Error;
				/**
				 * 一但添加不能修改
				 * 
				 * $info2->where('bid=%d',$_SESSION['bid'])->save($data);
				 */				
			}		
		}else{
			$this->error('非法操作');
		}	
	}          
}