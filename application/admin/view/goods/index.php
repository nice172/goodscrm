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
                        <table class="table syc-table border">
                            <thead>
                            <tr>
                                <th width="120">图形</th>
                                <th>型号</th>
                                <th>铝材名称</th>
                                <th>KG/M</th>
                                <th>支长/M</th>
                                <th>支长重量<br/>KG</th>
                                <th>添加员</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="$list" id="vo" empty="$empty"}
                            <tr>
                                <td class="st-list-img">
                                    {eq name="$vo.lximg" value=""}
                                    <img src="/uploads/noimage.png">
                                    {else/}
                                    <img src="{$vo.lximg}">
                                    {/eq}
                                </td>
                                <td>{$vo.lxxhao}</td>
                                <td>{$vo.lxname}</td>
                                <td>{$vo.lxkg}</td>
                                <td>{$vo.lxzhic}</td>
                                <td>{php}echo $vo['lxkg'] * $vo['lxzhic'];{/php}</td>
                                <td>{$vo.lx_uid}</td>
                                <td>
                                    <a href="{:url('storage/charge_edit',['pid'=>$vo.lxid])}">修改</a>
                                    <span class="text-explode">|</span>
                                    <a href="javascript:void(0);" onclick="deleteOne('{$vo.lxid}');">删除</a>
                                </td>
                            </tr>
                            {/volist}

                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">
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
                var data={name:'delone',pid:e};
                $.sycToAjax("{:url('product/color_delete')}", data);
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
                        var data={name:'delone',pid:e};
                        $.sycToAjax("{:url('storage/charge_delete')}", data);
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