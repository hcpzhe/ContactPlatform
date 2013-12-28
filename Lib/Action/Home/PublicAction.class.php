<?php
class PublicAction extends Action{

    function _initialize() {
		$set_M = D('Setting');
		$list = $set_M->getField('set_name,set_value');
		$this->assign('_PF',$list);
    }
    
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
			//成功提示
				if (!empty($_FILES['photo']['name'])){
				$fileinfo = $this->_uploadone($_FILES['photo'] , $member_M->getModelName().'/'.$status.'/'); //传递头像图片
				//头像URL地址
				$photo_url =substr($fileinfo['savepath'].$fileinfo['savename'],1);
				$member_M->where("id=%d",$status)->setField('photo',$photo_url);
				}
				//发送邮箱激活邮箱
				$member = $member_M->getById($status);
				$this->sendMail($member);
				$this->success('注册成功！管理员会尽快为您审核！你可以先登录注册填写的邮箱进行邮箱验证！' , __GROUP__.'/Index/index');
			}else {
				$this->error('注册失败！');
			}
		}else {
			$this->error($member_M->getError());		
		}
	}
    protected function _uploadone($file , $path) {
		import('@.ORG.Net.UploadFile');
		//导入上传类
		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize			= 3292200;
		//设置上传文件类型
		$upload->allowExts		  = explode(',', 'jpg,gif,png,jpeg');
		//设置附件上传目录
		$upload->savePath		   = APP_PATH.'Public/Uploads/'.$path;
		//设置上传文件规则
		$upload->saveRule		   = 'uniqid';
		//删除原图
		$upload->thumbRemoveOrigin  = true;
		if (!file_exists($upload->savePath)){
			mkdir($upload->savePath,'0644',true);
		}
		$fileinfo = $upload->uploadOne($file);
		if ($fileinfo === false) {
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		} else {
			return $fileinfo[0];
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
			$map = array();
			$map['account'] = $_POST['account'];
			$map['status']=array('gt',0);
			 import ( 'ORG.Util.RBAC' );
	        $member_info = RBAC::authenticate($map);
	        //使用用户名、密码和状态的方式进行认证
	        if(false === $member_info) {
	            $this->error('帐号不存！');
	        }elseif ($member_info['status'] == '2'){
	            $this->error('帐号未通过审核！');
	        }elseif ($member_info['status'] < 0){
	            $this->error('帐号已被删除！');
	        }else {
	            if($member_info['password'] != pwdHash($_POST['password'])) {
	                $this->error('密码错误！');
	            }
	            $_SESSION[C('USER_AUTH_KEY')] = $member_info['id'];
	           	$_SESSION['account']	=	$member_info['account'];          
	            $_SESSION['loginUserName']		=	$member_info['nickname'];
	            $_SESSION['lastLoginTime']		=	$member_info['last_login_time'];
	            $_SESSION['login_count']	=	$member_info['login_count'];
	            //保存登录信息到数据库
	            $member_M = M('Member');
	            $ip		=	get_client_ip();
	            $time	=	time();
	            $data = array();
	            $data['id']	=	$member_info['id'];
	            $data['last_login_time']	=	$time;
	            $data['login_count']	=	array('exp','login_count+1');
	            $data['last_login_ip']	=	$ip;
	            $member_M->save($data);
	
	            // 缓存访问权限
	            RBAC::saveAccessList();
	
	            // 跳转到个人中心
	            $this->success('登录成功！',__GROUP__.'/Member/index');
			}
		}
		$this->display();
	}

	/**
	 * 注销接口
	 */
	function logout() {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！', __GROUP__.'/Index/');
        }else {
            $this->error('已经登出！', __GROUP__.'/Index/');
        }
	}
	/*
	 * 发送email
	 * 接受注册用户的信息
	 */
	protected function sendMail($member){
	   import('@.ORG.Net.Email');//导入本类
	   $data['mailto'] 	= 	$member['email']; //收件人
	   $data['subject'] =	'洛阳市老城区人民检察院账户邮箱验证';    //邮件标题
	   //生成邮件内容
	   $data['body'] 	=	'<font face="楷体_gb18030" size="6"><span style="line-height: 48px; ">洛阳市老城区人民检察院欢迎你!</span></font><div><font face="楷体_gb18030" size="6"><span style="line-height: 48px;">请点击下面链接，进行账户邮箱验证</span></font></div><div><font face="楷体_gb18030" size="6" color="#0000ff"><a href="';
	   $url='http://'.$_SERVER['SERVER_NAME'].__APP__.'/Public/yzEmail/id/'.$member['id'].'/account/'.$member['account'].'/code/'.$member['security_code'];
	   $data['body'].=$url;
	   $data['body'].='" target="_blank"><span style="line-height: 48px;">点这里邮件验证</span></a></font></div><div>如果未跳转请复制下面地址到浏览器地址栏进行邮箱验证</div><div>'.$url.'</div>';
	   $mail = new Email();
	   $mail->send($data);
	}
	/*
	 * 验证邮箱
	 * 接受用户id 用户账号 邮箱验证值
	 * 
	 */
	public  function yzEmail(){
		$member = array();
		$member['id'] = $_REQUEST['id'];
		$member['account'] = $_REQUEST['account'];
		$member['security_code'] = $_REQUEST['code'];
		$member_M = M('Member');
		//查询用户信息
		$member_info = $member_M->where($member)->find();
		
		$flag = $member_M->where($member)->setField('security_code','');
		if ($flag){
			$this->success('邮箱已激活，今后建议回复，会发送到验证的邮箱',__GROUP__.'/Index/index');
		}else {
			$this->error('邮箱验证失败，你的验证地址可能有误！',__GROUP__.'/Index/index');
		}
	}
}