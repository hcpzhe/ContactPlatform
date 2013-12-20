<?php
class  News_comment extends CommonModel{
	protected $_validate = array(
		array('news_id','require','新闻ID不存在'),
		array('title','require','请先登录'),
		array('content','require','请先登录'),
		array('member_id','require','请先登录'),
	
	);
	protected  $_auto = array(
		array('member_id','getMemberId',Model:: MODEL_INSERT,'callback'),
		array('create_time','time',Model:: MODEL_INSERT,'function'),
		array('status','2',Model:: MODEL_INSERT),
	
	);

}