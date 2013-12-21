<?php
class NewsCommentAction extends CommonAction{
	public function insert(){
		$news_comment_M = D('News_comment');
		if (false === $news_comment_M->create()){
			$this->error($news_comment_M->getError());
			
		}
		//保存数据到数据库
		$list = $news_comment_M->add();
		if ($list !==false){//数据保存成功
			$this->success('评论成功，请等待审核！');
		}else {
			$this->error('评论失败');
		}
	}
	/*
	 * 获取建议列表
	 */
	public function index(){
		$suggest_M = M('Suggest');
		$member_id = $suggest_M -> getMemberId();//获取用户ID
		$suggest_list = $suggest_M->where("member_id=$member_id AND status>0")->select();
		$this -> assign('suggest_list',$suggest_list);
		$this->display();
	}
	
	//查看建议及建议回复的内容
	//接受建议的主键
	public function read(){
		$suggest_M = M('Suggest');
		$id = $_REQUEST[$suggest_M->getPk()];
		$info = $suggest_M->getById($id);//建议信息
		
		$sugreply_M = M('Sugreply');
		$sugreply_lsit = $sugreply_M -> where("sug_id=%d AND status>0",$info['id'])->select();//建议回复内容
		$this->assign('info',$info);
		$this->assign('sugreply_list',$sugreply_lsit);
		$this->display();
	}


}