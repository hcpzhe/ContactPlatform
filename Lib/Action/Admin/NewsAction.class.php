<?php
//新闻
class NewsAction extends CommonAction {
	/*
	 * 设置图片操作
	 * 可以批量操作，传主键
	 * 
	 */
	public function on_pic(){
	 	$news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_pic', 1);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
	
	
	
	}
	/*
	 * 取消设置图片操作
	 * 可以批量操作，传主键
	 * 
	 */
	public function off_pic(){
	 	$news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_pic', 0);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
	
	
	
	}
	
    //过滤查询条件
    public function _filter(&$map){
    	//分类检索
    	if(isset($_POST['newstype'])){
    		switch ($_POST['newstype']){
    			case 0: //图片信息
    				$map['is_pic']=array('gt',0);
    				break;
    			case 1: //推荐信息
    				$map['is_recom']=array('gt',0);
    				break;
    			case 2: //显示信息
    				$is_display = C('DB_PREFIX').'news.is_display';
    				$map[$is_display]=array('gt',0);
    				break;
    			case 3: //非图片信息
    				$map['is_pic']=array('eq',0);
    				break;
    			case 4: //未推荐信息
    				$map['is_recom']=array('eq',0);
    				break;
    			case 5: //不显示信息
    				$is_display = C('DB_PREFIX').'news.is_display';
    				$map[$is_display]=array('eq',0);
    				break;
    			default: 
    				;
    		}
    	}
    	if ($map['ctg_id']==0){
    		$map['ctg_id']=array('gt',0);
    	}
    	if (!empty($_POST['txtsearch'])){
    		$map['title'] = array('like',"%".$_POST['txtsearch']."%");
    	}
    	$status = C('DB_PREFIX').'news.status';
    	$map[$status]=array('gt',0);
    }
    /*
     * 列表显示
     */
    protected function myIndex($map){
    	//新闻分类
    	$news_category_M = M('NewsCategory');
    	$category_list = $news_category_M->where("status>0")->select();
    	$this->assign('category_list',$category_list);
    	
    	
    	//新闻信息列表
    	$news_M = new Model('News');
    	$tablepre = C('DB_PREFIX');
    	$myjoin = $tablepre."news_category on ".$tablepre."news.ctg_id=".$tablepre."news_category.id";
    	$field = $tablepre."news.*,".$tablepre."news_category.name";
    	$count = $news_M->join($myjoin)->where($map)->count();
    	import("@.ORG.Util.Page");
    	$p = new Page($count,15);
    	$list = $news_M->join($myjoin)->where($map)->order($tablepre."news.id")->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
    	foreach ($map as $key => $val) {
             if (!is_array($val)) {
                 $p->parameter .= "$key=" . urlencode($val) . "&";
             }
        }
        //echo $news_M->getLastSql();//exit();
    	$page = $p->show();
    	$this->assign('list',$list);
    	$this->assign('page',$page); 
    
    }
    
    /**
     * 新增页面
     */
    public function add() {
    	$news_category_M = M('NewsCategory');
    	$category_list = $news_category_M->where('status>0')->select();
    	$this -> assign('category_list',$category_list);
    	$this->display();
    }
    
    /**
     * 新增接口
     */
    public function insert() {
    	$news_M = D('News');
    	
    	if (false !== $news_M->create()){
    		$new_news_id = $news_M->add();
    		if ($new_news_id !== false) {
				if (!empty($_FILES['imgupload']['name'])){
					$fileinfo = $this->_uploadone($_FILES['imgupload'] , $this->getActionName().'/'.$new_news_id.'/'); //传递新闻预览图
					//预览图URL地址
					$picture_url =substr($fileinfo['savepath'].$fileinfo['savename'], 1);
					$news_M->where("id=$new_news_id")->setField('picture',$picture_url);
				}
    			
    			$this->success('新闻添加成功！',__GROUP__.'/News/index');
    		}else {
    			$this->error('新闻添加失败，请重新添加！');
    		}
    	}else {
			$this->error($news_M->getError());    	
    	}
    }
    
    /**
     * 编辑查看页面
     */
    public function read() {
    	//栏目列表
    	$news_category_M = M('NewsCategory');
    	$category_list = $news_category_M->where('status>0')->select();
    	$this -> assign('category_list',$category_list);
    	
    	$news_M = M('News');
        $id = $_REQUEST [$news_M->getPk()];
        $vo = $news_M->getById($id);
        $this->assign('vo', $vo);
       
    	$this->display();
    }
    
    /**
     * 更新修改接口
     * 必须传递主键ID
     */
    public function update() {
    	$_POST['id'] = (int)$_POST['id'];
    	if ($_POST['id'] <= 0) $this->error('参数不合法,请联系程序人员! ');
    	
    	$news_M = D('News');
   		if (false === $news_M->create()) {
            $this->error($news_M->getError());
        }
        // 更新数据
        $list = $news_M->save();
        if (false !== $list) {
			if (!empty($_FILES['imgupload']['name'])){
				$fileinfo = $this->_uploadone($_FILES['imgupload'] , $this->getActionName().'/'.$_POST['id'].'/'); //传递新闻预览图
				//预览图URL地址
				$picture_url =substr($fileinfo['savepath'].$fileinfo['savename'], 1);
				$news_M->where("id=".$_POST['id'])->setField('picture',$picture_url);
			}
            //成功提示
            $this->success('编辑成功!',__GROUP__.'/News/index');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
        
    	
    }
    /*
     * 取消显示
     * 可以批量操作，必须传递主键ID
     */
    public function off_display(){
      	$news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_display', 0);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
    /*
     * 显示信息
     * 可批量操作，必须传递主键ID
     */
    public function on_display(){
        $news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_display', 1);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
    /*
     * 设置推荐
     * 可批量操作
     */
    public function on_recom(){
    	$news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_recom', 1);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    
    }
    /*
     * 取消推荐
     * 可以批量操作
     */
    public function off_recom(){
   		$news_M = M('News');
        if (!empty($news_M)) {
            $pk = $news_M->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $news_M->where($condition)->setField('is_recom', 0);
                if ($list !== false) {
                    $this->success('批操作成功！');
                } else {
                    $this->error('批操作失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
    
}