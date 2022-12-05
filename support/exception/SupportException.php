<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support\exception;

/**
 * @Description
 * 第三方业务异常类
 * 除非特殊情况，调用support/rpc/acl等第三方类异常抛出此异常统一处理
 *
 * @Class  : SupportException
 * @Package: support\exception
 */
class SupportException extends \Exception
{
}