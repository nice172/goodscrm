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
<div class="col-xs-12">
<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal" >新增品牌</button>
</div>
</div>


<table id="sample-table-1" class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>品牌名称</th>
			<th>品牌LOGO</th>
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
			<?php if ($v['cloud_upload']){ ?>
			<img src="<?php echo config('CLOUD_URL').'/'.urlencode($v['brand_logo']);?>" alt="<?php echo $v['brand_name'];?>" height="25" />
			<?php }else{ ?>
			<img src="<?php echo request()->domain().$v['brand_logo'];?>" alt="<?php echo $v['brand_name'];?>"  height="25" />
			<?php }?>
			</td>
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
					<a href="<?php echo url('updateParams',array('brand_id' => $v['brand_id']));?>" class="btn btn-xs btn-danger" data-id="<?php echo $v['brand_id'];?>">修改</a>
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['brand_id'];?>" action="<?php echo url('deleteAttr',array('brand_id' => $v['brand_id']));?>">
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
      <form method="post" class="ajaxForm" enctype="multipart/form-data" action="<?php echo url('addBrand');?>">
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
              <input type="text" name="description" class="form-control" id="desciption">
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
            
				<div class="form-group">
					<div class="col-xs-12">
						<input multiple="" name="file" type="file" id="id-input-file-3" />
						<!-- /section:custom/file-input -->
					</div>
				</div>
            
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


</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->
{/block}
{block name="footer_static"}
<script type="text/javascript">
$(function(){
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
	

	
	$('.openModal').click(function(){
		$('#exampleModal').modal({
			show : true,
			keyboard : false,
		});
	});

	$('.width100').blur(function(){
		$.ajax({type:'post',url:'<?php echo url('updateSort');?>',data:{sort:$(this).val(),goods_attr_id:$(this).attr('data-id')},success:function(data){
			var data = JSON.parse(data);
			if(data.code==0) layer.msg(data.msg, function(){});
		}});
	});
});
</script>
{/block}
