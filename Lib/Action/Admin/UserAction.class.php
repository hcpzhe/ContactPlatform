<?php
//管理员
class UserAction extends CommonAction {
	// TODO 新增管理员时, 增加角色关系
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
	
    public  function  _filter(){
   		if (!empty($_POST['txtsearch'])){
    		$map['account'] = array('like',"%".$_POST['txtsearch']."%");
    	}
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
  		
  		$return = array();
		//组合数据
   		foreach ($role_user_list as $val){
   			$return[$val['user_id']][$val['role_id']]=$role_list[$val['role_id']];
   		}
   		$this->assign('return',$return);
    }
    /**
     * 新增接口
     */
//    public function insert() {
//    	
//    }
    
    /**
     * 编辑查看页面
     */
//    public function read() {
//    	$this->display();
//    }
    
    /**
     * 更新修改接口
     * 必须传递主键ID
     */
//    public function update() {
//    	
//    }
//    
}