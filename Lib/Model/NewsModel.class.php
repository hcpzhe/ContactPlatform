<?php
class  NewsModel extends CommonModel{
	public $_validate	=	array(
		array('ctg_id','1,100','请选择信息所属栏目',self::MUST_VALIDATE,'between'),
		array('title','require','新闻标题必须'),
		array('content','require','新闻内容必须'),    
		//array('is_pic','0,1','是否图片数据非法',self::EXISTS_VALIDATE,'in'),    
		//array('is_recom','0,1','是否推荐数据非法',self::EXISTS_VALIDATE,'in'),    
		//array('is_display','0,1','是否显示数据非法',self::EXISTS_VALIDATE,'in'),    
        );

    protected $_auto		=	array(
        array('editor','getEditor',self::MODEL_INSERT,'callback'),
        array('is_pic','is_pic',self::MODEL_BOTH,'callback'),
        array('is_recom','is_recom',self::MODEL_BOTH,'callback'),
        array('is_display','is_display',self::MODEL_BOTH,'callback'),
        array('status','1',1),
        array('create_time','time',self::MODEL_INSERT,'function'),
        array('update_time','time',self::MODEL_BOTH,'function'),
        );
    /*
     * 
     * 获取添加新闻用户名
     * */
    public function getEditor(){
    	return $_POST['editor']?$_POST['editor']:$_SESSION['nickname'];
    }
    protected function is_pic(){
    	return	empty($_REQUEST['is_pic'])?0:1;
    }
    protected function is_recom(){
    	return	empty($_REQUEST['is_recom'])?0:1;
    }
    protected function is_display(){
    	return	empty($_REQUEST['is_display'])?0:1;
    }



}