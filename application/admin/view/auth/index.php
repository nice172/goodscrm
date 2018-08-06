{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}

<div class="container-fluid">
	<div style="margin:10px 0;" id="rule-add">
		<form class="form-horizontal ajaxForm" name="rule_add" method="post" action="{:url('rule_add_runadd')}">
			<div class="col-xs-12 col-sm-12">
				<small>左侧菜单：</small>
				<small>
					<select name="ismenu">
						<option value="1">是</option>
						<option value="1">否</option>
					</select>
				</small>
				<small>状态：</small>
				<small>
					<select name="status">
						<option value="1">开启</option>
						<option value="0">禁用</option>
					</select>
				</small>
				<small class="sl-left10">父级：</small>
				<small>
					<select name="parentid" required>
						<option value="0">--默认顶级--</option>
						{foreach name="select" item="v"}
							<option value="{$v.id}">├{$v.title}</option>
							{foreach name="v['child']" item="vv"}
								<option value="{$vv.id}">&nbsp;&nbsp;├{$vv.title}</option>
							{/foreach}
						{/foreach}
					</select>
				</small>
				<small class="sl-left10">名称：</small>
				<small><input name="title" id="title" class="input-text"  placeholder=" 输入名称" required/></small>
				<small class="sl-left10">模块/控制器/方法：</small>
				<small><input name="name" id="name" class="input-text"  placeholder=" 输入模块/控制器/方法" required/></small>
				<small class="sl-left10">css：</small>
				<small><input name="css" id="css" class="input-text"  placeholder=" css样式" /></small>
				<small class="sl-left10">排序：</small>
				<small><input name="sort" id="sort" class="input-text" value="50"/></small>
				<small>
					<button type="submit" class="btn btn-default ruleadd">添加节点</button>
				</small>
			</div>
		</form>
	</div>

<div class="col-xs-12 col-sm-12 rule-top alert alert-info top10" style="margin-top:10px;margin-bottom:5px;">
	<button type="button" class="close" data-dismiss="alert">
		<i class="ace-icon fa fa-times"></i>
	</button>
	1、控制器/方法; 例如admin/Index/index<br />
	2、菜单name检测规则：一级菜单=>控制器名，二级菜单=>不限制，但建议模块/控制器/方法(选择默认的方法)，三级、四级菜单=>控制器/方法<br />
	3、css为控制左侧导航顶级栏目前图标样式(仅一级菜单有效)，具体可查看FontAwesome图标CSS样式
</div>

<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<label class="position-relative">
					<input class="ace" type="checkbox">
					<span class="lbl"></span>
				</label>
			</th>
			<th>ID</th>
			<th>节点名称</th>
			<th>权限URL</th>
			<th>左侧菜单</th>
			<th>排序</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
		{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['id'];?>">
			<td class="center">
				<label class="position-relative">
					<input class="ace" value="{$v.id}" name="checkbox[]" type="checkbox">
					<span class="lbl"></span>
				</label>
			</td>
			<td>
				{$v.id}
			</td>
			<td>
				{$v.title}
			</td><td>
				{$v.name}
			</td>
						<td>
				{if condition="$v['ismenu']"}
					是
				{else}
					否
				{/if}
			</td>	
			<td><input type="text" name="sort" item="{$v.id}" style="text-align: center;width:50px;" class="form-control inputSort" value="{$v.sort}"/></td>
			<td>
				
				<?php if ($v['status']){?>
				<button class="btn btn-xs btn-success ajaxRequest" action="<?php echo url('node_status');?>" data-id="<?php echo $v['id'];?>">开启</button>
				<?php }else{ ?>
				<button class="btn btn-xs btn-warning ajaxRequest" action="<?php echo url('node_status');?>" data-id="<?php echo $v['id'];?>">禁用</button>
				<?php }?>
		
			</td>

			<td>
			
				<div class="hidden-sm hidden-xs btn-group">
					<button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo url('edit_node',array('id' => $v['id']));?>'">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>
					{if condition="$v['id'] neq 2"}
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['id'];?>" action="<?php echo url('deletenode',array('id' => $v['id']));?>">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>
					{/if}
				</div>

				<div class="hidden-md hidden-lg">
					<div class="inline position-relative">
						<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
							<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
						</button>

						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
							
							<li>
								<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit">
									<span class="green">
										<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
									</span>
								</a>
							</li>
							{if condition="$v['id'] neq 2"}
							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
							{/if}
						</ul>
					</div>
				</div>
				
			</td>
		</tr>
{/foreach}
</table>
</div>
{/block}
{block name="footer"}
<script type="text/javascript">
$(function(){
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-auth").addClass("active"); // 小分类
	$('.inputSort').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('nodesort');?>',data:{sort:$(this).val(),id:$(this).attr('item')},success:function(){}});
	});	
});
</script>
{/block}