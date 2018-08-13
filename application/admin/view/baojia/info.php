{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}
<div class="container-fluid">
                <!--内容开始-->
                <div class="row syc-bg-fff">
                    <div class="col-lg-12 syc-border-bs">
                        <div class="console-title">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{:url('edit',['gid'=>$data.id])}">修改</a>
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-main">
                    <div class="section-left">
                        <div class="tab-content section-wrap">
                            <!--基本信息-->
                            <div class="tab-pane active" id="jibenxinxi">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <tbody>
                                    <tr>

                                        <td width="15%" class="right-color"><span>报价单号:</span></td>
                                        <td width="35%"><span>{$data.order_sn}</span></td>
                                        <td width="15%" class="right-color"><span>报价日期:</span></td>
                                        <td width="35%"><span>{$data.create_time|date='Y-m-d',###}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>客户名称:</span></td>
                                        <td width="35%">
                                            <span>{$data.company_name}</span>
                                        </td>
                                        <td width="15%" class="right-color"><span>简称:</span></td>
                                        <td width="35%"><span>{$data.company_short}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>联系人:</span></td>
                                        <td width="35%"><span>{$data.contacts}</span></td>
                                        <td width="15%" class="right-color"><span>传真:</span></td>
                                        <td width="35%"><span>{$data.fax}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>E-MAIL:</span></td>
                                        <td width="35%"><span>{$data.email}</span></td>
                                        <td width="15%" class="right-color"><span>跟单员:</span></td>
                                        <td width="35%"><span>{$data.order_handle}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>创建时间:</span></td>
                                        <td width="35%"><span>{$data.create_time|date='Y-m-d H:i:s',###}</span></td>
                                        <td width="15%" class="right-color"><span>更新时间:</span></td>
                                        <td width="35%"><span>{$data.update_time|date='Y-m-d H:i:s',###}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>状态:</span></td>
                                        <td width="35%" colspan="3">{if condition="$data.status==1"}未确认{else}已确认{/if}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>备注信息:</span></td>
                                        <td width="35%" colspan="3">{$data.order_remark}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-hover" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>商品列表</span>
                                                </div>
                                            </div>
                                            <!--<div class="pull-right" style="margin-top: 5px;">
                                                <a class="btn btn-primary" onclick=setHandle.addContact("{$data.id}");>新增</a>
                                            </div> -->
                                        </th>
                                    </tr>
                                    <tr>
<!--                                         <th>商品ID</th> -->
                                        <th>商品名称</th>
                                        <th>单位</th>
                                        <th>标准单价</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {volist name="goodsList" id="vo" empty="$empty"}
                                    <tr class="thead-tbl-adduser">
<!--                                         <td>{$vo.goods_id}</td> -->
                                        <td>{$vo.goods_name}</td>
                                        <td>{$vo.unit}</td>
                                        <td>{$vo.goods_price}</td>
                                        <td>{$vo.remark}</td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                </table>
                            </div>
                            <!--历史订单-->
                            <div class="tab-pane" id="lishidingdan">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="9">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>下单记录</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>订单编号</th>
                                        <th>订单数量</th>
                                        <th>订单金额</th>
                                        <th>已收订金</th>
                                        <th>已收余款</th>
                                        <th>客户确认</th>
                                        <th>订单状况</th>
                                        <th>销售日期</th>
                                        <th>发货日期</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {volist name="lsdd" id="vo" empty="$empty"}
                                    <tr>
                                        <td>
                                            <a href="{:url('orders/view',['pid'=>$vo.pnumber])}" target="_blank">{$vo.pnumber}</a>
                                        </td>
                                        <td>{$vo.pcount}</td>
                                        <td>￥{$vo.pamount|number_format=2}</td>
                                        <td>{$vo.amo_dj}</td>
                                        <td>{$vo.amo_yk}</td>
                                        <td>
                                            {eq name="$vo.affirm" value="0"}
                                            <span class="label label-sm label-default">未确认</span>
                                            {else/}
                                            <span class="label label-sm label-success">已确认</span>
                                            {/eq}
                                        </td>
                                        <td>{:purchase_status($vo.status)}</td>
                                        <td>{$vo.pstart_date}</td>
                                        <td>{$vo.pend_date}</td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div class="pull-right page-box">{$page_l}</div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="section-right">
                        <div class="syc-page-panel">
                            <ul class="nav nav-tabs section-nav">
                                <li class="first-li">
                                    <i class="fa fa-list"></i>
                                    <span class="spans1">{$client.cus_name}</span>
                                </li>
                                <li class="active"><a href="#jibenxinxi" data-toggle="tab">基本信息</a></li>
                                <li class=""><a href="#lishidingdan" data-toggle="tab">下单记录</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
        </div>
    </div>
</div>

{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/plugins/city/jquery.cityselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-baojia").addClass("sidebar-nav-active"); // 大分类
        $("#baojia-index").addClass("active"); // 小分类

        $(".thead-tbl-adduser").hover(function(){
            $(this).find(".implicit").removeClass('hide');
        },function(){
            $(this).find(".implicit").addClass('hide');
        });
        //premises
        

        //提交收货地址信息
        $("#editPremisesSubmit").click(function () {
            if (JqValidate()) {
                //$("#editPremises").submit();
                $.ajax({
                    url: '{:url("premises/add_do")}',
                    type: 'POST', //GET
                    data: $("#editPremises").serialize(),
                    dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                    success: function (result) {
                        if (result.code == '1') {
                            //
                            toastr.success(result.msg)
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
                return false;
            } else {
                toastr.warning("信息填写不完整");
            }
        });
    });
    //onclick操作
    var setHandle = {
        //新增联系人
        addContact: function (e) {
            bDialog.open({
                title : '新增联系人',
                width: '800',
                height: '520',
                url : '{:url(\'contacts/add\')}?id='+e,
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        //window.location.href = data.results[0].url;
                        window.location.reload();
                    }
                }
            });
        },
        //设定默认联系人
        adduser: function (e) {
            //console.log(e)
            $.ajax({
                url: '{:url(\'customers/adduser\')}',
                type: 'post',
                dataType: 'JSON',
                data: {con:e,cus:'{$data.cus_id}'},
                success: function (result) {
                    if (result.code > 0) {
                        toastr.success(result.msg)
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
            return false;
        },
        //查看联系人
        edituser: function (e) {
            bDialog.open({
                title : '查看联系人',
                width: '800',
                height: '520',
                url : '{:url(\'contacts/edit\')}?id='+e,
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        //window.location.href = data.results[0].url;
                        window.location.reload();
                    }
                }
            });
        },
        //删除联系人
        deluser: function (e) {
        	if(!confirm("是否删除？")){
				return false;
        	}
            $.ajax({
                url: '{:url(\'contacts/deluser\')}',
                type: 'post',
                dataType: 'JSON',
                data: {id:e},
                success: function (result) {
                    if (result.code > 0) {
                        toastr.success(result.msg)
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
            return false;
        },
    };

    //
    function JqValidate() {
        return $("#editPremises").validate({
            rules:{
                pre_log_id: {
                    required: true,
                },
                pre_name: {
                    required: true,
                },
                pre_phone: {
                    required: true,
                    isTel: true
                },
                pre_prov: {
                    required: true,
                },
                pre_street: {
                    required: true,
                }
            },
            errorClass: 'error', // 默认输入错误消息类
            focusInvalid: true, //当为false时，验证无效，没有焦点响应
            onkeyup: false, //当丢失焦点时才触发验证请求
            errorPlacement: function(error, element) {}, //设置验证消息不显示
        }).form();
    };
</script>
{/block}