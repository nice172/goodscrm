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
                                <h5><span>新增角色</span></h5>
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
        <div class="alert alert-warning success"></div>
        <div class="form-group padding-top20">
            <label for="bumenname" class="col-sm-2 control-label"><span class="text-danger">*</span>角色名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control w300 fleft" name="bumenname" id="bumenname" placeholder="角色名称">
            </div>
        </div>
                <div class="form-group">
            <label for="bumenname" class="col-sm-2 control-label"><span class="text-danger">*</span>角色状态</label>
            <div class="col-sm-10">
                <label class="radio-inline">
  <input type="radio" name="status" id="status" checked="checked" value="1"> 开启
</label>
<label class="radio-inline">
  <input type="radio" name="status" id="status" value="0"> 禁用
</label>
            </div>
        </div>
        
        <div class="form-group">
        
        <div class="col-sm-12">
        
<!-- <table class="table table-hover"> -->
<!-- 		<tr> -->
<!--           <td>Thornton</td> -->
<!--           <td> -->
          
<!--           </td> -->
<!--         </tr> -->
<!-- </table> -->
<div class="col-xs-12 col-sm-12" style="margin-top:10px;margin-bottom:5px;">
<span style="font-weight: 600;margin-bottom:10px;display:block;">选择权限</span>
<!--<button class="btn btn-info" id="allno" style="margin-bottom: 10px;">全选/反选</button>  -->
			{foreach name="lists" item="value"}
			<dl class="rule">
				<dt><label for="parent_{$value['id']}"><input type="checkbox" id="parent_{$value['id']}" {if condition="in_array($value['id'],$data['rule_pids'])"}checked="checked"{/if} name="parent[{$value['id']}]" value="{$value['id']}"/>{$value['title']}</label></dt>
				{if condition="isset($value['child'])"}
				<dd>
					{foreach name="value['child']" item="vv"}
						<label for="rule_{$vv['id']}"><input type="checkbox" id="rule_{$vv['id']}" {if condition="in_array($vv['id'],$data['rules'])"}checked="checked"{/if} name="rule[{$vv['id']}]" value="{$vv['id']}"/>{$vv['title']}</label>
						{foreach name="vv['child']" item="v3"}
							<label for="rule_{$v3['id']}"><input type="checkbox" id="rule_{$v3['id']}" {if condition="in_array($v3['id'],$data['rules'])"}checked="checked"{/if} name="rule[{$v3['id']}]" value="{$v3['id']}"/>{$v3['title']}</label>
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
        
        // 当前页面分类高亮
        // 当前页面分类高亮
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-role").addClass("active"); // 小分类

        //表单验证
        $("#addDepartmentForm").validate({
            rules: {
                bumenname: {
                    required: true,
                    minlength: 2,
                    remote:{
                        url:"check_name",
                        dataType: "json",           //接受数据格式
                        type:"post",
                        data: {                     //要传递的数据
                            username: function() {
                                return $("#inputusername").val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16

                },
                nickname: {
                    required: true,
                    remote:{
                        url:"check_nick",
                        dataType: "json",           //接受数据格式
                        type:"post",
                        data: {                     //要传递的数据
                            nickname: function() {
                                return $("#inputusernick").val();
                            }
                        }
                    }
                }
            },
            messages: {
                username: {
                    required: "名称不能为空",
                    minlength: $.validator.format("不能小于{0}个字符"),
                    remote: "已存在登录名称"
                },
                bumenname: {
					remote: '角色名称已存在'
                }
            },

            //debug: true, // 调试时用，只验证不提交表单
            //errorClass: 'help-block', // 默认输入错误消息类
            //errorLabelContainer: $(".success"), // 如果表单验证不通过，所有错误消息提示都会插入到该元素中
            //wrapper: "span", // 错误的标签

            focusInvalid: true, //当为false时，验证无效，没有焦点响应
            //onclick: true, //是否在鼠标点击时验证
            onkeyup: false, //当丢失焦点时才触发验证请求
            errorElement: 'label', //默认输入错误消息容器，有div和em/label
            //errorClass: "tooltip fade bottom in", //div错误的样式
            //sycError:true, //自己定义是否显示错误提示 需与:{errorElement: 'div',errorClass: "tooltip fade bottom in"} 一起用

            //验证不通过
            highlight: function(element, errorClass) {
                $(element).closest('input').addClass('error').removeClass('valid'); // 验证未通过给input添加css
            },
            //验证通过后
            unhighlight: function (element) {
                $(element).closest('input').removeClass('error').addClass('valid'); // 验证未通过给input添加css
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            // 如果表单验证不通过
            invalidHandler: function(){
                //
                toastr.warning("填写不完整请认真检查");
            },
            // 表单验证成功，调用Ajax表单提交
            submitHandler: function() {
                //
                $.ajax({
                    url: '{:url("add_do")}',
                    type: 'post',
                    dataType: 'JSON',
                    data: $("#addDepartmentForm").serialize(),
                    success: function (result) {
                        if (result.code > 0) {
                            toastr.success(result.msg);
                            window.setTimeout(function() {
                                bDialog.close(result.url);
                            }, 1500);
                        } else {
                            toastr.error(result.msg);
                            window.setTimeout(function() {
                                window.location.href=result.url;
                            }, 1500);
                        }
                    }
                });
                
                return false; // 阻止表单自动提交事件
            }
        });
    });

</script>
{/block}