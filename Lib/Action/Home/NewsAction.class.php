<?php
class  NewsAction extends CommonAction{
	
	protected function _condition(&$map){
		$map['status']=array('gt',0);
	}
	
	/*
	 * 显示新闻列表
	 * 接受栏目的主键
	 */
	public function newsList(){
		//获取导航信息
		$this->getNav();
		
		$condition = array();
		$condition['is_display']=array('gt',0);
		$condition['ctg_id'] = (int)$_REQUEST['id'];
		$this->_condition($condition);
		$news_M = M('News');       
//        $ctg_id = $_REQUEST ['id'];
        $news_category_M = M('NewsCategory');
       //获取栏目名称
        $news_category_name = $news_category_M->where("id=".$condition['ctg_id'])->getField('name');
        $this->assign('news_category_name',$news_category_name);
        import('@.ORG.Util.Page');
        $count = $news_M->where($condition)->count();
        $p = new Page($count,15);
	    $list = $news_M->where($condition)->limit($p->firstRow . ',' . $p->listRows)->select();
	    $page = $p -> show();
	    $this->assign('list',$list);
	    $this->assign('page',$page);
	    $this->display('list_article');
	}
	/*
	 * 显示新闻内容
	 * 接受新闻信息的ID，即主键
	 */
	public function show(){
		//获取导航信息
		$this->getNav();
		
		$condition = array();
		$condition['id'] = (int)$_REQUEST['id'];
		$this->_condition($condition);
		
		$news_M = M('News');
        //获取当前新闻信息
        $info = $news_M->where($condition)->find();
        
       //获取栏目名称
       $news_category_name =M('NewsCategory')->where("id=".$info['ctg_id'])->getField('name');
		
       $condition['ctg_id'] = $info['ctg_id'];
        //获取前一条新闻信息
       	$front = $news_M->where($condition)->order('id desc')->limit('1')->find();

       	//获取后一条新闻信息
		$after = $news_M->where($condition)->order('id desc')->limit('1')->find();
       	
		//给模板赋值
        $this->assign('info',$info);
        $this->assign('news_category_name',$news_category_name);
        $this->assign('prevNews',$front);
        $this->assign('nextNews',$after);
        
        $this->display('article_article');
	}


}