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
 <form class="form-horizontal ajaxForm2" method="post" action="<?php echo url('edit');?>" id="form1">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#goods" aria-controls="goods" role="tab" data-toggle="tab">商品</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    <input type="hidden" name="id" value="{$data.id}"  id="id" />
    <input type="hidden" name="cus_id" value="{$data.cus_id}"  id="cus_id" />
								
                    <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>订单号:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$data.order_sn}" name="order_sn" id="order_sn">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>下单日期:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" readonly="readonly" value="{$data.create_time|date='Y-m-d',###}" name="create_date" id="create_date"></td>
                                </tr>
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>公司名称:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w500" style="display:inline-block;" value="{$data.company_name}" name="company_name" id="company_name">
                                	<button type="button" class="btn btn-primary search_company" style="margin-top:-4px;">查找</button>
                                </td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>简称:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="company_short" value="{$data.company_short}" id="company_short">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="contacts" value="{$data.contacts}" id="contacts"></td>
                                </tr>
                                
                                <tr>
                                    <td width="15%" class="right-color">传真号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" value="{$data.fax}" name="fax" id="fax">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>E-Mail:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="email" value="{$data.email}" id="email"></td>
                                </tr> 
                                 <tr>
                                <td width="15%" class="right-color"><span class="text-danger">*</span><span>交货日期:</span></td>
                                <td width="35%" colspan="3">
                                	<input type="text" class="form-control w300" name="require_time" value="{$data.require_time|date='Y-m-d',###}" id="LAY-component-form-group-date">
                                </td>
                                </tr>
                                   <tr>
                                    <td width="15%" class="right"><span>备注:</span></td>
                                    <td colspan="3"><textarea class="form-control" name="remark" id="remark" rows="6">{$data.order_remark}</textarea> </td>
                                </tr>
                                
                    </tbody>
                    </table>
    </div>

<div role="tabpanel" class="tab-pane" id="goods">

		<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>商品名称</th>
                                    <th>单位</th>
                                    <th>标准单价</th>
                                    <th>实际单价</th>
                                    <th>下单数量</th>
                                    <th>已送数量</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                            <tfoot>
                            	<tr>
                            	<td><a href="javascript:;" class="get_goods">请选择商品</a></td>
                            	<td colspan="10"></td>
                            	</tr>
                            </tfoot>
                        </table>

                <!--内容结束-->
            </div>
        </div>

</div>

  </div>
                
    <div class="modal-footer">
        <div class="col-md-offset-2 col-md-8 left">
            <button type="submit" send="save" class="btn btn-primary">保 存</button>
            <button type="submit" send="confirm" class="btn btn-primary">确 认</button>
            <button type="submit" send="create" class="btn btn-primary">创建采购单</button>
            <button type="reset" onclick="history.go(-1);" class="btn btn-default">取消</button>
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
    		    elem: '#LAY-component-form-group-date'
    		  });
        });
    	
        // 当前页面分类高亮
        $("#sidebar-schedule").addClass("sidebar-nav-active"); // 大分类
        $("#order-index").addClass("active"); // 小分类

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
		html += '<tr data-index="'+j+'" data-goods_id="'+goods_info[j]['goods_id']+'" class="goods_'+j+'">';
		html += '<td>'+num+'</td>';
		html += '<td>'+goods_info[j]['goods_name']+'</td>';
		html += '<td>'+goods_info[j]['unit']+'</td>';
		html += '<td class="market_price"><input type="text" data-market_price="'+goods_info[j]['market_price']+'" oninput="checkNum(this)" name="market_price" style="width:80px;display:none;" value="'+goods_info[j]['market_price']+'" /><span class="inputspan">'+goods_info[j]['market_price']+'</span></td>';
		html += '<td class="shop_price"><input type="text" data-shop_price="'+goods_info[j]['shop_price']+'" oninput="checkNum(this)" name="shop_price" style="width:80px;display:none;" value="'+goods_info[j]['shop_price']+'" /><span class="inputspan">'+goods_info[j]['shop_price']+'</span></td>';
		html += '<td class="goods_number"><input type="text" data-goods_number="'+goods_info[j]['goods_number']+'" oninput="checkNum2(this)" name="goods_number" style="width:80px;display:none;" value="'+goods_info[j]['goods_number']+'" /><span class="inputspan">'+goods_info[j]['goods_number']+'</span></td>';
		html += '<td class="send_num"><input type="text" data-send_num="'+goods_info[j]['send_num']+'" oninput="checkNum2(this)" name="send_num" style="width:80px;display:none;" value="'+goods_info[j]['send_num']+'" /><span class="inputspan">'+goods_info[j]['send_num']+'</span></td>';
		html += '<td class="remark"><input type="text" name="remark" style="width:200px;display:none;" value="'+goods_info[j]['remark']+'" /><span class="inputspan">'+goods_info[j]['remark']+'</span></td>';
		html += '<td><a href="javascript:;" onclick="update('+j+')" class="update">修改</a><span class="text-explode">|</span><a href="javascript:;" onclick="_delete('+j+')" class="delete">删除</a></td>';
		html += '</tr>';
	}
	$('.goodsList').html(html);
}

function update(index){
	if(status == 2){
		status = 1;
		var market_price = $('.goods_'+index+' input[name=market_price]').val();
		if(market_price == ''){
			market_price = $('.goods_'+index+' input[name=market_price]').attr('data-market_price');
		}
		var shop_price = $('.goods_'+index+' input[name=shop_price]').val();
		if(shop_price == ''){
			shop_price = $('.goods_'+index+' input[name=shop_price]').attr('data-shop_price');
		}
		var goods_number = $('.goods_'+index+' input[name=goods_number]').val();
		if(goods_number == ''){
			goods_number = $('.goods_'+index+' input[name=goods_number]').attr('data-goods_number');
		}
		var send_num = $('.goods_'+index+' input[name=send_num]').val();
		if(send_num == ''){
			send_num = $('.goods_'+index+' input[name=send_num]').attr('data-send_num');
		}
		goods_info[index]['goods_number'] = goods_number;
		goods_info[index]['send_num'] = send_num;
		goods_info[index]['market_price'] = market_price;
		goods_info[index]['shop_price'] = shop_price;
		goods_info[index]['remark'] = $('.goods_'+index+' input[name=remark]').val();
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
$('button[type=submit]').click(function(){
	var send = $(this).attr('send');
	$('.ajaxForm2').ajaxSubmit({
		data:{goods_info:goods_info,type:send},
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