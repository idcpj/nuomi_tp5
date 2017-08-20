<?php
namespace app\bis\controller;

use app\common\model\Bis;
use app\common\model\City;
use think\Controller;

class Register extends Controller
{
	private $city;
	private $category;
	private $bis;
	private $location;

	public function _initialize(){
		$this->city=model("City");
		$this->category=model("Category");
		$this->bis=model("Bis");
		$this->location=model("Location");
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
		//获取数据
		$data=input("post.");
		//print_r($data);
		//校验
		//$validate = $this->validate($data, "Bis.add");
		//if(true !== $validate){
		//	$this->error($validate);
		//}
		//获取经纬度
		$getlant = \Map::getLngLat($data['address']);
		if(empty($getlant) || $getlant['status'] !=0 || $getlant['result']['precise']!=1){
			$this->error("无法获取数据");
		}
		//商户信息入户
		$bisData=[
			'name'=>$data['name'],
			'city_id'=>$data['city_id'],
			'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'logo'=>$data['logo'],
			'licence_logo'=>$data['licence_logo'],
			'description'=>empty($data['description'])?'':$data['description'],
			'bank_info'=>$data['bank_info'],
			//'bank_user'=>$data['bank_user'],
			'bank_name'=>$data['bank_name'],
			'faren'=>$data['faren'],
			'faren_tel'=>$data['faren_tel'],
			'email'=>$data['email'],
		];
		$bisId =$this->bis->add($bisData);
		//总店信息入库
		$data['cat']='';
		if(!empty($data['se_category_id'])){
			$data['cat']=implode('|', $data['se_category_id']);
		}
		$bisId=1;
		$locationData = [
			'bis_id'=>$bisId,
			'name'=>$data['tel'],
			'contact'=>$data['contact'],
			'category_id'=>$data['category_id'],
			'category_path'=>$data['category_id'].','.$data['cat'],
			'content'=>empty($data['content'])?'':$data['content'],
			'is_main'=>1,
			'xpoint'=>empty($getlant['result']['location']['lng'])?'':$getlant['result']['location']['lng'],
			'ypoint'=>empty($getlant['result']['location']['lat'])?'':$getlant['result']['location']['lat'],
		];
		dump($locationData);

		$bisLocationId= $this->location->add($data);
		print_r($bisId);
		//账户信息效验



	}
}