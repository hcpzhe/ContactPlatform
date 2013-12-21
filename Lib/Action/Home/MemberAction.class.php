<?php
class MemberAction extends CommonAction{
	//用户中心首页
	public function index(){
		//导航条信息
		$this->getNav();
		//获取用户信息
		$member_M = M('Member');
		$member = $member_M->where("id={$_SESSION[C('USER_AUTH_KEY')]}")->find();
		$this->assign('member',$member);
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
        $member    =   M("Member");
        if(!$member->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        }else {
            $member->password	=	pwdHash($_POST['password']);
            $member->save();
            $this->success('密码修改成功！');
         }
    }
   
   
}