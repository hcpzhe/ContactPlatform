<?php
/*
 * 管理员用户模型
 */
class UserModel extends CommonModel{
	protected $_validate = array(
		array('account','require','账号名称必须'),
		array('account','/^[a-zA-Z]\w{3,15}$/i','帐号格式错误'),//字母开头 4-16位  \w等价于[A-Za-z0-9_]
		array('account','','帐号已经存在',self::EXISTS_VALIDATE,'unique'),
		array('password','require','密码不能为空'),
		array('nickname','require','姓名不能为空'),
		array('email','email','邮件格式不正确'),
	);
	protected $_auto = array(
		array('last_login_time','time',''),
		array('last_login_ip','get_client_ip',Model:: MODEL_BOTH,'function'),
		array('login_count','0',Model:: MODEL_INSERT),
		array('create_time','time',Model:: MODEL_INSERT,'function'),
		array('update_time','time',Model:: MODEL_BOTH,'function'),
		array('status','1',Model:: MODEL_INSERT),
	
	);


}