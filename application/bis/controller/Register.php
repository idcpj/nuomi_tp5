<?php
namespace app\bis\controller;

use app\common\model\City;
use think\Controller;

class Register extends Controller
{
	private $city;
	private $category;

	public function _initialize(){
		$this->city=model("City");
		$this->category=model("Category");
	}
	public function index(){
		//获取一级城市列表
		$citys = $this->city->getNormalCityByParentId();
		$cate  = $this->category->getFirstCategorys();
		return $this->fetch('',[
			'citys'=>$citys,
			'cate'=>$cate,
		]);
	}

	//添加
	public function add(){
		if(!$this->request->isPost()){
			$this->error("非法访问");
		}
		$data=input("post.");
		//print_r($data);
		$validate = $this->validate($data, "Bis.add");
		if(true !== $validate){
			$this->error($validate);
		}


	}
}