<?php

namespace app\index\controller;


use app\common\model\Category;

class Lists extends Common
{
    //首页
	public function index()
	{
		$headConf = ['title'=>'分类列表'];
		$this->assign('headConf',$headConf);
		//获取左侧第一部分数据
		$cate_id = input('param.cate_id');
		$tag_id = input('param.tag_id');
		if($cate_id)
		{
			//当前分类所有子集分类id
			$cids = (new Category())->getSon(db('cate')->select(),$cate_id);
			$cids[] = $cate_id;//把自己追加进去
			$headData = [
				'title'=>'分类',
				'name'=>db('cate')->where('cate_id',$cate_id)->value('cate_name'),
				'total'=>db('products')->whereIn('cate_id',$cids)->count(),
			];
			//获取文章数据
			$articleData = db('products')->alias('a')
				->join('__CATE__ c','a.cate_id=c.cate_id')->where('a.is_recycle',2)->whereIn('a.cate_id',$cids)->select();
		}
		if($tag_id)
		{
			$headData = [
				'title'=>'标签',
				'name'=>db('tag')->where('tag_id',$tag_id)->value('tag_name'),
				'total'=>db('pro_tag')->where('tag_id',$tag_id)->count(),
			];
			//获取文章数据
			$articleData = db('products')->alias('a')
				->join('__PRO_TAG__ at','a.pro_id=at.pro_id')
				->join('__CATE__ c','a.cate_id=c.cate_id')
				->where('a.is_recycle',2)->where("at.tag_id",$tag_id)->select();

		}
		foreach($articleData as $k=>$v)
		{
			$articleData[$k]['tags'] = db('pro_tag')->alias('at')
				->join('__TAG__ t','at.tag_id=t.tag_id')
				->where('at.pro_id',$v['pro_id'])->field('t.tag_id,t.tag_name')->select();
		}
		$this->assign('headData',$headData);
		$this->assign('articleData',$articleData);
		return $this->fetch();
	}
}
