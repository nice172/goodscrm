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
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                            <div class="pull-right">
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
                                <label class="control-label" for="cus_name">客户名称 :</label>
                                <input name="cus_name" id="cus_name" class="ipt form-control" value="<?php if(isset($_GET['cus_name'])){echo $_GET['cus_name'];}?>" data-toggle="tooltip" data-placement="top" title="客户名称">
                            </div>
                                <div class="form-group">
                                	<label class="control-label" for="order_sn">订单号码 :</label>
                                	<input name="order_sn" id="order_sn" class="ipt form-control" value="<?php if(isset($_GET['order_sn'])){echo $_GET['order_sn'];}?>" data-toggle="tooltip" data-placement="top" title="订单号码">
                                </div>
                            	<div class="form-group">
                                    <label class="control-label" for="start_time">送货日期 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> class="ipt form-control">
                                </div>
                                                                
                                <button type="submit" class="btn btn-primary">查找</button>
                                </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table">
                            <thead>
                            <tr>
                                <th>选择</th>
                                <th>客户名称</th>
                                <th>商品分类</th>
                                <th>商品名称</th>
                                <th>送货单号</th>
                                <th>送货日期</th>
                                <th>订单号</th>
                                <th>下单日期</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>税率</th>
                                <th>交货数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td><input type="checkbox" {if condition="isset($soset['checked']) && in_array($vo['cus_id'].'_'.$vo['id'].'_'.$vo['order_id'],$soset['checked'])"}checked="checked"{/if} name="cus_delivery[]" data-cus_id="{$vo.cus_id}" value="{$vo.cus_id}_{$vo.id}_{$vo.order_id}"/></td>
                                <td>{$vo.cus_name}</td>
                                <td>{$vo.category_name}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.order_dn}</td>
                                <td>{$vo.delivery_date}</td>
                                <td>{$vo.order_sn}</td>
                                <td>{$vo.order_create_time|date='Y-m-d',###}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>{$vo.tax}</td>
                                <td>{$vo.current_send_number}</td>
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
           {if condition="!empty($list)"}             
    <div class="modal-footer" style="border-top:none;">
        <div class="col-md-offset-5 col-md-12 left">
            <button type="submit" class="btn btn-primary confirm">确认</button>
            <button type="button" class="btn btn-default cancel">取消</button>
        </div>
    </div>
            {/if}            
                    </div>
                </div>

                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-account").addClass("sidebar-nav-active"); // 大分类
        $("#account-index").addClass("active"); // 小分类
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期选择器
            laydate.render({
                elem: '#start_time'
                //,type: 'date' //默认，可不填
            });
            laydate.render({
                elem: '#end_time'
                //,type: 'date' //默认，可不填
            });
        });
        $('[data-toggle="tooltip"]').tooltip(); //工具提示

		$('.cancel').click(function(){
			$.ajax({
				method:'POST',
				url:'<?php echo url('soset');?>',
				data:{},success:function(res){
					window.history.go('-1');
					if(res.code != 1){
					alert(res.msg);}
				}});
		});
		var checkedArr = new Array();
		var current_cus = 0;
		<?php if (isset($soset['checked'])){ foreach ($soset['checked'] as $val){?>
		checkedArr.push('<?php echo $val;?>');
		<?php }}?>
		$('.confirm').click(function(){
			if(checkedArr.length == 0){
				alert('请选择销售单');
				return;
			}
			window.location.href='<?php echo url('create');?>';
		});
        
		$("input[name='cus_delivery[]']").click(function(){
			var cus_id = $(this).attr('data-cus_id');
			var val = $(this).val();
			if(current_cus != 0 && current_cus != cus_id){
				$(this).attr('checked',false);
				alert('客户名称不相同的不能创建对账单');
				return;
			}
			if(current_cus == 0){
				current_cus = cus_id;
			}
			if($(this).is(':checked')){
				checkedArr.push(val);
			}else{
				var newArr = new Array();
				for(var i in checkedArr){
					if(val != checkedArr[i]){
						newArr.push(checkedArr[i]);
					}
				}
				checkedArr = newArr;
			}
			$.ajax({
				method:'POST',
				url:'<?php echo url('soset');?>',
				data:{checked:checkedArr},success:function(res){
					if(res.code != 1){
					alert(res.msg);}
				}});
		});
        
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
        if(confirm("是否取消此订单？")){
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
                $.sycToAjax("{:url('orders/huifu')}", data);
            }
        };
        return false;
    }

    //单条删除订单操作
    function deleteOrdersOne(e) {
        if(confirm("确定删除？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('delete')}", data);
            }
        };
        return false;
    }
</script>
{/block}