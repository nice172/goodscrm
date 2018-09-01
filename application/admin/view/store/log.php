<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
  
        <div class="modal-body">

<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                                <tr>
                                    <th width="10%">序号</th>
                                    <th width="15%">创建时间</th>
                                    <th width="15%">变动类别</th>
                                    <th width="20%">商品分类</th>
                                    <th width="30%">商品名称</th>
                                    <th width="10%">数量</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" key="key" empty="$empty"}
                                <tr index="{$key}" class="selected_po">
                                    <td>{$key}</td>
                                    <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                    <td>
                                    {if condition="$vo['type']==1"}
                                    	入库
                                    {elseif condition="$vo['type']==2"}
                                    	出库
                                    {elseif condition="$vo['type']==3"}
                                    	报溢
                                    {elseif condition="$vo['type']==4"}
                                    	报损
                                    {/if}
                                    </td>
                                    <td>{$vo.category_name}</td>
                                    <td>{$vo.goods_name}</td>
                                    <td>{$vo.number}</td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
<!--                                 <td width="10"> -->
<!--                                     <input type="checkbox" class="mydomain-checkbox" id="ckSelectAll" name="ckSelectAll"> -->
<!--                                 </td> -->
                                <td colspan="19">
                                    <div class="pull-left">
<!--                                         <button id="DelAllAttr" type="button" class="btn btn-default">选中删除</button> -->
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                <!--内容结束-->
            </div>
        </div>
                        

        </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    layui.use('laydate', function() {
        var laydate = layui.laydate;
		  	laydate.render({
		    elem: '#start_date'
		  });
		  	laydate.render({
		    elem: '#end_date'
		  });
    });
    var polist = [];
	$('.selected_po').click(function(){
		//parent.window.relation_order(polist[$(this).attr('index')]);
		//bDialog.close('');
	});
});
</script>
</body>
</html>