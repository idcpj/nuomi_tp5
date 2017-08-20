<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class Category extends Controller
{
	protected $category;

	public function _initialize(){
		$this->category=model("category");
	}
	public function getategoryByParentId(){
		$id = input("post.id");
		if(empty($id)){
			$this->error("ID不合法");
		}
		$cate = $this->category->getFirstCategory($id);
		if(empty($cate)){
			return show(0, "error");
		}
		return show(1, "success",$cate);

    }
}
