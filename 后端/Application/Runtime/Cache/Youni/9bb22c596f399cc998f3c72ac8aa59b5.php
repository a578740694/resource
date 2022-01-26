<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title><?php echo ($config); ?>总后台</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/common/lib/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/Public/admin/css/admin.min.css" media="all">
</head>

<body class="layui-layout-body">

  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite><?php echo ($_SESSION['adminuser']['name']); ?></cite>
            </a>
            <dl class="layui-nav-child">
              <dd>
                <a lay-href="/Youni/Admin/add">基本资料</a>
              </dd>
              <dd>
                <a lay-href="/Youni/Admin/add">修改密码</a>
              </dd>
			  <dd>
                <a lay-href="/Youni/Admin/admin">清理缓存</a>
              </dd>
              <hr>
              <dd style="text-align: center;">
                <a href="<?php echo U('Public/loginOut');?>">退出</a>
              </dd>
            </dl>
          </li>

          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        
        </ul>
      </div>

      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="">
            <span><?php echo ($config); ?>总后台</span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-this">
                <a href="javascript:;" lay-href="/Youni/Index/home" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>主页</cite>
              </a>
            </li>
            
            <li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="系统设置" lay-direction="2">
                <i class="layui-icon layui-icon-set"></i>
                <cite>系统设置</cite>
              </a>
                <dl class="layui-nav-child">
                
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Config/add">基本设置</a>
                    </dd>
					<dd>
                        <a href="javascript:;" lay-href="/Youni/Config/qiandao">签到设置</a>
                    </dd>
					<dd>
                        <a href="javascript:;" lay-href="/Youni/Config/weixin">广告设置</a>
                    </dd>
					 <dd>
                       <a href="javascript:;" lay-href="/Youni/Config/wenti">规则说明</a> 
                    </dd>
					
					 
					
					
                </dl>
            </li>
			<li data-name="home" class="layui-nav-item">
                <a href="javascript:;" lay-href="/Youni/Tan/add" lay-tips="弹窗设置" lay-direction="2">
                <i class="layui-icon layui-icon-circle-dot"></i>
                <cite>弹窗设置</cite>
              </a>
            </li>
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="轮播管理" lay-direction="2">
                <i class="layui-icon layui-icon-carousel"></i>
                <cite>轮播管理</cite>
              </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Adver/add">添加轮播</a>
                    </dd>
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Adver/index">轮播列表</a>
                    </dd>
                </dl>
            </li>
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="分类管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>分类管理</cite>
				</a>
                <dl class="layui-nav-child">
                
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Type/add">添加分类</a>
                    </dd>
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Type/index">分类列表</a>
                    </dd>
                </dl>
            </li>
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="卡密管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>卡密管理</cite>
              </a>
                <dl class="layui-nav-child">
                
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Kami/add">添加卡密</a>
                    </dd>
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Kami/index">卡密列表</a>
                    </dd>
					
					<dd>
                        <a href="javascript:;" lay-href="/Youni/Kami/jilu">使用记录</a>
                    </dd>
					
                </dl>
            </li>
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="资源管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>资源管理</cite>
				</a>
                <dl class="layui-nav-child">
                
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Reso/add">添加资源</a>
                    </dd>
                    <dd>
                        <a href="javascript:;" lay-href="/Youni/Reso/index">资源列表</a>
                    </dd>
                </dl>
            </li>
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="更多好玩" lay-direction="2">
                <i class="layui-icon layui-icon-user"></i>
                <cite>更多好玩</cite>
              </a>
                <dl class="layui-nav-child">
					<dd>
                        <a href="javascript:;" lay-href="/Youni/Link/add">添加外链</a>
                    </dd>
                <dd>
                        <a href="javascript:;" lay-href="/Youni/Link/index">外链列表</a>
                    </dd>
                </dl>
            </li>
			
		
			<li data-name="add" class="layui-nav-item">
                <a href="javascript:;" lay-tips="用户管理" lay-direction="2">
                <i class="layui-icon layui-icon-user"></i>
                <cite>用户管理</cite>
              </a>
                <dl class="layui-nav-child">
					<dd>
                        <a href="javascript:;" lay-href="/Youni/User/index">用户管理</a>
                    </dd>
                
                </dl>
            </li>
			
			
			
        </ul>
    </div>
</div>

      <!-- 页面标签 -->

      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="/Youni/Index/home" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>

      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

 <script src="/Public/common/lib/layui/layui.js"></script>
 <script type="text/javascript" src="/Public/common/lib/jquery/jquery-3.3.1.min.js"></script>
 <script type="text/javascript" src="/Public/common/lib/jquery/jquery.cookie.js"></script>
  <script>
    layui.config({
      base: '/Public/admin/js/' //静态资源所在路径
    }).extend({
      index: 'lib/index' //主入口模块
    }).use('index');
  </script>
</body>

</html>