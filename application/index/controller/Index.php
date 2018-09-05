<?php
namespace app\index\controller;


class Index extends Common
{
    public function index()
    {
		$headConf = ['title'=>'商品分类'];
		$this->assign('headConf',$headConf);
		//获取文章数据
		$articleData = db('products')->alias('a')
			->join('__CATE__ c','a.cate_id=c.cate_id')->where('a.is_recycle',2)->order('sendtime desc')->select();
		//halt($articleData);
		foreach($articleData as $k=>$v)
		{
			$articleData[$k]['tags'] = db('pro_tag')->alias('at')
				->join('__TAG__ t','at.tag_id=t.tag_id')
				->where('at.pro_id',$v['pro_id'])->field('t.tag_id,t.tag_name')->select();
		}
		//halt($articleData);
		$this->assign('articleData',$articleData);
		return $this->fetch();
    }

	public function location(){

		$headConf = ['title'=>'宝贝分类管理'];
		$this->assign('headConf',$headConf);
		return $this->fetch();
	}
}
