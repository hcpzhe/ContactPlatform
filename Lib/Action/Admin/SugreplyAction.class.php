<?php
//建议回复
class SugreplyAction extends CommonAction {
    
    /**
     * 回复提交接口
     */
    public function save() {
    	$sugreply_M = D('Sugreply');
    	if (false === $sugreply_M->create()){
    		//自动验证不通过
    		$this->error($sugreply_M->getError());
    	}else{
    		if (false !== $sugreply_M->add()){
				$this->success('回复成功',cookie('_currentUrl_'));
				$suggest_M = M('Suggest');
				$info = $suggest_M->where("id={$sugreply_M->sug_id}")->find();
				if ($info['status']==2){//更新建议审核状态
					$info['status']=1;
					$suggest_M->save($info);
				}    		
    		}else{
    			$this->error('回复失败');
    		}
    	}
    }
    
}