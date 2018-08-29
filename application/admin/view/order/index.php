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
                                <a class="btn btn-primary" href="{:url('order/add')}">新建订单</a>
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
                                <label class="control-label" for="company_short">客户简称 :</label>
                                <input name="company_short" id="company_short" class="ipt form-control" value="<?php if(isset($_GET['company_short'])){echo $_GET['company_short'];}?>" data-toggle="tooltip" data-placement="top" title="客户简称">
                                
                            </div>
                            	<div class="form-group">
                                    <label class="control-label" for="projectNameInput">创建时间 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> class="ipt form-control">
                                </div>
                                
                                <div class="form-group">
                                	<label class="control-label" for="">订单状态 :</label>
                                	<select name="status" id="status" class="ipt form-control">
                                		<option value="">全部</option>
                                		<option value="0" {if condition="isset($_GET['status']) && $_GET['status']!='' && $_GET['status']==0"}selected="selected"{/if}>未确认</option>
                                		<option value="1" {if condition="isset($_GET['status']) && $_GET['status']==1"}selected="selected"{/if}>已确认</option>
                                		<option value="5" {if condition="isset($_GET['status']) && $_GET['status']==5"}selected="selected"{/if}>已创建</option>
                                		<option value="2" {if condition="isset($_GET['status']) && $_GET['status']==2"}selected="selected"{/if}>已送货</option>
                                		<option value="3" {if condition="isset($_GET['status']) && $_GET['status']==3"}selected="selected"{/if}>已完成</option>
                                		<option value="4" {if condition="isset($_GET['status']) && $_GET['status']==4"}selected="selected"{/if}>已取消</option>
                                		<option value="6" {if condition="isset($_GET['status']) && $_GET['status']==6"}selected="selected"{/if}>部分已送货</option>
                                	</select>
                                </div>
                                
                         		<div class="form-group">
                                	<label class="control-label" for="">商品分类 :</label>
                                	<select name="categroy_id" id="categroy_id" class="ipt form-control">
                                		<option value="">全部</option>
                                        <?php foreach ($category as $key => $value):?>
                                        <option {if condition="isset($_GET['categroy_id']) && $_GET['categroy_id']==$value['category_id']"}selected="selected"{/if} value="<?php echo $value['category_id'];?>" path="<?php echo $value['path'].'_'.$value['category_id'];?>">
			              		<?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', substr_count($value['path'], '_'));?>
			              		└<?php echo str_repeat('─', substr_count($value['path'], '_'));?>
			              		<?php echo $value['category_name'];?>
			              		</option>
                                        <?php endforeach;?>
                                	</select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary" id="searchprojectName">查找</button>
                                <button type="button" class="btn btn-primary goods_attr_btn">按商品属性查找</button>
                                </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table">
                            <thead>
                            <tr>
                                <th>ID编号</th>
                                <th>订单号</th>
                                <th>下单日期</th>
                                <th>简称</th>
                                <th>商品名称</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>下单数量</th>
                                <th>要求送货日期</th>
                                <th>实际送货日期</th>
                                <th>创建时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" empty="$empty"}
                                <tr>
                                <td>{$vo.id}</td>
                                <td>{$vo.order_sn}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.company_short}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.goods_price}</td>
                                <td>{$vo.goods_number}</td>
                                <td>{$vo.require_time|date='Y-m-d',###}</td>
                                <td>{if condition="$vo['deliver_time']"}{$vo.deliver_time|date='Y-m-d',###}{else}--{/if}</td>
                                <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                <td>
								{if condition="$vo['status'] eq -1"}
								已删除
								{elseif condition="$vo['status'] eq 0"}
								未确认
								{elseif condition="$vo['status'] eq 1"}
								已确认
								{elseif condition="$vo['status'] eq 2"}
								已送货
								{elseif condition="$vo['status'] eq 3"}
								已完成
								{elseif condition="$vo['status'] eq 4"}
								已取消
								{elseif condition="$vo['status'] eq 5"}
								已创建
								{elseif condition="$vo['status'] eq 6"}
								部分已送货
								{/if}
								</td>
                                <td>
                                	<a href="{:url('info',['id' => $vo['oid']])}">详情</a>
                                	{if condition="$vo['status'] eq 0"}
                                	<span class="text-explode">|</span>
                                	<a href="{:url('edit',['id' => $vo['oid']])}">编辑</a>
                                	{/if}
                                	{if condition="$vo['status'] eq 0 || $vo['status'] eq 1 || $vo['status'] eq 5"}
                                	<span class="text-explode">|</span>
                                	<a href="javascript:cancel({$vo['oid']});">取消</a>
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
<style>.modal .form-control{width:250px !important;}.check_box{margin-top:10px;}.span_input{width:100px;display:block;float:left;margin-top:5px;}</style>
<div class="modal fade" aria-hidden="true" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" style="width:400px;" role="document">
      <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="<?php echo url('index');?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">关闭</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">产品属性</h4>
        </div>
        <div class="modal-body">
        
        	<div class="tabbable">

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
					
			            <div class="form-group form-inline">
			              <span class="span_input"><label for="check_cate"><input type="checkbox" id="check_cate" name="check_cate" value="1" class="check_box"/> 分类</label></span>
			              <input type="text" name="cate" class="form-control" id="cate" />
			            </div>           
           				<?php foreach ($attr as $key => $value){?>
           				<div class="form-group form-inline">
			              <span class="span_input"><label for="check_attr<?php echo $key;?>"><input type="checkbox" id="check_attr<?php echo $key;?>" value="1" name="check_attr[<?php echo $key;?>]" class="check_box"/> <?php echo $value;?></label></span>
			              <input type="text" name="attr_val[]" class="form-control" />
			            </div>
            			<?php }?>
				</div>
			</div>
 		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-primary">确认</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-schedule").addClass("sidebar-nav-active"); // 大分类
        $("#order-index").addClass("active"); // 小分类
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

		$('.goods_attr_btn').click(function(){
			$('#exampleModal').modal({
				show : true,
				keyboard : false,
			});
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