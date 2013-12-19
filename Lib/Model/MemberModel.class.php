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
        );

    public $_auto		=	array(
        array('password','pwdHash',self::MODEL_BOTH,'callback'),
        array('create_time','time',self::MODEL_INSERT,'function'),
        array('update_time','time',self::MODEL_BOTH,'function'),
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
    
//    /**
//     * 是否存在此用户
//     */
//    function isExist($id) {
//    	if ($this->where('`id`='.$id)->count() > 0) return $id;
//    	return FALSE;
//    }

}
