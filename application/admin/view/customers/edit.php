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
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" id="editCustomersForm">
                            <input type="hidden" name="__token__" value="{$Request.token}" />
                            <input type="hidden" name="cus_id" value="{$data.cus_id}" />
                            <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        <div class="bs-callout bs-callout-warning">
                                            <span>企业信息</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>公司名称:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="cus_name"  value="{$data.cus_name}">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>简称:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_short" value="{$data.cus_short}"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>电话号码:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_phome" id="phome" value="{$data.cus_phome}"></td>
                                    <td width="15%" class="right-color"><span>传真:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_fax" id="fax" value="{$data.cus_fax}"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>手机号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="cus_mobile" id="cus_mobile" value="{$data.cus_mobile}">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_duty" id="cus_duty" value="{$data.cus_duty}"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>E-Mail:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_email" id="cus_email" value="{$data.cus_email}"></td>
                                    <td width="15%" class="right-color"><span>职务:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_post" value="{$data.cus_post}"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>性别:</span></td>
                                    <td width="35%">
                                    <select class="syc-select w300" name="cus_sex">
                                            <option value="-1">--请选择性别--</option>
                                            <option value="1" {if condition="$data['cus_sex']"}selected="selected"{/if}>男</option>
                                            <option value="0" {if condition="!$data['cus_sex']"}selected="selected"{/if}>女</option>
                                    </select>
                                    </td>
                                    <td width="15%" class="right-color"><span>QQ:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" name="cus_qq" value="{$data.cus_qq}" id="con_qq" placeholder=""></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>部门:</span></td>
                                    <td width="35%">
                                       <select class="syc-select w300" name="cus_section">
                                            <option value="0">--请选择部门--</option>
                                            <?php foreach ($section as $val){?>
                                            <option value="<?php echo $val;?>" {if condition="$data['cus_section'] eq $val"}selected="selected"{/if}><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>业务经理:</span></td>
                                    <td width="35%">
                                            <select class="syc-select w300" name="cus_business">
                                            <option value="0">--请选择业务经理--</option>
                                            <?php foreach ($business as $val){?>
                                            <option value="<?php echo $val;?>" {if condition="$data['cus_business'] eq $val"}selected="selected"{/if}><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                </tr>
                                                                                             <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>跟单员:</span></td>
                                    <td width="35%" colspan="3">
                                             <select class="syc-select w300" name="con_order_ren">
                                            <option value="">--请选择跟单员--</option>
                                            <?php foreach ($order_ren as $val){?>
                                            <option value="<?php echo $val;?>" {if condition="$data['cus_order_ren'] eq $val"}selected="selected"{/if}><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>详细地址:</span></td>
                                    <td width="35%" colspan="3" id="city_4">
                                        <select class="syc-select w150 prov" name="cus_prov" id="selectProvince">
                                            <option>--请选择省份--</option>
                                        </select>
                                        <select class="syc-select w150 city" name="cus_city" id="selectCitp">
                                        </select>
                                        <select class="syc-select w150 dist" name="cus_dist" id="selectCounty">
                                        </select>
                                        <input type="text" class="form-control" style="margin-top: 10px;width: 50%;" name="cus_street" value="{$data.cus_street}">
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
                                    <td colspan="3"><textarea class="form-control" name="cus_content" id="content" rows="6">{$msg.msg_content}</textarea> </td>
                                </tr>

                                <tr class="table-submit">
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
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-sales").addClass("sidebar-nav-active"); // 大分类
        $("#sidebar-customers").addClass("active"); // 小分类
        //城市地区
        $("#city_4").citySelect({prov:"{$data.cus_prov}", city:"{$data.cus_city}", dist:"{$data.cus_dist}"});

        //修改信息
        $("#editCustomersForm").validate({
            //
            rules:{
                duty: {
                    required:true
                },
            },
            focusInvalid: true, //当为false时，验证无效时，没有焦点响应
            onkeyup: false, //当丢失焦点时才触发验证请求
            sycError:false, //自己定义是否显示错误提示
            errorPlacement: function(error, element) {}, //设置验证消息不显示
            highlight: function(element, errorClass) {
                $(element).closest('input').addClass('error'); // 验证未通过给input添加css
                $(element).closest('input').removeClass('valid'); // 验证未通过给input添加css
            },
            //如果表单验证不通过
            invalidHandler: function(element){
                toastr.warning("填写不完整请认真检查");
            },
            // 表单验证成功
            submitHandler: function() {
                //
                $.ajax({
                    url: '{:Url(\'customers/edit_do\')}',
                    type: 'post',
                    dataType: 'JSON',
                    data: $("#editCustomersForm").serialize(),
                    success: function (result) {
                        if (result.code > 0) {
                            toastr.success(result.msg);
                        } else {
                            toastr.error(result.msg);
                        }
                        window.setTimeout(function() {
                            window.location.href=result.url;
                        }, 1500);
                    }
                });
                return false; // 阻止表单自动提交事件
            }
        });
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