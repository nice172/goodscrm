{extend name="public/base"}
{block name="header"}

{/block}

{block name="sub_sidebar"}
{include file="goods/goods_sidebar"}
{/block}

{block name="main"}
<div class="container-fluid">

	<!-- 导航 -->
    <div class="row syc-bg-fff">
        <div class="col-lg-12 syc-border-bs">
        <div class="console-title">
        <div class="pull-left">
            <h5><span>商品分类管理</span></h5>
            </div>
            <div class="pull-right">
            	<a class="btn btn-primary openModal" href="javascript:;">新增分类</a>
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
			<th>分类名称</th>
<!-- 			<th>显示导航</th> -->
			<th>所属类型</th>
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
<!-- 			<td>{if condition="$v['is_nav']"}是{else/}否{/if}</td> -->
			<td><?php if (isset($goods_type[$v['goods_type_id']])) echo $goods_type[$v['goods_type_id']]['type_name'];?></td>
			<td>{if condition="$v['status']"}显示{else/}禁用{/if}</td>
			<td>
					<a href="javascript:;" class="updatecategory" data-id="<?php echo $v['category_id'];?>">修改</a>
					<span class="text-explode">|</span>
					<a href="javascript:;" class="ajaxDelete" data-id="<?php echo $v['category_id'];?>" action="<?php echo url('deleteCategory',array('category_id' => $v['category_id']));?>">删除</a>
			</td>
		</tr>
{/foreach}
	<?php }?>	
	</tbody>
</table>
<div class="pager">
<?php echo $page;?>
</div>

<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->

</div><!-- /.col -->
{/block}
{block name="footer"}

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
<!-- 				<ul class="nav nav-tabs" id="myTab"> -->
<!-- 					<li class="active"> -->
<!-- 						<a data-toggle="tab" href="#home">基本</a> -->
<!-- 					</li> -->
<!-- 					<li> -->
<!-- 						<a data-toggle="tab" href="#messages">META</a> -->
<!-- 					</li> -->
<!-- 				</ul> -->

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
<!-- 			            <div class="form-group hidden"> -->
<!-- 			              <label for="price_nums" class="control-label">价格区间个数:</label> -->
<!-- 			              <input type="text" name="price_nums" required="required" class="form-control" id="price_nums"> -->
<!-- 			            </div> -->
            <div class="form-group hidden">
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
            <div class="form-group hidden">
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
            			            <div class="form-group">
			              <label for="desciption" class="control-label">分类描述:</label>
			              <textarea name="description" class="form-control" id="description" style="width: 100%;resize:none;"></textarea>
			            </div>
					</div>

					<div id="messages" class="tab-pane fade">
			            <div class="form-group">
			              <label for="keywords" class="control-label">分类关键字:</label>
			              <input type="text" name="keywords" class="form-control" id="keywords">
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

<script type="text/javascript">
$(function(){
    $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
    $("#storage-xingcai").addClass("active"); // 小分类
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

    $(".updatecategory").click(function () {
        var title = '修改分类';
        var category_id = $(this).attr('data-id');
        bDialog.open({
            title : title,
            height: 460,
            width:550,
            url : '{:url(\'updatecategory\')}?category_id='+category_id,
            callback:function(data){
                if(data && data.results && data.results.length > 0 ) {
                    window.location.reload();
                }
            }
        });
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
