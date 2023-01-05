<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:40
 */

declare (strict_types = 1);

namespace support\exception;

use support\Request;
use support\Response;

/**
 * @Description
 * 基础异常类
 *
 * @Class  : BaseException
 * @Package: support\exception
 */
abstract class BaseException extends \Exception
{
    public function report(\Throwable $exception)
    {
    }

    public function render(Request $request): Response
    {
        return \support\Response::failed($this->getCode());
    }
}