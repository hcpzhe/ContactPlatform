<?php
//新闻
class NewsAction extends CommonAction {

    //过滤查询条件
    public function _filter(){
    	if (!empty($_POST['txtsearch'])){
    		$map['title'] = array('like',"%".$_POST['txtsearch']."%");
    	}
    }
    
    /**
     * 新增页面
     */
    public function add() {
    	$this->display();
    }
    
    /**
     * 新增接口
     */
    public function insert() {
    	$news_M = D('News');
    	
    	if (false !== $news_M->create()){
    		
    		if ($news_M->add()){
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
    
}