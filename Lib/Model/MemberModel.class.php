<?php
// 用户模型
class MemberModel extends CommonModel {
    public $_validate	=	array(
        array('account','/^[a-zA-Z]\w{3,15}$/i','帐号格式错误'),//字母开头 4-16位  \w等价于[A-Za-z0-9_]
        array('password','require','密码必须'),
        array('nickname','require','昵称必须'),
        array('repassword','require','确认密码必须'),
        array('repassword','password','确认密码不一致',self::EXISTS_VALIDATE,'confirm'),
        array('account','','帐号已经存在',self::EXISTS_VALIDATE,'unique'),
        array('email','email','邮箱格式不正确'),
        array('paper_number','require','委员证号必填'),
        array('company','require','工作单位必填'),
        array('mobile','require','手机号必填'),
        array('mobile','/^1\d{10}$/','手机号格式不正确'),

        );

    public $_auto		=	array(
        array('password','pwdHash',self::MODEL_BOTH,'callback'),
        array('last_login_time','time',self::MODEL_BOTH,'function'),
        array('last_login_ip','get_client_ip',self::MODEL_BOTH,'function'),
        array('login_count','login_count',self::MODEL_UPDATE,'callback'),
        array('create_time','time',self::MODEL_INSERT,'function'),
        array('update_time','time',self::MODEL_BOTH,'function'),
        array('status','2',self::MODEL_INSERT),
        );

	/**
	 * 密码加密
	 */
    protected function pwdHash() {
        if(isset($_POST['password'])) {
        	return pwdHash($_POST['password']);
        }else{
            return false;
        }
    }
    
    /***登录次数是在用户登录成功后更改, 不是执行update时更改, 这里写错了!!!!!!****************************************************/
    /**
     * 计算登录次数
     *
     */
    protected function login_count(){
    	
    	$count=$this->where("account='".$this->account."'")->field('login_count')->find();
        
    	return $count['login_count']+1;
    }
    
//    /**
//     * 是否存在此用户
//     */
//    function isExist($id) {
//    	if ($this->where('`id`='.$id)->count() > 0) return $id;
//    	return FALSE;
//    }

}
