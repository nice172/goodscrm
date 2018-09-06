<?php

return [
    // AUTH 权限配置
    'AUTH_CONFIG' => array(
        'NO_AUTH_USER' => array(1,2),
        'AUTH_ON' => true,
        'AUTH_USER' => config('database.prefix').'users',
        'NO_AUTH_URL' => array(
            'admin/users/check_nick','admin/users/check_name',
            'admin/users/user_do','admin/users/update',
            'admin/order/create_do','admin/customers/add_do',
            'admin/customers/edit_do','admin/contacts/add_do',
            'admin/contacts/edit_do','admin/contacts/check_name',
            'admin/purchase/edit_do','admin/supplier/add_do',
            'admin/supplier/edit_do','admin/supplier/contacts_do',
            'admin/supplier/edit_e_do','admin/order/search_company',
            'admin/order/get_goods','admin/purchase/getsupplier',
            'admin/purchase/get_goods','admin/delivery/search_purchase',
            'admin/delivery/relation_order','admin/delivery/rel_order',
            'admin/delivery/order','admin/delivery/get_goods',
	        'admin/baojia/search_company','admin/baojia/get_goods',
            'admin/account/view','admin/goods/change_cate',
	        'admin/goods/change_type','admin/config/edit',
            'admin/account/soset','admin/account/setsupplier',
            'admin/auth/rule_add_runadd','admin/auth/rule_edit_runedit',
            'admin/role/editrole','admin/supplier/add_contacts','admin/supplier/adduser',
            'admin/supplier/edit_contacts','admin/supplier/deluser'
        ),
    ),
    'PAGE_SIZE' => 10,
    'UPLOAD_DIR' => 'uploads'
];
