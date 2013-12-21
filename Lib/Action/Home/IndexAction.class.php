<?php

class IndexAction extends CommonAction {
    public function index(){
    	//取出导航条信息
    	$this->getNav();
    	
    	//取代表委员风采
    	
    	
    	//代表委员之声
    	
    	
    	//检查工作动态
    	
    	
    	//检查工作动态
    	
    	
    	//重要工作部署
    	
    	
    	$this->display();
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
    	$this -> display();
    
    }
    
    public function test(){
    	
    }
}