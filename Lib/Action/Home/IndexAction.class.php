<?php

class IndexAction extends CommonAction {
    public function index(){
    	//取出导航条信息
    	$this->getNav();
    	
    	$news_M = M('News');
    	//代表委员之声
    	$db_list =  $news_M->where("ctg_id=1 AND status>0")->order('create_time desc')->limit(6)->select();
    	$this->assign('db_list',$db_list);
    	
    	//检查工作动态
    	$jc_list =  $news_M->where("ctg_id=2 AND status>0")->order('create_time desc')->limit(6)->select();
    	$this->assign('jc_list',$jc_list);
    	
    	//热点案件追踪
    	$rd_list =  $news_M->where("ctg_id=3 AND status>0")->order('create_time desc')->limit(12)->select();
    	$this->assign('rd_list',$rd_list);
    	
    	//重要工作部署
    	$zy_list =  $news_M->where("ctg_id=4 AND status>0")->order('create_time desc')->limit(12)->select();
    	$this->assign('zy_list',$zy_list);
    	
    	$this->display();
    }
    /*
     * 获取用户列表
     */
    public function memberList(){
    	//获取导航信息
    	$this->getNav();
    	$member_M = M('Member');
    	import('@.ORG.Util.Page');
    	$count = $member_M-> where("status>0")->count();
    	$p = new Page($count,12);
    	$member_list = $member_M->where("status>0")->limit($p->firstRow.','.$p->listRows)->select();
    	$page = $p->show();//分页导航
    	$this->assign('member_list',$member_list);
    	$this->assign('page',$page);
    	$this->display('list_image');
    
    }
    /*
     * 获取委员详细信息，在前台展示
     * 
     * 接收参数为member表的主键
     */
    public function member(){
    	//获取导航信息
    	$this -> getNav();
    	
    	$member_M = M('Member');
    	$id = $_REQUEST[$member_M->getPk()];
    	$member_info = $member_M-> where("id=$id")->find();//获取指定委员信息
    	$this->assign('member_info',$member_info);
    	$this -> display('image_article');
    
    }
    
    public function test(){
    	
    }
}