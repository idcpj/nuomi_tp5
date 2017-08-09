<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {

    	return $this->fetch();
    }

	public function test(){
		//$res  = \Map::getLngLat("宁波天裕");
		//print_r($res);
		//header('Content-type:image/jpg;charset:utf-8');
		$url = \Map::staticimage("宁波万达");
		echo "<img src='{$url}' />  ";

    }
}
