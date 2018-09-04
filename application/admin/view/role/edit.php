{extend name="public/base"}
{block name="header"}
<style type="text/css">
.rule{padding:0 5px 5px 0px;margin-bottom:5px;}
.rule dt{padding:5px 10px;border:1px solid #ccc;margin-top:0px;}
.rule dt{border-top-right-radius:4px;border-top-left-radius:4px;}
.rule dt label{font-weight:bold;}
.rule dd label{font-size:12px;margin-left:5px;}
.rule dd{border:1px solid #ccc;padding:10px;margin-bottom:0px;border-top:none;border-bottom-right-radius:4px;border-bottom-left-radius:4px;}
.rule dt input,.rule dd input{vertical-align:sub;margin-right:5px;}
</style>
{/block}
{block name="main"}
	<div class="container-fluid">
	                <div class="row syc-bg-fff">
                    <div class="col-lg-12 syc-border-bs">
                        <div class="console-title">
                            <div class="pull-left">
                                <h5><span>修改角色</span></h5>
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
	
	<div class="col-md-12">
    <form class="form-horizontal" method="post" id="addDepartmentForm">
        <input type="hidden" name="__token__" value="{$Request.token}" />
        <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
        <div class="alert alert-warning success"></div>
        <div class="form-group padding-top20">
            <label for="bumenname" class="col-sm-2 control-label"><span class="text-danger">*</span>角色名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300 fleft" value="<?php echo $data['title'];?>" name="bumenname" id="bumenname" placeholder="角色名称">
            </div>
        </div>
                <div class="form-group">
            <label for="bumenname" class="col-sm-2 control-label"><span class="text-danger">*</span>角色状态</label>
            <div class="col-sm-10">
                <label class="radio-inline">
  <input type="radio" name="status" id="status" {if condition="$data['status']"}checked="checked"{/if} value="1"> 开启
</label>
<label class="radio-inline">
  <input type="radio" name="status" id="status" {if condition="!$data['status']"}checked="checked"{/if} value="0"> 禁用
</label>
            </div>
        </div>
        
        <div class="form-group">
        
        <div class="col-sm-12">
        <div class="icheck-list">
<div class="col-xs-12 col-sm-12" style="margin-top:10px;margin-bottom:5px;">
<span style="font-weight: 600;margin-bottom:10px;display:block;">选择权限</span>
			{foreach name="lists" item="value"}
			<dl class="rule">
				<dt><label for="parent_{$value['id']}"><input type="checkbox" class="icheck" id="parent_{$value['id']}" {if condition="in_array($value['id'],$data['rule_pids'])"}checked="checked"{/if} name="parent[{$value['id']}]" value="{$value['id']}"/>{$value['title']}</label></dt>
				{if condition="isset($value['child'])"}
				<dd>
					{foreach name="value['child']" item="vv"}
						<label for="rule_{$vv['id']}"><input type="checkbox" class="icheck" id="rule_{$vv['id']}" {if condition="in_array($vv['id'],$data['rules'])"}checked="checked"{/if} name="rule[{$vv['id']}]" value="{$vv['id']}"/>{$vv['title']}</label>
						{foreach name="vv['child']" item="v3"}
							<label for="rule_{$v3['id']}"><input type="checkbox" class="icheck" id="rule_{$v3['id']}" {if condition="in_array($v3['id'],$data['rules'])"}checked="checked"{/if} name="rule[{$v3['id']}]" value="{$v3['id']}"/>{$v3['title']}</label>
    						{foreach name="v3['child']" item="v4"}
    							<label for="rule_{$v4['id']}"><input type="checkbox" id="rule_{$v4['id']}" {if condition="in_array($v4['id'],$data['rules'])"}checked="checked"{/if} name="rule[{$v4['id']}]" value="{$v4['id']}"/>{$v4['title']}</label>
    						{/foreach}
						{/foreach}
					{/foreach}
				</dd>
				{/if}
			</dl>
			{/foreach}

</div>
</div>

        
        </div>
        
        </div>
        
        <div class="modal-footer">
        <a href="javascript:;" class="btn btn-info" id="allno">全选/反选</a>
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

    	var flag = true;
    	$(document).on('click','#allno',function(){
    		if(flag){
    			flag = false;
    			$('dl').find('input:checkbox').each(function(){
    				this.checked = true;
    			});
    		}else{
    			$('dl').find('input:checkbox').each(function(){
    				this.checked = false;
    			});
    			flag = true;
    		}
    	});
    	$(document).on('click', 'dt input:checkbox' , function(){
    		var _that = this.checked;
    		$(this).parents('dt').next('dd').find('input:checkbox').each(function(){
    			this.checked = _that;
    		});
    	});
    	$(document).on('click', 'dd input:checkbox' , function(){
    		var count = 0;
    		var _this = $(this);
    		$(this).parents('dl').find('dt input:checkbox').each(function(){
    			_this.parents('dl').find('dd input:checkbox').each(function(){
    				if(this.checked){
    					count++;
    				}
    			});
    			var _that = count > 0 ? true : false;
    			this.checked = _that
    		});
    	});
        
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-role").addClass("active"); // 小分类

        $('#addDepartmentForm').submit(function(){
			$(this).ajaxSubmit({
				url: '<?php echo url('editrole');?>',
				success: function(res){
					if(res.code == 1){
						toastr.success(res.msg);
					}else{
						toastr.error(res.msg);
						}
				}
			});
			return false;
        });
        
    });
</script>
{/block}