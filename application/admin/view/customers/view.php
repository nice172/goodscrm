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
                                <a class="btn btn-primary" href="{:url('customers/edit',['id'=>$data.cus_id])}">修改信息</a>
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
                            <div class="tab-pane <?php if (!$record){?>active<?php }?>" id="jibenxinxi">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <tbody>
                                    <tr>
                                        <td width="15%" class="right-color"><span>公司名称:</span></td>
                                        <td width="35%">
                                            <span>{$data.cus_name}</span>
                                        </td>
                                        <td width="15%" class="right-color"><span>简称:</span></td>
                                        <td width="35%"><span>{$data.cus_short}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>电话号码:</span></td>
                                        <td width="35%"><span>{$data.cus_phome}</span></td>
                                        <td width="15%" class="right-color"><span>传真:</span></td>
                                        <td width="35%"><span>{$data.cus_fax}</span></td>
                                    </tr>
                                    <tr>

                                        <td width="15%" class="right-color"><span>手机号码:</span></td>
                                        <td width="35%"><span>{$data.cus_mobile}</span></td>
                                        <td width="15%" class="right-color"><span>业务经理:</span></td>
                                        <td width="35%"><span>{$data.cus_business}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>E-MAIL:</span></td>
                                        <td width="35%"><span>{$data.cus_email}</span></td>
                                        <td width="15%" class="right-color"><span>跟单员:</span></td>
                                        <td width="35%"><span>{$data.cus_order_ren}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>详细地址:</span></td>
                                        <td width="35%" colspan="3" id="city_4">{$data.cus_prov} {$data.cus_city} {$data.cus_dist} {$data.cus_street}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>备注信息:</span></td>
                                        <td width="35%" colspan="3">{$msg.msg_content}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table syc-table border table-hover" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="8">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>联系人</span>
                                                </div>
                                            </div>
                                            <div class="pull-right" style="margin-top: 5px;">
                                                <a class="btn btn-primary" onclick=setHandle.addContact("{$data.cus_id}");>新增</a>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>联系人</th>
                                        <th>手机号码</th>
                                        <th>职位</th>
                                        <th>部门</th>
                                        <th>性别</th>
                                        <th>QQ</th>
                                        <th>Email</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {volist name="contact" id="vo" empty="$empty_con"}
                                    <tr class="thead-tbl-adduser">
                                        <td>{$vo.con_name}</td>
                                        <td>{$vo.con_mobile}</td>
                                        <td>{$vo.con_post}</td>
                                        <td>{$vo.con_section}</td>
                                        <td>{eq name="$vo.con_sex" value="1"}
                                            		男{else/}女{/eq}
                                        </td>
                                        <td>{$vo.con_qq}</td>
                                        <td>{$vo.con_email}</td>
                                        <td>
                                        	{neq name="$data.cus_con_id" value="$vo.con_id"}
                                        	<a href="javascript:void(0);" onclick="setHandle.adduser('{$vo.con_id}')">默认联系人</a>
                                        	<span class="text-explode">|</span>{/neq}
                                            <a href="javascript:void(0);" onclick="setHandle.edituser('{$vo.con_id}')">查看</a>
                                            {neq name="$data.cus_con_id" value="$vo.con_id"}
                                            <span class="text-explode">|</span>
                                            <a href="javascript:void(0);" onclick="setHandle.deluser('{$vo.con_id}');">删除</a>{/neq}
                                        </td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                </table>
                            </div>
                            <!--历史订单-->
                            <div class="tab-pane <?php if ($record){?>active<?php }?>" id="lishidingdan">
                                <table class="table syc-table border table-condensed" style="margin-top:0;">
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
                                        <th>下单日期</th>
                                        <th>订单号码</th>
                                        <th>联系人</th>
                                        <th>手机号码</th>
                                        <th>下单金额</th>
                                        <th>创建人</th>
                                        <th>创建时间</th>
                                        <th>详情</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {volist name="lsdd" id="vo" empty="$empty_lsdd"}
                                    <tr>
                                        <td>{$vo.id}</td>
                                        <td>{$vo.order_sn}</td>
                                        <td>{$vo.con_name}</td>
                                        <td>{$vo.con_mobile}</td>
                                        <td>{$vo.total_money}</td>
                                        <td>{$vo.user_nick}</td>
                                        <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                        <td><a href="{:url('order/info',['id' => $vo['id']])}">详情</a></td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="10">
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
                                    <span class="spans1">{$data.cus_name}</span>
                                </li>
                                <li <?php if ($record!='list'){?>class="active"<?php }?>><a href="{:url('view',['id' => $data['cus_id']])}">基本信息</a></li>
                                <li <?php if ($record=='list'){?>class="active"<?php }?>><a href="{:url('view',['id' => $data['cus_id'],'r' => 'list'])}">下单记录</a></li>
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
        $("#sidebar-sales").addClass("sidebar-nav-active"); // 大分类
        $("#sidebar-customers").addClass("active"); // 小分类

        $(".thead-tbl-adduser").hover(function(){
            $(this).find(".implicit").removeClass('hide');
        },function(){
            $(this).find(".implicit").addClass('hide');
        });
        //premises
        $("#city_shouhuo").citySelect({prov:'{$data.cus_prov}',city:'{$data.cus_city}',dist:'{$data.cus_dist}'});

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