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
                                <th width="10%">序号</th>
                                <th width="10%">商品分类</th>
                                <th width="20%">供应商</th>
                                <th width="30%">商品名称</th>
                                <th width="10%">单位</th>
                                <th width="10%">库存数量</th>
                                <th width="10%">操作</th>
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
                                <td><input type="text" style="display: none;width:90%;" class="goods_id{$vo.goods_id}" oninput="checkNum2(this)" value="{$vo.store_number}"/><span class="goods_id{$vo.goods_id}">{$vo.store_number}</span></td>
                                <td>
                                	<a href="javascript:;" data-id="{$vo.goods_id}" class="update">修改</a>
                                </td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left"></div>
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
function checkNum2(obj){
	obj.value = obj.value.replace(/[^\d]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{1}/g,"");//如果有一个. 就清除
}
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-store").addClass("sidebar-nav-active"); // 大分类
        $("#store-index").addClass("active"); // 小分类
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

        var status = 1;
        $('.update').click(function(){
        	var goods_id = $(this).attr('data-id');
            if(status == 1){
                status = 2;
    			$('input.goods_id'+goods_id).show();
    			$('span.goods_id'+goods_id).hide();
    			$(this).text('保存');
            }else{
				status = 1;
    			$('input.goods_id'+goods_id).hide();
    			$('span.goods_id'+goods_id).show();
    			$(this).text('修改');
                var data={name:'scrap',goods_id:goods_id,store_number:$('input.goods_id'+goods_id).val()};
                $.sycToAjax("{:url('update_store')}", data);
            }
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