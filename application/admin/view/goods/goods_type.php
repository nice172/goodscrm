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
            	<a class="btn btn-primary" href="{:url('add_type')}">新增类型</a>
                <a href="javascript:window.location.reload();" class="btn btn-default">
                    <span class="glyphicon glyphicon-refresh"></span>
                    <span>刷新</span></a>
            </div>
        </div>
        </div>
    </div>
	<!-- 导航end -->


<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>商品类型</th>
			<th>操作</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($lists)){?>
	{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['goods_type_id'];?>">
			<td>
				{$v.goods_type_id}
			</td>
			<td>
				<input type="text" class="width50" name="type_name" data-id="<?php echo $v['goods_type_id'];?>" value="<?php echo $v['type_name'];?>"  />
			</td>
			<td>
			
				<div class="hidden-sm hidden-xs btn-group">
					<a href="<?php echo url('typeParams',array('goods_type_id' => $v['goods_type_id'],'attr_type' => 1));?>" class="btn btn-xs btn-danger" data-id="<?php echo $v['goods_type_id'];?>">属性列表</a>
					<a href="<?php echo url('add_attr',array('goods_type_id' => $v['goods_type_id'],'attr_type' => 1));?>" class="btn btn-xs btn-danger" data-id="<?php echo $v['goods_type_id'];?>">新增属性</a>
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['goods_type_id'];?>" action="<?php echo url('deleteType',array('goods_type_id' => $v['goods_type_id']));?>">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</button>
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
							<li>
								<a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
									<span class="red">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
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


</div>
{/block}
{block name="footer"}
<script type="text/javascript">
$(function(){
    // 当前页面分类高亮
    $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
    $("#config-goods_type").addClass("active"); // 小分类
	$('.openModal').click(function(){
		$('#exampleModal').modal({
			show : true,
			keyboard : false,
		});
	});

	
	$('.width50').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('updateTypeName');?>',data:{type_name:$(this).val(),goods_type_id:$(this).attr('data-id')},success:function(data){
			if(data.code==0) {
				toastr.error(data.msg);
				}else{
					toastr.success('编辑成功');}
		}});
	});
});
</script>
{/block}
