{extend name="public/base"}
{block name="header"}
<style type="text/css">

</style>
{/block}
{block name="main"}
<div class="container-fluid">
	<!-- 导航 -->
    <div class="row syc-bg-fff">
        <div class="col-lg-12 syc-border-bs">
        <div class="console-title">
        <div class="pull-left">
            <h5><span>系统参数管理</span></h5>
            </div>
            <div class="pull-right">
            	<a class="btn btn-primary" href="{:url('add')}">新增参数</a>
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
    <form class="form-horizontal ajaxForm" action="{:url('edit')}" method="post">
    	<input type="hidden" value="{$data.id}" name="id" />
        <div class="alert alert-warning success"></div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label"><span class="text-danger">*</span>参数名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300 fleft" name="name" id="name" value="{$data.name}" placeholder="请输入参数名称">
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="col-sm-2 control-label"><span class="text-danger"></span>参数描述</label>
            <div class="col-sm-10">
                <textarea name="desc" id="desc" class="form-control w300 fleft" style="resize:none;height:100px;">{$data.desc}</textarea>
            </div>
        </div>
                <div class="form-group">
            <label for="desc" class="col-sm-2 control-label"><span class="text-danger"></span>类型</label>
            <div class="col-sm-10">
                <label for="radio1"><input id="radio1" type="radio" name="type" value="0" {if condition="!$data['type']"}checked="checked"{/if} />选项值</label>
                &nbsp;&nbsp;
                <label for="radio2"><input id="radio2" type="radio" name="type" value="1" {if condition="$data['type']"}checked="checked"{/if} />文本</label>
                &nbsp;&nbsp;
                <label for="radio3"><input id="radio3" type="radio" name="type" value="2" {if condition="$data['type']==2"}checked="checked"{/if} />图片</label>
            </div>
        </div>
        <div class="form-group">
            <label for="params_value" class="col-sm-2 control-label"><span class="text-danger">*</span>可选值</label>
            <div class="col-sm-10">
                <textarea name="params_value" id="params_value" class="form-control w300" style="resize:none;height:130px;">{$data.params_value}</textarea>
            	<span class="help-block">每行一个值</span>
            </div>
        </div>
                        <div class="form-group">
            <label for="sort" class="col-sm-2 control-label"><span class="text-danger">*</span>排序</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300 fleft" name="sort" id="sort" value="{$data.sort}" placeholder="请输入排序">
            </div>
        </div>
               <div class="form-group">
            <label for="sort" class="col-sm-2 control-label">上传图片</label>
            <div class="col-sm-10">
            	<input type="hidden" value="{$data.file}" name="org_file" />
                <input type="file" name="file" />
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
$(document).ready(function() {
    // 当前页面分类高亮
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-params").addClass("active"); // 小分类

});
</script>
{/block}