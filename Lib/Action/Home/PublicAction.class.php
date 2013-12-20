<?php
class PublicAction extends Action{

	public function _empty() {
		$this->redirect('Index/index');
	}
	
	
	public function register() {
		$this->display();
	}
	
	/**
	 *用户注册处理 
	 */
	public  function reg(){
		
		$member_M = D('Member');
		
		if ($member_M->create()){
			//添加用户
			$status=$member_M->add();
			if ($status!==false){
				$this->success('注册成功！管理员会尽快为您审核！' , __GROUP__.'/Index/index');
			}else {
				$this->error('注册失败！');
			}
		}else {
			$this->error($member_M->getError());		
		}
	}
	
	/*
	 *用户个人中心登录 验证
	 */
	public function login(){
		
		if (IS_POST){//处理登录信息
		   if(empty($_POST['account'])) {
				$this->error('帐号错误！');
			}elseif (empty($_POST['password'])){
				$this->error('密码必须！');
			}
			$member_M = D('Member');
			$map = array();
			$map['account'] = $_POST['account'];
			$map['status']=array('eq',1);
			$member_info = $member_M -> where($map)->find();
			
			if(false === $member_info) {
		  	  $this->error('帐号不存在或未通过审核！');
			}else {
				if($member_info['password'] != md5($_POST['password'])) {
					$this->error('密码错误！');
				}
			session_start();
		   	$_SESSION['account']	=	$member_info['account'];		  
			$_SESSION['loginUserName']		=	$member_info['nickname'];
			$_SESSION['lastLoginTime']		=	$member_info['last_login_time'];
			$_SESSION['login_count']	=	$member_info['login_count'];
			//保存登录信息到数据库
			$ip		=	get_client_ip();
			$time	=	time();
			$data = array();
			$data['id']	=	$member_info['id'];
			$data['last_login_time']	=	$time;
			$data['login_count']	=	array('exp','login_count+1');
			$data['last_login_ip']	=	$ip;
			$member_M->save($data);

			// 跳转到个人中心
			$this->success('登录成功！',__GROUP__.'/Member/index');

			}
		}
		$this->display();
	}

}