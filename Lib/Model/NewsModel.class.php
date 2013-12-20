<?php
class  NewsModel extends CommonModel{
	public $_validate	=	array(
		array('ctg_id','1,100','请选择信息所属栏目',Model::MUST_VALIDATE,'between'),
		array('title','require','新闻标题必须'),
		array('content','require','新闻标题必须'),    
		array('is_recom','0,1','是否推荐数据非法',Model::EXISTS_VALIDATE,'in'),    
		array('is_display','0,1','是否显示数据非法',Model::EXISTS_VALIDATE,'in'),    
        );

    public $_auto		=	array(
        array('editor','getEditor',self::MODEL_INSERT,'callback'),
        array('status','1',self::MODEL_INSERT),
        );
    /*
     * 
     * 获取添加新闻用户名
     * */
    public function getEditor(){
    	session_start();
    	return $_SESSION['nickname'];
    
    }



}