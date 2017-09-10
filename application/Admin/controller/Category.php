<?php

namespace app\admin\controller;

use think\Controller;
use think\Log;

class Category extends Controller
{
	private $category;//实例化Category

	public function _initialize(){
		$this->category=model("Category");
	}

    public function index()
    {

    	$parentId = input('parent_id',0,'intval');
    	$firsts = $this->category->getFirstCategorys($parentId);
        return $this->fetch('',[
        	'categorys'=>$firsts,
        ]);
    }
    //添加页面
    public function add()
    {
    	//获取父类id
		$Category = $this->category->getFirstCategory();

        return $this->fetch('',[
        	'categorys'=>$Category,
        ]);
    }
	//保存数据
	public function save()
	{
		if(!request()->isPost()){
			$this->error("请求失误");
		}

		$data = input('post.');
		//验证
		$category = validate('Category');
		if(!$category->scene('add')->check($data)){
			 $this->error($category->getError());
		}
		if(!empty($data['id'])){
			return $this->update($data);
		}
		//$data 提交给model
		$res  = $this->category->add($data);
		if(!$res){
			$this->error("新增失败");
		}
		$this->success("添加成功");
	}

    public function edit()
    {
    	$id = input('get.id');
    	if(intval($id)<1){
    		$this->error("参数错误");
	    }
    	$category = $this->category->get($id);
    	$categorys= $this->category->getFirstCategory();
        return $this->fetch('',[
        	'hello'=>"word",
	        'category'=>$category,
        	'categorys'=>$categorys,
        ]);
    }

    //更新栏目名
	private function update($data){
		$res =  $this->category->update($data);//更新有主键直接进行更新
		if($res ===false){
			$this->error("更新失败");
		}else{
			$this->success("更新成功");
		}
	}

	//排序
	public function listorder($id,$value){
		$res = $this->category->save(['listorder'=>$value],['id'=>$id]);
		if($res ===false){
			$this->result($_SERVER['HTTP_REFERER'],301,"添加失败");
		}else{
			$this->result($_SERVER['HTTP_REFERER'],200,"添加成功");
		}
	}

	public function status(){
		$data=input('get.');
		if(empty($data['id'])){
			$this->result($_SERVER['HTTP_REFERER'],301,'非法访问');
		}
		$res = $this->validate($data, 'Category.status');
		if($res!==true){
			 $this->result($_SERVER['HTTP_REFERER'],303,$res);
		}
		$res =$this->category->where(['id'=>$data['id']])->setField('status',$data['status']);
		if($res ===false){
			$this->result($_SERVER['HTTP_REFERER'],302,'更改失败');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],200,'更改成功');
		}
	}


}
