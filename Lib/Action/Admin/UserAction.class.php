<?php
//管理员
class UserAction extends CommonAction {
	public function _before_add() {
		$role_A = A('Admin/Role');
		$list = $role_A->_getRoleList();
		$this->assign("role_list", $list);
	}
	public function _before_read() {
		$role_A = A('Admin/Role');
		$list = $role_A->_getRoleList();
		$this->assign("role_list", $list);
		
        $model = M('RoleUser');
        $id = $_REQUEST ['id'];
        $user_role = $model->where('`user_id`='.$id)->getField('role_id',true);
		$this->assign("user_role", $user_role);
	}
	
    public  function  _filter(&$map){
   		if (!empty($_POST['txtsearch'])){
    		$map['account'] = array('like',"%".$_POST['txtsearch']."%");
    	}
    	$map['status']=array('gt',0);
    	$map['account']=array('not in',C('ADMIN_AUTHS'));
    }
    
    /**
     * 新增页面
     */
    public function add() {
    	$this->display();
    }
 	//显示界面新增处理
  	protected  function userIndex($user_M){
   		//用户Id列表
  		$user_id_list = $user_M->getField('id',TRUE);
   		//用户权限信息
  		$role_user_list  = M("RoleUser")->where(array('user_id'=>array('in',$user_id_list)))->select();
   		//角色信息
  		$role_list = M('Role')->getField("id,name",true);
  		
  		$user_role_list = array();
		//组合数据
   		foreach ($role_user_list as $val){
   			$user_role_list[$val['user_id']][$val['role_id']]=$role_list[$val['role_id']];
   		}
   		$this->assign('user_role_list',$user_role_list);
    }
    /**
     * 新增接口
     */
    public function insert() {
        $user_M = D('User');
        if (false === $user_M->create()) {
            $this->error($user_M->getError());
        }
        //开启事务
        $user_M->startTrans();
        
        //保存当前数据对象
        $list = $user_M->add();
        if ($list !== false) { //保存成功
        	//增加管理权限
        	if (!empty($_POST[roles])){
        		$role_user_M = M('RoleUser');
        		foreach ($_POST['roles'] as $role){
        			$data['role_id']=$role;
        			$data['user_id']=$list;
        			$flag = $role_user_M->data($data)->add();
        			if ($flag === false){
        				$user_M->rollback();
        				$this->error('新增管理员失败!');
        				return ;
        			}
        		}
        	}
        	$user_M->commit();
            $this->success('新增管理员成功!',__GROUP__.'User/index');
        } else {
            //失败提示
            $this->error('新增管理员失败!');
        }
    }
    
    /**
     * 编辑查看页面
     */
//    public function read() {
//    	$this->display();
//    }
    
    /**
     * 更新修改接口
     * 必须传递主键ID
     * 更改用户权限
     */
    public function update() {
        $user_M = D('User');
        if (false === $user_M->create()) {
            $this->error($user_M->getError());
        }
        //开启事务
        $user_M->startTrans();
        //保存当前数据对象
        if ($user_M->save() !== false) { //保存成功
        	//增加管理权限
        	if (!empty($_POST['roles'])){
        		$role_user_M = D('RoleUser');
    			$data['user_id'] = (int)$_REQUEST['id'] ;
    			$role_user_M->where("user_id=%d",$data['user_id'])->delete();
        		foreach ($_POST['roles'] as $role){
        			$data['role_id'] = $role ;
        			$flag = $role_user_M->data($data)->add();
        			if ($flag === false){
        				$user_M->rollback();
        				$this->error('权限修改失败!');
        			}
        		}
        	}
        	$user_M->commit();
            $this->success('管理员更新成功!',cookie('_currentUrl_'));
        } else {
            //失败提示
            $this->error('管理员更新失败!');
        }
    	
    }
    /*
     * 重置密码操作
     * 接收主键值
     */
	public function resetPwd(){
		$user_M = M('User');
		if (!empty($user_M)){
			$id = $_REQUEST ['id'];
			if (isset($id)) {
				$condition = array('id' => array('eq', $id));
				$list = $user_M->where($condition)->setField('password',pwdHash('123456'));
				if ($list !== false) {
					$this->success('密码已重置为:123456',__URL__.'/index');
				} else {
					$this->error('密码重置失败，请重试！');
				}
			} else {
				$this->error('非法操作');
			}
		}
	}

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}