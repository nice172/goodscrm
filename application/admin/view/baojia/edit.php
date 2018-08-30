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
                    <div class="col-lg-12">
                        <div class="portlet margin-top-3">
 <form class="form-horizontal ajaxForm2" method="post" action="<?php echo url('edit');?>" id="form1">
 <input type="hidden" name="id" value="{$order.id}" />
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a></li>
    <li role="presentation"><a href="#goods" aria-controls="goods" role="tab" data-toggle="tab">商品</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    							<input type="hidden" name="cus_id" value="{$order.cus_id}" id="cus_id" />
								<div class="form-group">
                                    <label for="order_sn" class="col-sm-2 control-label">报价单号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$order.order_sn}" name="order_sn" id="order_sn">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="create_date" class="col-sm-2 control-label">报价日期</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$order.create_time|date='Y-m-d',###}" name="create_date" id="create_date">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="company_name" class="col-sm-2 control-label"><span class="text-danger">*</span>公司名称</label>
                                    <div class="col-sm-8 w300">
                                        <input type="text" class="form-control w300" readonly="readonly" value="{$order.company_name}" name="company_name" id="company_name">
                                    </div>
                                    <div class="col-sm-2">
                                    	<button type="button" class="btn btn-primary search_company">查找</button>
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label for="company_short" class="col-sm-2 control-label"><span class="text-danger">*</span>简称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" value="{$order.company_short}" name="company_short" id="company_short">
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="contacts" class="col-sm-2 control-label"><span class="text-danger">*</span>联系人</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" value="{$order.contacts}" name="contacts" id="contacts">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="fax" class="col-sm-2 control-label">传真号码</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" value="{$order.fax}" name="fax" id="fax">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label"><span class="text-danger">*</span>E-Mail</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" value="{$order.email}" name="email" id="email">
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label"><span class="text-danger">*</span>跟单员</label>
                                    <div class="col-sm-10">
                                        <select name="order_handle" class="form-control w300" id="order_handle">
                                     <option value="">--请选择跟单员--</option>
                                            <?php foreach ($order_handle as $val){?>
                                            <option value="<?php echo $val;?>" {if condition="$val eq $order['order_handle']"}selected="selected"{/if}><?php echo $val;?></option>
                                            <?php }?>
                                    </select>
                                    </div>
                                </div>
                          <div class="form-group">
                                    <label for="remark" class="col-sm-2 control-label">备注</label>
                                    <div class="col-sm-10">
                                        <textarea name="order_remark" id="order_remark" class="form-control w300" style="height: 150px;resize:none;">{$order.order_remark}</textarea>
                                    </div>
                                </div>

    </div>

<div role="tabpanel" class="tab-pane" id="goods">

		<div class="row">
                    <div class="col-lg-12">
                        <table class="table syc-table border table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">序号</th>
                                    <th width="30%">商品名称</th>
                                    <th width="10%">单位</th>
                                    <th width="10%">标准单价</th>
                                    <th width="35%">备注</th>
                                    <th width="10%">操作</th>
                                </tr>
                            </thead>
                            <tbody class="goodsList"></tbody>
                            <tfoot>
                            	<tr>
                            	<td colspan="10"><a href="javascript:;" class="get_goods">请选择商品</a></td>
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
            <input type="submit" value="保 存" name="save" class="btn btn-primary" />
            <input type="submit" value="生成PDF文件并发送" name="saveemail" class="btn btn-primary" />
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
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
<!--icheck-->
<link href="/assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
    	
        // 当前页面分类高亮
        $("#sidebar-baojia").addClass("sidebar-nav-active"); // 大分类
        $("#baojia-index").addClass("active"); // 小分类

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
        
        //料型颜色
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_square-blue', //颜色设置
            radioClass: 'iradio_square',
            increaseArea: '20%' // optional
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
<?php if(!empty($order['goodsInfo'])){ foreach ($order['goodsInfo'] as $goods){?>
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
		data.id=0;
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
		html += '<td class="remark"><input type="text" name="remark" style="width:80%;display:none;" value="'+goods_info[j]['remark']+'" /><span class="inputspan">'+goods_info[j]['remark']+'</span></td>';
		html += '<td><a href="javascript:;" onclick="update('+j+')" class="update">修改</a><span class="text-explode">|</span><a href="javascript:;" onclick="_delete('+goods_info[j]['id']+','+j+')" class="delete">删除</a></td>';
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
		goods_info[index]['market_price'] = market_price;
		goods_info[index]['remark'] = $('.goods_'+index+' input[name=remark]').val();
		goodsList(goods_info);
		return;
	}
	status = 2;
	$('.goods_'+index+' .update').text('保存');
	$('.goods_'+index+' span.inputspan').hide();
	$('.goods_'+index+' input').show().css('display','inline');
}

function checkNum(obj){
	obj.value = obj.value.replace(/[^\d.]/g,"");//清除"数字"和"."以外的字符
	obj.value = obj.value.replace(/^\./g,"");//验证第一个字符是数字而不是
	obj.value = obj.value.replace(/\.{2,}/g,".");//只保留第一个. 清除多余的
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入三个小数.(\d\d\d) 修改个数  加\d
}

function _delete(bid,index){
	status = 1;
	var newGoodsList = new Array();
	for(var i in goods_info){
		if(i != index){
			newGoodsList.push(goods_info[i]);
		}
	}
	goods_info = newGoodsList;
	goodsList(goods_info);
	if(bid!=0){
		//$.get('<?php echo url('ajaxdel');?>?baojia_id={$order.id}&bid='+bid,{},function(res){});
	}
}

$('input[name=save]').click(function(){
	$('.modal-footer button,.modal-footer input').attr('disabled','disabled');
	_ajaxSubmit('save');
	return false;
});

$('input[name=saveemail]').click(function(){
	$('.modal-footer button,.modal-footer input').attr('disabled','disabled');
	$(this).val('正在发送邮件...');
	_ajaxSubmit('saveemail');
	return false;
});

function _ajaxSubmit(type){
	//$('.ajaxForm2').submit(function(){
		$('.ajaxForm2').ajaxSubmit({
			data:{goods_info:goods_info,type:type},
			success: function(res){
				$('.modal-footer button,.modal-footer input').removeAttr('disabled');
				if(type == 'saveemail'){$('input[name=saveemail]').val('生成PDF文件并发送');}
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
		//return false;});
}
</script>
{/block}