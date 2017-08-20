<?php

namespace app\common\model;

use think\Model;

class Bis extends Model
{
	public function add($data){
		$data['status']=0;//待审核
		$this->save($data);
		return $this->id;//获取新增id
    }
}
