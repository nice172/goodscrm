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
            <h5><span>系统参数管理</span></h5>
            </div>
            <div class="pull-right">
            	<a class="btn btn-primary" href="{:url('add')}">新增参数</a>
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
			<th class="center">
				<label class="position-relative">
					<input class="ace" id="ckSelectAll" type="checkbox">
					<span class="lbl"></span>
				</label>
			</th>
			<th>编号ID</th>
			<th>参数名称</th>
			<th>参数描述</th>
			<th>可选值</th>
			<th>排序</th>
			<th>操作</th>
		</tr>
	</thead>
		{foreach name="list" item="v"}
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
				{$v.name}
			</td><td>
				{$v.desc}
			</td>
						<td>
				{$v['params_value']}
			</td>	
			
<td>
				{$v['sort']}
			</td>
			<td>
			
				<div class="hidden-sm hidden-xs btn-group">
				
					<button class="btn btn-xs btn-info" onclick="window.location.href='<?php echo url('edit',array('id' => $v['id']));?>'">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</button>
					
					<button class="btn btn-xs btn-danger ajaxDelete" data-id="<?php echo $v['id'];?>" action="<?php echo url('delete',array('id' => $v['id']));?>">
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
<tfoot>
<tr>
    <td colspan="9">
        <div class="pull-left">
            <button id="DelAllAttr" type="button" class="btn btn-default">选中删除</button>
            
        </div>
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
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-params").addClass("active"); // 小分类

        // 使用prop实现全选和反选
        $("#ckSelectAll").on('click', function () {
            $("input[name='checkbox[]']").prop("checked", $(this).prop("checked"));
        });
        
        // 获取选中元素
        $("#DelAllAttr").on('click', function () {
            if(confirm("是否删除所选？")){
                // 获取所有选中的项并把选中项的文本组成一个字符串
                var valArr = new Array;
                $("input[name='checkbox[]']:checked").each(function(i){
                    valArr[i] = $(this).val();
                });
                if (valArr.length !== 0 && valArr !== null && valArr !== '') {
                    var data={name:'delallattr',id:valArr.join(',')};
                    $.sycToAjax("{:url('delete')}", data);
                };
            };
            return false;
        });
        
    });
</script>
{/block}