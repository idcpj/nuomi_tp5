<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * @param       $url
 * @param int   $type 0 get 1 post
 * @param array $data
 * @return mixed
 */
function dourl($url,$type=0,$data=[]){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//成功至返回结果
	curl_setopt($ch, CURLOPT_HEADER, 0);

	if($type == 1){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}

	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

//日志呼出
function write_log($msg){
	Think\Log::record($msg,\think\Log::INFO,true);
}