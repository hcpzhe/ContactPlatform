<?php
// 建议回复模型
class SugreplyModel extends CommonModel {
    public $_validate	=	array(
    		
        );

    public $_auto		=	array(
    	array('user_id','getUserId',Model:: MODEL_INSERT,'callback'),
    	array('reply_time','time',Model:: MODEL_INSERT,'function'),
    	array('status','1',Model:: MODEL_INSERT),
        );
        
     protected  function getUserId(){
     	return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
     }

}
