<?php
namespace Home\Controller;
use Think\Controller;
class PingdingController extends BaseController {
    public function index(){
    	session('bujian',null);    	
    	session('gid',null);
    	$get=I('get.');
    	$info2=M('info2');
    	$bujianlist=M('bujianlist');
    	$bujianname=$bujianlist->field('name')->select();
    	for($i=0;$i<16;$i++){
    		$pid[$i+1]=$bujianname[$i]['name'];
    	}
    	if(empty($get['bid'])&&empty($_SESSION['bid'])){
    		$this->error('非法操作');	exit();
    	}else if(!empty($get['bid'])&&!empty($_SESSION['bid'])){
    		if($get['bid']!=$_SESSION['bid']){
    			$this->error('非法操作');	exit();			
    		}else{    			
    			$data=$info2->where("bid=%d",$_SESSION['bid'])->select();    			
    			for($i=2,$j1=1,$j2=1,$j3=1,$k=1;$i<33;$i+=2,$k++){
    				if($i<7){
    					if($data[0]["t".$i]!=0){
    						$pid1[$j1]['bujian']="t".$i;
    						$pid1[$j1++]['name']=$pid[$k];
    					}   					
    				}else if($i<21){
    					if($data[0]["t".$i]!=0){
    						$pid2[$j2]['bujian']="t".$i;
    						$pid2[$j2++]['name']=$pid[$k];
    					}    					
    				}else{
    					if($data[0]["t".$i]!=0){
    						$pid3[$j3]['bujian']="t".$i;
    						$pid3[$j3++]['name']=$pid[$k];
    					}   					
    				}
    			}				
    			$this->pid1=$pid1;
    			$this->pid2=$pid2;
    			$this->pid3=$pid3;	
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
    				$data=$info2->where("bid=%d",$_SESSION['bid'])->select();
    				for($i=2,$j1=1,$j2=1,$j3=1,$k=1;$i<33;$i+=2,$k++){
    					if($i<7){
    						if($data[0]["t".$i]!=0){
    							$pid1[$j1]['bujian']="t".$i;
    							$pid1[$j1++]['name']=$pid[$k];    							
    						}
    					}else if($i<21){
    						if($data[0]["t".$i]!=0){
    							$pid2[$j2]['bujian']="t".$i;
    							$pid2[$j2++]['name']=$pid[$k];
    						}
    					}else{
    						if($data[0]["t".$i]!=0){
    							$pid3[$j3]['bujian']="t".$i;
    							$pid3[$j3++]['name']=$pid[$k];
    						}
    					}
    				}
    				$this->pid1=$pid1;
    				$this->pid2=$pid2;
    				$this->pid3=$pid3;
    				$this->display();
    			}
    		}else{
    			$data=$info2->where("bid=%d",$_SESSION['bid'])->select();
    			for($i=2,$j1=1,$j2=1,$j3=1,$k=1;$i<33;$i+=2,$k++){
    				if($i<7){
    					if($data[0]["t".$i]!=0){
    						$pid1[$j1]['bujian']="t".$i;
    						$pid1[$j1++]['name']=$pid[$k];
    					}
    				}else if($i<21){
    					if($data[0]["t".$i]!=0){
    						$pid2[$j2]['bujian']="t".$i;
    						$pid2[$j2++]['name']=$pid[$k];
    					}
    				}else{
    					if($data[0]["t".$i]!=0){
    						$pid3[$j3]['bujian']="t".$i;
    						$pid3[$j3++]['name']=$pid[$k];
    					}
    				}
    			}
    			$this->pid1=$pid1;
    			$this->pid2=$pid2;
    			$this->pid3=$pid3;
    			$this->display();
    		}
    	}
    }
    public function setbujian(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])){
    			$this->error('非法操作'); exit();
    		}else{
    			/**
    			 * 设置部件      返回部件的构件
    			 */ 
    			$_SESSION['bujian']=$_POST["bujian"];
    			$goujian=M('goujian');
    			$data=$goujian->field('name,gid')->order('gid asc')->where("bid=%d and bujian='%s'",$_SESSION['bid'],$_SESSION['bujian'])->select(); //  order('gid asc')升序         order('gid desc')降序                            		
    			$this->ajaxReturn($data);
    		}   		
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function setgoujian(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])){
    			$this->error('非法操作'); exit();
    		}else{
    			/**
    			 *   设置构件      返回构件的属性
    			 */ 
    			$_SESSION['gid']=$_POST["goujian"];
    			
    			// 构件基本信息
    			$Goujian=M('goujian');
    			$data['info']=$Goujian->field('weizhi,jianyi,time,score,img')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			
    			// 构件病害信息
    			$Binghai=M('binghai');    			
    			$data['binghai']=$Binghai->field('bingid,dengji,name')->order('bingid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			
    			// 构件维修信息
    			$Weixiu=M('weixiu');
    			$data['weixiu']=$Weixiu->field('name')->order('weixiuid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();   			
    		
    			// 构件图文件路径    			
    			$data['img']=md5($_SESSION['username'].$_SESSION['bid'])."/".md5($_SESSION['gid'])."/img".$data['info'][0]['img'].".jpg";
    			
    			$this->ajaxReturn($data);
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function addgoujian(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])){
    			$this->error('非法操作'); exit();
    		}else{
    			/**
    			 * 给部件添加构件  并返回该部件所有的构件数据
    			 */   			  			
    			$goujian=M('goujian');
    			$info2=M('info2');
    			
    			$gou['name']=$_POST["name"];
    			$gou['bid']=$_SESSION['bid'];
    			$gou['bujian']=$_SESSION['bujian'];
    			
    			$flag=$goujian->where("bid=%d and bujian='%s' and name='%s'",$_SESSION['bid'],$_SESSION['bujian'],$_POST["name"])->select();
				$flag1=$goujian->where("bid=%d and bujian='%s'",$_SESSION['bid'],$_SESSION['bujian'])->select();
    			$cont=count($flag1);    			
    			$t=$info2->where("bid=%d",$_SESSION['bid'])->select();
				if($cont>=$t[0][$_SESSION['bujian']]){
					//  检测部件是否数量达到上限
					echo "Error1";
				}else if(!empty($flag[0])){
					//  检测部件名是否存在
					echo "Error";
    			}else{    				
    				// 新增构件
    				$goujian->add($gou);
    				// 查询部件的所有构件
    				$data=$goujian->field('name,gid')->order('gid asc')->where("bid=%d and bujian='%s'",$_SESSION['bid'],$_SESSION['bujian'])->select();
    				$this->ajaxReturn($data);
    			}
    		}
    	}else{
    		$this->error('非法操作');
    	}	
    }
    public function deletegoujian(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])){
    			$this->error('非法操作'); exit();
    		}else{
    			/**
    			 * 删除部件的构件  并返回该部件所有的构件数据             且还需要删除   构件信息   病害   构架图片
    			 */
    			//  删除构件的基本信息
    			$goujian=M('goujian');    	    			
    			$goujian->where("gid=%d",$_POST["gid"])->delete();
    			 			
    			//  删除构件病害图片文件夹    使用函数删除文件夹
    			$imgfile="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$_SESSION['bid'])."/".md5($_POST["gid"]);   			   			     			
    			$this->delDirAndFile($imgfile,true);    			
    			
    			//  删除构件的病害信息
    			$binghai=M('binghai');
    			$binghai->where("gid=%d",$_POST["gid"])->delete();
    			
    			//  删除构件的维修信息    			
    			$weixiu=M('weixiu');
    			$weixiu->where("gid=%d",$_POST["gid"])->delete();
    			
    			// 查询部件的所有构件
    			$data=$goujian->field('name,gid')->order('gid asc')->where("bid=%d and bujian='%s'",$_SESSION['bid'],$_SESSION['bujian'])->select();
    			$this->ajaxReturn($data);
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    /**
     * 删除目录及目录下所有文件或删除指定文件
     * @param str $path   待删除目录路径
     * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
     * @return bool 返回删除状态
     */
    function delDirAndFile($path, $delDir = FALSE) {
    	$handle = opendir($path);
    	if ($handle) {
    		while (false !== ( $item = readdir($handle) )) {
    			if ($item != "." && $item != "..")
    				is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
    		}
    		closedir($handle);
    		if ($delDir)
    			return rmdir($path);
    	}else {
    		if (file_exists($path)) {
    			return unlink($path);
    		} else {
    			return FALSE;
    		}
    	}
    }
    public function deletebinghai(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');   exit();
    		}else{
    			//  更新构件得分
    			$Gj=M('goujian');
    			$gscore['score']="";
    			$Gj->where("bid=%d and bujian='%s'and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->save($gscore);
    			   			
    			/**
    			 * 删除构件病害    并     返回剩下构件的病害
    			 */
    			// 删除病害
    			$Bing=M('binghai');
    			$Bing->where("bid=%d and bujian='%s'and gid=%d and bingid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'],$_POST["bingid"])->delete();
    			// 查询构件所有病害
    			$data=$Bing->field('bingid,dengji,name')->order('bingid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			$this->ajaxReturn($data);
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function addbinghai(){
    	if(IS_AJAX){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');  exit();
    		}else{
    			//  更新构件得分
    			$Gj=M('goujian');
    			$gscore['score']="";
    			$Gj->where("bid=%d and bujian='%s'and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->save($gscore);

    			/**
    			 * IS_AJAX  ThinkPHP I  方法失效
    			 * 添加成功后 返回所有构件病害更新数据
    			 */
    			$_POST['binghai'][0]; //  病害 id
    			$_POST['binghai'][1]; //  病害等级
    			$_POST['binghai'][2]; //  病害扣分
    			 
    			$Bing=M('binghai');
    			$flag=$Bing->where("bid=%d and bujian='%s' and gid=%d and bingid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'],$_POST['binghai'][0])->select();
    			if(!empty($flag[0])){
    				echo Error;
    			}else{
    				$Binglist=M('binghailist');
    				$name=$Binglist->field('name')->where("bujian='%s' and bingid=%d",$_SESSION['bujian'],$_POST['binghai'][0])->select();
    				$binghai['bid']=$_SESSION['bid'];
    				$binghai['bujian']=$_SESSION['bujian'];
    				$binghai['gid']=$_SESSION['gid'];
    				$binghai['bingid']=$_POST['binghai'][0];
    				$binghai['name']=$name[0]['name'];
    				$binghai['dengji']=$_POST['binghai'][1];
    				$binghai['score']=$_POST['binghai'][2];
    				$Bing->add($binghai); //  添加
    
    				// 查询构件所有病害
    				$data=$Bing->field('bingid,dengji,name')->order('bingid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    				$this->ajaxReturn($data);
    			}
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function binghaileixing(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');   exit();
    		}else{
    			/**
    			 * 返回部件所有可能的     病害类型
    			 */
    			// 病害类型
    			$Binglist=M('binghailist');    			
    			$data=$Binglist->field('bingid,name,dengji,score')->order('bingid asc')->where("bujian='%s'",$_SESSION['bujian'])->select();   			
    			$this->ajaxReturn($data);
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function weixiuleixing(){
    	if(IS_AJAX){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');  exit();
    		}else{
    			/*
    			 * 返回部件所有可能的     维修方法
    			 */
    			
    			// 部件的所有维修方法
    			$Weixiulist=M('weixiulist');
    			$data=$Weixiulist->field('weixiuid,name')->order('weixiuid asc')->where("bujian='%s'",$_SESSION['bujian'])->select();
    			$cont=count($data);
    			
    			// 构件已选择的维修方法
    			$Weixiu=M('weixiu');
    			$dataweixiu=$Weixiu->field('weixiuid,name')->order('weixiuid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			$cont1=count($dataweixiu);
    			
    			// 标记已选的维修方法
    			for($i=0;$i<$cont;$i++){
    				$data[$i]['flag']=false;
    				for($j=0;$j<$cont1;$j++){
    					if($data[$i]['weixiuid']==$dataweixiu[$j]['weixiuid']){    						
    						$data[$i]['flag']=true;
    						break;
    					}	
    				}
    			}    			
    			$this->ajaxReturn($data);    			
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    public function savebinghaiinfo(){
    	if(IS_AJAX){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');  exit();
    		}else{
    			$goujian=M('goujian');
    			$data['weizhi']=$_POST['data']['weizhi'];
    			$data['jianyi']=$_POST['data']['jianyi'];
    			$data['time']=$_POST['data']['time'];
    			//更新构件信息
    			$goujian->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->save($data);
    
    			$Weixiu=M('weixiu');
    			//删除所有构件维修方法
    			$Weixiu->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->delete();
    
    			$Weixiulist=M('weixiulist');
    			$cont=count($_POST['data']['weixiu']);
    			for($i=0;$i<$cont;$i++){
    				$list=$Weixiulist->field('weixiuid,name')->where("weixiuid=%d",$_POST['data']['weixiu'][$i])->select();
    				$weilist['bid']=$_SESSION['bid'];
    				$weilist['bujian']=$_SESSION['bujian'];
    				$weilist['gid']=$_SESSION['gid'];
    				$weilist['weixiuid']=$list[0]['weixiuid'];
    				$weilist['name']=$list[0]['name'];
    				$Weixiu->add($weilist);
    			}
    			// 构件基本信息
    			$returndata['info']=$goujian->field('weizhi,jianyi,time,score')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			// 构件维修信息
    			$returndata['weixiu']=$Weixiu->field('name')->order('weixiuid asc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			$this->ajaxReturn($returndata);
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }    
    /**
     * 计算构件得分
     */
    public function goujiangrade(){
    	if(IS_POST){
    		if(empty($_SESSION['bid'])||empty($_SESSION['bujian'])||empty($_SESSION['gid'])){
    			$this->error('非法操作');  exit();
    		}else{
    			//  查询构件所有的 病害     按 病害扣分降序
    			$Bh=M('binghai');
    			$data=$Bh->field('gid,bingid,score')->order('score desc')->where("bid=%d and bujian='%s' and gid=%d",$_SESSION['bid'],$_SESSION['bujian'],$_SESSION['gid'])->select();
    			//dump($data);
    			$Gj=M('goujian');
    			if(empty($data)){     				
    				$datag['score']=sprintf("%.2f", 100);
    				$Gj->where("gid=%d",$_SESSION['gid'])->save($datag);
    				$this->ajaxReturn($datag);    				
    			//	echo "Error";  //  没有添加构件病害    			
    			}else{
    				$cont=count($data);
    				$flag=null;    //  标志构件是否改变
    				$gscore=null;  //  记录桥   构件得分  和   构件  gid
    				$bscore=null;  //  记录病害     得分  和  病害  bingid
    				$x=1;$bsum=0;
    				for($i=0,$j=0;$i<$cont;$i++){
    					if($i==0){
    						$flag=$data[$i]['gid'];
    						$gscore[$j]['gid']=$data[$i]['gid'];
    						$gscore[$j]['score']=100;
    							
    						$bscore[$i]['bingid']=$data[$i]['bingid'];
    						$bscore[$i]['score']=$data[$i]['score'];
    			
    						$bsum+=$bscore[$i]['score'];
    						$x++;
    						if($cont==1){
    							$gscore[$j]['score']-=$bsum;
    						}
    					}else if($flag!=$data[$i]['gid']){
    						$gscore[$j++]['score']-=$bsum;
    							
    						$bsum=0;$x=1;
    						$flag=$data[$i]['gid'];
    						$gscore[$j]['gid']=$data[$i]['gid'];
    						$gscore[$j]['score']=100;
    			
    						$bscore[$i]['bingid']=$data[$i]['bingid'];
    						$bscore[$i]['score']=$data[$i]['score'];
    			
    						$bsum+=$bscore[$i]['score'];
    						$x++;
    						if($i==$cont-1){
    							$gscore[$j]['score']-=$bsum;
    						}
    					}else{
    						$bscore[$i]['bingid']=$data[$i]['bingid'];
    						$bscore[$i]['score']=$data[$i]['score']/(100*sqrt($x))*(100-$bsum);
    						$bsum+=$bscore[$i]['score'];
    						$x++;
    						if($i==$cont-1){
    							$gscore[$j]['score']-=$bsum;
    						}
    					}
    				}
    				//     		dump($gscore);   构建得分
    				//     		dump($bscore);   病害得分
    				/**
    				 * 保存构件得分   将计算出的构件得分存入数据库
    				 */
    				
    				$contg=count($gscore);
    				for($i=0;$i<$contg;$i++){
    					$datag['score']=sprintf("%.2f", $gscore[$i]['score']);
    					$Gj->where("gid=%d",$gscore[$i]['gid'])->save($datag);
    				}
    				$this->ajaxReturn($datag);
    			}
    		}
    	}else{
    		$this->error('非法操作');
    	}
    }
    
    /**
     * 计算桥的所有得分
     */
    public function bridgegrade(){ 
    	if(empty($_SESSION['bid'])){
    		$this->error('非法操作');exit();
    	}else{
    		//  查询桥所有的    病害           按构件升序           病害扣分降序
    		$Bh=M('binghai');
    		$data=$Bh->field('gid,bingid,score')->order('gid,score desc')->where("bid=%d",$_SESSION['bid'])->select();
    		//dump($data);
    	
    		/**
    		 *  计算桥存在的构件的得分
    		*/
    		$cont=count($data);
    		$flag=null;    //  标志构件是否改变
    		$gscore=null;  //  记录桥   构件得分  和   构件  gid
    		$bscore=null;  //  记录病害     得分  和  病害  bingid
    		$x=1;$bsum=0;
    		for($i=0,$j=0;$i<$cont;$i++){
    			if($i==0){
    				$flag=$data[$i]['gid'];
    				$gscore[$j]['gid']=$data[$i]['gid'];
    				$gscore[$j]['score']=100;
    	
    				$bscore[$i]['bingid']=$data[$i]['bingid'];
    				$bscore[$i]['score']=$data[$i]['score'];
    				 
    				$bsum+=$bscore[$i]['score'];
    				$x++;
    				if($cont==1){
    					$gscore[$j]['score']-=$bsum;
    				}
    			}else if($flag!=$data[$i]['gid']){
    				$gscore[$j++]['score']-=$bsum;
    	
    				$bsum=0;$x=1;
    				$flag=$data[$i]['gid'];
    				$gscore[$j]['gid']=$data[$i]['gid'];
    				$gscore[$j]['score']=100;
    				 
    				$bscore[$i]['bingid']=$data[$i]['bingid'];
    				$bscore[$i]['score']=$data[$i]['score'];
    				 
    				$bsum+=$bscore[$i]['score'];
    				$x++;
    				if($i==$cont-1){
    					$gscore[$j]['score']-=$bsum;
    				}
    			}else{
    				$bscore[$i]['bingid']=$data[$i]['bingid'];
    				$bscore[$i]['score']=$data[$i]['score']/(100*sqrt($x))*(100-$bsum);
    				$bsum+=$bscore[$i]['score'];
    				$x++;
    				if($i==$cont-1){
    					$gscore[$j]['score']-=$bsum;
    				}
    			}
    		}
    		//     		dump($gscore);   构建得分
    		//     		dump($bscore);   病害得分
    		/**
    		 * 保存构件得分   将计算出的构件得分存入数据库
    		 */
    		$Gj=M('goujian');
    		$contg=count($gscore);
    		for($i=0;$i<$contg;$i++){
    			$datag['score']=sprintf("%.2f", $gscore[$i]['score']);
    			$Gj->where("gid=%d",$gscore[$i]['gid'])->save($datag);
    		}
    			
    		// 取出部件数量        计算部件得分
    		$Bj=M('info2');
    		$datab=$Bj->where("bid=%d",$_SESSION['bid'])->select();
    		//dump($datab);
    	
    		/**
    		 *   计算桥的所有部件得分
    		*/
    		for($i=2;$i<33;$i+=2){
    			$score=null;$t=null;
    			if($datab[0]["t".$i]>0){
    				//  部件数量大于  0
    				if($datab[0]["t".$i]==1) $t=0;
    				if($datab[0]["t".$i]==2) $t=10;
    				if($datab[0]["t".$i]==3) $t=9.7;
    				if($datab[0]["t".$i]==4) $t=9.5;
    				if($datab[0]["t".$i]==5) $t=9.2;
    				if($datab[0]["t".$i]>=6&&$datab[0]["t".$i]<=7) $t=8.8;
    				if($datab[0]["t".$i]>=8&&$datab[0]["t".$i]<=10) $t=8.3;
    				if($datab[0]["t".$i]>=11&&$datab[0]["t".$i]<=15) $t=7.5;
    				if($datab[0]["t".$i]>=16&&$datab[0]["t".$i]<=20) $t=6.8;
    				if($datab[0]["t".$i]>=21&&$datab[0]["t".$i]<=24) $t=6.3;
    				if($datab[0]["t".$i]>=25&&$datab[0]["t".$i]<=29) $t=5.7;
    				if($datab[0]["t".$i]>=30&&$datab[0]["t".$i]<=39) $t=5.2;
    				if($datab[0]["t".$i]>=40&&$datab[0]["t".$i]<=49) $t=4.7;
    				if($datab[0]["t".$i]>=50&&$datab[0]["t".$i]<=59) $t=4.2;
    				if($datab[0]["t".$i]>=60&&$datab[0]["t".$i]<=69) $t=3.8;
    				if($datab[0]["t".$i]>=70&&$datab[0]["t".$i]<=79) $t=3.4;
    				if($datab[0]["t".$i]>=80&&$datab[0]["t".$i]<=89) $t=3;
    				if($datab[0]["t".$i]>=90&&$datab[0]["t".$i]<=99) $t=2.65;
    				if($datab[0]["t".$i]>=100&&$datab[0]["t".$i]<=199) $t=2.5;
    				if($datab[0]["t".$i]>=200) $t=2.3;
    				 
    				$data=null;
    				//  找出部件    添加了的构件   按构件分值     升序排列
    				$data=$Gj->field('score,bujian,gid')->order('score')->where("bid=%d and bujian='%s'",$_SESSION['bid'],"t".$i)->select();
    					
    	
    				//部件得分  = 病害构件得分的平均值 -(100 - 最小病害构件得分)/t
    				$cont=count($data);$sum=0;$cn=0;$min=null;
    				for($j=0;$j<$cont;$j++){
    					if($data[$j]['score']!=null){
    						if($min==null){
    							$min=$data[$j]['score'];
    						}
    						$sum+=$data[$j]['score'];
    						$cn++;// 构件有分的个数
    					}
    				}
    				if($cn==0){
    					//部件没有病害
    					$score=100;
    				}else{
    					if($t==0){
    						$score=(($datab[0]["t".$i]-$cn)*100+$sum)/$datab[0]["t".$i];   //  t无穷大
    					}else{
    							
    						$score=(($datab[0]["t".$i]-$cn)*100+$sum)/$datab[0]["t".$i]-(100-$min)/$t;
    					}
    					// 主要部件   构件分存在小于  60  的      部件得分取构件最小值
    					if($min<60&&($i==2||$i==6||$i==12||$i==14||$i==16)){
    						$score=$min;
    					}
    				}
    			}else{
    				// 部件不存在   部件得分 0
    				$score=0;
    			}
    			//  保存所有计算后的部件得分
    			$bujiangrade["t".$i]=sprintf("%.2f", $score);
    		}
    		 
    		/**
    		 *   将计算过了的部件得分存入数据库
    		 */
    		$bujiangrade['bid']=$_SESSION['bid'];
    		$pingfen=M('pingfen');
    		$data=null;
    		$data=$pingfen->where('bid=%d',$_SESSION['bid'])->select();
    		if(empty($data)){
    			$pingfen->add($bujiangrade);
    		}else{
    			$pingfen->save($bujiangrade);
    		}
    		/**
    		 * 计算结构得分
    		 */
    		$bujiangrade['j1']=$bujiangrade['j2']=$bujiangrade['j3']=0;
    		for($i=2,$j=1;$i<33;$i+=2,$j+=2){
    			if($i<8){
    				// 上部结构
    				$bujiangrade['j1']+=($bujiangrade["t".$i]*$datab[0]["t".$j]);
    			}else if($i<22){
    				// 下部结构
    				$bujiangrade['j2']+=($bujiangrade["t".$i]*$datab[0]["t".$j]);
    			}else{
    				// 桥面系
    				$bujiangrade['j3']+=($bujiangrade["t".$i]*$datab[0]["t".$j]);
    			}
    		}
    		for($i=1;$i<4;$i++){
    			if($bujiangrade["j".$i]>100){
    				$bujiangrade["j".$i]=100;
    			}
    		}
    		//计算桥得分
    		$bujiangrade['q']=$bujiangrade['j1']*0.4+$bujiangrade['j2']*0.4+$bujiangrade['j3']*0.2;
    		// 计算结构等级
    		for($i=1;$i<4;$i++){
    			if($bujiangrade["j".$i]>=95&&$bujiangrade["j".$i]<=100){
    				$bujiangrade["jd".$i]=1;
    			}else if($bujiangrade["j".$i]>=80&&$bujiangrade["j".$i]<95){
    				$bujiangrade["jd".$i]=2;
    			}else if($bujiangrade["j".$i]>=60&&$bujiangrade["j".$i]<80){
    				$bujiangrade["jd".$i]=3;
    			}else if($bujiangrade["j".$i]>=40&&$bujiangrade["j".$i]<60){
    				$bujiangrade["jd".$i]=4;
    			}else if($bujiangrade["j".$i]>=0&&$bujiangrade["j".$i]<40){
    				$bujiangrade["jd".$i]=5;
    			}
    		}
    		//  计算桥等级
    		if($bujiangrade["q"]>=95&&$bujiangrade["q"]<=100){
    			$bujiangrade["qd"]=1;
    		}else if($bujiangrade["q"]>=80&&$bujiangrade["q"]<95){
    			$bujiangrade["qd"]=2;
    		}else if($bujiangrade["q"]>=60&&$bujiangrade["q"]<80){
    			$bujiangrade["qd"]=3;
    		}else if($bujiangrade["q"]>=40&&$bujiangrade["q"]<60){
    			$bujiangrade["qd"]=4;
    		}else if($bujiangrade["q"]>=0&&$bujiangrade["q"]<40){
    			$bujiangrade["qd"]=5;
    		}
    		// 保留两位小数
    		$bujiangrade["q"]=sprintf("%.2f", $bujiangrade["q"]);
    		$bujiangrade['j1']=sprintf("%.2f", $bujiangrade['j1']);
    		$bujiangrade['j2']=sprintf("%.2f", $bujiangrade['j2']);
    		$bujiangrade['j3']=sprintf("%.2f", $bujiangrade['j3']);
    		// 保存到数据库中
    		$pingfen->save($bujiangrade);
    	}    		  			    			    		    	
    }
    public function pingding(){ 
    	if(empty($_SESSION['bid'])){
    		$this->error('非法操作'); exit();
    	}else{   		
			$this->bridgegrade();
			$pingfen=M('pingfen');
			$bridge=M('bridge');
			$datap=$pingfen->where("bid=%d",$_SESSION['bid'])->select();								
			$url="__PUBLIC__/img/".md5($_SESSION['username'].$_SESSION['bid'])."/qrcode.jpg";
			if(!is_file($url)){
				//二维码不存在时生成
				$this->qrcode(); // 生成二维码
			}
			$data['score']=$datap[0]['q'];
			$data['level']=$datap[0]['qd'];			
			$data['qrcode']="img/".md5($_SESSION['username'].$_SESSION['bid'])."/qrcode.jpg";
			$bridge->where("bid=%d",$_SESSION['bid'])->save($data);
			$this->data=$data;
    		$this->display(pingding);
    	}	
    }
    public function qrcode(){
    	if(empty($_SESSION['bid'])){
    		$this->error('非法操作'); exit();
    	}else{
	    	vendor('phpqrcode.phpqrcode');
	    	$value = 'http://loveme1234567.oicp.net/Qiao/Home/Api/index/flag/'.md5($_SESSION['username'].$_SESSION['bid']).'.html'; //二维码内容
	    	$errorCorrectionLevel = 'L';   //容错级别
	    	$matrixPointSize = 8;         //生成图片大小片       	
	    	$url="C:/wamp/www/Qiao/Application/Home/View/Public";    	    	
	    	$qrcode=$url."/img/".md5($_SESSION['username'].$_SESSION['bid'])."/qrcode.jpg";
	    	\QRcode::png($value, $qrcode, $errorCorrectionLevel, $matrixPointSize, 2);  	
    	}
    }
}