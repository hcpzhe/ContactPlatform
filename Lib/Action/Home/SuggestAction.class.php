<?php
class SuggestAction extends CommonAction{
	/*
	 * 获取信息管理列表
	 */
	public function index(){
		$suggest_M = M('Suggest');
		if (!empty($suggest_M)){
			//获取建议条数
			$count = $suggest_M->where("status>0 AND member_id=".$_SESSION[C('USER_AUTH_KEY')])->count();
			//引入分页类
			import('@.ORG.Util.Page');
			//创建分类实例
			$p = new Page($count,15);
			//获取建议列表
			$suggest_list = $suggest_M->where("status>0 AND member_id=".$_SESSION[C('USER_AUTH_KEY')])->limit($p->firstRow.','.$p->listRows)->select();
			//获取分页导航条
			$page = $p->show();
			//给模板赋值
			$this->assign('suggest_list',$suggest_list);
			$this->assign('page',$page);
		
			$this->display();
		
		}
	}
	/*
	 * 读取建议信息和回复信息
	 */
	public function read(){
        $suggest_M  = M('Suggest');
        $id = $_REQUEST ['id'];
        $vo = $suggest_M->getById($id);
        $vo['reply_type']=explode(',',  $vo['reply_type']);
        //处理回复方式字段
      	$reply_type = '';
		$reply_type .= in_array(0, $vo['reply_type'])?'回复&nbsp;&nbsp;':'';
		$reply_type .= in_array(1, $vo['reply_type'])?'短信&nbsp;&nbsp;':'';
		$reply_type .= in_array(2, $vo['reply_type'])?'邮件&nbsp;&nbsp;':'';
		$reply_type .= in_array(3, $vo['reply_type'])?'电话&nbsp;&nbsp;':'';
		$reply_type .= in_array(4, $vo['reply_type'])?'信函&nbsp;&nbsp;':'';
		$vo['reply_type']=$reply_type;
        //获取回复信息列表
        $sugreply_M = M('Sugreply');
        //获取回复条数
        $count = $sugreply_M->where("status>0 AND sug_id=".$id)->count();
        //引入分页类
        import('@.ORG.Util.Page');
        $p = new  Page($count,15);
        //获取分页列表
        $sugreply_list = $sugreply_M->where("status>0 AND sug_id=".$id)->limit($p->firstRow.','.$p->listRows)->select();
        //获取回复用户ID列表
        $user_id_list = $sugreply_M->where("status>0 AND sug_id=".$id)->limit($p->firstRow.','.$p->listRows)->getField("user_id",true);
		
        $user_M = M('User');
      	//获取用户账号
      	$user_list = $user_M->where(array('id'=>array('in',$user_id_list)))->getField("id,account");  
      
        
        //获取分页导航条
        $page = $p->show();
        
        //给模板赋值
        $this->assign('vo', $vo);
        $this->assign('sugreply_list',$sugreply_list);
        $this->assign('page',$page);
        $this->assign('user_list',$user_list);
        $this->display();
	}
	function insert() {
		if (!isset($_POST['reply_type'])||empty($_POST['reply_type'])){
			$this->error('请选择希望回复方式！');
		}else {
			$_POST['reply_type']=implode(",", $_POST['reply_type']);
		}
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
        if ($list !== false) { //保存成功
            $this->success('建议提交成功!',__GROUP__.'/Suggest/index');
        } else {
            //失败提示
            $this->error('建议提交失败!');
        }
    }

	function update() {
		if (!isset($_POST['reply_type'])||empty($_POST['reply_type'])){
			$this->error('请选择希望回复方式！');
		}else {
			$_POST['reply_type']=implode(",", $_POST['reply_type']);
		}
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
            //成功提示
            $this->success('编辑成功!',__GROUP__.'/Suggest/index');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }
	function edit() {
        $suggest_M = M('Suggest');
        $id = $_REQUEST ['id'];
        $vo = $suggest_M->getById($id);
		$vo['reply_type']=explode(',', $vo['reply_type']);
        $this->assign('vo', $vo);
        $this->display();
    }
}