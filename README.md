1. 执行`php start.php start`启动
2. 访问`http://localhost:2346/index/json`

创建模型：`php webman make:model 表名`

```
.
├── app                           应用目录
│   ├── controller                控制器目录
│   ├── model                     模型目录
│   ├── view                      视图目录
│   └── middleware                中间件目录
│   |   └── StaticFile.php        自带静态文件中间件
|   |—— functions.php             自定义函数
|
├── config                        配置目录
│   ├── app.php                   应用配置
│   ├── autoload.php              这里配置的文件会被自动加载
│   ├── bootstrap.php             进程启动时onWorkerStart时运行的回调配置
│   ├── container.php             容器配置
│   ├── dependence.php            容器依赖配置
│   ├── database.php              数据库配置
│   ├── exception.php             异常配置
│   ├── log.php                   日志配置
│   ├── middleware.php            中间件配置
│   ├── process.php               自定义进程配置
│   ├── redis.php                 redis配置
│   ├── route.php                 路由配置
│   ├── server.php                端口、进程数等服务器配置
│   ├── view.php                  视图配置
│   ├── static.php                静态文件开关及静态文件中间件配置
│   ├── translation.php           多语言配置
│   └── session.php               session配置
├── public                        静态资源目录
├── process                       自定义进程目录
├── runtime                       应用的运行时目录，需要可写权限
├── start.php                     服务启动文件
├── vendor                        composer安装的第三方类库目录
└── support                       类库适配(包括第三方类库)
├── Request.php               请求类
├── Response.php              响应类
├── Plugin.php                插件安装卸载脚本
├── helpers.php               助手函数
└── bootstrap.php             进程启动后初始化脚本
```

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

### 数据库迁移

```shell
# 初始化
vendor/bin/phinx init
# 创建
vendor/bin/phinx create TestTable
# 执行
vendor/bin/phinx migrate -e development
# 回滚
vendor/bin/phinx rollback -e development -t 20120103083322
# 创建seeder
vendor/bin/phinx seed:create MySeeder
# 执行某一seeder
vendor/bin/phinx seed:run -e development -s MySeeder
```
[文档](https://tsy12321.gitbooks.io/phinx-doc/content/)

