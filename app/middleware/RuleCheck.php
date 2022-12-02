<?php
declare (strict_types=1);

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use teamones\casbin\Enforcer;

/**
 * Class StaticFile
 * @package app\middleware
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
