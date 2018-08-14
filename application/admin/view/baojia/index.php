{extend name="public/base"}
{block name="header"}

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
                                <a class="btn btn-primary" href="{:url('add')}">新增报价单</a>
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
                                    <label class="control-label" for="goods_name">客户简称 :</label>
                                    <input name="goods_name" id="goods_name" class="ipt form-control" <?php if (isset($_GET['supplier_short'])):?>value="<?php echo $_GET['supplier_short'];?>"<?php endif;?> />
                                    </div>
                                <div class="form-group">
                                    <label class="control-label" for="projectNameInput">创建时间 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> class="ipt form-control">
                                    
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
                                <th>报价单号</th>
                                <th>报价日期</th>
                                <th>简称</th>
                                <th>客户名称</th>
                                <th>联系人</th>
                                <th>传真号码</th>
                                <th>电子邮箱</th>
                                <th>跟单员</th>
                                <th>创建时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {volist name="$list" id="vo" empty="$empty"}
                            <tr>
                                <td>{$vo.id}</td>
                                <td>{$vo.order_sn}</td>
                                <td>{$vo.create_time|date='Y-m-d',###}</td>
                                <td>{$vo.company_short}</td>
                                <td>{$vo.company_name}</td>
                                <td>{$vo.contacts}</td>
                                <td>{$vo.fax}</td>
                                <td>{$vo.email}</td>
                                <td>{$vo.order_handle}</td>
                                <td>{$vo.create_time|date='Y-m-d H:i:s',###}</td>
                                <td>{if condition="$vo.status==1"}已发送{else}未发送{/if}</td>
                                <td>
                                	<a href="{:url('info',['gid'=>$vo.id])}">详情</a>
                                	<span class="text-explode">|</span>
                                	<a href="{:url('pdf',['gid'=>$vo.id])}" target="_blank">查看PDF</a>
                                	<span class="text-explode">|</span>
                                	{if condition="$vo.status==1"}
                                	<a href="javascript:void(0);" onclick="send('{$vo.id}');">重新发送</a>
                                	{else}
                                	<a href="javascript:void(0);" onclick="send('{$vo.id}');">发送PDF</a>
                                	{/if}
                                	<span class="text-explode">|</span>
                                    <a href="{:url('edit',['gid'=>$vo.id])}">修改</a>
                                    <span class="text-explode">|</span>
                                    <a href="javascript:void(0);" onclick="deleteOne('{$vo.id}');">删除</a>
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
        $("#sidebar-baojia").addClass("sidebar-nav-active"); // 大分类
        $("#baojia-index").addClass("active"); // 小分类
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期选择器
            laydate.render({
                elem: '#start_time'
                //,type: 'date' //默认，可不填
            });
            laydate.render({
                elem: '#end_time'
                //,type: 'date' //默认，可不填
            });
        });

    });
    function deleteOne(e) {
        if (!isNaN(e) && e !== null && e !== '') {
            if(confirm("确认删除？")){
                if (!isNaN(e) && e !== null && e !== '') {
                    var data={name:'delone',gid:e};
                    $.sycToAjax("{:url('delete')}", data);
                }
            };
            return false;
        }
    }
    function send(e) {
        if (!isNaN(e) && e !== null && e !== '') {
            if(confirm("确认发送？")){
                if (!isNaN(e) && e !== null && e !== '') {
                    var data={name:'delone',gid:e};
                    $.sycToAjax("{:url('send')}", data);
                }
            };
            return false;
        }
    }
</script>
{/block}