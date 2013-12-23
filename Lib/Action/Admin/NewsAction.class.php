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
    	/**
    	 * TODO 新闻增加了预览图片, 这里要做图片上传处理
    	 */
    	$this->upload();//上传图片处理
    	if (false !== $news_M->create()){
    		
    		if ($news_M->add()){
    			//echo $news_M->getLastSql();exit();
    			$this->success('新闻添加成功！',__GROUP__.'/News/index');
    		}else {
    			$this->error('新闻添加失败，请重新添加！');
    		}
    	}else {
			$this->error($news_M->getError());    	
    	}
    }
 	public function upload() {
        if (!empty($_FILES)) {
            //如果有文件上传 上传附件
            $this->_upload();
        }
    }
	/*
	 * 图片上传处理
	 */
    protected function _upload() {
        import('ORG.Util.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize            = 3292200;
        //设置上传文件类型
        $upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
        //设置附件上传目录
        $upload->savePath           = './Uploads/';
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
        //删除原图
        $upload->thumbRemoveOrigin  = true;
        if (!$upload->upload()) {
            //捕获上传异常
            $this->error($upload->getErrorMsg());
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            $_POST['picture'] = $uploadList[0]['savename'];
        }
        //dump($uploadList);exit();
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
    	$news_M = D('News');
    	$this->upload();
   		 if (false === $news_M->create()) {
            $this->error($news_M->getError());
        }
        // 更新数据
        $list = $news_M->save();
        if (false !== $list) {
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
    public function no_display(){
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
    public function no_recom(){
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