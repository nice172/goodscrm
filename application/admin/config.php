<?php

return [
    // AUTH 权限配置
    'AUTH_CONFIG' => array(
        'NO_AUTH_USER' => array(1,2),
        'AUTH_ON' => true,
        'AUTH_USER' => config('database.prefix').'users',
        'NO_AUTH_URL' => array(
            'admin/users/check_nick','admin/users/check_name',
            'admin/order/create_do','admin/customers/add_do',
            'admin/customers/edit_do','admin/contacts/add_do',
            'admin/contacts/edit_do','admin/contacts/check_name',
            'admin/purchase/edit_do','admin/supplier/add_do',
            'admin/supplier/edit_do','admin/supplier/contacts_do',
            'admin/supplier/edit_e_do'
        ),
    ),
    'PAGE_SIZE' => 10,
    'UPLOAD_DIR' => 'uploads'
];