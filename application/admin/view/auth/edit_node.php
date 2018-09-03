{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}

<div class="container-fluid">
	                <div class="row syc-bg-fff">
                    <div class="col-lg-12 syc-border-bs">
                        <div class="console-title">
                            <div class="pull-left">
                                <h5><span>修改权限</span></h5>
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
			<div class="row">
				<div class="col-xs-12">
				<form class="form-horizontal ajaxForm" name="rule_edit_runedit" method="post" action="<?php echo url('rule_edit_runedit');?>">
					<input type="hidden" value="{$data.id}" name="id"/>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 节点标题：  </label>
						<div class="col-sm-10">
							<input type="text" name="title" id="title" value="{$data.title}" placeholder="输入节点标题" class="col-xs-10 col-sm-4 form-control w300 fleft" required/>
						</div>
					</div>
					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 模块/控制器/方法：  </label>
						<div class="col-sm-10">
							<input type="text" name="name" id="name" value="{$data.name}" placeholder="输入模块/控制器/方法" class="col-xs-10 col-sm-4 form-control w300 fleft" required/>
						</div>
					</div>
					<div class="space-4"></div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> css样式：  </label>
						<div class="col-sm-10">
							<input type="text" name="css" id="css" value="{$data.css|default='icon-ecs'}" placeholder="输入css样式" class="col-xs-10 col-sm-4 form-control w300 fleft"/>
						</div>
					</div>
					<div class="space-4"></div>
					
										<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 排序：  </label>
						<div class="col-sm-10">
							<input type="text" name="sort" id="sort" value="{$data.sort}" placeholder="排序" class="col-xs-10 col-sm-4 form-control w300 fleft"/>
						</div>
					</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 左侧菜单： </label>
						<div class="col-sm-10" style="padding-top:5px;">
							<select name="ismenu" class="form-control w300 fleft">
								<option value="1" {if condition="$data['ismenu'] eq 1"}selected="selected"{/if}>是</option>
								<option value="0" {if condition="$data['ismenu'] eq 0"}selected="selected"{/if}>否</option>
							</select>
						</div>
					</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 所属父级： </label>
						<div class="col-sm-10" style="padding-top:5px;">
							<select name="parentid" class="form-control w300 fleft" required>
								<option value="0">--默认顶级--</option>
								{foreach name="select" item="v"}
									<option value="{$v.id}" {if condition="$data['parentid'] eq $v['id']"}selected="selected"{/if}>├{$v.title}</option>
									{foreach name="v['child']" item="vv"}
										<option value="{$vv.id}" {if condition="$data['parentid'] eq $vv['id']"}selected="selected"{/if}>&nbsp;&nbsp;├{$vv.title}</option>
        								{foreach name="vv['child']" item="vvv"}
        									{if condition="$vvv['ismenu']"}
        									<option value="{$vvv.id}" {if condition="$data['parentid'] eq $vvv['id']"}selected="selected"{/if}>&nbsp;&nbsp;&nbsp;&nbsp;├{$vvv.title}</option>
        									{/if}
        								{/foreach}
									{/foreach}
								{/foreach}
							</select>
						</div>
					</div>
					<div class="space-4"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="status"> 是否启用： </label>
						<div class="col-sm-10" style="padding-top:5px;">
							<input name="status" id="status" value="1" {if condition="$data['status']"}checked="checked"{/if} type="checkbox" />
							<span class="lbl">&nbsp;默认开启</span>
						</div>
					</div>
					<div class="space-4"></div>

					<div class="clearfix">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								保存
							</button>

							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset" onclick="window.history.go(-1);">
								<i class="ace-icon fa fa-undo bigger-110"></i>
								返回
							</button>
						</div>
					</div>
				</form>
				

					
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
{/block}
{block name="footer"}
<script type="text/javascript">
$(function(){
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-auth").addClass("active"); // 小分类
});
</script>
{/block}