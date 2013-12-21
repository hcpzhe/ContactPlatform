<?php
class CommonAction extends Action{
	/*
	 * 获取导航条信息
	 */
	protected function getNav(){
	    $news_category_M = M('News_category');
    	$category_list = $news_category_M->where("is_display>0 AND is_index>0 AND status>0")->order("rank")->select();
    	$this -> assign('category_list',$category_list); 
	
	}
	function read() {
        $this->edit();
    }
	function edit() {
        $name = $this->getActionName();
        $model = M($name);
        $id = $_REQUEST [$model->getPk()];
        $vo = $model->getById($id);
        //dump($vo);
        $this->assign('vo', $vo);
        $this->display();
    }
	function update() {
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
            //成功提示
            $this->success('编辑成功!',cookie('_currentUrl_'));
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }
	function insert() {
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
        if ($list !== false) { //保存成功
            $this->success('新增成功!',cookie('_currentUrl_'));
        } else {
            //失败提示
            $this->error('新增失败!');
        }
    }



}