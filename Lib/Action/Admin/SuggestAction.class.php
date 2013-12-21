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
    /*
     * 待处理建议
     */
    public function daicl(){
    	$map=array();
    	$suggest_M = M('Suggest');
        $this->_filter($map);
        $map['status']=2;
        $count = $suggest_M->where($map)->count('id');
        import('ORG.Util.Page');
        $p = new Page($count,15);
        
        $volist = $suggest_M->where($map)->limit($p->firstRow.','.$p->listRows)->select(); 
    	foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
        }
        $page = $p->show();
        $this -> assign('volist',$volist);
        $this -> assign('page',$page);
        
        $this->display();
    }
    
    
    /*
     * 已处理建议列表
     */
    public function yicl(){
    	$map=array();
    	$suggest_M = M('Suggest');
        $this->_filter($map);
        $map['status']=1;
        $count = $suggest_M->where($map)->count('id');
        import('ORG.Util.Page');
        $p = new Page($count,15);
        
        $volist = $suggest_M->where($map)->limit($p->firstRow.','.$p->listRows)->select(); 
    	foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
        }
        $page = $p->show();
        $this -> assign('volist',$volist);
        $this -> assign('page',$page);
        
        $this->display();
    
    
    }
    
}