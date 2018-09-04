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
            <h5><span>商品属性列表</span></h5>
            </div>
            <div class="pull-right">
            	<a class="btn btn-primary" href="{:url('add_attr',['goods_type_id' => input('goods_type_id'),'attr_type' => input('attr_type')])}">新增属性</a>
                <a href="javascript:window.location.reload();" class="btn btn-default">
                    <span class="glyphicon glyphicon-refresh"></span>
                    <span>刷新</span></a>
            </div>
        </div>
        </div>
    </div>
	<!-- 导航end -->
<table id="sample-table-1" class="table table-striped table-bordered table-hover border">
	<thead>
		<tr>
			<th>ID</th>
			<th>属性名称</th>
			<th>可选值</th>
			<th>类型</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($lists)){?>
	{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['goods_attr_id'];?>">
			<td>{$v.goods_attr_id}</td>
			<td>{$v.attr_name}</td>
			<td><?php echo str_replace("\n", "、", $v['attr_value']);?></td>
			<td>
				<?php if ($v['attr_type']){ ?>
					属性
				<?php }else {?>
					参数
				<?php }?>
			</td>
			<td><input type="text" data-id="<?php echo $v['goods_attr_id'];?>" style="text-align: center;width:50px;" value="{$v.sort}" name="sort"/></td>
			<td>
					<a href="<?php echo url('edit_attr',array('goods_attr_id' => $v['goods_attr_id']));?>" class="" data-id="<?php echo $v['goods_attr_id'];?>">修改</a>
					<span class="text-explode">|</span>
					<a class="ajaxDelete" data-id="<?php echo $v['goods_attr_id'];?>" action="<?php echo url('deleteAttr',array('goods_attr_id' => $v['goods_attr_id']));?>">删除</a>
			</td>
		</tr>
{/foreach}
	<?php }?>	
	</tbody>
	
	<tfoot>
<tr>
    <td colspan="9">

        <div class="pull-right page-box">
                                        {$page}
                                    </div>
    </td>
</tr>
</tfoot>
	
</table>

</div><!-- /.main-content -->
{/block}
{block name="footer"}
<script type="text/javascript">
$(function(){
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-goods_type").addClass("active"); // 小分类
	$('.openModal').click(function(){
		$('#exampleModal').modal({
			show : true,
			keyboard : false,
		});
	});

	$('.width100').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('updateSort');?>',data:{sort:$(this).val(),goods_attr_id:$(this).attr('data-id')},success:function(data){
			if(data.code==0) {
				toastr.error(data.msg);
				}else{
					toastr.success('编辑成功');}
		}});
	});
});
</script>
{/block}
