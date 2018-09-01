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
                        <div class="portlet">
 <form class="form-horizontal ajaxForm2" method="post" action="<?php echo url('add');?>" id="form1">
  <!-- Tab panes -->
  <div class="tab-content">
								<input type="hidden" name="cus_id" id="cus_id" />
    							<input type="hidden" name="purchase_id" id="purchase_id" />
    							<input type="hidden" name="order_id" id="order_id" />
								
                    <table class="table contact-template-form" style="margin-bottom: 10px;">
                                <tbody>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>送货单号:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" readonly="readonly" value="DN<?php echo date('Ymdis').date('sms');?>" name="order_dn" id="order_dn">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>送货日期:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="delivery_date" id="delivery_date"></td>
                                </tr>
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>采购单:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w300" readonly="readonly" style="display:inline-block;" name="po_sn" id="po_sn">
                                	<button type="button" class="btn btn-primary search_purchase" style="margin-top:-4px;">查找</button>
                                </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>采购日期:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="purchase_date" id="purchase_date">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>采购金额:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="purchase_money" id="purchase_money"></td>
                                </tr>
                                
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>关联订单:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w300" readonly="readonly" style="display:inline-block;" name="order_sn" id="order_sn">
                                	<button type="button" style="display: none;" class="btn btn-primary relation_order" style="margin-top:-4px;">查找</button>
                                </td>
                                </tr>
                                
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>客户名称:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w300" style="display:inline-block;" name="cus_name" id="cus_name">
                                </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="contacts" id="contacts"></td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>电话号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="contacts_tel" id="contacts_tel">
                                    </td>
                                </tr>
                                 <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>送货地址:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w300" name="delivery_address" id="delivery_address">
                                </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>物流单号:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="delivery_sn" id="delivery_sn">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>交货方式:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="delivery_way" id="delivery_way"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>司机:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="delivery_driver" id="delivery_driver">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>司机电话:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="driver_tel" id="driver_tel"></td>
                                </tr>
                    </tbody>
                    </table>

		<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                        <th colspan="20">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>订单商品</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                <tr>
                                    <th width="5%">序号</th>
                                    <th width="10%">商品分类</th>
                                    <th width="20%">商品名称</th>
                                    <th width="5%">单位</th>
                                    <th width="5%">未交数量</th>
                                    <th width="5%">库存数量</th>
                                    <th width="10%">本次送货数量</th>
                                    <th width="5%">入库数量</th>
                                    <th width="25%">备注</th>
                                    <th width="10%">操作</th>
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                            
                        </table>

                <!--内容结束-->
            </div>
        </div>


  </div>
                
    <div class="modal-footer" style="border-top:none;">
        <div class="col-md-offset-5 col-md-12 left">
            <button type="submit" send="save" class="btn btn-primary">保 存</button>
<!--             <button type="submit" send="confirm" class="btn btn-primary">打印送货单</button> -->
            <button type="button" onclick="history.go(-1);" class="btn btn-default">取消</button>
        </div>
    </div>
</form>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<!-- Modal -->
<div class="modal fade" id="search_company_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">查找客户</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal search_account" method="post" action="<?php echo url('search_account');?>" id="form1">
			
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
<!--         <button type="button" class="btn btn-primary">确认</button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        layui.use('laydate', function() {
            var laydate = layui.laydate;
  		  	laydate.render({
    		    elem: '#delivery_date'
    		  });
        });
    	
        // 当前页面分类高亮
        $("#sidebar-delivery").addClass("sidebar-nav-active"); // 大分类
        $("#delivery-index").addClass("active"); // 小分类
        
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
        

        $(".search_purchase").click(function () {
            var title = '查找采购单';
            bDialog.open({
                title : title,
                height: 560,
                width:"90%",
                url : '{:url(\'search_purchase\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        window.location.reload();
                    }
                }
            });
        });

        $(".relation_order").click(function () {
            var title = '查找订单';
            var purchase_id = $('#purchase_id').val();
            bDialog.open({
                title : title,
                height: 560,
                width:"90%",
                url : '{:url(\'relation_order\')}?purchase_id='+purchase_id,
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

var goods_info = new Array();
var status = 1;
var relation_type = 1; //默认关联订单

function client_info(data){
	relation_type = 1;
	goods_info = [];
	$('#po_sn').val(data.po_sn);
	$('#purchase_date').val(data.purchase_date);
	$('#purchase_money').val(data.total_money);
	$('#purchase_id').val(data.purchase_id);
	if(data.is_cancel == 0 || data.create_type == 1){
    	$('#order_sn').val(data.order_sn);
    	$('#order_id').val(data.order_id);
    	$('#delivery_address').val(data.delivery_address);
    	$('#contacts').val(data.contacts);
    	$('#contacts_tel').val(data.cus_phome);
	}else{
		$('#cus_name').val('');
		$('#order_id').val('');
		//$('#purchase_id').val('');
    	$('#order_sn').val('');
    	$('#delivery_address').val('');
    	$('#contacts').val('');
    	$('#contacts_tel').val('');
    	$('#cus_id').val('');
		$('.relation_order').show();
	}
	$.get('<?php echo url('order');?>?purchase_id='+data.purchase_id,{},function(res){
		if(res.code == 1){
			$('.relation_order').hide();
			$('#cus_name').val(res.data.cus_name);
			$('#cus_id').val(res.data.cus_id);
			goods_info = res.data.goodslist;
			goodsList(goods_info);
		}else{
			$('#cus_name').val('');
			$('#order_id').val('');
			//$('#purchase_id').val('');
	    	$('#order_sn').val('');
	    	$('#delivery_address').val('');
	    	$('#contacts').val('');
	    	$('#contacts_tel').val('');
	    	$('#cus_id').val('');
	    	$('.relation_order').show();
	    	goods_info = [];
	    	goodsList(goods_info);
			toastr.error(res.msg);
		}
	});
}

function relation_order(data){
	relation_type = 0;
	goods_info = [];
	$('#purchase_date').val(data.purchase_date);
	$('#order_sn').val(data.order_sn);
	$('#order_id').val(data.orderid);
	var purchase_id = $('#purchase_id').val();
	$.get('<?php echo url('rel_order');?>?purchase_id='+purchase_id+'&order_id='+data.orderid,{},function(res){
		if(res.code == 1){
			$('#cus_name').val(res.data.cus_name);
			$('#cus_id').val(res.data.cus_id);
	    	$('#order_sn').val(res.data.order_sn);
	    	$('#delivery_address').val(res.data.delivery_address);
	    	$('#contacts').val(res.data.contacts);
	    	$('#contacts_tel').val(res.data.cus_phome);
	    	$('#purchase_money').val(res.data.total_money);
			goods_info = res.data.goodslist;
			goodsList(goods_info);
		}else{
			$('#cus_name').val('');
			$('#order_id').val('');
	    	$('#order_sn').val('');
	    	$('#delivery_address').val('');
	    	$('#contacts').val('');
	    	$('#contacts_tel').val('');
	    	$('#cus_id').val('');
	    	goodsList(goods_info);
			toastr.error(res.msg);
		}
	});
}

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
		var show_input = goods_info[j]['show_input']==true?'inline':'none';
		var show_span = goods_info[j]['show_input']==true?'none':'inline';
		var text_update = goods_info[j]['show_input']==true?'保存':'修改';
		html += '<tr data-index="'+j+'" data-goods_id="'+goods_info[j]['goods_id']+'" class="goods_'+j+'">';
		html += '<td>'+num+'</td>';
		html += '<td>'+goods_info[j]['category_name']+'</td>';
		html += '<td>'+goods_info[j]['goods_name']+'</td>';
		html += '<td>'+goods_info[j]['unit']+'</td>';
		html += '<td>'+goods_info[j]['diff_number']+'</td>';
		html += '<td class="store_number"><span class="">'+goods_info[j]['store_number']+'</span></td>';
		html += '<td class="current_send_number"><input type="text" data-current_send_number="'+goods_info[j]['current_send_number']+'" oninput="checkNum2(this)" name="current_send_number" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['current_send_number']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['current_send_number']+'</span></td>';
		html += '<td class="add_number"><input type="text" data-add_number="'+goods_info[j]['add_number']+'" oninput="checkNum2(this)" name="add_number" style="width:80%;display:'+show_input+';" value="'+goods_info[j]['add_number']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['add_number']+'</span></td>';
		html += '<td class="remark"><input type="text" name="remark" style="width:90%;display:'+show_input+';" value="'+goods_info[j]['remark']+'" /><span class="inputspan" style="display:'+show_span+';">'+goods_info[j]['remark']+'</span></td>';
		html += '<td><a href="javascript:;" onclick="update('+j+')" class="update">'+text_update+'</a><span class="text-explode">|</span><a href="javascript:;" onclick="_delete('+j+')" class="delete">删除</a></td>';
		html += '</tr>';
	}
	$('.goodsList').html(html);
}

function update(index){
	if(!goods_info[index]['show_input']){
		goods_info[index]['show_input'] = true;
		$('.goods_'+index+' .update').text('保存');
		$('.goods_'+index+' span.inputspan').hide();
		$('.goods_'+index+' input').show().css('display','inline');
		return;
	}
		var current_send_number = $('.goods_'+index+' input[name=current_send_number]').val();
		if(current_send_number == ''){
			current_send_number = $('.goods_'+index+' input[name=current_send_number]').attr('data-current_send_number');
		}
		var add_number = $('.goods_'+index+' input[name=add_number]').val();
		if(add_number == ''){
			add_number = $('.goods_'+index+' input[name=add_number]').attr('data-add_number');
		}
		current_send_number = parseInt(current_send_number);
		add_number = parseInt(add_number);
		if(current_send_number+add_number > goods_info[index]['purchase_number']){
			alert('“'+goods_info[index]['goods_name']+'”本次送货数量+入库数量不能大于采购单的未交数量');
			return;
		}
		
		goods_info[index]['current_send_number'] = current_send_number;
		goods_info[index]['add_number'] = add_number;
		goods_info[index]['remark'] = $('.goods_'+index+' input[name=remark]').val();
		goods_info[index]['show_input'] = false;
		$('tbody.goodsList tr').each(function(idx){
			var eIndex = $('tbody.goodsList tr').eq(idx).attr('data-index');
			if(eIndex != index){
				var _current_send_number = $('.goods_'+eIndex+' input[name=current_send_number]').val();
				if(_current_send_number == ''){
					_current_send_number = $('.goods_'+eIndex+' input[name=current_send_number]').attr('data-current_send_number');
				}
				var _add_number = $('.goods_'+eIndex+' input[name=add_number]').val();
				if(_add_number == ''){
					_add_number = $('.goods_'+eIndex+' input[name=add_number]').attr('data-add_number');
				}
				goods_info[eIndex]['current_send_number'] = parseInt(_current_send_number);
				goods_info[eIndex]['add_number'] = parseInt(_add_number);
				goods_info[eIndex]['remark'] = $('.goods_'+eIndex+' input[name=remark]').val();
			}
		});
    	$('.goods_'+index+' .update').text('修改');
    	$('.goods_'+index+' span.inputspan').show().css('display','inline');
    	$('.goods_'+index+' input').hide();
		goodsList(goods_info);
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
$('button[type=submit]').click(function(){
	var send = $(this).attr('send');
	$('.ajaxForm2').ajaxSubmit({
		data:{goods_info:goods_info,relation_type:relation_type,type:send},
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
	return false;});
</script>
{/block}