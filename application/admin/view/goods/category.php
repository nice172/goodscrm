{extend name="public/base" /}
{block name="main"}
<div class="main-content">
<div class="main-content-inner">
<div class="page-content">
			
<!-- #section:settings.box -->
{include file="public/setting"}
<!-- /section:settings.box -->
<!--
<div class="page-header">
	<h1>Two menu </h1>
</div> /.page-header -->

<div class="row">
<div class="col-xs-12">
{include file="public/top_menu"}

<div class="row maintop">
<div class="col-xs-12 col-sm-2">
<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" >新增分类</button>
</div>
</div>


<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>分类名称</th>
			<th>显示导航</th>
			<th>类型</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($lists)){?>
	{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['category_id'];?>">
			<td>
				{$v.category_id}
			</td>
			<td>
				<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($v['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($v['path'], '_'));?>
			              		<?php echo $v['category_name'].'(ID:'.$v['category_id'].')';?>
			</td>
			<td>{if condition="$v['is_nav']"}是{else/}否{/if}</td>
			<td><?php if (isset($goods_type[$v['goods_type_id']])) echo $goods_type[$v['goods_type_id']]['type_name'];?></td>
			<td>{if condition="$v['status']"}显示{else/}禁用{/if}</td>
			<td>
			
				<div class="hidden-sm hidden-xs btn-group">
					<a href="javascript:;" class="btn btn-xs btn-danger exampleModal2" item-id="<?php echo $v['category_id'];?>" data-id="<?php echo $v['goods_type_id'];?>">筛选条件</a>
					<a href="<?php echo url('updateCategory',array('category_id' => $v['category_id']));?>" class="btn btn-xs btn-danger" data-id="<?php echo $v['category_id'];?>">修改</a>
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['category_id'];?>" action="<?php echo url('deleteCategory',array('category_id' => $v['category_id']));?>">
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
</table>
<div class="pager">
<?php echo $page;?>
</div>

<div class="bd-example">
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->
  <div class="modal fade" aria-hidden="true" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" class="ajaxForm" enctype="multipart/form-data" action="<?php echo url('addCategory');?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">关闭</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">新增分类</h4>
        </div>
        <div class="modal-body">
        
        	<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#home">基本</a>
					</li>
					<li>
						<a data-toggle="tab" href="#messages">META</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
			            <div class="form-group">
			              <label for="pid" class="control-label">上级分类:</label>
			              <select name="pid" id="pid" class="form-control">
			              	<option value="0" path="0">├顶级分类</option>
			              	<?php foreach ($lists as $key => $value){ ?>
			              		<option value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>">
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
			              	<?php } ?>
			              </select>
			            </div>
			            <input type="hidden" value="0" name="path" id="path"/>
			            <div class="form-group">
			              <label for="goods_type_id" class="control-label">分类类型:</label>
			              <select name="goods_type_id" id="goods_type_id" class="form-control">
			              	<option value="0">请选择类型</option>
			              	<?php foreach ($goods_type as $key => $value){ ?>
			              	<option value="<?php echo $value['goods_type_id'];?>"><?php echo $value['type_name'];?></option>
			              	<?php } ?>
			              </select>
			            </div>
			            
			            <div class="form-group">
			              <label for="category_name" class="control-label">分类名称:</label>
			              <input type="text" name="category_name" required="required" class="form-control" id="category_name">
			            </div>
			            <div class="form-group">
			              <label for="price_nums" class="control-label">价格区间个数:</label>
			              <input type="text" name="price_nums" required="required" class="form-control" id="price_nums">
			            </div>
            <div class="form-group">
              <label for="" class="control-label">状态:</label>
              
				<div class="radio">
								<label>
					<input name="status" checked="checked" value="1" type="radio" class="ace">
					<span class="lbl">显示</span>
				</label>
				<label>
					<input name="status" value="0" type="radio" class="ace">
					<span class="lbl">禁用</span>
				</label>
			
				</div>
			  
            </div>
            <div class="form-group">
              <label for="" class="control-label">是否导航:</label>
              
				<div class="radio">
				<label>
					<input name="is_nav" checked="checked" value="0" type="radio" class="ace">
					<span class="lbl">否</span>
				</label>
				&nbsp;&nbsp;
				<label>
					<input name="is_nav" value="1" type="radio" class="ace">
					<span class="lbl">是</span>
				</label>
				</div>
			  
            </div>          
            <div class="form-group">
              <label for="sort" class="control-label">排序:</label>
              <input type="text" name="sort" value="50" required="required" class="form-control" id="sort">
            </div>
					</div>

					<div id="messages" class="tab-pane fade">
			            <div class="form-group">
			              <label for="keywords" class="control-label">分类关键字:</label>
			              <input type="text" name="keywords" class="form-control" id="keywords">
			            </div>
			            <div class="form-group">
			              <label for="desciption" class="control-label">分类描述:</label>
			              <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
			            </div>
					</div>
				</div>
			</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-primary">提交</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" aria-hidden="true" data-backdrop="static" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" class="ajaxForm formFilterAttr" enctype="multipart/form-data" action="<?php echo url('updatefilter');?>">
        <input type="hidden" name="category_id" value=""/>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">关闭</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">新增筛选条件</h4>
        </div>
        <div class="modal-body">

		<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="filter_attr">筛选条件:</label>
			  <div class="col-sm-9">
				  <select name="filter_attr[]" class="filter_attr col-xs-10 col-sm-5">
				  	<option value="0">请选择</option>
				  </select>
				  <span class="help-inline col-xs-12 col-sm-7">
				  <div class="middle" style="padding-top:5px;cursor:pointer;">增加条件</div>
				  </span>
			  </div>
          </div>
          <div class="space-8" style="clear:both;"></div>
        
        </div>
		
        
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-primary">提交</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->
{/block}
{block name="footer_static"}
<script type="text/javascript">
$(function(){
	
	$('.openModal').click(function(){
		$('#exampleModal').modal({
			show : true,
			keyboard : false,
		});
	});
	$('#pid').change(function(){
		$('#path').val($(this).find(':selected').attr('path'));
	});

	$('.exampleModal2').click(function(){
		var goods_type_id = $(this).attr('data-id');
		$('input[name=category_id]').val($(this).attr('item-id'));
		$.ajax({
			type: 'GET',
			url: '<?php echo url('getGoodsType');?>',
			dataType: 'json',
			async: false,
			data:{goods_type_id:goods_type_id},
			success:function(data){
				if(data.status == 1){
		              var html = '<option value="0">请选择</option>';
						for(var i in data.data){
		              		html += '<option value="'+data.data[i]['goods_attr_id']+'">'+data.data[i]['attr_name']+'</option>';
						}
		              html += '</select>';
		              $('.filter_attr').html(html);
					$('#exampleModal2').modal({
						show : true,
						keyboard : false,
					});

					$('.middle').click(function(){
						var _parents = $(this).parents('.form-group');
						$('.modal-body').append('<div class="form-group" style="display:none;">'+_parents.html()+'</div><div class="space-8" style="clear:both;"></div>');
						var _lastHtml = $('.modal-body .form-group').last();
						_lastHtml.find('.middle').addClass('removeNode');
						_lastHtml.find('label').text('');
						_lastHtml.find('.middle').text('移除');
						_lastHtml.show();
						$('body').on('click','.removeNode',function(){
							var _p = $(this).parents('.form-group');
							_p.next().remove();
							_p.remove();
						});
					});
				}else{
					alert('请绑定分类类型');
				}
			}
		});

		$('body').on('change','select',function(){
			var i = 0,_this = $(this);
			$('.formFilterAttr select').each(function(){
				if (_this.find(':selected').val() == $(this).find(':selected').val()) {
					i++;
				}
			});
			if(i >= 2) {
				_this.val(0);
				alert('已经重复选择相同的值！！！');
			}
		});
		
// 		$.ajax({
// 			type: 'GET',
//			url: '<?php echo url('getGoodsType');?>',
// 			dataType: 'json',
// 			async: false,
// 			data:{goods_type_id:goods_type_id},
// 			success:function(data){

// 			}
// 		});

	});
	
	$('.width100').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('updateTypeName');?>',data:{type_name:$(this).val(),goods_type_id:$(this).attr('data-id')},success:function(data){
			var data = JSON.parse(data);
			if(data.code==0) layer.msg(data.msg, function(){});
		}});
	});
});
</script>
{/block}
