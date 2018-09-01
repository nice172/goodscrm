{extend name="public/base"}
{block name="header"}
<style>.tab-pane{padding-top:15px;}</style>
{/block}

{block name="main"}
<div class="container-fluid">
                <!--内容开始-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="console-title console-title-border clearfix">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                            </div>
                            <div class="pull-right">
                                	<a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                                    <a href="javascript:history.go(-1);" class="btn btn-default">
                                    <span class="icon-goback"></span><span>返回</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-inline marginTop20">
                                        
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" role="tablist">
    <li><a href="{:url('info',['id' => $id])}">采购单</a></li>
    <li class="active"><a href="javascript:;">采购记录</a></li>
  </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 marginTop15">
                        <table class="table table-hover syc-table border">
                            <thead>
                            <tr>
                                <th>序号</th>
                                <th>采购日期</th>
                                <th>采购单号</th>
                                <th>供应商</th>
                                <th>联系人</th>
                                <th>采购金额</th>
                                <th>创建人</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="list" id="vo" key="key" empty="$empty"}
                                <tr>
                                <td>{$key}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.po_sn}</td>
                                <td>{$vo.supplier_name}</td>
                                <td>{$vo.contacts}</td>
                                <td>{$vo.total_money}</td>
                                <td>{$vo.user_nick}</td>
                                <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                <td>
                                	<a href="{:url('info',['id' => $vo['id']])}">详情</a>
                                </td>
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

                <!--内容结束-->
            </div>
{/block}
{block name="footer"}

<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
//         layui.use('laydate', function() {
//             var laydate = layui.laydate;
//   		  	laydate.render({
//     		    elem: '#start_time'
//     		  });
//   		  	laydate.render({
//     		    elem: '#end_time'
//     		  });
//         });
        
        // 当前页面分类高亮
        $("#sidebar-purchase").addClass("sidebar-nav-active"); // 大分类
        $("#purchase-index").addClass("active"); // 小分类
});
</script>
{/block}