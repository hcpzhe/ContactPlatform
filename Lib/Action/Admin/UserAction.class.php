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