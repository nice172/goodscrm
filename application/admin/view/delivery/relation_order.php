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
        
							<div class="sub-button-line form-inline">
                            <form class="pull-left" method="get" action="?">
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">客户名称 :</label>
                                    <input name="supplier_name" id="supplier_name" class="ipt form-control" <?php if (isset($_GET['supplier_name'])):?>value="<?php echo $_GET['supplier_name'];?>"<?php endif;?> />
                                </div>
                            	<div class="form-group">
                                    <label class="control-label">送货日期 :</label>
                                    <input name="start_date" id="start_date" <?php if (isset($_GET['start_date'])):?>value="<?php echo $_GET['start_date'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_date" id="end_date" <?php if (isset($_GET['end_date'])):?>value="<?php echo $_GET['end_date'];?>"<?php endif;?> class="ipt form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">查找</button>
                                </div>
                            </form>
                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                                <tr>
                                    
                                    <th>订单号码</th>
                                    <th>下单时间</th>
                                    <th>送货日期</th>
                                    <th>客户名称</th>
                                    <th>商品分类</th>
                                    <th>商品名称</th>
                                    <th>单位</th>
                                    <th>下单数量</th>
                                    <th>未交数量</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" empty="$empty"}
                                <tr style="cursor: pointer;" index="{$key}" class="selected_po">
                                    <td>{$vo.order_sn}</td>
                                    <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                    <td>{$vo.require_time}</td>
                                    <td>{$vo.company_short}</td>
                                    <td>{$vo.category_name}</td>
                                    <td>{$vo.goods_name}</td>
                                    <td>{$vo.unit}</td>
                                    <td>{$vo.goods_number}</td>
                                    <td><?php echo $vo['goods_number']-$vo['send_num'];?></td>
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
    var polist = <?php echo $pojson;?>;
	$('.selected_po').click(function(){
		parent.window.relation_order(polist[$(this).attr('index')]);
		bDialog.close('');
	});
});
</script>
</body>
</html>