<?php
//会员
class MemberAction extends CommonAction {
//    /**
//     * 列表
//     * 根据传递参数, 进行列表筛选
//     * 要分页, 排序
//     */
//	public function index() {
//    	
//		$this->display();
//    }
	//过滤查询字段
    function _filter(&$map){
        if(!empty($_POST['txtsearch'])) {
        $map['account'] = array('like',"%".$_POST['txtsearch']."%");
        }
    }
    /**
     * 新增页面
     */
    public function add() {
    	$this->display();
    }
    
    /**
     * 新增接口
     */
    public function insert() {
    	 $member_M  = D('Member');
        if (false === $member_M->create()) {
            $this->error($member_M->getError());
        }
        //保存当前数据对象
        $list = $member_M->add();
        if ($list !== false) { //保存成功
            $this->success('用户新增成功!',cookie('_currentUrl_'));
        } else {
            //失败提示
            $this->error('用户新增失败!');
        }
    	
    }
    
    /**
     * 编辑查看页面
     */
    public function read() {
        $member_M = M('Member');
        $id = $_REQUEST [$member_M->getPk()];
        $vo = $member_M->getById($id);
        //dump($vo);
        $this->assign('vo', $vo);
    	$this->display();
    }
    
    /**
     * 更新修改接口
     * 必须传递主键ID
     */
  /*  public function update() {
    	
    }*/
    
}