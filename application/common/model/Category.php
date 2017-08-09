<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{

	public function getStatusAttr($value){
		$status = [
			1  => "<span class=\"label label-success radius\">正常</span>",
           -1 => "<span class=\"label label-danger radius\">删除</span>",
			0 => "<span class=\"label label-label-success radius\">隐藏</span>",
		];
		return $status[$value];
	}
	// 在databases.php 开启时间戳
	public function add($data){
		$data['status']=1;
		return $this->save($data);//添加
	}

	//添加页获取一级目录
	public function getFirstCategory(){
		$where=[
			'status'=>1,
			'parent_id'=>0,
		];
		$order=[
			'id'=>'desc',
		];
		return $this->where($where)->order($order)->select();
	}
	//首页获取一级目录
	public function getFirstCategorys($parentId=0){
		$where=[
			'status'=>['neq',-1],
			'parent_id'=>$parentId,
		];
		$order=[
			'listorder'=>'desc',
			'id'=>'desc',
		];
		return $this->where($where)->order($order)->paginate();
	}


}