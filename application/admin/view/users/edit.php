{extend name="public/base"}
{block name="header"}
<style type="text/css">

</style>
{/block}
{block name="main"}
<div class="container-fluid">
            <div class="console-container">
                <!--内容开始-->
<?php $current_title = '修改用户';?>
{include file="public/current"}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet light margin-top-3">
                            <form class="form-horizontal" method="post" id="updateUserForm">
                                <input type="hidden" name="__token__" value="{$Request.token}" />
                                <input type="hidden" name="uid" value="{$user.id}" />
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>温馨提示</strong> 登录密码为空则不修改密码，如需要修改密码则不少于 6 位字母或加数字，不能用特殊符号等。
                                </div>
                                <div class="form-group">
                                    <label for="inputuserid" class="col-sm-2 control-label">员工编号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300 fleft" id="inputuserid" value="{$user.id}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputusername" class="col-sm-2 control-label">登陆名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300 fleft" id="inputusername" value="{$user.user_name}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">登陆密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300 fleft" name="password" id="inputPassword" value=""> <label class="control-label" style="margin-left:10px;"><b>为空则不修改密码</b></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputusernick" class="col-sm-2 control-label">员工姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300 fleft" name="nickname" id="inputusernick" value="{$user.user_nick}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputemail" class="col-sm-2 control-label">所属角色</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" {if condition="$user['id']==1"}disabled="disabled"{/if} name="group_id">
                                            <option value="0">选择角色</option>
                                            {volist name="group" id="vo"}
                                            <option value="{$vo.id}" {if condition="$user['group_id']==$vo['id']"}selected="selected"{/if}>{$vo.title}</option>
                                            {/volist}
                                        </select>
                                    </div>
                                </div>
                               
                                   <div class="form-group">
                                    <label for="ruzhishijian" class="col-sm-2 control-label">入职时间</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control w150 fleft" name="ruzhishijian" id="ruzhishijian" value="{$user.entry_time}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-10">
                                        <label class="mt-radio">
                                            <input type="radio" class="margin-right" name="sex" value="1" {eq name="$user.user_sex" value="1"} checked{/eq}>男
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" class="margin-right" name="sex" value="2" {eq name="$user.user_sex" value="2"} checked{/eq}>女
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputemail" class="col-sm-2 control-label">员工邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w300" name="email" id="inputemail" value="{$user.user_email}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputemail" class="col-sm-2 control-label">账户状态</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="status">
                                            <option value="">选择状态</option>
                                            <option value="-1" {eq name="$user.status" value="-1"}selected{/eq}>删除</option>
                                            <option value="0" {eq name="$user.status" value="0"}selected{/eq}>禁用</option>
                                            <option value="1" {eq name="$user.status" value="1"}selected{/eq}>正常</option>
                                            <option value="2" {eq name="$user.status" value="2"}selected{/eq}>审核</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-offset-2 col-md-8 left">
                                        <button type="submit" class="btn btn-primary">保存</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!--内容结束-->
            </div>
        </div>

{/block}
{block name="footer"}
<script type="text/javascript" src="/assets/plugins/jquery-validation/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-users").addClass("active"); // 小分类

        //
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期选择器
            laydate.render({
                elem: '#ruzhishijian'
                //,type: 'date' //默认，可不填
            });
        });

        //更新验证
        $("#updateUserForm").validate({
            rules: {
                password: {
                    minlength: 2,
                    maxlength: 16
                },
                nickname: {
                    required: true,
                },
                group_id: {
                    required: true
                }
            },
            errorClass: 'help-block',
            focusInvalid: true, //当为false时，验证无效，没有焦点响应
            onkeyup: false, //当丢失焦点时才触发验证请求
            errorElement: 'label',

            //验证不通过
            highlight: function(element, errorClass) {
                $(element).closest('.form-group').addClass('has-error'); // 验证未通过给input添加css
            },
            //验证通过后
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error'); // 验证未通过给input添加css
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            // 如果表单验证不通过
            invalidHandler: function(){
                //
                toastr.warning("填写不完整请认真检查");
            },
            // 表单验证成功，调用Ajax表单提交
            submitHandler: function() {
                //
                $.ajax({
                    url: '{:url("users/update")}',
                    type: 'post',
                    dataType: 'JSON',
                    data: $("#updateUserForm").serialize(),
                    success: function (result) {
                        if (result.code > 0) {
                            toastr.success(result.msg)
                        } else {
                            toastr.error(result.msg);
                        }
                        window.setTimeout(function() {
                            window.location.href=result.url;
                        }, 1500);
                    }
                });
                return false; // 阻止表单自动提交事件
            }
        });
    })
</script>
{/block}