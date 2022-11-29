<?php

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            // 数据库类型
            'type' => getenv('DB_TYPE'),
            // 服务器地址
            'hostname' => getenv('DB_HOSTNAME'),
            // 数据库名
            'database' => getenv('DB_DATABASE'),
            // 数据库用户名
            'username' => getenv('DB_USERNAME'),
            // 数据库密码
            'password' => getenv('DB_PASSWORD'),
            // 数据库连接端口
            'hostport' => getenv('DB_HOSTPORT'),
            // 数据库连接参数
            'params' => [],
            // 数据库编码默认采用utf8
            'charset' => getenv('DB_CHARSET'),
            // 数据库表前缀
            'prefix' => getenv('DB_PREFIX'),
            // 断线重连
            'break_reconnect' => true,
            // 关闭SQL监听日志
            'trigger_sql' => false,
            // 自定义分页类
            'bootstrap' =>  ''
        ],
    ],
];