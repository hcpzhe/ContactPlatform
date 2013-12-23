<?php
//新闻评论
//若为匿名评论, 则所属用户ID member_id 为0
class NewsCommentAction extends CommonAction {
    //过滤查询字段
 	public function _filter(&$map){
        if(!empty($_POST['txtsearch'])) {
        $map['title'] = array('like',"%".$_POST['txtsearch']."%");
        }
        //审核条件
        $map['status'] = array('gt',0);
        if (!empty($_POST['status'])){
        	switch ($_POST['status']){
        		case 1: 
        			$map['status']=array('eq',1);
        			break;
				case 2:	
					$map['status']=array('eq',2);
					break;
				default:;        	
        	}
        }
        //所属栏目的评论条件生成
        if (!empty($_POST['typelist'])){
        	$news_M = M('News');
        	$news_id_list = $news_M -> where('ctg_id=%d',$_POST['tupelist'])->getField('id');
        	$map['news_id']=array('in',$news_id_list);
        }
    }
    /**
     * 新增接口
     * 必须传递所属新闻ID
     */
    public function insert() {
        $news_comment_M = D('NewsComment');
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
    /*
     * 评论列表显示
     */
    public function  myIndex($map){
    	//信息分类
    	$news_category_M = M('NewsCategory');
    	$news_comment_M = M('NewsComment');
    	$member_M = M('Member');
    	$news_M = M('News');
    	$category_list = $news_category_M->where("status>0")->select();
    	$this->assign('category_list',$category_list);
    	
    	//评论列表
//    	$tablepre = C('DB_PREFIX');
//    	$myjoin = $tablepre."member on ".$tablepre."news_comment.member_id=".$tablepre."member.id";
//    	$field = $tablepre."news_comment.*,".$tablepre."member.account";
//    	$count = $news_comment_M->join($myjoin)->where($map)->count();
		$count = $news_comment_M->where($map)->count();
    	import("@.ORG.Util.Page");
    	$p = new Page($count,15);
    	//用户ID列表
    	$member_id_list = $news_comment_M->where($map)->limit($p->firstRow . ',' . $p->listRows)->getField('member_id');
    	//用户信息列表
    	$member_list = $member_M->where(array('id'=>array('in',$member_id_list)))->getField('id,account,nickname'); 
    	//新闻ID列表
    	$news_id_list = $news_comment_M->where($map)->limit($p->firstRow . ',' . $p->listRows)->getField('news_id');
    	//新闻标题列表
    	$news_list = $news_M -> where(array('id'=>array('in',$news_id_list)))->getField('id,title');

    	
    	//评论信息列表
    	$list = $news_comment_M->where($map)->limit($p->firstRow . ',' . $p->listRows)->select();
    	
    	
//    	$list = $news_comment_M->join($myjoin)->where($map)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
    	foreach ($map as $key => $val) {
             if (!is_array($val)) {
                 $p->parameter .= "$key=" . urlencode($val) . "&";
             }
        }
        //echo $news_comment_M->getLastSql();exit();
    	$page = $p->show();
    	$this->assign('list',$list);
    	$this->assign('page',$page); 
    	$this->assign('member_list',$member_list);
    	$this->assign('news_list',$news_list);
    
    
    }
    
    /**
     * 审核接口
     * 必须传递主键ID , 可批量
     */
    public function verify() {
        $new_comment_M = M('NewsComment');
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
        $news_comment_M = M('NewsComment');
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
      	$news_comment_M = D('NewsComment');
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
    	$news_comment_M = M('NewsComment');
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
    	$news_comment_M = M('NewsComment');
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