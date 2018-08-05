{extend name="public/base"}
{block name="header"}
<link href="/assets/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css">
{/block}
{block name="main"}
            <div class="console-container">
                <!--内容开始-->
                <div class="row syc-bg-fff">
                    <div class="col-lg-12 syc-border-bs">
                        <div class="console-title">
                            <div class="pull-left">
                                <h5><span>{$title}</span></h5>
                            </div>
                            <div class="pull-right">
<!--                                 <a class="btn btn-primary" id="AddDepartmentModal">新增角色</a> -->
<a class="btn btn-primary" href="{:url('add')}">新增角色</a>
                                <a href="javascript:window.location.reload();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="syc-page-panel marginTop20">
                            <div class="syc-table" style="padding-top: 10px;">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 marginBottom10">
                                        <div class="margin-bottom-10" id="nestable_list_menu">
                                            <button type="button" class="btn btn-primary green sbold" data-action="expand-all">全部展开</button>
                                            <button type="button" class="btn btn-info red sbold" data-action="collapse-all">全部折叠</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="dd" id="nestable_list_3">
                                            <ol class="dd-list">
                                                {volist name="group" key="key" id="vo"}
                                                <li class="dd-item dd3-item node{$vo.id}" data-id="{$key}">
                                                    <div class="dd-handle dd3-handle"><i class="fa fa-bars"></i></div>
                                                    <div class="dd3-content"> {$vo.title} <span class="label label-sm label-primary" style="margin:0px 0px 0px 50px;">{$vo.count} 人</span><span class="cat-text">{if condition="$vo['status']"}<a href="javascript:;" class="rolestatus" role-id="{$vo.id}">开启</a>{else}<a href="javascript:;" class="rolestatus" role-id="{$vo.id}">禁用</a>{/if}&nbsp;&nbsp;<a href="<?php echo url('edit',['id' => $vo['id']]);?>">修改</a>&nbsp;&nbsp;<a href="javascript:void(0);" class="deleteRole" role-id="{$vo.id}">删除</a></span></div>
                                                    {notempty name="$vo.son"}
                                                    <ol class="dd-list">
                                                        {foreach $vo.son as $son1}
                                                        <li class="dd-item dd3-item" data-id="{$key}">
                                                            <div class="dd-handle dd3-handle"><i class="fa fa-bars"></i></div>
                                                            <div class="dd3-content"> {$son1.user_nick} </div>
                                                        </li>
                                                        {/foreach}
                                                    </ol>
                                                    {/notempty}
                                                </li>
                                                {/volist}
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-role").addClass("active"); // 小分类

        //
        $("#AddDepartmentModal").on('click', function () {
            var title = $(this).text();
            //初始化插件
            bDialog.open({
                title : title,
                height : '300',
                url : '{:Url(\'department/add\')}',
                callback:function(data){
                    if(data && data.results && data.results.length > 0 ) {
                        //console.log(data.results);
                        window.location.href = data.results;
                    }
                }
            });
        });

        $('#nestable_list_menu').on('click', function (e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable_list_3').nestable({
            group: 0
        });
        //$('.dd').nestable('collapseAll');// 开启默认折叠所有节点 需要放在后面
    });

    $('.rolestatus').click(function(){
    	 var nodeid = $(this).attr('role-id');
         var _this = this;
			$.ajax({
				url: '<?php echo url('rolestatus');?>',
				method: 'get',
				data: {
					id:nodeid},
				success: function(res){
					if(res.code == 1){
						toastr.success(res.msg);
						setTimeout(function(){
							window.location.reload();
							},2000);
					}else{
						toastr.error(res.msg);
					}
				}
			});
     });
    
    $('.deleteRole').click(function(){
        if(confirm('确认要删除吗？')){
            var nodeid = $(this).attr('role-id');
            var _this = this;
			$.ajax({
				url: '<?php echo url('deleterole');?>',
				method: 'get',
				data: {
					id:nodeid},
				success: function(res){
					if(res.code == 1){
						$(_this).parents('li.node'+nodeid).remove();
						toastr.success(res.msg);
					}else{
						toastr.error(res.msg);
						}
				}
			});
        }
     });
    
    function deleteCategory(obj) {
        var categoryId=$(obj).attr("categoryId");
        //alert(categoryId);
        if(confirm("不可恢复，是否删除？")){
            $.ajax({
                url: "/sycit.php/category/delete/",
                type: "POST",
                dataType: "JSON",
                async:true,   //是否为异步请求
                cache:false,  //是否缓存结果
                data: {catid:categoryId,name:'delete'},
                success: function (result) {
                    if (result.code > 0) {
                        var okToast = toastr["success"](result.msg);
                        window.setTimeout(function(){
                            okToast(location.href=result.url);
                        }, 1000);
                    } else {
                        toastr["error"](result.msg);
                    }
                }
            });
        }
        return false;
    };

    //部门授权
    function DepartmentAuthModal() {
        //初始化插件
//        bDialog.open({
//            title : '部门授权',
//            width: '95%',
//            height : '600',
//            url : '{:Url(\'department/auth\')}',
//            callback:function(data){
//                if(data && data.results && data.results.length > 0 ) {
//                    //console.log(data.results);
//                    window.location.href = data.results;
//                }
//            }
//        });
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer;
            //iframe窗
            layer.open({
                type: 2, //基本层类型
                title: '部门授权',
                offset: '100px', //顶部100px
                maxmin: true, //最大最小化
                shadeClose: true, //点击遮罩关闭层
                area : ['800px' , '520px'], //高
                content: '{:Url(\'department/auth\')}'
            });
        });
    }
    //
    function DepartmentAddAuthRuleModal() {
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer;
            //iframe窗
            layer.open({
                type: 2, //基本层类型
                title: '添加授权',
                offset: '100px', //顶部100px
                maxmin: true, //最大最小化
                shadeClose: true, //点击遮罩关闭层
                area : ['800px' , '520px'], //高
                content: '{:Url(\'department/auth_rule\')}'
            });
        });
    }
</script>
{/block}