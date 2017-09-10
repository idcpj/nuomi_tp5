<?php
namespace app\common\model;



class Category extends BaseModel

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

	//通过父id获取城市列表
	public function getFirstCategory($parentId = 0){
		$where=[
			'status'=>1,
			'parent_id'=>$parentId,
		];
		$order=[
			'id'=>'desc',
		];
		return $this->where($where)->order($order)->select();
	}
	//首页获取一级目录(分页)
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