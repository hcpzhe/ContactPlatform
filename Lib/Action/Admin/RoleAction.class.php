<?php
//角色
class RoleAction extends CommonAction {
	public function _getRoleList() {
		$role_M = D('role');
		$list = $role_M->select();
		return $list;
	}
}