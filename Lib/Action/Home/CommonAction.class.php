<?php
class CommonAction extends Action{
	
    function _initialize() {
		if (C('USER_AUTH_ON') && in_array(MODULE_NAME, explode(',', C('REQUIRE_AUTH_MODULE')))) {
			if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
				$this->redirect(C('USER_AUTH_GATEWAY'));
			}
		}
		
		$set_M = D('Setting');
		$list = $set_M->getField('set_name,set_value');
		$this->assign('_PF',$list);
    }
	/*
	 * 获取导航条信息
	 * 和取代表委员风采信息
	 */
	protected function getNav(){
		//获取导航信息
	    $news_category_M = M('News_category');
    	$category_list = $news_category_M->where("is_display>0 AND is_index>0 AND status>0")->order("rank asc")->limit(5)->select();
    	$this -> assign('category_list',$category_list); 
    	
    	//获取代表委员信息
    	$member_M = M('Member');
    	$memer_list = $member_M->where("status=1 AND is_recom=1")->limit('6')->select();
		$this->assign('member_list',$memer_list);		
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
    protected function _uploadone($file , $path) {
		import('@.ORG.Net.UploadFile');
		//导入上传类
		$upload = new UploadFile();
		//设置上传文件大小
		$upload->maxSize			= 3292200;
		//设置上传文件类型
		$upload->allowExts		  = explode(',', 'jpg,gif,png,jpeg');
		//设置附件上传目录
		$upload->savePath		   = APP_PATH.'Public/Uploads/'.$path;
		//设置上传文件规则
		$upload->saveRule		   = 'uniqid';
		//删除原图
		$upload->thumbRemoveOrigin  = true;
		if (!file_exists($upload->savePath)){
			mkdir($upload->savePath,'0644',true);
		}
		$fileinfo = $upload->uploadOne($file);
		if ($fileinfo === false) {
			//捕获上传异常
			$this->error($upload->getErrorMsg());
		} else {
			return $fileinfo[0];
		}
    }



}