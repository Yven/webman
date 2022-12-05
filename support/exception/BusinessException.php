<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support\exception;

use Exception;
use Webman\Http\Response;
use Webman\Http\Request;

/**
 * @Description
 * 业务异常类
 * 核心业务异常抛出此异常类
 *
 * @Class  : BusinessException
 * @Package: support\exception
 */
class BusinessException extends Exception
{
    public function render(Request $request): ?Response
    {
        if ($request->expectsJson()) {
            $code = $this->getCode();
            $json = ['code' => $code ? $code : 500, 'msg' => $this->getMessage()];
            return new Response(200, ['Content-Type' => 'application/json'],
                \json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        return new Response(200, [], $this->getMessage());
    }
}
