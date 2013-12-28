<?php
//建议回复
class SugreplyAction extends CommonAction {
    
    /**
     * 回复提交接口
     */
    public function save() {
    	$sugreply_M = D('Sugreply');
    	if (false === $sugreply_M->create()){
    		//自动验证不通过
    		$this->error($sugreply_M->getError());
    	}else{
    		$list = $sugreply_M->add();
    		if (false !== $list){
   				$sug_id = $sugreply_M->where("id=".$list)->getField("sug_id");
				$suggest_M = M('Suggest');
				$info = $suggest_M->where("id=".$sug_id)->find();
				
				if ($info['status']==2){//更新建议审核状态
					$info['user_id']=$_SESSION[C('USER_AUTH_KEY')];
					$info['status']=1;
					$suggest_M->save($info);
				}
				//发送回复邮件
				$this->sendMail($info,$list);
				$this->success('回复成功',cookie('_currentUrl_'));    		
    		}else{
    			$this->error('回复失败');
    		}
    	}
    }
	protected function sendMail($suggest_info,$sugreply_id){
	   import('@.ORG.Net.Email');//导入本类
	   //获取用户信息
	   $member_M = M('Member');
	   $member = $member_M->where('id=%d',$suggest_info['member_id'])->find();
	   //获取回复信息
	   $sugreply_M = M('Sugreply');
	   $sugreply_info = $sugreply_M->where('id=%d',$sugreply_id)->find();
	   //获取管理员用户名
	   $user_M = M('User');
	   $user_nickname = $user_M->where('id=%d',$sugreply_info['user_id'])->getField('nickname');
	 
	   $data['mailto'] 	= 	$member['email']; //收件人
	   
	   $data['subject'] =	'洛阳市老城区人民检察院建议回复提醒';    //邮件标题
	   //生成邮件内容
	   $data['body'] 	=	'<font face="楷体_gb18030" size="4"><span style="line-height: 48px; ">洛阳市老城区人民检察院欢迎你!</span></font><div><font face="楷体_gb18030" size="4"><span style="line-height: 48px;">你提交的建议标题为：<font color="#0000ff">';
	   $data['body'].=$suggest_info['title'];//建议标题
	   $data['body'].='</font></span></font></div><div><font face="楷体_gb18030" size="4"><span style="line-height: 48px;">内容为：<font color="#ff0000">';
	   $data['body'].=$suggest_info['content'];//建议内容
	   $data['body'].='</font></span></font></div><div><font size="4"><br></font></div><div><font face="楷体_gb18030" size="4"><span style="line-height: 48px;">已被管理员：<font color="#00ff00">';
	   $data['body'].=$user_nickname;//管理员用户别名
	   $data['body'].='</font> 回复</span></font></div><div><font face="楷体_gb18030" size="4"><span style="line-height: 48px; ">回复内容为：<font color="#993366"><b>';
	   $data['body'].=$sugreply_info['reply_content'];//回复内容
	   $data['body'].='</b></font></span></font></div><div><font face="楷体_gb18030" size="2"><span style="line-height: 48px;"><br></span></font></div><div><font face="楷体_gb18030" size="4"><span style="line-height: 48px; ">更多回复信息请登录用户中心进行查看</span></font></div><div><font face="楷体_gb18030" size="4"><a href="';//回复内容
	   $url='http://'.$_SERVER['SERVER_NAME'].__APP__.'/Public/login';
	   $data['body'].=$url;//用户中心登录地址
	   $data['body'].='"><span style="line-height: 48px; ">点击这里进行登录</span></a></font></div><div><font face="楷体_gb18030" size="6"><span style="line-height: 48px;"><br></span></font></div>';
	   $mail = new Email();
	   $mail->send($data);
	}
    
}