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
                            <div class="tab-pane active">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="9">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>产品列表</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>ID编号</th>
                                        <th>产品名称</th>
                                        <th>产品规格</th>
                                        <th>单位</th>
                                        <th>单价</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
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
                                    <span class="spans1">{$data.supplier_name}</span>
                                </li>
                                <li class=""><a href="{:url('view',['id' => $data['id']])}">基本信息</a></li>
                                <li class="active"><a href="javascript:;" data-toggle="tab">产品列表</a></li>
                                <li class=""><a href="{:url('view',['id' => $data['id']])}?show=order">采购记录</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/plugins/city/jquery.cityselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
        $("#supplier-index").addClass("active"); // 小分类

        $(".thead-tbl-adduser").hover(function(){
            $(this).find(".implicit").removeClass('hide');
        },function(){
            $(this).find(".implicit").addClass('hide');
        });
        //premises
        $("#city_shouhuo").citySelect({prov:'{$data.supplier_province}',city:'{$data.supplier_city}',dist:'{$data.supplier_area}'});

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
                url : '{:url(\'supplier/add_contacts\')}?id='+e,
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
                url: '<?php echo url('adduser');?>',
                type: 'post',
                dataType: 'JSON',
                data: {con:e,cus:'{$data.id}'},
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
                url : '<?php echo url('edit_contacts');?>?id='+e,
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
                url: '<?php echo url('deluser');?>',
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