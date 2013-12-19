<?php
//新闻评论
//若为匿名评论, 则所属用户ID member_id 为0
class NewsCommentAction extends CommonAction {
    /**
     * 新增接口
     * 必须传递所属新闻ID
     */
    public function insert() {
    	
    }
    
    /**
     * 审核接口
     * 必须传递主键ID , 可批量
     */
    public function verify() {
    	
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