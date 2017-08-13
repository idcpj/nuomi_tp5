<?php
namespace app\bis\controller;

use app\common\model\City;
use think\Controller;

class Register extends Controller
{
	private $city;

	public function _initialize(){
		$this->city=model("city");
	}
	public function index(){
		//获取一级城市列表
		$citys = $this->city->getNormalCityByParentId();
		return $this->fetch('',[
			'citys'=>$citys,
		]);
	}
}