<?php
//建议
class SuggestAction extends CommonAction {
	
	private $reply_type = array(
			'0' => '回复',
			'1' => '短信',
			'2' => '邮件',
			'3' => '电话',
			'4' => '信函'
		);

	//过滤查询字段
    public function _filter(&$map){
        if(!empty($_POST['txtsearch'])) {
        $map['title'] = array('like',"%".$_POST['txtsearch']."%");
        }
        $status = C('DB_PREFIX').'suggest.status';
        $map[$status] = array('gt',0);
    }
    public function myIndex($map){
    	$suggest_M = new Model('Suggest');
    	$tablepre = C('DB_PREFIX');
    	$myjoin = $tablepre."member on ".$tablepre."suggest.member_id=".$tablepre."member.id";
    	$field = $tablepre."suggest.*,".$tablepre."member.account";
    	$count = $suggest_M->join($myjoin)->where($map)->count();
    	import("@.ORG.Util.Page");
    	$p = new Page($count,15);
    	$list = $suggest_M->join($myjoin)->where($map)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
    	foreach ($map as $key => $val) {
             if (!is_array($val)) {
                 $p->parameter .= "$key=" . urlencode($val) . "&";
             }
        }
    	$page = $p->show();
    	$this->assign('list',$list);
    	$this->assign('page',$page); 
    }
    
    
    public function _before_read() {
    	$this->assign('reply_type',$this->reply_type);
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
        $member_M = M('Member');
        $member_info = $member_M->getById($vo['member_id']);
        //处理回复方式字段
        $vo['reply_type']=explode(',',  $vo['reply_type']);
        $this->assign('vo', $vo);//建议信息
        $this->assign('member_info',$member_info);//建议用户信息
        if($vo['status']==1){
        	//取回复的数据
        	$sugreply_M = M('Sugreply');
        	$tablepre = C('DB_PREFIX');
    		$myjoin = $tablepre."user on ".$tablepre."sugreply.user_id=".$tablepre."user.id";
    		$field = $tablepre."sugreply.*,".$tablepre."user.account";
    		$condition = "sug_id={$vo['id']} AND ".$tablepre."sugreply.status>0";
    		$count = $sugreply_list = $sugreply_M ->join($myjoin)-> where($condition)->count();
    		import("@.ORG.Util.Page");
    		$p = new Page($count,15);
        	$sugreply_list = $sugreply_M ->join($myjoin)-> where($condition)->order($tablepre."sugreply.id")->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
        	//echo $sugreply_M->getLastSql();exit();
        	$page = $p->show();
        	$this->assign('sugreplay_list',$sugreply_list);//回复列表
        	$this->assign('page',$page);//分页导航
        }
        cookie('_currentUrl_', __SELF__);
        $this->display();  	
    }
    /*
     * 待处理建议
     */
    public function daicl(){
    	$map=array();
    	$suggest_M = M('Suggest');
    	$this->_search($map);
        $this->_filter($map);
        $status = C('DB_PREFIX').'suggest.status';
        $map[$status] = array('eq',2);
        $tablepre = C('DB_PREFIX');
    	$myjoin = $tablepre."member on ".$tablepre."suggest.member_id=".$tablepre."member.id";
    	$field = $tablepre."suggest.*,".$tablepre."member.account";
    	$count = $suggest_M->join($myjoin)->where($map)->count();
        import("@.ORG.Util.Page");
        $p = new Page($count,15);
        
        $volist = $suggest_M->join($myjoin)->where($map)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
    	foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
        }
        $page = $p->show();
        $this -> assign('list',$volist);
        $this -> assign('page',$page);
        
        $this->display();
    }
    
    
    /*
     * 已处理建议列表
     */
    public function yicl(){
    	$map=array();
    	$suggest_M = M('Suggest');
    	$this->_search($map);
        $this->_filter($map);
        $status = C('DB_PREFIX').'suggest.status';
        $map[$status] = array('eq',1);
        $tablepre = C('DB_PREFIX');
    	$myjoin = $tablepre."member on ".$tablepre."suggest.member_id=".$tablepre."member.id";
    	$field = $tablepre."suggest.*,".$tablepre."member.account";
    	$count = $suggest_M->join($myjoin)->where($map)->count();
        import("@.ORG.Util.Page");
        $p = new Page($count,15);
        
        $volist = $suggest_M->join($myjoin)->where($map)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
    	foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
        }
        $page = $p->show();
        $this -> assign('list',$volist);
        $this -> assign('page',$page);
        
        $this->display();
    
    
    }
    
}