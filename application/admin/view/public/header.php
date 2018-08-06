<!--头部文件-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<title><?php if (isset($title)){echo $title.'-';}?>{:Config('syc_webname')}</title>
<meta name="keywords" content="{:Config('syc_keywords')}"/>
<meta name="description" content="{:Config('syc_description')}"/>
<link href="/favicon.ico" type="image/x-icon" rel="icon"/>
<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/assets/plugins/layui/css/layui.css">
<link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/css/console1412.css" rel="stylesheet" type="text/css" />
<link href="/assets/admin/css/sycit.css" rel="stylesheet" type="text/css" />