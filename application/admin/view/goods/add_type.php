{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}
<div class="container-fluid">
<!-- 导航 -->
    <div class="row syc-bg-fff">
        <div class="col-lg-12 syc-border-bs">
        <div class="console-title">
        <div class="pull-left">
            <h5><span>商品类型管理</span></h5>
            </div>
            <div class="pull-right">
            	<a href="javascript:window.history.go(-1);" class="btn btn-default">
                <i class="fa fa-mail-reply"></i>
                <span>返回</span>
                </a>
            </div>
        </div>
        </div>
    </div>
	<!-- 导航end -->
	
	<div class="col-md-12">
    <form class="form-horizontal ajaxForm" action="{:url('add_type')}" method="post">
        <div class="form-group">
            <label for="type_name" class="col-sm-2 control-label"><span class="text-danger">*</span>类型名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300 fleft" name="type_name" id="type_name" placeholder="请输入类型名称">
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="reset" class="btn btn-default">重置</button>
        </div>
    </form>
</div>
	
</div>
{/block}
{block name="footer"}
<script type="text/javascript">
$(function(){
    // 当前页面分类高亮
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-goods_type").addClass("active"); // 小分类
	
});
</script>
{/block}