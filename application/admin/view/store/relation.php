{extend name="public/base"}
{block name="header"}

{/block}

{block name="main"}
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                            </div>
                            <div class="pull-right">
                                <!--<a class="btn btn-primary" href="{:url('order/add')}">新建订单</a>-->
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-inline marginTop10">
                        <div class="col-lg-12">
                        
                        	<form action="" method="get">
                        
                            <div class="form-group">
                                <label class="control-label" for="supplier_name">供应商 :</label>
                                <input name="supplier_name" id=supplier_name class="ipt form-control" value="<?php if(isset($_GET['supplier_name'])){echo $_GET['supplier_name'];}?>" data-toggle="tooltip" data-placement="top" title="供应商">
                                
                            </div>
                            	<div class="form-group">
                                    <label class="control-label" for="goods_name">商品名称 :</label>
                                    <input name="goods_name" id="goods_name" <?php if (isset($_GET['goods_name'])):?>value="<?php echo htmlspecialchars($_GET['goods_name']);?>"<?php endif;?> class="ipt form-control">
                                </div>
                                
                                <div class="form-group">
                                <label class="control-label" for="category_id">商品分类 :</label>
                                	<select name="category_id" class="form-control" id="category_id">
                                     <option value="">--选择商品分类--</option>
                                            <option value="0" path="0">├顶级分类</option>
			              	<?php foreach ($lists as $key => $value){ ?>
			              		<option <?php if (isset($_GET['category_id']) && $_GET['category_id']==$value['category_id']):?>selected="selected"<?php endif;?> value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>">
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
			              	<?php } ?>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">查找</button>
                                </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>商品分类</th>
                                <th>供应商</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>库存数量</th>
                                <th>关联订单</th>
                                <th>关联采购单</th>
                                <th>变动记录</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" key="key" empty="$empty"}
                                <tr>
                                <td>{$key}</td>
                                <td>{$vo.category_name}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.store_number}</td>
                                <td>{$vo.order_sn}</td>
                                <td>{$vo.po_sn}</td>
                                <td><a href="javascript:;" onclick="viewLog({$vo['goods_id']},{$vo.order_id})">查看</a></td>
                                <td>
                                	{if condition="$vo['is_cancel']==1"}
                                	<span>已取消关联</span>
                                	{else}
                                	<a href="javascript:cancel({$vo.purchase_id});" data-id="{$vo.purchase_id}">取消关联</a>
                                	{/if}
                                </td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left">
                                        
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript">

function viewLog(goods_id,order_id){
    var title = '变动记录';
    bDialog.open({
        title : title,
        height: 630,
        width:'85%',
        url : '{:url(\'log\')}?goods_id='+goods_id+'&order_id='+order_id,
        callback:function(data){
            if(data && data.results && data.results.length > 0 ) {
                window.location.reload();
            }
        }
    });
}

    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-store").addClass("sidebar-nav-active"); // 大分类
        $("#relation-index").addClass("active"); // 小分类
//         layui.use('laydate', function() {
//             var laydate = layui.laydate;
//             //日期选择器
//             laydate.render({
//                 elem: '#start_time'
//                 //,type: 'date' //默认，可不填
//             });
//             laydate.render({
//                 elem: '#end_time'
//                 //,type: 'date' //默认，可不填
//             });
//         });
        $('[data-toggle="tooltip"]').tooltip(); //工具提示

        // 使用prop实现全选和反选
        $("#ckSelectAll").on('click', function () {
            $("input[name='ckbox[]']").prop("checked", $(this).prop("checked"));
        });
        // 获取选中元素
        $("#DelAllAttr").on('click', function () {
            layui.use(['layer'], function() {
                var layer = layui.layer;
                layer.open({
                    title: '温馨提示',
                    content: '是否要废除所有选择的订单？',
                    btn: ['我已确认', '放弃操作'],
                    yes: function(index, layero){
                        layer.close(index);
                        var valArr = new Array;
                        $("input[name='ckbox[]']:checked").each(function(i){
                            valArr[i] = $(this).val();
                        });
                        if (valArr.length !== 0 && valArr !== null && valArr !== '') {
                            var data={name:'delallattr',uid:valArr.join(',')};
                            $.sycToAjax("{:Url('orders/scrap')}", data);
                        };
                        return false;
                    }
                    ,btn2: function(index, layero){
                        layer.close(index);
                    }
                });
            });
        });
    });
    //单条订单操作
    function cancel(e) {
        if(confirm("确认取消关联？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('cancel')}", data);
            }
        };
        return false;
    }
    
    //单条恢复订单操作
    function huifuLogisticsOne(e) {
        if(confirm("确定恢复此订单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',pid:e};
                $.sycToAjax("{:Url('orders/huifu')}", data);
            }
        };
        return false;
    }

    //单条删除订单操作
    function deleteOrdersOne(e) {
        if(confirm("确定删除订单？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',pid:e};
                $.sycToAjax("{:Url('orders/delete')}", data);
            }
        };
        return false;
    }
</script>
{/block}