<?php
//新闻分类
class NewsCategoryAction extends CommonAction {
    /**
     * 分类列表
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
     * 编辑查看
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