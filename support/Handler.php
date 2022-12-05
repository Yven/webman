<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support;

use support\exception\BusinessException;
use Throwable;
use Webman\Exception\ExceptionHandler;
use Webman\Http\Request;
use Webman\Http\Response;

/**
 * @Description
 * 默认异常处理类
 *
 * @Class  : Handler
 * @Package: support
 */
class Handler extends ExceptionHandler
{
    /**
     * 默认不记录日志的异常
     * @Var string[] $dontReport
     */
    public $dontReport = [
        BusinessException::class,
    ];

    /**
     * 异常记录日志方法
     *
     * @param Throwable $exception
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * 异常输出方法
     *
     * @param Request   $request
     * @param Throwable $exception
     *
     * @return Response
     */
    public function render(Request $request, Throwable $exception): Response
    {
        if(($exception instanceof BusinessException) && ($response = $exception->render($request)))
        {
            return $response;
        }

        return parent::render($request, $exception);
    }

}