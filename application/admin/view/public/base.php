<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header"}
{block name="header"}{/block}
<style>.border-top{border-top:none;}</style>
</head>
<body>
{include file="public/topbar"}
<div class="viewFramework-body viewFramework-sidebar-full">
    {include file="public/sidebar"}
    <div class="viewFramework-product <?php if (isset($sub_class)){echo $sub_class;}?>">
    <!-- 中间导航 开始 viewFramework-product-col-1-->
    {block name="sub_sidebar"}{/block}
    <!-- 中间导航 结束 -->
        <div class="viewFramework-product-body">
        
        	{block name="main"}{/block}
        
        </div>
    </div>
</div>

{include file="public/footer"}
{block name="footer"}{/block}
<script type="text/javascript">
$(function(){
$('.ajaxRequest').click(function(){
	var id = $(this).attr('data-id');
	$.get($(this).attr('action'),{id:id},function(res){
		if(res.code == 1){
			toastr.success(res.msg);
			setTimeout(function(){window.location.reload();},2000);}else{
				toastr.error(res.msg);}
	});
});
$('.ajaxDelete').click(function(){
	if(confirm('确认删除吗？')){
	var id = $(this).attr('data-id');
	$.get($(this).attr('action'),{id:id},function(res){
		if(res.code == 1){
			toastr.success(res.msg);
			setTimeout(function(){window.location.reload();},2000);}else{
				toastr.error(res.msg);}
	});
	}
});
$('.ajaxForm').submit(function(){
	$(this).ajaxSubmit({
		success: function(res){
			if(res.code == 1){
				toastr.success(res.msg);
				if(res.url != '' && typeof res.url != 'undefined'){
					setTimeout(function(){window.location.href = res.url;},2000);
					}else{
						setTimeout(function(){window.location.reload();},2000);
						}
			}else{
				toastr.error(res.msg);
				}
		}
	});
	return false;});
});
</script>
</body>
</html>