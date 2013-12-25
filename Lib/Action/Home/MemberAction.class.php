<?php
class MemberAction extends CommonAction{
	
	public function _ass_memberInfo() {
		$member_M = D('Member');
		$member = $member_M->getMemberInfo();
		$this->assign('member',$member);
	}
	
	//用户中心首页
	public function index(){
		//导航条信息
		$this->getNav();
		
		//获取用户信息
		$this->_ass_memberInfo();
		
		//获取新闻顶级栏目
		$newscat_M = M('NewsCategory');
		$newscat_list = $newscat_M->where('parent_id=0 AND status>0')->order('rank desc')->select();
		$this->assign('newscat_list',$newscat_list);
		
		$this->display();
	}
	
	public function info() {
		//获取用户信息
		$this->_ass_memberInfo();
		$this->display();
	}
	
	function edit() {
		$this->_ass_memberInfo();
        $this->display();
	}
	
	// 更换密码
	public function changePwd() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->error('没有登录',__GROUP__.'Public/login');
		}
		//对表单提交处理进行处理或者增加非表单数据
		$map	=	array();
		$map['password']= pwdHash($_POST['oldpassword']);
		if(isset($_POST['account'])) {
			$map['account']	 =	 $_POST['account'];
		}elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
			$map['id']		=	$_SESSION[C('USER_AUTH_KEY')];
		}
		//检查用户
		$member	=   M("Member");
		if(!$member->where($map)->field('id')->find()) {
			$this->error('旧密码不符或者用户名错误！');
		}else {
			$member->password	=	pwdHash($_POST['password']);
			$member->save();
			$this->success('密码修改成功！');
		 }
	}
	/**
	 * 更新修改接口
	 * 必须传递主键ID
	 */
	public function update() {
		$member_M = D('Member');
		if (false === $member_M->create()) {
			$this->error($member_M->getError());
		}
		// 更新数据
		$list = $member_M->save();
		if (false !== $list) {
			//成功提示
			if (!empty($_FILES['photo']['name'])){
				$fileinfo = $this->_uploadone($_FILES['photo'] , $this->getActionName().'/'.$member_M->id.'/'); //传递头像图片
				//头像URL地址
				$photo_url =$fileinfo['savepath'].$fileinfo['savename'];
				$member_M->where("id={$member_M->id}")->setField('photo',$photo_url);
			}
			$this->success('编辑成功!',cookie('_currentUrl_'));
		} else {
			//错误提示
			$this->error('编辑失败!');
		}
	}
   
}