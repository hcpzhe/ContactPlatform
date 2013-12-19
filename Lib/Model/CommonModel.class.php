<?php
class CommonModel extends Model {
	
	/**
	 * 根据条件获取表总记录数
	 */
	public function getNums($options='`status` > 0') {
		return $this->where($options)->count();
	}
	
	// 获取当前用户的ID
	public function getMemberId() {
		return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
	}
	
	/**
	 * 是否存在用户
	 */
	function isMember($id) {
		$model = D('Member');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在站点
	 */
	function isSite($id) {
		$model = D('Site');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在关键词
	 */
	function isWord($id) {
		$model = D('Keyword');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在关键词记录
	 */
	function isWordRec($id) {
		$model = D('KeywordRecord');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}

	/**
	 * 是否存在搜索引擎
	 */
	function isSe($id) {
		$model = D('Sename');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在搜索引擎
	 */
	function isMsg($id) {
		$model = D('Outbox');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在管理员角色
	 */
	function isRole($id) {
		$model = D('Role');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	/**
	 * 是否存在管理员
	 */
	function isUser($id) {
		$model = D('User');
		if ($model->where('`id`='.$id)->count() > 0) return $id;
		else return FALSE;
	}
	
	
   /**
	 +----------------------------------------------------------
	 * 根据条件禁用表数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param array $options 条件
	 +----------------------------------------------------------
	 * @return boolen
	 +----------------------------------------------------------
	 */
	public function forbid($options,$field='status'){

		if(FALSE === $this->where($options)->setField($field,0)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}

	 /**
	 +----------------------------------------------------------
	 * 根据条件批准表数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param array $options 条件
	 +----------------------------------------------------------
	 * @return boolen
	 +----------------------------------------------------------
	 */

	public function checkPass($options,$field='status'){
		if(FALSE === $this->where($options)->setField($field,1)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}


	/**
	 +----------------------------------------------------------
	 * 根据条件恢复表数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param array $options 条件
	 +----------------------------------------------------------
	 * @return boolen
	 +----------------------------------------------------------
	 */
	public function resume($options,$field='status'){
		if(FALSE === $this->where($options)->setField($field,1)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}

	/**
	 +----------------------------------------------------------
	 * 根据条件恢复表数据
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param array $options 条件
	 +----------------------------------------------------------
	 * @return boolen
	 +----------------------------------------------------------
	 */
	public function recycle($options,$field='status'){
		if(FALSE === $this->where($options)->setField($field,0)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}

	public function recommend($options,$field='is_recommend'){
		if(FALSE === $this->where($options)->setField($field,1)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}

	public function unrecommend($options,$field='is_recommend'){
		if(FALSE === $this->where($options)->setField($field,0)){
			$this->error =  L('_OPERATION_WRONG_');
			return false;
		}else {
			return True;
		}
	}
}
?>