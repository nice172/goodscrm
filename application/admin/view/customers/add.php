{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}
<div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5>{$title}</h5>
                                <a href="{:Url('customers/index')}">
                                    <button class="btn btn-default"><span class="icon-goback"></span>返回</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="addCustomersForm" class="ajaxForm" action="{:url('add_do')}">
                            <input type="hidden" name="__token__" value="{$Request.token}" />
                            <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        <div class="bs-callout bs-callout-warning">
                                            <span>客户信息</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>公司名称:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="con_name" id="con_name">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>简称:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_short" id="con_short"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>电话号码:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_phome" id="con_phome"></td>
                                    <td width="15%" class="right-color"><span>传真:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_fax" id="con_fax"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>手机号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="con_mobile" id="con_mobile" >
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_duty" id="con_duty" ></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>E-Mail:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_email" id="con_email"></td>
                                    <td width="15%" class="right-color"><span>职务:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_post" id="con_post" placeholder=""></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>性别:</span></td>
                                    <td width="35%">
                                    <select class="syc-select w300" name="con_sex">
                                            <option value="-1">--请选择性别--</option>
                                            <option value="1">男</option>
                                            <option value="0">女</option>
                                    </select>
                                    </td>
                                    <td width="15%" class="right-color"><span>QQ:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="con_qq" id="con_qq" placeholder=""></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>部门:</span></td>
                                    <td width="35%">
                                       <select class="syc-select w300" name="con_section">
                                            <option value="0">--请选择部门--</option>
                                            <?php foreach ($section as $val){?>
                                            <option value="<?php echo $val;?>"><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>详细地址:</span></td>
                                    <td width="35%" id="city_4">
                                        <select class="syc-select w150 prov" name="con_prov" id="selectProvince">
                                            <option>--请选择省份--</option>
                                        </select>
                                        <select class="syc-select w150 city" name="con_city" id="selectCitp">
                                        </select>
                                        <select class="syc-select w150 dist" name="con_dist" id="selectCounty">
                                        </select>
                                        <input type="text" class="form-control" style="margin-top: 10px;" name="con_street" placeholder="街道信息">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>跟单员:</span></td>
                                    <td width="35%">
                                             <select class="syc-select w300" name="con_order_ren">
                                            <option value="">--请选择跟单员--</option>
                                            <?php foreach ($order_ren as $val){?>
                                            <option value="<?php echo $val;?>"><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>业务经理:</span></td>
                                    <td width="35%">
                                            <select class="syc-select w300" name="con_business">
                                            <option value="0">--请选择业务经理--</option>
                                            <?php foreach ($business as $val){?>
                                            <option value="<?php echo $val;?>"><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                </tr>

                                <!--备注信息-->
                                <tr>
                                    <td colspan="4">
                                        <div class="bs-callout bs-callout-warning">
                                            <span>备注信息</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right"><span>备注内容:</span></td>
                                    <td colspan="3"><textarea class="form-control" name="con_content" id="con_content" rows="6"></textarea> </td>
                                </tr>

                                <tr>
                                    <td align="right"></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">提交信息</button>
                                    </td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/plugins/city/jquery.cityselect.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // 当前页面分类高亮
        $("#sidebar-sales").addClass("sidebar-nav-active"); // 大分类
        $("#sidebar-customers").addClass("active"); // 小分类
        $("#city_4").citySelect({prov:"北京市", city:"东城区", dist:""});

    });

    //onclick操作
    var setHandle = {
        //选择物流
        selectLog: function (e) {
            bDialog.open({
                title : '选择物流',
                width: '800',
                height: '700',
                url : '{:Url(\'logistics/select\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        var logid = data.results[0].logid;
                        var logname = data.results[0].logname;
                        $('input[name="cus_log_id"]').val(logid);
                        $("#precusid").val(logname);
                    }
                }
            });
        },
        //新增物流无信息
        addLogistics: function (e) {
            bDialog.open({
                title : '新增物流',
                width: '800',
                height: '320',
                url : '{:Url(\'logistics/add\')}',
            });
        },
        //收货地址选择默认联系人
        setLogisticsUser: function (e) {
            var cusid = '';
            if (e!=='') {
                var data = {cusid:cusid};
                $.ajax({
                    url: '{:Url("premises/getContactName")}',
                    type: 'POST', //GET
                    data: data,
                    timeout:5000,    //超时时间
                    dataType:'json',
                    success: function (result) {
                        if (result.code == '1') {
                            //
                            $('input[name="pre_name"]').val(result.data.shr);
                            $('input[name="pre_phone"]').val(result.data.tel);
                            $('input[name="pre_street"]').val(result.data.street);
                            $("#city_shouhuo").citySelect({
                                prov:result.data.prov,
                                city:result.data.city,
                                dist:result.data.dist
                            });
                            //console.log(result)
                        } else {
                            toastr.warning(result.msg+" ...");
                        }
                    }
                });
                return false;
            } else {
                toastr.warning("请检查是否已设定默认联系人");
            }
        }
    };
</script>
{/block}