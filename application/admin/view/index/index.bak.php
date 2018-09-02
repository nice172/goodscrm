{extend name="public/base"}
{block name="header"}
<link href="/assets/admin/css/home.console.css" rel="stylesheet" type="text/css" />
{/block}
{block name="main"}
            <div class="home-v2">
                <div class="home-section-main clearfix">
                    <!--内容开始-->
                    <!--顶栏-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="home-head">
                                <div class="home-head-open-title">
                                    <div class="title-noticeTitle">
                                        <span class="webname">{:Config('syc_webname')}</span>
                                        <em style="font-size: 16px;margin-left: 15px;">进销存管理系统</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/顶栏-->
                    <!-- 左侧 home-section-left-->
                    <div class="home-section">
                        <!--上-->
                        <div class="home-section-wrap clearfix">
                            <div class="pull-left" style="width: 54%">
                                <div class="section-container home-section-security">
                                    <div class="security-left">
                                        <div class="container-title">个人信息</div>
                                        <div class="sas-open-bg">
                                            <p>欢迎：{$user.user_nick}</p>
                                            <p>角色：{$user.title}</p>
                                        </div>
                                    </div>
                                    <div class="security-right">
                                        <div class="section-container home-section-undo" style="padding: 0;">
                                            <div class="container-title">订单信息</div>
                                            <div class="container-body">
                                                <a class="undo-item home-block-hover">
                                                    <span class="item-text">共计订单</span>
                                                    <span class="item-number item-number-grey text-danger" style="color: #FF0000;">{$pcount}</span>
                                                    <span class="item-unit">件</span>
                                                </a>
                                                <a class="undo-item home-block-hover">
                                                    <span class="item-text">未交货订单</span>
                                                    <span class="item-number item-number-grey">{$pshenc}</span>
                                                    <span class="item-unit">件</span>
                                                </a>
                                                <a class="undo-item home-block-hover">
                                                    <span class="item-text">完成订单</span>
                                                    <span class="item-number item-number-grey">{$pchuhuo}</span>
                                                    <span class="item-unit">件</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="pull-left" style="width: 46%;padding-left: 16px;">
                                <div class="section-container home-section-security">
                                    <div class="security-left">
                                        <div class="container-title">待处理订单</div>
                                        <div class="container-body">
                                            <div class="item-horizontal" style="margin-bottom: 10px">
                                                <div class="item-content home-block-hover">
                                                    <span class="item-text">确认订单</span>
                                                    <span class="item-unit">件</span>
                                                    <span class="item-number item-number-grey">{$pqueren}</span>
                                                </div>
                                            </div>
                                            <div class="item-horizontal">
                                                <div class="item-content home-block-hover">
                                                    <span class="item-text">部分已送货</span>
                                                    <span class="item-unit">件</span>
                                                    <span class="item-number item-number-grey">{$pqrdjin}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!---->
                                    <div class="security-right">
                                        <div class="container-title">&nbsp;</div>
                                        <div class="container-body">
                                            <div class="item-horizontal" style="margin-bottom: 10px">
                                                <div class="item-content home-block-hover">
                                                    <span class="item-text">今日下单</span>
                                                    <span class="item-unit">件</span>
                                                    <span class="item-number item-number-grey">{$pqrweikuan}</span>
                                                </div>
                                            </div>
                                            <div class="item-horizontal">
                                                <div class="item-content home-block-hover">
                                                    <span class="item-text">今日下单客户</span>
                                                    <span class="item-unit">件</span>
                                                    <span class="item-number item-number-grey">{$pqrchuku}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--上 END-->
                        
                        <div class="home-section-wrap">
                        <span>最后5次报价记录 <a href="javascript:;" class="click_list">收起</a></span>
                        <div class="record_list">
                        	<table class="table syc-table border marginTop10 show_list">
                            <thead>
                            <tr>
                            <th colspan="5" style="text-align: left;">报价记录</th>
                            </tr>
                            <tr>
                                <th style="width:10%;">创建时间</th>
                                <th style="width:10%;">发送时间</th>
                                <th style="width:20%;">客户名称</th>
                                <th style="width:10%;">业务员</th>
                                <th style="width:40%;">备注</th>
                            </tr>
                            </thead>
                            <tbody>
							{volist name="$record_list" id="vo" empty="$empty"}
                            <tr>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{if condition="$vo['send_email_time']"}{$vo.send_email_time|date='Y-m-d',###}{else}--{/if}</td>
                                <td>{$vo.company_name}</td>
                                <td>{$vo.order_handle}</td>
                                <td>{$vo.order_remark}</td>
                            </tr>
                            {/volist}
                            </tbody>
                            </table>
                        </div>
                        </div>
                        
                        <div class="home-section-wrap">
                        <span>最后5次送货记录 <a href="javascript:;" class="click_list">收起</a></span>
                        <div class="record_list">
                        	<table class="table syc-table border marginTop10 show_list">
                            <thead>
                            <tr>
                            <th colspan="5" style="text-align: left;">送货记录</th>
                            </tr>
                            <tr>
                                <th style="width:10%;">要求送货时间</th>
                                <th style="width:10%;">实际送货时间</th>
                                <th style="width:20%;">客户名称</th>
                                <th style="width:10%;">业务员</th>
                                <th style="width:40%;">备注</th>
                            </tr>
                            </thead>
                            <tbody>
							{volist name="$delivery_list" id="vo" empty="$empty"}
                            <tr>
                                <td>{$vo.require_time|date='Y-m-d',###}</td>
                                <td>{$vo.delivery_date}</td>
                                <td>{$vo.cus_name}</td>
                                <td>{$vo.cus_order_ren}</td>
                                <td>{$vo.order_remark}</td>
                            </tr>
                            {/volist}
                            </tbody>
                            </table>
                        </div>
                        </div>
                        
                        <div class="home-section-wrap">
                        <span>库存记录 <a href="javascript:;" class="click_list">收起</a></span>
                        <div class="record_list">
                        	<table class="table syc-table border marginTop10 show_list">
                            <thead>
                            <tr>
                                <th style="width:15%;">商品分类</th>
                                <th style="width:25%;">供应商</th>
                                <th style="width:40%;">商品名称</th>
                                <th style="width:10%;">单位</th>
                                <th style="width:10%;">库存数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" key="key" empty="$empty"}
                                <tr>
                                <td>{$vo.category_name}</td>
                                <td>{$vo.supplier_name}</td>
                                <td style="text-align:left;">{$vo.goods_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.store_number}</td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-left">
                                        
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                            </table>
                        </div>
                        </div>
                        
                        <!-- 模块区域 -->
                        <div class="home-section-wrap">
                            <div class="home-section-module home-box-shadow">
                                <ul class="nav nav-tabs">
                                    <li class=""><a>销售图表</a></li>
                                    <li class="pull-right">
                                        <a id="plain">平面柱</a>
                                        <a id="inverted">侧面柱</a>
                                        <a id="polar">极地图</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- 图表 -->
                                    <div class="tab-pane active" id="tabsQuanyi">
                                        <div class="home-section-rights clearfix">
                                            <div id="container" style="min-height: 450px;margin: 0 auto"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 模块区域 END-->
                        
                    </div>
                    <!-- 左侧 结束 -->
                    <!-- 右侧 home-section-right-->
                    <!-- 右侧 END-->
                    <!--内容结束-->
                </div>
            </div>
{/block}
{block name="footer"}
<script src="/assets/plugins/highcharts/code/highcharts.js"></script>
<script src="/assets/plugins/highcharts/code/highcharts-more.js"></script>
<script src="/assets/plugins/highcharts/code/modules/exporting.js"></script>
<script type="text/javascript">

	$('.click_list').click(function(){
		var parents = $(this).parents('.home-section-wrap');
		if($(parents).find('.record_list table').hasClass('show_list')){
			$(parents).find('.record_list table').removeClass('show_list').addClass('hide_list');
			$(parents).find('.record_list table').hide();
			$(this).text('展开');
		}else{
			$(parents).find('.record_list table').removeClass('hide_list').addClass('show_list');
			$(parents).find('.record_list table').show();
			$(parents).find(this).text('收起');
		}
	});

    var chart = Highcharts.chart('container', {
        //顶部的标题
        title: {
            text: '{$dateD}年销售订单'
        },
        //顶部的来源注释
        subtitle: {
            text: '平面柱'
        },
        //侧边注释标题
        yAxis: {
            min: 0,
            title: {
                text: false
            }
        },
        //数据标签
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} 件</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        //展示的标题
        xAxis: {
            categories: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
        },
        //展示的数据
        series: [{
            type: 'column',
            colorByPoint: true,
            name: '数量', //{series.name}
            data: {$dateArr},
            showInLegend: false
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 900
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        credits: {
            enabled: false
        }

    });


    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: '平面柱'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: '侧面柱'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: '极地图'
            }
        });
    });

</script>
{/block}