<?php
class News_categoryModel extends CommonModel{
	//自动验证
	protected $_validate = array(
		array('name','require','栏目名称必须'),
		array('type','1,2','栏目类型非法',Model::EXISTS_VALIDATE,'in'),
		array('rank','0,4000','排序在0到4000之间',Model::EXISTS_VALIDATE,'between'),
		array('is_display','0,1','是否显示数据非法',Model::EXISTS_VALIDATE,'in'),
		array('is_index','0,1','是否首页显示数据非法',Model::EXISTS_VALIDATE,'in'),   
	);
	//自动完成
	protected $_auto = array(
		array('status','1',Model:: MODEL_INSERT),
	);



}