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
            <h5><span>品牌管理</span></h5>
            </div>
            <div class="pull-right">
            	<a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" href="javascript:;">新增品牌</a>
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
			<th>品牌名称</th>
			<th>状态</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($lists)){?>
	{foreach name="lists" item="v"}
		<tr id="tr<?php echo $v['brand_id'];?>">
			<td>{$v.brand_id}</td>
			<td>{$v.brand_name}</td>
			<td>
				<?php if ($v['status']){ ?>
					显示
				<?php }else {?>
					禁用
				<?php }?>
			</td>
			<td><input type="text" data-id="<?php echo $v['brand_id'];?>" class="width100" value="{$v.sort}" name="sort"/></td>
			<td>
			
				<div class="hidden-sm hidden-xs btn-group">
					<a href="javascript:;" class="btn btn-xs btn-danger openModal" data-id="<?php echo $v['brand_id'];?>">修改</a>
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['brand_id'];?>" action="<?php echo url('delbrand',array('brand_id' => $v['brand_id']));?>">
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
        <div class="pull-right page-box">{$page}</div>
    </td>
</tr>
</tfoot>

</table>

</div><!-- /.col -->
{/block}
{block name="footer"}

<div class="bd-example">
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button> -->
<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button> -->
  <div class="modal fade" aria-hidden="true" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form method="post" class="ajaxForm" enctype="multipart/form-data" action="<?php echo url('addbrand');?>">
        <div class="hidden_brand_id"></div>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">关闭</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">新增品牌</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="brand_name" class="control-label">品牌名称:</label>
              <input type="text" name="brand_name" required="required" class="form-control" id="brand_name">
            </div>
            <div class="form-group">
              <label for="brand_name_en" class="control-label">品牌名称(英文):</label>
              <input type="text" name="brand_name_en" required="required" class="form-control" id="brand_name_en">
            </div>
            <div class="form-group">
              <label for="desciption" class="control-label">品牌描述:</label>
              <input type="text" name="description" class="form-control" id="description">
            </div>
            <div class="form-group">
              <label for="website" class="control-label">品牌网址:</label>
              <input type="text" name="website" class="form-control" id="website">
            </div>
            <div class="form-group">
              <label for="" class="control-label">状态:</label>
              
				<div class="radio">
				<label>
					<input name="status" value="0" type="radio" class="ace">
					<span class="lbl">禁用</span>
				</label>
				&nbsp;&nbsp;
				<label>
					<input name="status" checked="checked" value="1" type="radio" class="ace">
					<span class="lbl">显示</span>
				</label>
				</div>
			  
            </div>
            
				<!--<div class="form-group">
					<div class="col-xs-12">
						<input multiple="" name="file" type="file" id="id-input-file-3" />
					</div>
				</div>-->
            
            <div class="form-group">
              <label for="sort" class="control-label">排序:</label>
              <input type="text" name="sort" value="50" required="required" class="form-control" id="sort">
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
<script type="text/javascript">
$(function(){
    $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
    $("#storage-xingcai").addClass("active"); // 小分类
	/*
	var upload_in_progress = false;
	$('#id-input-file-3').ace_file_input({
		style:'well',
		btn_choose:'品牌LOGO',
		btn_change:null,
		no_icon:'ace-icon fa fa-cloud-upload',
		droppable:true,
		// maxSize: 110000,//bytes
		allowExt: ["jpeg", "jpg", "png", "gif"],
		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],
		thumbnail:'small'//large | fit
		//,icon_remove:null//set null, to hide remove/reset button
		,before_change:function(files, dropped) {
			//Check an example below
			//or examples/file-upload.html
			return true;
		}
		,before_remove : function() {
			if(upload_in_progress)
				return false;//if we are in the middle of uploading a file, don't allow resetting file input
			return true;
		}
		,
		preview_error : function(filename, error_code) {
			//name of the file that failed
			//error_code values
			//1 = 'FILE_LOAD_FAILED',
			//2 = 'IMAGE_LOAD_FAILED',
			//3 = 'THUMBNAIL_FAILED'
			//alert(error_code);
		}

	}).on('change', function(){
		//console.log($(this).data('ace_input_files'));
		//console.log($(this).data('ace_input_method'));
		//$(this).ace_file_input('loading', true);
	});
	*/

$('.close,.btn-secondary').click(function(){
	$('#exampleModalLabel').text('新增品牌');
	$('.ajaxForm').resetForm();
	$('.hidden_brand_id').html('');
});
	
	$('.openModal').click(function(){
		var brand_id = $(this).attr('data-id');
		if(brand_id != ''){
			$.get('<?php echo url('get_brand');?>?brand_id='+brand_id,{},function(res){
				$('#exampleModalLabel').text('修改品牌');
				$('.hidden_brand_id').html('<input type="hidden" name="brand_id" value="'+res.data.brand_id+'" />');
				$('#brand_name').val(res.data.brand_name);
				$('#description').val(res.data.description);
				$('#brand_name_en').val(res.data.brand_name_en);
				$('#website').val(res.data.website);
				$('#sort').val(res.data.sort);
				$('#exampleModal').modal({
					show : true,
					keyboard : false,
				});
			});
			
		}
	});

	$('.width100').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('brandsort');?>',data:{sort:$(this).val(),brand_id:$(this).attr('data-id')},success:function(data){
			if(data.code==0) {
				toastr.error(data.msg);
				}else{
					toastr.success('排序成功');}
		}});
	});
});
</script>
{/block}
