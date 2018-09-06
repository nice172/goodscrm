{extend name="public/base"}
{block name="header"}

{/block}

{block name="sub_sidebar"}
{include file="goods/goods_sidebar"}
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
                                <a class="btn btn-primary" href="{:url('goods_edit',['gid'=>$data.goods_id])}">修改信息</a>
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
                            <div class="tab-pane active">
                                <table class="table table-condensed" style="margin-top:0;">
                                    <tbody>
                                    <tr>
                                        <td width="15%" class="right-color"><span>商品名称:</span></td>
                                        <td width="35%">
                                            <span>{$data.goods_name}</span>
                                        </td>
                                        <td width="15%" class="right-color"><span>商品分类:</span></td>
                                        <td width="35%"><span>{$data.category_name}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>状态:</span></td>
                                        <td width="35%">
                                        	{if condition="$data['status']==1"}正常{elseif condition="$data['status']==-1"}已删除{else}禁售{/if}
                                        </td>
                                        <td width="15%" class="right-color"><span>商品类型:</span></td>
                                        <td width="35%"><span>{$data.goods_type}</span></td>
                                    </tr>
                                    <tr>
                                        <!--<td width="15%" class="right-color"><span>商品品牌:</span></td>
                                        <td width="35%"><span>{$data.brand_name}</span></td> -->
                                        <td width="15%" class="right-color"><span>供应商:</span></td>
                                        <td width="35%" colspan="3"><span>{$data.supplier_name}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>属性规格:</span></td>
                                        <td width="35%" colspan="3">
										{foreach name="data.goods_attr" item="v"}
											{$v.attr_name}：{$v.attr_value}<br/>
										{/foreach}
										</td>
                                    </tr>
                                    <tr>

                                        <td width="15%" class="right-color"><span>采购价:</span></td>
                                        <td width="35%"><span>{$data.shop_price}</span></td>
                                        <td width="15%" class="right-color"><span>销售价:</span></td>
                                        <td width="35%"><span>{$data.market_price}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>单位:</span></td>
                                        <td width="35%"><span>{$data.unit}</span></td>
                                        <td width="15%" class="right-color"><span>重量:</span></td>
                                        <td width="35%"><span>{$data.goods_weight}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>商品存在:</span></td>
                                        <td width="35%"><span>{$data.store_number}</span></td>
                                        <td width="15%" class="right-color"><span>库存属性:</span></td>
                                        <td width="35%"><span>{$data.store_attr}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>所有权:</span></td>
                                        <td width="35%"><span>{$data.copyright}</span></td>
                                        <td width="15%" class="right-color"><span>具体位置:</span></td>
                                        <td width="35%"><span>{$data.address}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>新增时间:</span></td>
                                        <td width="35%"><span>{$data.create_time|date='Y-m-d H:i:s',###}</span></td>
                                        <td width="15%" class="right-color"><span>更新时间:</span></td>
                                        <td width="35%"><span>{$data.update_time|date='Y-m-d H:i:s',###}</span></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="right-color"><span>备注信息:</span></td>
                                        <td width="35%" colspan="3">{$data.remark}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
    $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
    $("#storage-xingcai").addClass("active"); // 小分类

    });
</script>
{/block}