<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<title>控制台登陆-{:Config('syc_webname')}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<link href="/favicon.ico" type="image/x-icon" rel="icon"/>
<link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/admin/style/login2017.css">
<link rel="stylesheet" href="/assets/admin/css/components.css">
</head>
<body>
<div class="login-2017">
    <!--顶部 开始-->
    <div class="login-2017-topbar">
        <span class="login-2017-topbar-logo" style="font-size:22px;color:#fff;line-height:60px;padding-left:10px;">
            {:Config('syc_webname')}
        </span>
        <ul class="login-2017-link">
            <li>
                <a href="javascript:;">返回首页</a>
            </li>
        </ul>
    </div>
    <!--顶部 结束-->
    <div class="login-2017-body">
        <div class="login-2017-body-box">
            
            <!--登录框-->
            <div class="login-do">
                <form id="login-form" class="form clr style-type-vertical" method="post">
                    <div class="title" style="width:100%;">{:Config('syc_webname')}</div>
                    <div id="success"></div>
                    <div id="login-content" class="form clr">
                        <dl>
                            <dd id="fm-login-id-wrap" class="fm-field">
                                <div class="fm-field-wrap ">
                                    <input id="fm-login-id" class="fm-text" value="<?php echo $user['user_name'];?>" name="username" tabindex="1" placeholder="登录账户">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dd id="fm-login-password-wrap" class="fm-field">
                                <div class="fm-field-wrap">
                                    <input id="fm-login-password" class="fm-text" type="password" value="<?php echo $user['user_pwd'];?>" name="password" placeholder="登录密码">
                                </div>
                            </dd>
                        </dl>
                         <dl>
                            <dd id="fm-login-remember-wrap" style="text-align: left;" class="fm-field">
                                <div class="fm-field-wrap" style="text-align: left;">
                                <?php if (empty($user['user_name']) && empty($user['user_name'])){?>
                                    <label for="remember" style="text-align: left;"><input type="checkbox" name="remember" value="1" id="remember"/> 记住登录账号!</label>
                                <?php }else{?>
                                <label for="remember" style="text-align: left;"><input type="checkbox" checked="checked" name="remember" value="1" id="remember"/> 记住登录账号!</label>
                                <?php }?>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div id="login-submit">
                        <input id="fm-login-submit" value="登录" class="fm-button fm-button1 fm-submit" type="submit">
                        <input id="fm-login-submit" value="重置" class="fm-button fm-button2" type="reset">
                    </div>
                    <p style="margin-top:10px;">Power by CSUN(SICHUAN) CHEMICAL CO., LTD</p>
					<p style="margin-top:10px;">服务热线：{:config('syc_tousu')}</p>
                    <input type="hidden" name="token" value="{$Request.token}" />
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/plugins/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery.blockui.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/App.js"></script>
<script type="text/javascript" src="/assets/admin/scripts/login.js"></script>
<script>
    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
        $("#reloadverify").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
        $('.fm-button2').click(function(){
			$.ajax({
			url: '<?php echo url('Login/clear');?>',
			success:function(res){
				window.location.reload();}
				});
        });
    });
</script>
</body>
</html>