<?php
//网站设置
class SettingAction extends CommonAction {
	public function read() {
		$set_M = D('Setting');
		$vo = $set_M->getField('set_name,set_value');
		$this->assign('vo', $vo);
		$this->display();
	}
	
	//数据更新接口
	public function update() {
		
	}
}