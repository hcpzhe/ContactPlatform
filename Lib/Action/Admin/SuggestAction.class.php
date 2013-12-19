<?php
//建议
class SuggestAction extends CommonAction {
    /**
     * 建议列表
     * 根据传递参数, 进行筛选
     */
	public function index() {
    	
		$this->display();
    }
    
    /**
     * 建议内容查看
     * 必须有传递主键ID
     * 如果建议已经被回复过, 则显示所有的回复内容
     */
    public function read() {
    	
    }
    
    /**
     * 建议删除接口
     * 修改status即可
     */
    public function delete() {
    	
    }
    
    /**
     * 回复提交接口
     */
    public function replySave() {
    	
    }
    
    /**
     * 回复删除接口
     * 修改status即可
     */
    public function replyDel() {
    	
    }
}