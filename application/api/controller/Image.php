<?php
namespace app\api\controller;

class Image
{
	public function upload(){
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file');
		$savePath=DS . 'uploads' . DS . request()->module() . DS . request()->controller();
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->validate([
				'size' => 15678,
				'ext'  => 'jpg,png,gif',
			])->move( ROOT_PATH . 'public' . $savePath);
		if($info &&$info->getPathname()){
			return show(1, "success",$savePath.DS.$info->getSaveName());
		}
		return show(0, 'upload error');
	}

}