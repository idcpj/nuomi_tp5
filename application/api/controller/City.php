<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class City extends Controller
{
	private $obj;

	public function _initialize(){
		$this->obj=model("City");
	}

	public function getCitysByParentId(){
		$id = input('post.id');
		if(empty($id)){
			$this->error("ID不合法");
		}
		$citys = $this->obj->getNormalCityByParentId($id);
		if(empty($citys)){
			return show(0,'error');
		}
		return show(1, "success",$citys);
    }
}
