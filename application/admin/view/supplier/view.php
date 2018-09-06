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
                                <a class="btn btn-primary" href="{:url('edit',['id'=>$data.id])}">修改信息</a>
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
                            <div class="tab-pane <?php echo !isset($_GET['show'])?'active':'';?>" id="jibenxinxi">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <tbody>
                                    <tr>
                                        <td width="15%" class="right-color"><span>供应商名称:</span></td>
                                        <td width="35%">
                                            <span>{$data.supplier_name}</span>
                                        </td>
                                        <td width="15%" class="right-color"><span>简称:</span></td>
                                        <td width="35%"><span>{$data.supplier_short}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>联系人:</span></td>
                                        <td width="35%"><span>{$data.supplier_contacts}</span></td>
                                        <td width="15%" class="right-color"><span>邮箱:</span></td>
                                        <td width="35%"><span>{$data.supplier_email}</span></td>
                                    </tr>
                                    <tr>

                                        <td width="15%" class="right-color"><span>手机号码:</span></td>
                                        <td width="35%"><span>{$data.supplier_mobile}</span></td>
                                        <td width="15%" class="right-color"><span>部门职务:</span></td>
                                        <td width="35%"><span>{$data.supplier_post}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>QQ:</span></td>
                                        <td width="35%"><span>{$data.supplier_qq}</span></td>
                                        <td width="15%" class="right-color"><span>电话号码:</span></td>
                                        <td width="35%"><span>{$data.supplier_like}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>付款方式:</span></td>
                                        <td width="35%"><span>{$data.supplier_payment}</span></td>
                                        <td width="15%" class="right-color"><span>详细地址:</span></td>
                                        <td width="35%"><span>{$data.supplier_province} {$data.supplier_city} {$data.supplier_area} {$data.supplier_address}</span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="15%" class="right-color"><span>备注信息:</span></td>
                                        <td width="35%" colspan="3">{$data.supplier_remark}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-hover syc-table border" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="10">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>联系人</span>
                                                </div>
                                            </div>
                                            <div class="pull-right" style="margin-top: 5px;">
                                                <a class="btn btn-primary" onclick=setHandle.addContact("{$data.id}");>新增</a>
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
                                    {volist name="contact" id="vo" empty="$empty"}
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
                                            <a href="javascript:void(0);" onclick="setHandle.edituser('{$vo.con_id}')">查看</a>
                                            {neq name="$data.default_con_id" value="$vo.con_id"}
                                            <span class="text-explode">|</span>
                                            <a href="javascript:void(0);" onclick="setHandle.deluser('{$vo.con_id}');">删除</a>{/neq}
                                        </td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                </table>
                            </div>
                            <!--历史订单-->
                            <div class="tab-pane <?php echo isset($_GET['show'])?'active':'';?>" id="lishidingdan">
                                <table class="table table-condensed table-hover syc-table border" style="margin-top:0;">
                                    <thead>
                                    <tr>
                                        <th colspan="20">
                                            <div class="pull-left">
                                                <div class="bs-callout bs-callout-warning">
                                                    <span>采购记录</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>采购日期</th>
                                        <th>采购单号</th>
                                        <th>联系人</th>
                                        <th>联系电话</th>
                                        <th>采购金额</th>
                                        <th>创建人</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {volist name="lsdd" id="vo" empty="$empty"}
                                    <tr>
                                        <td>{$vo.id}</td>
                                        <td>{$vo.create_time|date='Y-m-d',###}</td>
                                        <td>{$vo.po_sn}</td>
                                        <td>{$vo.contacts}</td>
                                        <td>{$vo.cus_phome}</td>
                                        <td>{$vo.total_money}</td>
                                        <td>{$vo.user_nick}</td>
                                        <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                        <td>{$vo.update_time|date='Y-m-d H:i:s',###}</td>
                                        <td><a href="{:url('purchase/info',['id' => $vo['id']])}">详情</a></td>
                                    </tr>
                                    {/volist}
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="20">
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
                                <li class="<?php echo !isset($_GET['show'])?'active':'';?>"><a href="#jibenxinxi" data-toggle="tab">基本信息</a></li>
                                <li class=""><a href="{:url('product',['supplier_id' => $data['id']])}">产品列表</a></li>
                                <li class="<?php echo isset($_GET['show'])?'active':'';?>"><a href="#lishidingdan" data-toggle="tab">采购记录</a></li>
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