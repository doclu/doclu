<?php

namespace app\common\model;

use think\Model;

class Product extends Model
{

	protected $pk     = 'pro_id';
	protected $table  = 'blog_products';
	protected $auto   = [ 'admin_id' ];
	protected $insert = [ 'sendtime' ];
	protected $update = [ 'updatetime' ];

	protected function setAdminIdAttr ( $value )
	{
		return session( 'admin.admin_id' );
	}

	protected function setSendTimeAttr ( $value )
	{
		return time();
	}

	protected function setUpdateTimeAttr ( $value )
	{
		return time();
	}

	/**
	 * 获取宝贝首页数据
	 */
	public function getAll ($is_recycle)
	{
		return db( 'products' )->alias( 'a' )->join( '__CATE__ c' , 'a.cate_id=c.cate_id' )->where( 'a.is_recycle' , $is_recycle )->field( 'a.pro_id,a.pro_title,a.pro_place,a.sendtime,c.cate_name,a.pro_sort' )->order( 'a.pro_sort desc,a.sendtime desc,a.pro_id desc' )->paginate( 5 );

	}

	/**
	 * 添加宝贝
	 */
	public function store ( $data )
	{
		//halt($data);
		if ( !isset( $data[ 'tag' ] ) ) {
			//说明添加的时候没有选择标签
			return [ 'valid' => 0 , 'msg' => '请选择标签' ];
		}
		//验证
		//添加数据库
		$result = $this->validate( true )->allowField( true )->save( $data );
		if ( $result ) {
			//宝贝标签中间表的添加
			foreach ( $data[ 'tag' ] as $v ) {
				$proTagData = [
					'pro_id' => $this->pro_id ,
					'tag_id' => $v ,
				];
				( new ProTag() )->save( $proTagData );
			}

			//执行成功
			return [ 'valid' => 1 , 'msg' => '操作成功' ];
		}
		else {
			return [ 'valid' => 0 , 'msg' => $this->getError() ];
		}
	}

	/**
	 * 宝贝编辑
	 */
	public function edit ( $data )
	{
		$res = $this->validate( true )->allowField( true )->save( $data , [ $this->pk => $data[ 'pro_id' ] ] );
		if ( $res ) {
			//执行标签处理
			//首先将原有的标签数据删除
			(new ProTag())->where('pro_id',$data['pro_id'])->delete();
			//执行添加
			foreach ( $data[ 'tag' ] as $v ) {
				$arcTagData = [
					'pro_id' => $this->pro_id ,
					'tag_id' => $v ,
				];
				( new ProTag() )->save( $arcTagData );
			}
			return [ 'valid' => 1 , 'msg' => '操作成功' ];
		}
		else {
			return [ 'valid' => 0 , 'msg' => $this->getError() ];
		}
	}

	/**
	 * 修改排序
	 */
	public function changeSort ( $data )
	{
		$result = $this->validate(
			[
				'pro_sort' => 'require|between:1,9999' ,
			] , [
			'pro_sort.require' => '请输入排序' ,
			'pro_sort.between' => '排序需要在1-9999之间' ,
		]
		)->save( $data , [ $this->pk => $data[ 'pro_id' ] ] );
		if ( $result ) {
			return [ 'valid' => 1 , 'msg' => '操作成功' ];
		}
		else {
			return [ 'valid' => 0 , 'msg' => $this->getError() ];
		}
	}
	/**
	 * 删除
	 */
	public function del($pro_id)
	{
		if(Product::destroy($pro_id))
		{
			//说明删除成功
			//删除宝贝标签中间表
			(new ProTag())->where('pro_id',$pro_id)->delete();
			return ['valid'=>1,'msg'=>'删除成功'];
		}else{
			//删除失败
			return ['valid'=>0,'msg'=>'删除失败'];
		}
	}

}
