{extend name="public/base"}
{block name="header"}

{/block}
{block name="main"}
            <div class="console-container">
                <div class="row syc-bg-fff">
                    <div class="col-md-12 syc-border-bs">
                        <div class="console-title">
                            <div class="pull-left">
                                <h5>{$title}</h5>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:window.location.reload();" class="btn btn-default" style="margin-left:10px;" >
                                    <span class="glyphicon glyphicon-refresh"></span>
                                    <span>刷新</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="ConfigFormEdit" action="{:url('config/edit')}" method="post">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th><span>配置说明</span></th>
                                    <th><span>配置值</span></th>
                                    <th><span>配置名称</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                {volist name="data" id="vo"}
                                <tr>
                                    <td>{$vo.info}</td>
                                    <td><div style="width: 80%;">
                                        {switch $vo.type}
                                        {case string}
                                        <input {if condition="$vo['name']=='syc_email_pwd'"}type="password"{else}type="text"{/if} class="form-control" name="{$vo.name}" value="{$vo.value|htmlspecialchars}" />{/case}
                                        {case bstring}
                                        <textarea class="form-control" name="{$vo.name}" rows="4">{$vo.value|htmlspecialchars}</textarea>
                                        {/case}
                                        {/switch}
                                    </div></td>
                                    <td>{$vo.name}</td>
                                </tr>
                                {/volist}
                                </tbody>
                            </table>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">保存</button>
                                        <button type="button" class="btn default" onclick="JavaScript:history.back(-1);">重置</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
{/block}
{block name="footer"}
<script type="text/javascript">
    $(document).ready(function() {
        // 当前页面分类高亮
        $("#sidebar-config").addClass("sidebar-nav-active"); // 大分类
        $("#config-index").addClass("active"); // 小分类
        // 提交信息
        $("#ConfigFormEdit").ajaxForm(function (e) {
            if (e.code === 1) {
                //console.log(e.msg);
                toastr.success(e.msg);
            } else {
                toastr.error(e.msg);
            }
        })
    })
</script>
{/block}