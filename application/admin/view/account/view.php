<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
<style>tr td,tr th{text-align:center;}</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
  
        <div class="modal-body">

<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>序号</th>
                                    <th>商品分类</th>
                                    <th>商品名称</th>
                                    <th>单位</th>
                                    <th>收货数量</th>
                                    <th>退款数量</th>
                                    <th>已开票数量</th>
                                    <th>入库数量</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" key="key" empty="$empty"}
                                <tr index="{$key}" class="selected_po">
                                    <td>{$key}</td>
                                    <td>{$vo.category_name}</td>
                                    <td>{$vo.goods_name}</td>
                                    <td>{$vo.unit}</td>
                                    <td>{$vo['current_send_number']+$vo['add_number']}</td>
                                    <td>0</td><td>0</td>
                                    <td>{$vo.add_number}</td>
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