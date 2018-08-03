<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!--头部文件-->
    <meta charset="UTF-8">
    <title>{$title}-{:Config('syc_webname')}</title>
    <meta name="author" content="www.sycit.cn, hyzwd@outlook.com"/>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/css/console1412.css" rel="stylesheet" type="text/css" />
    <link href="/assets/admin/css/sycit.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/assets/plugins/jquery-2.2.4.min.js" ></script>
    <script type="text/javascript" src="/assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
    <!--AJAX插件-->
    <script type="text/javascript" src="/assets/plugins/jquery.form.js" ></script>
    <!--弹窗插件-->
    <script type="text/javascript" src="/assets/plugins/toastr.js" ></script>
    <!-- bootstrap3-dialog -->
    <script type="text/javascript" src="/assets/plugins/b.dialog.js" ></script>
    <!-- layui -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/assets/plugins/layui/layui.js"></script>

    <!--打印-->
    <script type="text/javascript" src="/assets/plugins/print/jQuery.print.js" ></script>
</head>
<body>
<div class="console-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="console-title console-title-border clearfix">
                <div class="col-md-4 pull-left order-title">
                    <h3><span>{$title}</span></h3>
                    <span class="text-explode">|</span>
                    <span class="text-danger">
                    订单{:purchase_status($data.status,'1')}
                    {if condition="($data.status == 1)"}
                    ，可安排生产
                    {elseif condition="($data.status == 2)"/}
                    ，{:CountDownDays($data.pend_date)}
                    {elseif condition="($data.status == 5)"/}
                    ，【{$data.pend_date}】
                    {/if}

                    </span>
                </div>
                <div class="col-md-5 text-center order-title">
                    <input class="btn btn-primary" type="button" value="客户已确认" disabled>
                    {if condition="($data.pshoudj == 1)"/}
                    <input class="btn btn-primary" type="button" value="已收订金" disabled>
                    {elseif condition="($data.pshoudj == 2)"/}
                    <input class="btn btn-primary" type="button" value="已收余款" disabled>
                    {elseif condition="($data.pshoudj == 3)"/}
                    <input class="btn btn-primary" type="button" value="已收全款" disabled>
                    {/if}

                    {switch name="$data.status"}
                    {case value="1"}
                    <input class="btn btn-info" type="button" value="开始生产" onclick="editKaiShiShengChan('{$data.pnumber}')">
                    {/case}
                    {case value="2"}
                    <input class="btn btn-danger" type="button" value="生产完成" onclick="editShengChanWanCheng('{$data.pnumber}')">
                    {/case}
                    {case value="3"}
                    <input class="btn btn-primary" type="button" value="生产完成" disabled>
                    <input class="btn btn-primary" type="button" value="等待出库" disabled>
                    {/case}
                    {case value="4"}
                    <input class="btn btn-primary" type="button" value="生产完成" disabled>
                    {/case}
                    {case value="5"}
                    <input class="btn btn-primary" type="button" value="生产完成" disabled>
                    <input class="btn btn-primary" type="button" value="已 出 库" disabled>
                    {/case}
                    {/switch}
                </div>
                <div class="col-md-3 text-right">
                    {gt name="$data.status" value="1"}
                    <a href="{:Url('schedule/lodop',['pid'=>$data.pnumber])}" target="_blank" class="btn btn-warning">打印标签</a>
                    {/gt}
                    <a class="btn btn-primary" onclick="PrintMytable();">打印预览</a>
                    <a href="javascript:window.close();" class="btn btn-default"><span>关闭窗口</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <div style="padding: 15px;" id="orderList">
                <div class="order-head">
                    <div class="order-head-title"><span>{:Config('syc_webname')}</span></div>
                </div>
                <div class="form-inline">
                    <div class="row order-form-title">
                        <div class="syc-orde-col"><span></span></div>
                        <div class="syc-orde-col order-form-name">
                            <span>生产订单</span>
                        </div>
                        <div class="syc-orde-col text-right">
                            <label class="control-label syc-label">销售单号:</label>
                            <input type="text" class="syc-input w120 order-one" value="{$data.pnumber}" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="syc-orde-col">
                            <label class="control-label syc-label order-span">客户名称:</label>
                            <input type="text" class="syc-input w120"  value="{$data.pcsname}" disabled>
                        </div>
                        <div class="syc-orde-col">

                        </div>
                        <div class="syc-orde-col" align="right">
                            <label class="control-label syc-label">发货日期:</label>
                            <input type="text" class="syc-input w120" value="{$data.pend_date}" disabled>
                        </div>
                    </div>

                </div>

                <table class="table table-hover order-list" style="margin-bottom: 0;">
                    <tbody>
                    <tr class="thead">
                        <td rowspan="2" class="w50">序号</td>
                        <td rowspan="2" class="w80">颜色</td>
                        <td rowspan="2" colspan="2">产品编号</td>
                        <td colspan="3" class="w150">规格/mm</td>
                        <td rowspan="2" class="w50">吊脚高度/mm</td>
                        <td rowspan="2" colspan="2">包边线设置</td>
                        <td rowspan="2" class="w80">锁向</td>
                        <td rowspan="2" class="w80">锁具</td>
                        <td rowspan="2" class="w65">数量</td>
                        <td rowspan="2" class="w120">备注</td>
                    </tr>
                    <tr class="thead">
                        <td class="w50">宽</td>
                        <td class="w50">高</td>
                        <td class="w50">厚</td>
                    </tr>
                    <!--列表开始-->
                    {volist name="list" id="vo" empty="$empty" key="k"}
                    <tr>
                        <td>{$vo.xuhao}</td>
                        <td>{$vo.yanse}</td>
                        <td class="w50">{$vo.products}</td>
                        <td class="w50">{$vo.chanph}</td>
                        <td>{$vo.breadth}</td>
                        <td>{$vo.heiget}</td>
                        <td>{$vo.thick}</td>
                        <td>{$vo.diaojiao}</td>
                        <td width="50">{$vo.attribute}</td>
                        <td width="70">{$vo.baobian}</td>
                        <td>{$vo.suoxiang}</td>
                        <td>{$vo.fittings}</td>
                        <td>{$vo.quantity}</td>
                        {eq name="$k" value="1"}<td rowspan="{$count}" width="120">{$remark}</td>{/eq}
                    </tr>
                    {/volist}
                    <!--列表结束-->
                    </tbody>
                </table>
                <table class="table borde-xiao">
                    <tbody>
                    <!---->
                    <tr>
                        <td><b>注：</b>左锁内开 <img src="/assets/img/suo-zn.png"></td>
                        <td>右锁内开 <img src="/assets/img/suo-yn.png"></td>
                        <td>左锁外开 <img src="/assets/img/suo-zw.png"></td>
                        <td>右锁外开 <img src="/assets/img/suo-yw.png"></td>
                        <td class="text-left">
                            数量合计:
                            <span class="syc-input order-one w50v"> {$data.pcount}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-inline" style="padding:0 15px;">
                <div class="alert alert-tip"><b>打印说明：</b>
                    <p></p>
                    <p>需要打印最好使用Charome(谷歌浏览器)、或360浏览器。</p>
                    <p>因为打印是调用系统接口，没有权限，所以默认打印会显示页眉和页脚。</p>
                    <p>如需要去除页眉和页脚，可以在浏览打印时候，点击【+更多设置】，取消勾选【页眉和页脚】。</p>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="handle_status" value="">
<script type="text/javascript" src="/assets/admin/scripts/syc-order.js"></script>
<script type="text/javascript">
    $(function () {
        //
    });
    //打印设置
    function PrintMytable() {
        $("#orderList").print({mediaPrint : false,});
    };

    //开始生产
    function editKaiShiShengChan(e) {
        if (!isNaN(e) && e !== null && e !== '') {
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer;
                layer.open({
                    offset: '80px',
                    type: 2, //窗口模式
                    title: '确认生产' ,//不显示标题栏
                    area: ['800px', '550px'],
                    content: '{:Url("schedule/in")}?pid='+e,
                    end: function(){
                        var status = $("#handle_status").val();
                        if ( status == '1' ) {
                            //
                            window.location.reload(); //刷新页面
                        }
                    }
                })
            })
        }
    };

    //生产完成
    function editShengChanWanCheng(e) {
        if (!isNaN(e) && e !== null && e !== '') {
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer;
                layer.open({
                    offset: '100px',
                    type: 2, //窗口模式
                    title: '订单生产完成' ,//不显示标题栏
                    area: ['800px', '300px'],
                    //closeBtn: false,
                    //shade: 0.8, //遮罩层深度
                    content: '{:Url("schedule/shengcwc")}?pid='+e,
                    end: function(){
                        var status = $("#handle_status").val();
                        if ( status == '1' ) {
                            window.location.reload(); //刷新页面
                        }
                    }
                })
            })
        }
    };
    
    //订单出库
//    function editDingDanChuKu(e) {
//        if (!isNaN(e) && e !== null && e !== '') {
//            layui.use(['layer', 'form'], function(){
//                var layer = layui.layer;
//                layer.open({
//                    offset: '100px',
//                    type: 2, //窗口模式
//                    title: '订单出库' ,//不显示标题栏
//                    area: ['800px', '500px'],
//                    //closeBtn: false,
//                    //shade: 0.8, //遮罩层深度
//                    content: '{:Url("schedule/chuku")}?pid='+e,
//                    end: function(){
//                        var status = $("#handle_status").val();
//                        if ( status == '1' ) {
//                            window.location.reload(); //刷新页面
//                        }
//                    }
//                })
//            })
//        }
//    }

</script>
</body>
</html>