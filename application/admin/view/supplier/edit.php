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
                                <a href="javascript:window.history.go(-1);">
                                    <button class="btn btn-default"><span class="icon-goback"></span>返回</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="addCustomersForm" class="ajaxForm" action="{:url('edit_do')}">
                        <input type="hidden" name="supplier_id" value="{$data.id}" />
                           
                            <table class="table contact-template-form">
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        <div class="bs-callout bs-callout-warning">
                                            <span>供应商信息</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>供应商名称:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="supplier_name" value="{$data.supplier_name}" id="supplier_name">
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>简称:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_short}" name="supplier_short" id="supplier_short"></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>手机号码:</span></td>
                                    <td width="35%">
                                        <input type="text" class="form-control w300" name="supplier_mobile" value="{$data.supplier_mobile}" id="con_mobile" >
                                    </td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>联系人:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_contacts}" name="supplier_contacts" id="con_duty" ></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>E-Mail:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_email}" name="supplier_email" id="con_email"></td>
                                    <td width="15%" class="right-color"><span>部门职务:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_post}" name="supplier_post" id="con_post" placeholder=""></td>
                                </tr>
                                <tr>
                                    <td width="15%" class="right-color"><span>状态:</span></td>
                                    <td width="35%">
                                    <select class="syc-select w300" name="supplier_status">
                                            <option value="1" {if condition="$data['supplier_status']"}selected="selected"{/if}>正常</option>
                                            <option value="0" {if condition="!$data['supplier_status']"}selected="selected"{/if}>禁用</option>
                                    </select>
                                    </td>
                                    <td width="15%" class="right-color"><span>QQ:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_qq}" name="supplier_qq" id="con_qq" placeholder=""></td>
                                </tr>
                                <tr>
                                <td width="15%" class="right-color"><span class="text-danger"></span><span>传真:</span></td>
                                <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_fax}" name="supplier_fax" id="supplier_fax" placeholder=""></td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>付款方式:</span></td>
                                    <td width="35%">
                                            <select class="syc-select w300" name="supplier_payment">
                                            <option value="0">--请选择付款方式--</option>
                                            <?php foreach ($payment as $val){?>
                                            <option value="<?php echo $val;?>" {if condition="$val == $data['supplier_payment']"}selected="selected"{/if}><?php echo $val;?></option>
                                            <?php }?>
                                            </select>
                                    </td>
                                </tr>
                             
                                <tr>
                                    <td width="15%" class="right-color"><span>电话号码:</span></td>
                                    <td width="35%"><input type="text" class="form-control w300" value="{$data.supplier_like}" name="supplier_like" id="con_qq" placeholder=""></td>
                                    <td width="15%" class="right-color"><span class="text-danger">*</span><span>详细地址:</span></td>
                                    <td width="35%" id="city_4">
                                        <select class="syc-select w130 prov" name="supplier_province" id="selectProvince">
                                            <option>--请选择省份--</option>
                                        </select>
                                        <select class="syc-select w150 city" name="supplier_city" id="selectCitp">
                                        </select>
                                        <select class="syc-select w150 dist" name="supplier_area" id="selectCounty">
                                        </select>
                                        <input type="text" class="form-control" value="{$data.supplier_address}" style="margin-top: 10px;" name="supplier_address" placeholder="街道信息">
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
                                    <td colspan="3"><textarea class="form-control" name="supplier_remark" id="con_content" rows="6">{$data.supplier_remark}</textarea> </td>
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
        $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
        $("#supplier-index").addClass("active"); // 小分类
        $("#city_4").citySelect({prov:"{$data.supplier_province}", city:"{$data.supplier_city}", dist:"{$data.supplier_area}"});
                
    });

    //onclick操作
    var setHandle = {
        //选择物流
        selectLog: function (e) {
            bDialog.open({
                title : '选择物流',
                width: '800',
                height: '700',
                url : '{:url(\'logistics/select\')}',
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
                url : '{:url(\'logistics/add\')}',
            });
        },
        //收货地址选择默认联系人
        setLogisticsUser: function (e) {
            var cusid = '';
            if (e!=='') {
                var data = {cusid:cusid};
                $.ajax({
                    url: '{:url("premises/getContactName")}',
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