<?php
return array(
    'URL_MODEL'                 =>  2, // 1:PATHINFO  2:rewrite 如果你的环境不支持PATHINFO 请设置为3
    'APP_GROUP_LIST'            =>  'Home,Admin',
    'DEFAULT_GROUP'             =>  'Home',
//    'SHOW_PAGE_TRACE'           =>  1,//显示调试信息
    
    'DB_TYPE'                   =>  'mysql',
//    'DB_HOST'                   =>  '192.168.1.9',
//    'DB_NAME'                   =>  'ctplatform',
//    'DB_USER'                   =>  'ctpf',
//    'DB_PWD'                    =>  'ctpf',
    'DB_HOST'                   =>  '118.192.42.26',
    'DB_NAME'                   =>  'platform',
    'DB_USER'                   =>  'platform',
    'DB_PWD'                    =>  'cDZkBTNjJTM2ETN',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'pf_',
/* RBAC 在每个单独分组中设置
	'USER_AUTH_ON'				=>	true,		// 开启登录验证
	'USER_AUTH_TYPE'			=>	1,			// 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY'				=>	'authId',	// 用户认证SESSION标记
	'USER_PW_PREFIX'			=>	'pgj6hd', 	//用户密码前缀
	'NOT_AUTH_MODULE'			=>	'Public',	// 默认无需认证模块
	'USER_AUTH_GATEWAY'			=>	'/Public/login',	// 默认认证网关
	'GUEST_AUTH_ON'				=>	false,	    // 是否开启游客授权访问
    
//	'TOKEN_ON'					=>	TRUE,
//	'TOKEN_NAME'				=>	'__hash__',

*/
//	'TMPL_ACTION_ERROR'			=>	TMPL_PATH.'dispatch_jump.tpl', // 错误跳转对应的模板文件
//	'TMPL_ACTION_SUCCESS'		=>	TMPL_PATH.'dispatch_jump.tpl', // 成功跳转对应的模板文件
	'SMTP_SERVER' =>'smtp.qq.com',					//邮件服务器
	'SMTP_PORT' =>25,								//邮件服务器端口
	'SMTP_USER_EMAIL' =>'lbbniu@qq.com', 			//SMTP服务器的用户邮箱(一般发件人也得用这个邮箱)
	'SMTP_USER'=>'lbbniu@qq.com',					//SMTP服务器账户名
	'SMTP_PWD'=>'LBBNIU',							//SMTP服务器账户密码
	'SMTP_MAIL_TYPE'=>'HTML',						//发送邮件类型:HTML,TXT(注意都是大写)
	'SMTP_TIME_OUT'=>30,							//超时时间
	'SMTP_AUTH'=>true,								//邮箱验证(一般都要开启)
);
