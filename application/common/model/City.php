<?php

namespace app\common\model;


class City extends BaseModel{


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


