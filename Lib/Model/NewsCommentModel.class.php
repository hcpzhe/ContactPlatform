<?php
class  NewsCommentModel extends CommonModel{
	protected $_validate = array(
		array('news_id','require','新闻ID非法'),
		//array('title','require','评论标题不能为空'),
		array('content','require','内容不能为空'),
		array('member_id','require','请先登录'),
	
	);
	protected  $_auto = array(
		array('member_id','getMemberId',Model:: MODEL_INSERT,'callback'),
		array('create_time','time',Model:: MODEL_INSERT,'function'),
		array('status','2',Model:: MODEL_INSERT),
	);

}