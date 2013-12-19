<?php

class IndexAction extends CommonAction {
    public function index() {
		//待审核用户
		$member_M = D('Member');
		$nums = $member_M->where('status=2')->count();
		$this->assign('member_num',$nums);
		
		//待审核评论
		$news_comment_M = M('news_comment');
		$comment_num = $news_comment_M -> where('status=2')->count();
		$this->assign('comment_num',$comment_num);
		
		//待回复建议
		$suggest_M = M('suggest');
		$suggest_num = $suggest_M->where('status=2')->count();
		$this->assign('suggest_num',$suggest_num);
		
		//总用户数
		$member_total = $member_M->count();
		$this->assign('member_total',$member_total);
		
		//总信息数
		$news_M = M('news');
		$news_num = $news_M->where('status>0')->count();
		$this->assign('news_num',$news_num);
		
		//总建议数
		$suggest_total = $suggest_M->where('status>0')->count();
		$this->assign('suggest_total',$suggest_total);
		
		$this->display();
    }
}