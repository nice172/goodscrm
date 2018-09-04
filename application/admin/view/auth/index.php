{extend name="public/base"}
{block name="header"}
<link rel="stylesheet" href="/assets/plugins/treetable/css/jquery.treetable.css" />
<style>.border tbody tr td {padding:2px 8px;}</style>
{/block}
{block name="main"}

<div class="container-fluid">
	<div style="margin:10px 0;" id="rule-add">
		<form class="form-horizontal ajaxForm" name="rule_add" method="post" action="{:url('rule_add_runadd')}">
			<div class="col-xs-12 col-sm-12">
				<small>左侧菜单：</small>
				<small>
					<select name="ismenu" class="form-control w50 inline">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</small>
				<small>状态：</small>
				<small>
					<select name="status" class="form-control w80 inline">
						<option value="1">开启</option>
						<option value="0">禁用</option>
					</select>
				</small>
				<small class="sl-left10">父级：</small>
				<small>
					<select name="parentid" required="required" class="form-control w150 inline">
						<option value="0">--默认顶级--</option>
						{foreach name="select" item="v"}
							<option value="{$v.id}">├{$v.title}</option>
							{foreach name="v['child']" item="vv"}
								<option value="{$vv.id}">&nbsp;&nbsp;├{$vv.title}</option>
								{foreach name="vv['child']" item="vvv"}
									{if condition="$vvv['ismenu']"}
									<option value="{$vvv.id}">&nbsp;&nbsp;&nbsp;&nbsp;├{$vvv.title}</option>
									{/if}
								{/foreach}
							{/foreach}
						{/foreach}
					</select>
				</small>
				<small class="sl-left10">名称：</small>
				<small><input name="title" id="title" class="input-text form-control w130 inline"  placeholder=" 输入名称" required/></small>
				<small class="sl-left10">模块/控制器/方法：</small>
				<small><input name="name" id="name" class="input-text form-control w150 inline"  placeholder=" 输入模块/控制器/方法" required/></small>
				<small class="sl-left10">css：</small>
				<small><input name="css" id="css" class="input-text form-control w100 inline" value="icon-ecs" placeholder=" css样式" /></small>
				<small class="sl-left10">排序：</small>
				<small><input name="sort" id="sort" class="input-text form-control w50 inline" value="50"/></small>
				<small>
					<button type="submit" class="btn btn-primary ruleadd">添加节点</button>
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

<table id="treeTable" class="table table-striped table-bordered syc-table border table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th style="text-align: left;">节点名称</th>
			<th style="text-align: left;">权限URL</th>
			<th>左侧菜单</th>
			<th>排序</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
		{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['id'];?>" data-tt-id="node-{$v['id']}" {if condition="$v['parentid']"}data-tt-parent-id="node-{$v['parentid']}"{/if}>
			<td>
				{$v.id}
			</td>
			<td style="text-align: left;">
								<?php echo str_repeat('&nbsp;&nbsp;&nbsp;', $v['level']);?>
			              		└<?php echo str_repeat('─',  $v['level']);?>
			              		{if condition="$v['parentid']"}
			              		{$v.title}
			              		{else}
			              		<strong>{$v.title}</strong>
			              		{/if}
			</td><td style="text-align: left;">
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
				<a href="javascript:;" class="ajaxRequest" action="<?php echo url('node_status');?>" data-id="<?php echo $v['id'];?>">开启</a>
				<?php }else{ ?>
				<a href="javascript:;" class="ajaxRequest" action="<?php echo url('node_status');?>" data-id="<?php echo $v['id'];?>">禁用</a>
				<?php }?>
		
			</td>

			<td>
			
					<a onclick="window.location.href='<?php echo url('edit_node',array('id' => $v['id']));?>'">修改</a>
					{if condition="$v['id'] neq 2"}
					<span class="text-explode">|</span>
					<a class="ajaxDelete" data-id="<?php echo $v['id'];?>" action="<?php echo url('deletenode',array('id' => $v['id']));?>">删除</a>
					{/if}
				
			</td>
		</tr>
{/foreach}
</table>
</div>
{/block}
{block name="footer"}
<script src="/assets/plugins/treetable/jquery.treetable.js"></script>
<script type="text/javascript">
$(function(){
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-auth").addClass("active"); // 小分类
	$('.inputSort').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('nodesort');?>',data:{sort:$(this).val(),id:$(this).attr('item')},success:function(){}});
	});	
	　$("#treeTablex").treetable({ 
		expandable: true,
		stringCollapse: '收起',
		stringExpand:'展开',
		clickableNodeNames: false,
		expandable: true,
		expanderTemplate:'<i class="layui-icon layui-icon-triangle-r" style="cursor:pointer;"></i>' });
	 $('body').on('click','#treeTable .indenter i',function(){
		 
		 if($(this).hasClass('layui-icon-triangle-r')){
			 $(this).removeClass('layui-icon-triangle-r');
			 $(this).addClass('layui-icon-triangle-d');
			 }else{
			 $(this).removeClass('layui-icon-triangle-d');
			 $(this).addClass('layui-icon-triangle-r');
		}
	 });
});
</script>
{/block}
