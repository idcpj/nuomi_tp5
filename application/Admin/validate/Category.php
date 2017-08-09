<?php
	namespace app\Admin\Validate;

	use think\Validate;

	class Category extends Validate{
		protected $rule=[
			['name','require|max:10','分类名不能为空|分类名不能或超过10个字符'],
			['parent_id','number'],
			['id','number'],
			['status','number|in:-1,0,1','状态必须为数字|状态范围不合法'],
			['listorder','number']
		];

		//场景设置
		protected $scene=[
			'add'=>['name','parent_id','id'],//对添加场景设置 add为方法名
			'listorder'=>['id','listorder'],//对排序进行设置,
			'status'=>['id','status']
		];
	}