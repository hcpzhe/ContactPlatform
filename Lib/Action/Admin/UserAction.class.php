<?php
//管理员
class UserAction extends CommonAction {
    /**
     * 列表
     * 根据传递参数, 进行列表筛选
     * 要分页, 排序
     */
	public function index() {
    	
		$this->display();
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
    public function insert() {
    	
    }
    
    /**
     * 编辑查看页面
     */
    public function read() {
    	$this->display();
    }
    
    /**
     * 更新修改接口
     * 必须传递主键ID
     */
    public function update() {
    	
    }
    
}