<?php
//新闻评论
//若为匿名评论, 则所属用户ID member_id 为0
class NewsCommentAction extends CommonAction {
    /**
     * 新增接口
     * 必须传递所属新闻ID
     */
    public function insert() {
        $news_comment_M = D('News_comment');
        if (false === $news_comment_M->create()) {
            $this->error($news_comment_M->getError());
        }
        //保存当前数据对象
        $list = $news_comment_M->add();
        if ($list !== false) { //保存成功
            $this->success('评论成功!',cookie('_currentUrl_'));
        } else {
            //失败提示
            $this->error('评论失败!');
        }
    }
    
    /**
     * 审核接口
     * 必须传递主键ID , 可批量
     */
    public function verify() {
        $new_comment_M = M('News_comment');
        if (!empty($new_comment_M)) {
            $pk = $new_comment_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $new_comment_M->where($condition)->setField('status', 1);
                if ($list !== false) {
                    $this->success('审核成功！');
                } else {
                    $this->error('审核失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    	
    }
    
    /**
     * 编辑查看
     */
    public function read() {
        $news_comment_M = M('News_comment');
        $id = $_REQUEST [$news_comment_M->getPk()];
        $vo = $news_comment_M->getById($id);
        $this->assign('vo', $vo);
        $this->display();
    }

    /**
     * 更新修改接口
     * 必须传递主键ID
     */
    public function update() {
      	$news_comment_M = D('News_comment');
        if (false === $news_comment_M->create()) {
            $this->error($news_comment_M->getError());
        }
        // 更新数据
        $list = $news_comment_M->save();
        if (false !== $list) {
            //成功提示
            $this->success('评论更新成功!',cookie('_currentUrl_'));
        } else {
            //错误提示
            $this->error('评论更新失败!');
        }
    }
    /*
     * 评论通过审核
     * 可以批量操作，必选传递主键
     */
    public function toStatus1(){
    	$news_comment_M = M('News_comment');
        if (!empty($news_comment_M)) {
            $pk = $news_comment_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_comment_M->where($condition)->setField('status', 1);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
 	/*
     * 取消对评论的通过审核
     * 可以批量操作，必选传递主键
     */
    public function toStatus2(){
    	$news_comment_M = M('News_comment');
        if (!empty($news_comment_M)) {
            $pk = $news_comment_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_comment_M->where($condition)->setField('status', 2);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
}