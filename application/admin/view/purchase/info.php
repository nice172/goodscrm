{extend name="public/base"}
{block name="header"}
<style>.tab-pane{padding-top:15px;}</style>
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
                        </div>
                    </div>
                </div>           
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet margin-top-3">
 <form class="form-horizontal ajaxForm2" method="post" action="<?php echo url('confirm');?>" id="form1">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">采购单</a></li>
    <li><a href="{:url('record',['id' => $data['id'],'sid' => $data['supplier_id']])}">采购记录</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    <input type="hidden" name="id" value="{$data.id}"  id="id" />
    <input type="hidden" name="cus_id" value="{$data.cus_id}"  id="cus_id" />
								
                    <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td width="15%" class="right-color"><span>PO号码:</span></td>
                                    <td width="35%">
                                        <span>{$data.po_sn}</span>
                                    </td>
                                    <td width="15%" class="right-color"><span>订购日期:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" readonly="readonly" value="{$data.create_time|date='Y-m-d',###}" name="create_date" id="create_date"></td>
                                </tr>
                                <tr>
                                <td width="15%" class="right-color"><span>供应商:</span></td>
                                <td width="35%" colspan="3">
                                	<span>{$data.supplier_name}</span>
                                </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color"><span>联系人:</span></td>
                                    <td width="35%">{$data.contacts}</td>
                                    <td width="15%" class="right-color"><span>电话号码:</span></td>
                                    <td width="35%">
                                        {$data.cus_phome}
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color">传真号码:</span></td>
                                    <td width="35%">
                                        {$data.fax}
                                    </td>
                                    <td width="15%" class="right-color"><span>E-Mail:</span></td>
                                    <td width="35%">{$data.email}</td>
                                </tr> 
                               <tr>
                                    <td width="15%" class="right-color"><span>交易类别:</span></td>
                                    <td width="35%">
                                       {$data.transaction_type}
                                    </td>
                                    <td width="15%" class="right-color"><span>付款条件:</span></td>
                                    <td width="35%">
                                      {$data.payment}
                                    </td>
                                </tr> 
                                 <tr>
                                <?php if ($data['create_type']==0){?>
                                <td width="15%" class="right-color"><span class="text-danger"></span><span>关联订单:</span></td>
                                    <td width="35%">
                                        <span>{if condition="$data['is_cancel']"}已取消关联{else}{$data.order_sn}{/if}</span>
                                    </td>
                                <?php }?>
                                <td width="15%" class="right-color"><span>交货方式:</span></td>
                                <td width="35%" <?php if ($data['create_type']==1){echo 'colspan="3"';}?>>
                                	{$data.delivery_type}
                                </td>
                                
                           <tr>
                                    <td width="15%" class="right-color"><span>送货公司:</span></td>
                                    <td width="35%">
                                        {$data.delivery_company}
                                    </td>
                                    <td width="15%" class="right-color"><span>税率:</span></td>
                                    <td width="35%">
                                    {$data.tax}
                                    </td>
                                </tr> 
                                
                                   <tr>
                                    <td width="15%" class="right-color"><span>送货地址:</span></td>
                                    <td colspan="3">
                                    	 {$data.delivery_address}
                                    </td>
                                </tr>
                                 <tr>
                                    <td width="15%" class="right-color"><span>备注:</span></td>
                                    <td colspan="3">{$data.remark}</td>
                                </tr>
                                
                    </tbody>
                    </table>


		<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border" style="margin-top:0px;">
                            <thead>
                            <tr>
                                        <th colspan="20">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>商品信息</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                <tr>
                                    <th>序号</th>
                                    <th>商品名称</th>
                                    <th>单位</th>
                                    <th>单价</th>
                                    <?php if ($data['create_type']==0 && !$data['is_cancel']){?>
                                    <th>订单数量</th>
                                    <?php }?>
                                    <th>采购数量</th>
                                    <th>已送数量</th>
                                    <th>库存数量</th>
                                    <th>总金额</th>
                                    <!-- <th>操作</th> -->
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                        </table>

                <!--内容结束-->
            </div>
        </div>

</div>

  </div>
                
    {if condition="$data['status']==0 || $data['status']==1"}
    <div class="modal-footer" style="border-top: none;">
        <div class="col-md-offset-5 col-md-12 left">
            
            {if condition="$data['status']==1"}
            <button type="submit" send="send" class="btn btn-primary">生成PDF并发送</button>
            {elseif condition="$data['status']==0"}
            <button type="submit" send="confirm" class="btn btn-primary">确认采购单</button>
            {else}
            
            {/if}
            
<!--
            
            <button type="reset" onclick="history.go(-1);" class="btn btn-default">取消</button>
-->
            
        </div>
    </div>
    {/if}
</form>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<!-- Modal -->
<div class="modal fade" id="contacts_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">选择联系人</h4>
      </div>
      <div class="modal-body">
      		                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                <th>选择</th>
                                <th>联系人</th>
                                <th>职务</th>
                                <th>电子邮箱</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach name="$supplier" item="v"}
                            <tr>
                            	<td><input type="checkbox" name="send_email_list" value="{$v.con_email}"/></td>
                            	<td>{$v.con_name}</td>
                            	<td>{$v.con_post}</td>
                            	<td>{$v.con_email}</td>
                            </tr>
                            {/foreach}
                            </tbody>
                            </table>
                            </div>
                            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary confirmSend">确认生成并发送</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>

<script type="text/javascript">
function _formatMoney(num){
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
//  每隔3位添加,
// 	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
// 	num = num.substring(0,num.length-(4*i+3))+','+
// 	num.substring(num.length-(4*i+3));

	return (((sign)?'':'-') + num + '.' + cents);
}
    $(document).ready(function() {
        layui.use('laydate', function() {
            var laydate = layui.laydate;
  		  	laydate.render({
    		    elem: '#LAY-component-form-group-date'
    		  });
        });
        
        // 当前页面分类高亮
        $("#sidebar-purchase").addClass("sidebar-nav-active"); // 大分类
        $("#purchase-index").addClass("active"); // 小分类

		$('.attrChange').change(function(){
			var goods_type_id = $(this).val();
			$.get('<?php echo url('change_type');?>',{goods_type_id:goods_type_id},function(res){
				$('.appendAttr').html(res);
			});
		});

		$('.search_companyx').click(function(){
			$('#search_company_modal').modal({
				show : true,
				keyboard : false,
				backdrop:'static'
			});
		});
        

        $(".search_company").click(function () {
            var title = '查找客户';
            bDialog.open({
                title : title,
                height: 560,
                width:960,
                url : '{:url(\'search_company\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

        $('.get_goods').click(function(){
        	var title = '选择商品';
            bDialog.open({
                title : title,
                height: 560,
                width:960,
                url : '{:url(\'get_goods\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

    });

function client_info(data){
	$('#cus_id').val(data.id);
	$('#company_name').val(data.company_name);
	$('#company_short').val(data.company_short);
	$('#fax').val(data.fax);
	$('#contacts').val(data.user);
	$('#email').val(data.email);
}

var goods_info = new Array();
<?php if(!empty($data['goodsInfo'])){ foreach ($data['goodsInfo'] as $goods){?>
goods_info.push(<?php echo $goods;?>);
<?php }}?>
if(goods_info.length > 0){
	goodsList(goods_info);
}

var status = 1;
function goods(data){
	var flag = false;
	for(var i in goods_info){
		if(goods_info[i]['goods_id'] == data.goods_id){
			flag = true;
			break;
		}
	}
	if(!flag){
		goods_info.push(data);
	}
	status = 1;
	goodsList(goods_info);
}

function goodsList(goods_info){
	var html = '';
	for(var j in goods_info){
		var num = parseInt(j)+1;
		goods_info[j]['totalMoney'] = _formatMoney(goods_info[j]['purchase_number']*goods_info[j]['shop_price']);
		html += '<tr data-index="'+j+'" data-goods_id="'+goods_info[j]['goods_id']+'" class="goods_'+j+'">';
		html += '<td>'+num+'</td>';
		html += '<td>'+goods_info[j]['goods_name']+'</td>';
		html += '<td>'+goods_info[j]['unit']+'</td>';
		html += '<td class="shop_price"><input type="text" data-shop_price="'+goods_info[j]['shop_price']+'" oninput="checkNum(this)" name="shop_price" style="width:80px;display:none;" value="'+goods_info[j]['shop_price']+'" /><span class="inputspan">'+goods_info[j]['shop_price']+'</span></td>';
		<?php if ($data['create_type']==0 && !$data['is_cancel']){?>
		html += '<td class="goods_number"><span class="span">'+goods_info[j]['goods_number']+'</span></td>';
		<?php }?>
		html += '<td class="purchase_number"><input type="text" data-purchase_number="'+goods_info[j]['purchase_number']+'" oninput="checkNum2(this)" name="purchase_number" style="width:80px;display:none;" value="'+goods_info[j]['purchase_number']+'" /><span class="inputspan">'+goods_info[j]['purchase_number']+'</span></td>';
		html += '<td class="send_number"><span class="span">'+goods_info[j]['send_num']+'</span></td>';
		html += '<td class="store_number"><span class="span">'+goods_info[j]['store_number']+'</span></td>';
		html += '<td class="totalMoney"><span class="span">'+goods_info[j]['totalMoney']+'</span></td>';
		//html += '<td><a href="javascript:;" onclick="update('+j+')" class="update">修改</a><span class="text-explode">|</span><a href="javascript:;" onclick="_delete('+j+')" class="delete">删除</a></td>';
		html += '</tr>';
	}
	$('.goodsList').html(html);
}

function update(index){
	if(status == 2){
		status = 1;
		var shop_price = $('.goods_'+index+' input[name=shop_price]').val();
		if(shop_price == ''){
			shop_price = $('.goods_'+index+' input[name=shop_price]').attr('data-shop_price');
		}
		if(shop_price > goods_info[index]['shop_price']){
			alert('采购单价不能高于关联订单商品单价');
			status = 2;
			return;
		}
		var goods_number = $('.goods_'+index+' input[name=goods_number]').val();
		if(goods_number == ''){
			goods_number = $('.goods_'+index+' input[name=goods_number]').attr('data-goods_number');
		}
		var purchase_number = $('.goods_'+index+' input[name=purchase_number]').val();
		if(purchase_number == ''){
			purchase_number = $('.goods_'+index+' input[name=purchase_number]').attr('data-purchase_number');
		}
		
		if(purchase_number > goods_info[index]['store_number']){
			alert('采购数量不能大于库存量');
			status = 2;
			return;
		}
		//goods_info[index]['goods_number'] = goods_number;
		goods_info[index]['purchase_number'] = purchase_number;
		goods_info[index]['shop_price'] = shop_price;
		goodsList(goods_info);
		return;
	}
	status = 2;
	$('.goods_'+index+' .update').text('保存');
	$('.goods_'+index+' span.inputspan').hide();
	$('.goods_'+index+' input').show();
}

function checkNum(obj){
	obj.value = obj.value.replace(/[^\d.]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{2,}/g,".");//只保留第一个. 清除多余的
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入三个小数.(\d\d\d) 修改个数  加\d
}

function checkNum2(obj){
	obj.value = obj.value.replace(/[^\d]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{1}/g,"");//如果有一个. 就清除
}

function _delete(index){
	status = 1;
	var newGoodsList = new Array();
	for(var i in goods_info){
		if(i != index){
			newGoodsList.push(goods_info[i]);
		}
	}
	goods_info = newGoodsList;
	goodsList(goods_info);
}

$('.confirmSend').click(function(){
	var send_email_list = '';
	var input = $('input[name=send_email_list]');
	input.each(function(index){
		if($(input).eq(index).is(':checked')){
			send_email_list += $(input).eq(index).val()+',';
		}
	});
	if(send_email_list == '' || send_email_list.split(',').length == 0){
		//alert('请至少选择一个联系人');
		//return false;
	}
	_ajaxSubmit('send',send_email_list);
});

function _ajaxSubmit(send,send_email_list){
	if(!send_email_list) send_email_list = '';
	$('.ajaxForm2').ajaxSubmit({
		data:{send_email_list:send_email_list,type:send},
		success: function(res){
			if(res.code == 1){
				toastr.success(res.msg);
				if(res.url != '' && typeof res.url != 'undefined'){
					setTimeout(function(){window.location.href = res.url;},2000);
					}else{
						setTimeout(function(){window.location.reload();},2000);
						}
			}else{
				toastr.error(res.msg);
				}
		}
	});
}

$('button[type=submit]').click(function(){
	var send = $(this).attr('send');
	{if condition="$data['status']==1"}
	$('#contacts_modal').modal({
		show : true,
		keyboard : false,
		backdrop:'static'
	});
	return false;
	{else}
	_ajaxSubmit(send);
	{/if}
	return false;});
</script>
{/block}