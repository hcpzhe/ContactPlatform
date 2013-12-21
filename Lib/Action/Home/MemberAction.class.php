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
    public function upload() {
        if (!empty($_FILES)) {
            //如果有文件上传 上传附件
            $this->_upload();
        }
    }

    // 文件上传
    protected function _upload() {
        import('ORG.Util.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize            = 3292200;
        //设置上传文件类型
        $upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
        //设置附件上传目录
        $upload->savePath           = './Uploads/';
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
        //删除原图
        $upload->thumbRemoveOrigin  = true;
        if (!$upload->upload()) {
            //捕获上传异常
            $this->error($upload->getErrorMsg());
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            $_POST['photo'] = $uploadList[0]['savename'];
        }
        $member_M  = D('Member');
        //保存当前数据对象
        $data['photo']          = $_POST['photo'];
        $data['id']    = $member_M->getMemberId();
        $list   = $member_M->where("id={$data['id']}")->setField('photo',$data['photo']);
        if ($list !== false) {
            $this->success('上传头像成功！');
        } else {
            $this->error('上传头像失败!');
        }
    }
    
   
   
}