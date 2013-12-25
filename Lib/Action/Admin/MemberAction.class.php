<?php
//会员
class MemberAction extends CommonAction {
	/*
	 * 重置用户密码
	 * 传递用户主键信息
	 */
	public function resetPwd(){
		$member_M = M('Member');
		if (!empty($member_M)) {
			$pk = $member_M->getPk();
			$id = $_REQUEST [$pk];
			if (isset($id)) {
				$condition = array($pk => array('eq', $id));
				$member = $member_M->where($condition)->find();
				$list = $member_M->where($condition)->setField('password',pwdHash($member['account']));
				if ($list !== false) {
					$this->success('密码已重置为用户名！',cookie('_currentUrl_'));
				} else {
					$this->error('密码重置失败，请重试！');
				}
			} else {
				$this->error('非法操作');
			}
		}
		
	}
	
	
	
	//过滤查询字段
	function _filter(&$map){
		$map['status']=array('gt',0);
		if (!empty($_POST['member_type'])){
			switch ($_POST['member_type']){
				case '1'://未审核 
					$map['status']=array('eq',2);
					break;
				case '2': //已审核
					$map['status']=array('eq',1);
					break;
				case '3': //未推荐
					$map['is_recom']=array('eq',0);
					break;
				case '4': //已推荐
					$map['is_recom']=array('eq',1);
					break;
				default:;
			}
		}
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
		$new_member_id = $member_M->add();
		if ($new_member_id !== false) { //保存成功
			if (!empty($_FILES['photo']['name'])){
				$fileinfo = $this->_uploadone($_FILES['photo'] , $this->getActionName().'/'.$new_member_id.'/'); //传递头像图片
				//头像URL地址
				$photo_url =substr($fileinfo['savepath'].$fileinfo['savename'], 1);
				$member_M->where("id=$new_member_id")->setField('photo',$photo_url);
			}
			$this->success('用户新增成功!',cookie('_currentUrl_'));
		} else {
			//失败提示
			$this->error('用户新增失败!');
		}
		
	}
	
//	public function upload() {
//		if (!empty($_FILES)) {
//			//如果有文件上传 上传附件
//			$this->_upload();
//		}
//	}
//	/*
//	 * 图片上传处理
//	 */
//	protected function _upload() {
//		import('ORG.Util.UploadFile');
//		//导入上传类
//		$upload = new UploadFile();
//		//设置上传文件大小
//		$upload->maxSize			= 3292200;
//		//设置上传文件类型
//		$upload->allowExts		  = explode(',', 'jpg,gif,png,jpeg');
//		//设置附件上传目录
//		$upload->savePath		   = './Uploads/';
//		//设置上传文件规则
//		$upload->saveRule		   = 'uniqid';
//		//删除原图
//		$upload->thumbRemoveOrigin  = true;
//		if (!$upload->upload()) {
//			//捕获上传异常
//			$this->error($upload->getErrorMsg());
//		} else {
//			//取得成功上传的文件信息
//			$uploadList = $upload->getUploadFileInfo();
//			$_POST['photo'] = $uploadList[0]['savename'];
//		}
//		//dump($uploadList);exit();
//	}
	
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
    public function update() {
        $member_M = D('Member');
      	if (false === $member_M->create()) {
            $this->error($member_M->getError());
        }
        // 更新数据
        $list = $member_M->save();
        if (false !== $list) {
            //成功提示
        	if (!empty($_FILES['photo']['name'])){
				$fileinfo = $this->_uploadone($_FILES['photo'], $this->getActionName().'/'.$member_M->id.'/'); //传递头像图片
				//头像URL地址
				$photo_url =substr($fileinfo['savepath'].$fileinfo['savename'], 1);
				$member_M->where("id={$member_M->id}")->setField('photo',$photo_url);
			}
            $this->success('编辑成功!',cookie('_currentUrl_'));
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
	}
	/*
	 * 通过审核
	 * 可以批量操作，必选传递主键
	 */
	public function toStatus1(){
		$member_M = M('Member');
		if (!empty($member_M)) {
			$pk = $member_M->getPk();
			$id = $_REQUEST [$pk];
			if (isset($id)) {
				$condition = array($pk => array('in', explode(',', $id)));
				$list = $member_M->where($condition)->setField('status', 1);
				if ($list !== false) {
					$this->success('批操作成功！',cookie('_currentUrl_'));
				} else {
					$this->error('批操作失败！');
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	/*
	 * 取消对其审核
	 * 可以批量操作，必须传递主键
	 */
	public function toStatus2(){
		$member_M = M('Member');
		if (!empty($member_M)) {
			$pk = $member_M->getPk();
			$id = $_REQUEST [$pk];
			if (isset($id)) {
				$condition = array($pk => array('in', explode(',', $id)));
				$list = $member_M->where($condition)->setField('status', 2);
				if ($list !== false) {
					$this->success('批操作成功！',cookie('_currentUrl_'));
				} else {
					$this->error('批操作失败！');
				}
			} else {
				$this->error('非法操作');
			}
		}
	}
	/*
	 * 首页推荐
	 * 可以批量，必须传递主键
	 */
	public function toRecom1(){
		$member_M = M('Member');
		if (!empty($member_M)){
			$pk = $member_M->getPk();
			$id = $_REQUEST[$pk];
			if(isset($id)){
				$condition = array($pk => array('in',explode(',',$id)));
				$list = $member_M->where($condition)->setField('is_recom',1);
				if ($list !== false){
					$this -> success('批操作成功！',cookie('_currentUrl_'));
				}else {
					$this ->error('批操作失败！');
				}
			}else{
			
				$this -> error('非法操作');
			}
		}
	}
	/*
	 * 取消首页推荐
	 * 可以批量操作，必须传递主键
	 * 
	 */
	public function toRecom0(){
   		$member_M = M('Member');
		if (!empty($member_M)){
			$pk = $member_M->getPk();
			$id = $_REQUEST[$pk];
			if(isset($id)){
				$condition = array($pk => array('in',explode(',',$id)));
				$list = $member_M->where($condition)->setField('is_recom',0);
				if ($list !== false){
					$this -> success('批操作成功！',cookie('_currentUrl_'));
				}else {
					$this ->error('批操作失败！');
				}
			}else{
			
				$this -> error('非法操作');
			}
		}
	
	
	}
}