<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support;

use Throwable;
use Webman\Exception\ExceptionHandler;

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
        \support\exception\BusinessException::class,
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
        if ($this->shouldntReport($exception)) {
            return;
        }

        $logs = '';
        if ($request = \request()) {
            $logs = $request->getRealIp() . ' ' . $request->method() . ' ' . \trim($request->fullUrl(), '/');
        }

        $this->_logger->error($logs . PHP_EOL . $exception);
    }

    /**
     * 异常输出方法
     *
     * @param Request   $request
     * @param Throwable $exception
     *
     * @return Response
     */
    public function render(\Webman\Http\Request $request, Throwable $exception): \Webman\Http\Response
    {
        // debug模式输出，线上模式输出
        // 系统Exception处理，系统Error处理，自定义Exception处理

        if(!$this->_debug) {
            if (($exception instanceof \support\exception\BaseException)) {
                $response = $exception->render($request);
            } elseif (($exception instanceof \Error)) {
                $response = \support\Response::failed(StatusCode::SERR_DEFAULT, ['msg' => $exception->getMessage()]);
            } else {
                $response = \support\Response::failed(StatusCode::SERR_SERVICE_EXCEPTION, ['msg' => $exception->getMessage()]);
            }

            return $response;
        }

        return new Response(500, [], \nl2br((string)$exception));
    }

}