<?php
class  NewsAction extends CommonAction{

	/*
	 * 显示新闻列表
	 * 接受栏目的主键
	 */
	public function news_list(){
		//获取导航信息
		$this->getNav();
		
		$news_M = M('News');       
        $ctg_id = $_REQUEST ['ctg_id'];
        import('@.ORG.Util.Page');
        $count = $news_M->where("ctg_id=%d",$ctg_id)->count();
        $p = new Page($count,15);
	    $list = $news_M->where("ctg_id=%d",$ctg_id)->limit($p->firstRow . ',' . $p->listRows)->select();
	    $page = $p -> show();
	    $this->assign('list',$list);
	    $this->assign('page',$page);
	    $this->display();
	}
	/*
	 * 显示新闻内容
	 * 接受新闻信息的ID，即主键
	 */
	public function show(){
		//获取导航信息
		$this->getNav();
		
		$news_M = M('News');
        $pk = $news_M->getPk();
        $id = $_REQUEST [$pk];
        //获取当前新闻信息
        $info = $news_M->where("id=%d",$id)->find();

        //获取前一条新闻信息
       	$front = $news_M->where("ctg_id=%d AND id<%d",$info['ctg_id'],$id)->order('id desc')->limit('1')->find();

       	//获取后一条新闻信息
		$after = $news_M->where("ctg_id=%d AND id>%d",$info['ctg_id'],$id)->order('id desc')->limit('1')->find();
       	
		//给模板赋值
        $this->assign('info',$info);
        $this->assign('front',$front);
        $this->assign('after',$after);
        
        $this->display();
	}


}