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
		$setting_M = M('Setting');
		if (!empty($_REQUEST)){
			
			$web_name = $_REQUEST['web_name'];
			$copyright = $_REQUEST['content'];
			//修改网站名称
			$flag_web = $setting_M->where("set_name='web_name'")->setField('set_value',$web_name);
			//修改网站版权信息
			$flag_copy = $setting_M->where("set_name='copyright'")->setField('set_value',$copyright);
		
			$this->success('修改成功！',__GROUP__.'/Setting/read');
			
		}
	}
}