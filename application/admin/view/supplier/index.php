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
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{:Url('supplier/add')}">新增供应商</a>
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="sub-button-line marginTop10 form-inline">
                            <form class="pull-left">
                                <div class="form-group">
                                    <label class="control-label" for="projectNameInput">供应商名称 :</label>
                                    <input name="cus_short" id="projectNameInput" class="ipt form-control" data-toggle="tooltip" <?php if (isset($_GET['cus_short'])):?>value="<?php echo $_GET['cus_short'];?>"<?php endif;?> data-placement="top" title="可搜索 供应商名称">
                                    </div>
                                <div class="form-group">
                                    <label class="control-label" for="projectNameInput">创建时间 :</label>
                                    <input name="start_time" id="start_time" <?php if (isset($_GET['start_time'])):?>value="<?php echo $_GET['start_time'];?>"<?php endif;?> class="ipt form-control">
                                    <span>到</span>
                                </div>
                                
                                <div class="form-group">
                                    <input name="end_time" id="end_time" <?php if (isset($_GET['end_time'])):?>value="<?php echo $_GET['end_time'];?>"<?php endif;?> class="ipt form-control">
                                    <button type="submit" class="btn btn-primary" id="searchprojectName">查找</button>
                                </div>
                            </form>
<!--                             <div class="pull-right"> -->
<!--                                 <a class="btn btn-primary" href="{:Url('customers/excel')}" target="_blank">导出Excel</a> -->
<!--                             </div> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table syc-table border table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>ID编号</th>
                                    <th>供应商名称</th>
                                    <th>联系人</th>
                                    <th>手机号码</th>
                                    <th>付款方式</th>
                                    <th>备注</th>
                                    <th>添加人</th>
                                    <th>添加时间</th>
                                    <th>更新时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" empty="$empty"}
                                <tr>
                                    <td>{$vo.id}</td>
                                    <td>{$vo.supplier_name}</td>
                                    <td>{$vo.supplier_contacts}</td>
                                    <td>{$vo.supplier_mobile}</td>
                                    <td>{$vo.supplier_payment}</td>
                                    <td>{$vo.supplier_remark}</td>
                                    <td>{$vo.add_user}</td>
                                    <td><?php echo $vo['create_time'];?></td>
                                    <td><?php echo $vo['update_time'];?></td>
                                    <td><?php echo $vo['supplier_status']?'正常':'禁用';?></td>
                                    <td>
                                        <a href="{:Url('view',['id'=>$vo.id])}">详情</a>
                                        <span class="text-explode">|</span>
                                        <a href="{:Url('edit',['id'=>$vo.id])}">修改</a>
                                        <span class="text-explode">|</span>
                                        <a href="javascript:void(0);" onclick="deleteLogisticsOne('{$vo.id}');">删除</a>
                                    </td>
                                </tr>
                            {/volist}
                            </tbody>
                            <tfoot>
                            <tr>
<!--                                 <td width="10"> -->
<!--                                     <input type="checkbox" class="mydomain-checkbox" id="ckSelectAll" name="ckSelectAll"> -->
<!--                                 </td> -->
                                <td colspan="19">
                                    <div class="pull-left">
<!--                                         <button id="DelAllAttr" type="button" class="btn btn-default">选中删除</button> -->
                                    </div>
                                    <div class="pull-right page-box">{$page}</div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                <!--内容结束-->
            </div>
        </div>
    </div>


{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-storage").addClass("sidebar-nav-active"); // 大分类
        $("#supplier-index").addClass("active"); // 小分类

        $('[data-toggle="tooltip"]').tooltip(); //工具提示

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

        
        // 名称搜索
//         $("#searchprojectName").on('click', function () {
//             var NameInput = $("input[name='projectNameInput']").val();
//             var NameInput = $("input[name='projectNameInput']").val();
//             if (NameInput !== null && NameInput !== '' && NameInput !== 'undefined') {
//                 window.location.href="{:Url('customers/index')}?q="+NameInput;
//             }
//         });

        // 使用prop实现全选和反选
        $("#ckSelectAll").on('click', function () {
            $("input[name='ckbox[]']").prop("checked", $(this).prop("checked"));
        });

        // 获取选中元素删除操作
        $("#DelAllAttr").on('click', function () {
            if(confirm("是否删除所选？")){
                // 获取所有选中的项并把选中项的文本组成一个字符串
                var valArr = new Array;
                $("input[name='ckbox[]']:checked").each(function(i){
                    valArr[i] = $(this).val();
                });
                if (valArr.length !== 0 && valArr !== null && valArr !== '') {
                    var data={name:'delallattr',uid:valArr.join(',')};
                    $.sycToAjax("{:Url('delete')}", data);
                };
            };
            return false;
        });
    });
    // 单条删除操作
    function deleteLogisticsOne(e) {
        if(confirm("是否删除？")){
            if (!isNaN(e) && e !== null && e !== '') {
                var data={name:'delone',supplier_id:e};
                $.sycToAjax("{:Url('delete')}", data);
            }
        };
        return false;
    }
</script>
{/block}