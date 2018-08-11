{extend name="public/base"}
{block name="header"}

{/block}

{block name="sub_sidebar"}
{include file="goods/goods_sidebar"}
{/block}

{block name="main"}
            <div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                                <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{:url('add')}">新增商品</a>
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="marginTop10"></div>
                <div class="row">
                    <div class="col-lg-12">
                    
                    <div class="sub-button-line form-inline">
                            <form class="pull-left">
                                <div class="form-group">
                                    <label class="control-label" for="goods_name">商品名称 :</label>
                                    <input name="goods_name" id="goods_name" class="ipt form-control" <?php if (isset($_GET['goods_name'])):?>value="<?php echo $_GET['goods_name'];?>"<?php endif;?> />
                                    </div>
                                <div class="form-group">
                                    <label class="control-label" for="supplier_name">供应商 :</label>
                                    <input name="supplier_name" id="supplier_name" class="ipt form-control" <?php if (isset($_GET['supplier_name'])):?>value="<?php echo $_GET['supplier_name'];?>"<?php endif;?> />
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="searchprojectName">查找</button>
                                </div>
                            </form>
<!--                             <div class="pull-right"> -->
<!--                                 <a class="btn btn-primary" href="{:Url('customers/excel')}" target="_blank">导出Excel</a> -->
<!--                             </div> -->
                        </div>
                    	<div style="clear:both;"></div>
                        <table class="table syc-table border marginTop10">
                            <thead>
                            <tr>
                                <th>ID编号</th>
                                <th>商品名称</th>
                                <th>商品分类</th>
                                <th>供应商</th>
                                <th>商品品牌</th>
                                <th>单位</th>
                                <th>采购价</th>
                                <th>销售价</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="$list" id="vo" empty="$empty"}
                            <tr>
                                <td>{$vo.goods_id}</td>
                                <td>{$vo.goods_name}</td>
                                <td>{$vo.category_name}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.brand_name}</td>
                                <td>{$vo.unit}</td>
                                <td>{$vo.shop_price}</td>
                                <td>{$vo.market_price}</td>
                                <td>
                                	<a href="{:url('goodsinfo',['gid'=>$vo.goods_id])}">详情</a>
                                	<span class="text-explode">|</span>
                                    <a href="{:url('goods_edit',['gid'=>$vo.goods_id])}">修改</a>
                                    <span class="text-explode">|</span>
                                    <a href="javascript:void(0);" onclick="deleteOne('{$vo.goods_id}');">删除</a>
                                </td>
                            </tr>
                            {/volist}

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
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

        //查询条件显示
        var sName = '{$Request.param.q}';
        if (sName == '') {
            $("#listname").find("li:first-child").addClass('active');
        } else {
            //pills-item-
            $("#pills-item-"+sName).addClass('active');
        }
    });
    //单条删除操作
    function deleteOnes(e) {
        if(confirm("确认删除？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'delone',gid:e};
                $.sycToAjax("{:url('goodsdel')}", data);
            }
        };
        return false;
    }
    //单条删除操作
    function deleteOne(e) {
        if (!isNaN(e) && e !== null && e !== '') {
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer;
                layer.open({
                    offset: '150px',
                    type: 1, //窗口模式
                    title: false ,//不显示标题栏
                    area: '300px;',
                    closeBtn: false,
                    shade: 0.8, //遮罩层深度
                    content: '<div class="layui-msg">请确认是否执行操作，一旦删除，也将现有的关联库存数据一起删除。</div>',
                    id: 'LAY_layuipro', //设定一个id，防止重复弹出
                    btn: ['确认', '取消'],
                    yes: function(index, layero) {
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                        var data={name:'delone',gid:e};
                        $.sycToAjax("{:url('goodsdel')}", data);
                    }
                    ,btn2: function(index, layero){
                        layer.close(index);
                    }
                })
            })
        }
    }
</script>
{/block}