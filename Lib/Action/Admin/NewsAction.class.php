<?php
//新闻
class NewsAction extends CommonAction {
    /**
     * 新闻列表
     * 根据传递参数, 进行列表筛选
     * 要分页, 排序
     */
	public function index() {
    	
		$this->display();
    }
    
    /**
     * 新增新闻页面
     */
    public function add() {
    	$this->display();
    }
    
    /**
     * 新增新闻接口
     */
    public function insert() {
    	
    }
    
    /**
     * 新闻查看
     * 编辑页面
     */
    public function read() {
    	
    }
    
    /**
     * 更新修改接口
     * 必须传递新闻主键ID
     */
    public function update() {
    	
    }
    
    /**
     * 删除接口
     * 修改status即可
     */
    public function delete() {
    	
    }
    
}