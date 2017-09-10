<?php
namespace app\bis\controller;

use app\common\model\Bis;
use app\common\model\City;
use think\Controller;
use think\Env;

class Register extends Controller
{
	private $city;
	private $category;
	private $bis;
	private $location;
	private $bisAccount;

	public function _initialize(){
		$this->city=model("City");
		$this->category=model("Category");
		$this->bis=model("Bis");
		$this->location=model("Location");
		$this->bisAccount=model("BisAccount");
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
		$res =  input('post.captcha');
		dump(captcha_check($res));
		exit;
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
		if(empty($getlant) || $getlant['status'] !=0 ){
			$this->error("无法获取数据");
		}
		//判断用户是否存在
		$accountResult = Model('BisAccount')->get(['username'=>$data['username']]);
		if($accountResult){
			$this->error("该用户存在");
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

		$this->location->add($locationData);

		//自动生成密码加盐
		$data['code']=mt_rand(100,999);
		//账户信息效验
		$accountData = [
			'bis_id'=>$bisId,
			'username'=>$data['username'],
			'password'=>md5($data['password'].$data['code']),
			'is_main'=>1,
		];
		$accountId = $this->bisAccount->add($accountData);
		if(!$accountId){
			$this->error("审核失败");
		}
		//发送邮件 -测试失败
		//sendMail('15726817105@163.com','陈鹏杰','zhe shi is ceshi','asdsdasdasdas');



	}
}