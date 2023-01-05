<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support;

/**
 * @Description
 * 统一响应类
 *
 * @Class  : Response
 * @Package: support
 */
class Response extends \Webman\Http\Response
{
    /**
     * json输出选项
     * @Var int $jsonOpt
     */
    private static int $jsonOpt = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

    /**
     * 使用json输出
     *
     * @param int    $status
     * @param array  $headers
     * @param string $body
     */
    public function __construct(int $status, array $headers = [], string $body = '')
    {
        parent::__construct($status, $headers, $body);
    }

    /**
     * 成功的响应
     * @static
     *
     * @param array $data
     * @param array $headers
     *
     * @return Response
     */
    public static function success(array $data = [], array $headers = []): Response
    {
        return new Response(
            200,
            array_merge($headers, ['Content-Type' => 'application/json']),
            \json_encode(
                [
                    'status' => StatusCode::SUCCESS,
                    'msg' => StatusCode::$message[StatusCode::SUCCESS],
                    'data' => $data,
                ],
                self::$jsonOpt)
        );
    }

    /**
     * 失败的响应
     * @static
     *
     * @param int   $code
     * @param array $data
     * @param array $headers
     *
     * @return Response
     */
    public static function failed(int $code, array $data = [], array $headers = []): Response
    {
        return new Response(
            200,
            $headers,
            \json_encode(
                [
                    'status' => $code,
                    'msg' => isset(StatusCode::$message[$code]) ? StatusCode::$message[$code] : StatusCode::$message[StatusCode::SERR_DEFAULT],
                    'data' => $data,
                ],
                self::$jsonOpt)
        );
    }
}