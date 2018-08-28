{extend name="public/base"}
{block name="header"}

{/block}

{block name="sub_sidebar"}
{include file="account/account_sidebar"}
{/block}

{block name="main"}
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}列表</span></h5>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{:url('wait')}">新建</a>
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
                                <input name="supplier_name" id="supplier_name" class="ipt form-control" value="<?php if(isset($_GET['supplier_name'])){echo $_GET['supplier_name'];}?>" data-toggle="tooltip" data-placement="top" title="供应商名称">
                                
                            </div>
                            	<div class="form-group">
                                    <label class="control-label" for="start_time">对账日期 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> class="ipt form-control">
                                </div>
                                
                                <div class="form-group">
                                	<label class="control-label" for="status">对账状态 :</label>
                                	<select name="status" id="status" class="form-control">
                                		<option value="">全部</option>
                                		<option value="1">未对账</option>
                                		<option value="2">已对账</option>
                                	</select>
                                </div>
                                <div class="form-group">
                                	<label class="control-label" for="is_open">发票状态 :</label>
                                	<select name="is_open" id="is_open" class="form-control">
                                		<option value="">全部</option>
                                		<option value="0">未开票</option>
                                		<option value="1">已开票</option>
                                	</select>
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
                            	<th>ID</th>
                            	<th>供应商</th>
                            	<th>发票号码</th>
                            	<th>发票日期</th>
                            	<th>已对账</th>
                                <th>发票状态</th>
                                <th>对账金额</th>
                                <th>已付金额</th>
                                <th>冲减金额</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.id}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.invoice_sn}</td>
                                <td>{$vo.invoice_date}</td>
                                <td>{if condition="$vo['status']==1"}未对账{elseif condition="$vo['status']==2"}已对账{else}已关闭{/if}</td>
                                <td>{if condition="$vo['is_open']"}已开票{else}未开票{/if}</td>
                                <td>{$vo.total_money}</td>
                                <td>{$vo.pay_money}</td>
                                <td>{$vo.diff_money}</td>
                                <td>
									<a href="{:url('payment_info',['id' => $vo['id']])}">详情</a>
                                	{if condition="$vo['status']!=0"}
                                		{if condition="!$vo['is_open'] && $vo['status']==2"}
                                		<span class="text-explode">|</span>
                                		<a href="javascript:;" onclick="_open({$vo['id']})">已开票</a>
                                		{/if}
                                		{if condition="$vo['status']==1"}
                                    	<span class="text-explode">|</span>
                                    	<a href="javascript:;" onclick="_status({$vo['id']})">已对账</a>
                                    	{/if}
                                	{/if}
                                	{if condition="!$vo['is_open'] || $vo['status']==1"}
                                	<span class="text-explode">|</span>
                                	<a href="{:url('payment_edit',['id' => $vo['id']])}">编辑</a>
                                	{/if}
                                	<span class="text-explode">|</span>
                                	<a href="javascript:;" onclick="deleteOrdersOne({$vo['id']})">删除</a>
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
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-account").addClass("sidebar-nav-active"); // 大分类
        $("#account-payment").addClass("active"); // 小分类
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
    function _open(e) {
        if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('payment_open')}", data);
            }
        };
        return false;
    }
    function _status(e) {
        if(confirm("确认操作？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('payment_status')}", data);
            }
        };
        return false;
    }

    function deleteOrdersOne(e) {
        if(confirm("确定删除？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'scrap',id:e};
                $.sycToAjax("{:url('payment_delete')}", data);
            }
        };
        return false;
    }
</script>
{/block}