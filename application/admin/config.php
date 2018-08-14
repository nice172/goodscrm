<?php

return [
    // AUTH 权限配置
    'AUTH_CONFIG' => array(
        'NO_AUTH_USER' => array(1,2),
        'AUTH_ON' => true,
        'AUTH_USER' => config('database.prefix').'users',
        'NO_AUTH_URL' => array(),
    ),
    'PAGE_SIZE' => 10,
    'UPLOAD_DIR' => 'uploads'
];