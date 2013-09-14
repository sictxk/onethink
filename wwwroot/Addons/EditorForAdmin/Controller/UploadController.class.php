<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Addons\EditorForAdmin\Controller;
use Admin\Controller\AddonsController;
use COM\Upload;

class UploadController extends AddonsController{

	/* 上传图片 */
	public function upload(){
		/* 返回标准数据 */
		$return  = array('status' => 1, 'info' => '上传成功', 'data' => '');

		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$Upload = new Upload($setting, 'Local');
		$info   = $Upload->upload($_FILES);
		/* 记录附件信息 */
		if($info){
			$return['data'] = think_encrypt(json_encode($info['attachment']));
		} else {
			$return['status'] = 0;
			$return['info']   = $Upload->getError();
		}

		/* 返回JSON数据 */
		$this->ajaxReturn($return);
	}

}
