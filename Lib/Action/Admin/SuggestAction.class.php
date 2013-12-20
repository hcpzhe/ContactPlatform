<?php
//建议
class SuggestAction extends CommonAction {

	//过滤查询字段
    public function _filter(&$map){
        if(!empty($_POST['txtsearch'])) {
        $map['title'] = array('like',"%".$_POST['txtsearch']."%");
        }
    }
    
    /**
     * 编辑查看
     * 必须传递主键ID
     * 如果建议已经被回复过, 则显示所有的回复内容
     */
    public function read() {
        $suggest_M = M('Suggest');
        $id = $_REQUEST [$suggest_M->getPk()];
        $vo = $suggest_M->getById($id);
        $this->assign('vo', $vo);
        if($vo['status']==1){
        	//取回复的数据
        	$sugreply_M =　M('Sugreply');
        	$sugreply_list = $sugreply_M -> where("sug_id={$vo['id']} AND status>0")->select();
        	$this->assign('sugreplay_list',$sugreply_list);
        }
        $this->display();  	
    }
    
}