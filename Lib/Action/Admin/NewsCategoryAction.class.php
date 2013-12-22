<?php
//新闻分类
class NewsCategoryAction extends CommonAction {

    /**
     * 新增页面
     */
    public function add() {
    	$news_category_M = M('News_category');
    	$category_list = $news_category_M->where('status>0')->select();
    	$this -> assign('category_list',$category_list);
    	$this->display();
    }
    
    /**
     * 新增接口
     */
    public function insert() {
    	$news_category_M = D('News_category');
    	if (false === $news_category_M->create()){
    		//自动验证不通过
    		$this->error($news_category_M->getError());
    	}else {
    		if ($news_category_M->add()){
    			//添加成功
    			$this->success('栏目添加成功',__GROUP__.'/NewsCategory/index');
    		}else{
    			//添加失败
    			$this->error('栏目添加失败');
    		}
    	}
    	
    }
    
    /**
     * 编辑查看
     */
    public function read() {
    	$News_category_M = M('News_category');
        $id = $_REQUEST [$News_category_M->getPk()];
        $vo = $News_category_M->getById($id);
        $this->assign('vo', $vo);
    	$this->display();
    }

    /**
     * 更新修改接口
     * 必须传递主键ID
     */
    public function update() {
    	$News_category_M = D('News_category');
   		 if (false === $News_category_M->create()) {
            $this->error($News_category_M->getError());
        }
        // 更新数据
        $list = $News_category_M->save();
        if (false !== $list) {
            //成功提示
            $this->success('编辑成功!',__GROUP__.'/NewsCategory/index');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }
}