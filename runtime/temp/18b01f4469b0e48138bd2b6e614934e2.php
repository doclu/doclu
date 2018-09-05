<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"/Applications/MAMP/htdocs/mesunglo/public/../application/admin/view/product/recycle.html";i:1536113833;s:77:"/Applications/MAMP/htdocs/mesunglo/public/../application/admin/view/base.html";i:1536111852;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>商品分类管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="__STATIC__/admin/bootstrap-3.3.0-dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/admin/css/site.css" rel="stylesheet">
    <link href="__STATIC__/admin/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="__STATIC__/admin/js/jquery.min.js"></script>
    <script src="__STATIC__/admin/bootstrap-3.3.0-dist/dist/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>
    <style>
        i {
            color: #337ab7;
        }
    </style>
    <script>
        //模块配置项
        var hdjs = {
            //框架目录
            'base': '__STATIC__/node_modules/hdjs',
            //上传文件后台地址
            'uploader': "<?php echo url('system/component/uploader'); ?>",
            //获取文件列表的后台地址
            'filesLists': " <?php echo url('system/component/filesLists'); ?>?",
        };
    </script>
    <script src="__STATIC__/node_modules/hdjs/app/util.js"></script>
    <script src="__STATIC__/node_modules/hdjs/require.js"></script>
    <script src="__STATIC__/node_modules/hdjs/config.js"></script>
</head>
<body>
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <h4 style="display: inline;line-height: 50px;float: left;margin: 0px"><a href="index.html" style="color: white;margin-left: -14px">服装宝贝分类系统</a>
                </h4>
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="http://www.hznzcn.com/" target="_blank"><i class="fa fa-w fa-file-code-o"></i>
                                杭州女装网</a>
                        </li>
                        <li>
                            <a href="http://www.wsy.com/" target="_blank"><i class="fa fa-w fa-file-code-o"></i>
                                网商园</a>
                        </li>
                        <li>
                            <a href="http://571xz.com/" target="_blank"><i class="fa fa-w fa-file-code-o"></i>
                                四季星座网 </a>
                        </li>
                        <li>
                            <a href="mesunlo.com" target="_blank"><i class="fa fa-w fa-file-code-o"></i>
                                前台首页 </a>
                        </li>

                    </ul>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>
                            <?php echo session('admin.admin_username'); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('admin/entry/pass'); ?>">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--导航end-->
</div>
<!--主体-->
<div class="container-fluid admin_menu">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 left-menu">
            <div class="panel panel-default" id="menus">
                <!--栏目管理 start-->
                <div class="panel-heading" role="button" data-toggle="collapse" href="#collapseExample"
                     aria-expanded="false" aria-controls="collapseExample"
                     style="border-top: 1px solid #ddd;border-radius: 0%">
                    <h4 class="panel-title">分类管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus collapse in" id="collapseExample">
                    <a href="<?php echo url('admin/category/index'); ?>" class="list-group-item">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        <span class="pull-right" href=""></span>
                        分类列表
                    </a>
                </ul>
                <!--栏目管理 end-->

                <!--标签管理 start-->
                <div class="panel-heading" role="button" data-toggle="collapse" href="#collapseExample2"
                     aria-expanded="false" aria-controls="collapseExample">
                    <h4 class="panel-title">标签管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="#collapseExample2" aria-expanded="true">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus collapse in" id="collapseExample2">
                    <a href="<?php echo url('admin/tag/index'); ?>" class="list-group-item">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <span class="pull-right" href=""></span>
                        标签列表
                    </a>
                </ul>
                <!--标签管理 end-->

                <!--文章管理 start-->
                <div class="panel-heading" role="button" data-toggle="collapse" href="#collapseExample3"
                     aria-expanded="false" aria-controls="collapseExample">
                    <h4 class="panel-title">宝贝管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="#collapseExample3" aria-expanded="true">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus collapse in" id="collapseExample3">
                    <a href="<?php echo url('admin/product/index'); ?>" class="list-group-item">
                        <i class="fa fa-align-center" aria-hidden="true"></i>
                        <span class="pull-right" href=""></span>
                        宝贝列表
                    </a>
                    <a href="<?php echo url('admin/product/recycle'); ?>" class="list-group-item">
                        <i class="fa fa-recycle" aria-hidden="true"></i>
                        <span class="pull-right" href=""></span>
                        回收站
                    </a>
                </ul>
                <!--文章管理 end-->
             
                
            </div>
        </div>
        <!--右侧主体区域部分 start-->
        <div class="col-xs-12 col-sm-9 col-lg-10">
            
<ol class="breadcrumb" style="background-color: #f9f9f9;padding:8px 0;margin-bottom:10px;">
    <li>
        <a href=""><i class="fa fa-cogs"></i>
            宝贝管理</a>
    </li>
    <li class="active">
        <a href="">回收站</a>
    </li>
</ol>
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#tab1">回收站</a></li>
</ul>
<form action="" method="post">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="5%">编号</th>
                    <th>宝贝名称</th>
                    <th>宝贝作者</th>
                    <th width="5%">排序</th>
                    <th>所属分类</th>
                    <th>添加时间</th>
                    <th width="200">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($field) || $field instanceof \think\Collection || $field instanceof \think\Paginator): if( count($field)==0 ) : echo "" ;else: foreach($field as $key=>$vo): ?>
                <tr>
                    <td><?php echo $vo['pro_id']; ?></td>
                    <td><?php echo $vo['pro_title']; ?></td>
                    <td><?php echo $vo['pro_place']; ?></td>
                    <td>
                        <input type="text" class="form-control" value="<?php echo $vo['pro_sort']; ?>" onblur="changeSort(this,<?php echo $vo['pro_id']; ?>)">
                    </td>
                    <td><?php echo $vo['cate_name']; ?></td>
                    <td><?php echo date('Y-m-d',$vo['sendtime']); ?></td>
                    <td>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">操作 <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="<?php echo url('outToRecycle',['pro_id'=>$vo['pro_id']]); ?>">恢复数据</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:;" onclick="del(<?php echo $vo['pro_id']; ?>)">删除</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<div class="pagination pagination-sm pull-right">
    <?php echo $field->render(); ?>
</div>
<script>
    //删除
    function del(pro_id) {
        util.confirm('确定删除吗?',function(){
           location.href = "<?php echo url('del'); ?>" + '?pro_id='+pro_id;
        })
    }
    //修改排序
    function changeSort(obj,pro_id)
    {
        //获取修改完成之后的排序值
        var pro_sort = $(obj).val();
//        alert(sort);
//        alert(pro_id);
        $.post("<?php echo url('changeSort'); ?>",{pro_sort:pro_sort,pro_id:pro_id},function(res){
            if(res.code)
            {
                //执行成功
                util.message(res.msg,'refresh','success');
            }else{
                //执行失败
                util.message(res.msg,'back','error');
            }
        },'json')
    }
</script>

        </div>
    </div>
    <!--右侧主体区域部分结束 end-->
</div>
</div>

</body>
</html>
