<!DOCTYPE html>
<html lang="zh-CN">
<head>
{include file="public/header-model"}
<link href="/assets/plugins/fileinput/fileinput.css" rel="stylesheet" type="text/css" />
<script src="/assets/plugins/fileinput/fileinput.js" type="text/javascript"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
  
        <div class="modal-body">
        
							<div class="sub-button-line form-inline">
                            <form class="pull-left" method="get" action="?">
                                <div class="form-group">
                                    <label class="control-label" for="cus_short">客户简称 :</label>
                                    <input name="cus_short" id="cus_short" class="ipt form-control" <?php if (isset($_GET['cus_short'])):?>value="<?php echo $_GET['cus_short'];?>"<?php endif;?> />
                                    </div>
                                <div class="form-group">
                                    <label class="control-label" for="">跟单员 :</label>
                                    <select name="order_ren" class="form-control" id="order_ren">
                                     <option value="">--请选择跟单员--</option>
                                            <?php foreach ($order_ren as $val){?>
                                            <option value="<?php echo $val;?>" <?php if (isset($_GET['order_ren']) && $_GET['order_ren']==$val){?>selected="selected"<?php }?>><?php echo $val;?></option>
                                            <?php }?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="searchprojectName">查找</button>
                                </div>
                            </form>
                        </div>
                        <div style="clear: both;"></div>
                        
                       
<div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover syc-table border">
                            <thead>
                                <tr>
                                    
                                    <th>ID编号</th>
                                    <th>简称</th>
                                    <th>客户名称</th>
                                    <th>联系人</th>
                                    <th>手机号码</th>
                                    <th>传真号码</th>
                                    <th>电子邮箱</th>
                                    <th>创建时间</th>
                                    <th>状态</th>
                                </tr>
                            </thead>
                            <tbody>
                            {volist name="data" id="vo" empty="$empty"}
                                <tr style="cursor: pointer;" class="selected_contacts" data-fax="{$vo.cus_fax}" data-email="{$vo.cus_email}" data-user="{$vo.cus_duty}" data-short="{$vo.cus_short}" data-name="{$vo.cus_name}" data-id="{$vo['cus_id']}">
                                    <td>{$vo.cus_id}</td>
                                    <td>{$vo.cus_short}</td>
                                    <td>{$vo.cus_name}</td>
                                    <td>{$vo.cus_duty}</td>
                                    <td>{$vo.cus_mobile}</td>
                                    <td>{$vo.cus_fax}</td>
                                    <td>{$vo.cus_email}</td>
                                    <td><?php echo $vo['create_time'];?></td>
                                    <td><?php echo $vo['status']?'正常':'禁用';?></td>
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
        <div class="modal-footer">

        </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
	$('.selected_contacts').click(function(){
		var contacts = {
			'company_name': $(this).attr('data-name'),
			'company_short': $(this).attr('data-short'),
			'fax': $(this).attr('data-fax'),
			'email': $(this).attr('data-email'),
			'user': $(this).attr('data-user'),
			'id': $(this).attr('data-id')
		};
		parent.window.client_info(contacts);
		bDialog.close('');
	});
});
</script>
</body>
</html>