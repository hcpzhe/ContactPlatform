<?php
//建议
class SuggestAction extends CommonAction {
    /**
     * 列表
     * 根据传递参数, 进行筛选
     */
	public function index() {
    	
		$this->display();
    }
    
    /**
     * 编辑查看
     * 必须传递主键ID
     * 如果建议已经被回复过, 则显示所有的回复内容
     */
    public function read() {
    	
    }
    
}