<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support\exception;

use support\StatusCode;

/**
 * @Description
 * 第三方业务异常类
 * 除非特殊情况，调用support/rpc/acl等第三方类异常抛出此异常统一处理
 *
 * @Class  : SupportException
 * @Package: support\exception
 */
class SupportException extends BaseException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $this->message = $this->formatMessage($message, $code);

        parent::__construct($this->message, 0, $previous);

        $this->code = $code ?: StatusCode::SERR_SERVICE_EXCEPTION;
    }

    protected function formatMessage($message, $code): string
    {
        return __CLASS__.": [".$code."] ".$message;
    }
}