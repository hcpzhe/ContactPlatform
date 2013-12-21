<?php
// 建议模型
class SuggestModel extends CommonModel {
    public $_validate	=	array(
    		array('title','require','建议标题必须'),
    		array('reply_type','1,2,3,4','回复方式不正确',Model::EXISTS_VALIDATE,'in'),
    		array('content','require','建议内容必须'),
        );

    public $_auto		=	array(
    		array('member_id','getMemberId',Model:: MODEL_INSERT,'callback'),
    		array('create_time','time',Model:: MODEL_INSERT,'function'),
    		array('status','2',Model:: MODEL_INSERT),
        );

}
