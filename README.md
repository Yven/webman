### 单元测试-PHPUnit

在`./test`中编写单元测试

运行测试：
```shell
./vendor/bin/phpunit --bootstrap support/bootstrap.php tests/TestConfig.php
```

### 自定义命令

```shell
php webman make:command make:all
```

生成文件`app/command/MakeAll.php`


### 依赖注入

```php
use support\Container;

// 手动创建依赖注入
// Container创建的实例可以依赖注入
$user_service = Container::get(UserService::class);
// Container创建的实例可以依赖注入
$log_service = Container::make(LogService::class, [$path, $name]);

// 使用注解依赖注入
/**
 * @Inject
 * @var Mailer
 */
```

具体查看[php-di](https://php-di.org/doc/getting-started.html)


### Event事件

```php

// 在config/event.php中
<?php
return [
    'user.*' => [
        [app\event\User::class, 'deal']
    ],
    'user.register' => [
        [app\event\User::class, 'register'],
        // ...其它事件处理函数...
    ],
    'user.logout' => [
        [app\event\User::class, 'logout'],
        // ...其它事件处理函数...
    ],
    'user.login' => [
        function($user){
            var_dump($user);
        }
    ]
];

// 事件处理类
<?php
namespace app\event;
class User
{
    // 可选$event_name
    function deal($user, $event_name)
    {
        echo $event_name; // 具体的事件名，如 user.register user.logout 等
        var_export($user);
    }
}

// 发布事件，在需要使用的地方
Event::emit('user.register', $user);

// 查看项目配置的所有事件及监听器
php webman event:list 
```

### 消息队列

```php
// 同步
use Webman\RedisQueue\Redis;

// 投递消息
Redis::send($queue, $data);
// 投递延迟消息，消息会在60秒后处理
Redis::send($queue, $data, 60);

// 异步
use Webman\RedisQueue\Client;

// 投递消息
Client::send($queue, $data);
// 投递延迟消息，消息会在60秒后处理
Client::send($queue, $data, 60);
```



