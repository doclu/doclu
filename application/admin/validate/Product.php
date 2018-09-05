<?php

namespace app\admin\validate;

use think\Validate;

class Product extends Validate
{
	protected $rule = [
		'pro_title'=>'require',

        'pro_sort'=>'require|between:1,9999',
        
		'cate_id'=>'notIn:0',
		'pro_thumb'=>'require',

		'pro_pricein'=>'require',
		'pro_url'=>'require',

	];
	protected $message = [
		'pro_title.require'=>'请输入宝贝标题',

		'pro_sort.require'=>'请输入宝贝排序',
        'pro_sort.between'=>'宝贝排序需在1-9999之间',
        
		'cate_id.notIn'=>'请选择宝贝分类',
		'pro_thumb.require'=>'请上传宝贝图片',
		'pro_pricein.require'=>'请输入宝贝进价',
		'arc_url.require'=>'请输入宝贝链接',
	];
}