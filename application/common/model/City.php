<?php

namespace app\common\model;

use think\Model;

class City extends Model{

	//通过父id获取城市列表
	public function getNormalCityByParentId($parentId = 0){
		$where = [
			'status'    => 1,
			'parent_id' => $parentId,
		];
		$order = [
			'id' => 'desc',
		];

		return $this->where($where)->order($order)->select();
	}
}


