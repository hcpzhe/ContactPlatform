<?php
import("ORG.Net.UploadFile");

class RSUpload {
	
	private $UpFileObj;
	
    private $config =   array(
        'maxSize'           =>  3145728,    // 3Mb  上传文件的最大值  byte
        'supportMulti'      =>  true,    // 是否支持多文件上传
        'allowExts'         =>  array(),    // 允许上传的文件后缀 留空不作后缀检查
        'allowTypes'        =>  array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg'),    // 允许上传的文件类型 留空不做检查
        'thumb'             =>  false,    // 使用对上传图片进行缩略图处理
        'imageClassPath'    =>  'ORG.Util.Image',    // 图库类包路径
        'thumbMaxWidth'     =>  '',// 缩略图最大宽度
        'thumbMaxHeight'    =>  '',// 缩略图最大高度
        'thumbPrefix'       =>  'thumb_',// 缩略图前缀
        'thumbSuffix'       =>  '',
        'thumbPath'         =>  '',// 缩略图保存路径
        'thumbFile'         =>  '',// 缩略图文件名
        'thumbExt'          =>  '',// 缩略图扩展名        
        'thumbRemoveOrigin' =>  false,// 是否移除原图
        'thumbType'         =>  1, // 缩略图生成方式 1 按设置大小截取 0 按原图等比例缩略
        'zipImages'         =>  false,// 压缩图片文件上传
        'autoSub'           =>  false,// 启用子目录保存文件
        'subType'           =>  'hash',// 子目录创建方式 可以使用hash date custom
        'subDir'            =>  '', // 子目录名称 subType为custom方式后有效
        'dateFormat'        =>  'Ymd',
        'hashLevel'         =>  1, // hash的目录层次
        'savePath'          =>  '',// 上传文件保存路径
        'autoCheck'         =>  true, // 是否自动检查附件
        'uploadReplace'     =>  false,// 存在同名是否覆盖
        'saveRule'          =>  'uniqid',// 上传文件命名规则
        'hashType'          =>  'md5_file',// 上传文件Hash规则函数名
        );
        
    public function __construct($config=array()) {
    	// TODO 插入数据库配置或项目配置
        if(is_array($config)) {
            $this->config   =   array_merge($this->config,$config);
        }
    	$this->UpFileObj = new UploadFile($this->config);
    }
    
	public function __call($name, $arguments){
		return $this->UpFileObj->{$name}($arguments);
	}
}
