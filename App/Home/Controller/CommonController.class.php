<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function __construct(){
		parent::__construct();
		$hynumber=session('hynumber');
		// print_r($hynumber);die;
		if(empty($hynumber)){
			$this->error('请先登录',U('Login/login'));
		}
	}
}
?>