<?php
class NewsCategoryAction extends CommonAction{
	/*
	 * 指定栏目新闻列表信息
	 */
	public function inMemList(){
		
		$id = $_REQUEST[id];
		if (!empty($id)){
			$news_category_M = M('NewsCategory');
			$category_name = $news_category_M->where("id=%d",$id)->getField("name");
			//栏目名称
			$this->assign('category_name',$category_name);
			$news_M = M('News');
			$count = $news_M -> where("status>0 AND ctg_id=%d",$id)->count();
			//导入分页类
			import('@.ORG.Util.Page');
			$p = new Page($count,15);
			$news_list = $news_M-> where("status>0 AND ctg_id=%d",$id)->limit($p->firstRow.','.$p->listRows)->select();
			$page = $p->show();
			
			//给模板赋值
			$this->assign('news_list',$news_list);
			$this->assign('page',$page);
			$this->display();	
		
		}
	}
}