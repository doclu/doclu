<?php

namespace app\admin\controller;



use houdunwang\wechat\build\Base;
use houdunwang\wechat\WeChat;

class Webset extends Common
{


	//首页
	public function index()
	{
		//获取数据
		$field = db('webset')->select();
		$this->assign('field',$field);
		return $this->fetch();
	}
	/**
	 * 编辑
	 */
	public function edit()
	{
		if(request()->isAjax())
		{
			$res = (new \app\common\model\Webset())->edit(input('post.'));
			if($res['valid'])
			{
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}

		}
	}

	public function handle(){
		if(request()->isPost()){
			$data = input('post.');
			$urls=array_values($data['url']);
//			$urls = array(
//					'http://www.doclu.cn/public/index.html',
//			);
			$api = 'http://data.zz.baidu.com/urls?site=www.doclu.cn&token=L5JDu1pWjPUzR2fX&type=original';
			$ch = curl_init();
			$options =  array(
					CURLOPT_URL => $api,
					CURLOPT_POST => true,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POSTFIELDS => implode("\n", $urls),
					CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
			);
			curl_setopt_array($ch, $options);
			$result = curl_exec($ch);
			if(json_decode($result,true)['success']){
				$this->success('提交成功');
			}else{
				$this->error('提交失败');
			}
		}
		return $this->fetch();


	}

	public function wx(){
		(new Base())->valid();
	}

}
