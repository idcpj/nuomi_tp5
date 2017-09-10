<?php

namespace app\common\model;

use think\Model;

/**
 * 公共方法
 * Class BaseModel
 * @package app\common\model
 */
class BaseModel extends Model
{
	public function add($data){
		$data['status']=0;
		$this->save($data);
		return $this->id;
   } 
}
