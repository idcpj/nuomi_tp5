<?php
namespace app\bis\controller;

use think\Controller;

class Register extends Controller
{
	public function index(){
		//获取一级城市列表

		return $this->fetch();
	}
}