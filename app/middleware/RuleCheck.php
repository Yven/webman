<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use teamones\casbin\Enforcer;

/**
 * @Description
 * 权限规则判断中间件
 *
 * @Class  : RuleCheck
 * @Package: app\middleware
 */
class RuleCheck implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
//        if (!Enforcer::enforce('user1', '/user', 'read')) {
//            return json(['code' => 0, 'msg' => 'no auth']);
//        }

        return $handler($request);
    }
}
