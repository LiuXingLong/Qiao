<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){    	
    	session('bid',null);
    	session('bujian',null);    	
    	session('gid',null);
    	$Bridge=M('bridge');
    	$where['user']=$_SESSION['username'];
    	$count=$Bridge->where($where)->count();
    	$page=new \Think\Page($count,10);
    	$limit=$page->firstRow.','.$page->listRows;
    	$result=$Bridge->where($where)->order('bid asc')->limit($limit)->select(); //  order('gid asc')升序         order('gid desc')降序
    	$this->bridge=$result;
    	$page->setConfig('prev','上一页');
    	$page->setConfig('next','下一页');    	
    	$this->page=$page->show();
    	$this->display();
    }
    public function add(){
    	if(IS_POST){
    		$post=I('post.');
    		$bridge=M('bridge');
    		$post['name']=trim($post['name']);
    		$post['place']=trim($post['place']);
    		$post['user']=$_SESSION['username'];	
    		$result=$bridge->query("select *from bridge where user='%s' and name='%s'",$post['user'],$post['name']);
    		if($result[0]['bid']!=null){
    			echo "Cz";
    		}else{
    			$bridge->field('user,name,place')->create($post);
    			$bridge->add();    
    			$result2=$bridge->where("user='%s' and name='%s'",$post['user'],$post['name'])->select();
    			if($result2[0]['bid']==null){
    				echo "Error";exit();
    			}
    			$data['api']=md5($result2[0]['user'].$result2[0]['bid']);  
    			
    			//创建桥图片资源文件夹    类库创建文件夹
    			$url="C:/wamp/www/Qiao/Application/Home/View/Public/img/".$data['api'];    			
    			import("Org.File.File");
    			\File::mk_dir($url);
    			
    			$bridge->where("bid=%d",$result2[0]['bid'])->save($data);
    		}    		
    	}else{
    		$this->error('非法操作');
    	}
    }
    Public function remove(){
    	if(IS_POST){
    		/**
    		 *  这里需要注意的是，删除桥后      修要删除桥的所有信息  包括图片信息        包括  桥的部件  构件  构件病害   构件图    都要删除
    		 */
    		$post=I('post.');
    		$bridge=M('bridge');
    		$bridge->where("bid=%d",$post['bid'])->delete();
    		$result=$bridge->where("bid=%d",$post['bid'])->select();
    		if($result[0]['bid']!=null){
    			echo "Error"; exit();
    		}    		
    		$info1=M('info1');
    		$info1->where("bid=%d",$post['bid'])->delete();
    		
    		$info2=M('info2');
    		$info2->where("bid=%d",$post['bid'])->delete();
    		
    		$goujian=M('goujian');
    		$goujian->where("bid=%d",$post['bid'])->delete();
    		
    		$binghai=M('binghai');
    		$binghai->where("bid=%d",$post['bid'])->delete();
    		
    		$weixiu=M('weixiu');
    		$weixiu->where("bid=%d",$post['bid'])->delete();
    		
    		$pingfen=M('pingfen');
    		$pingfen->where("bid=%d",$post['bid'])->delete();
    		
    		$jilu=M('jilu');
    		$jilu->where("bid=%d",$post['bid'])->delete();
    		
    		$jilu2=M('jilu2');
    		$jilu2->where("bid=%d",$post['bid'])->delete();	

    		//删除桥文件夹  以及 里面所有的文件       使用文件类库删除目录
    		$url="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$post['bid']);
    		import("Org.File.File");
    		\File::del_dir($url);
    		
//          函数删除文件目录
//     		$url="C:/wamp/www/Qiao/Application/Home/View/Public/img/".md5($_SESSION['username'].$post['bid']);
//     		$this->delDirAndFile($url,true);    		
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
}