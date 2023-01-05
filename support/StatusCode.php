<?php
/**
 * @Author   : Yven<yvenchang@163.com>
 * @Copyright: Yven<yvenchang@163.com>
 * @Link     : https://www.yvenchang.com
 * @Created  : 2022/12/5 15:33
 */

declare (strict_types=1);

namespace support;

class StatusCode
{
    const SUCCESS = 200000;

    const CERR_EMPTY_ROUTE = 400000;
    const CERR_WRONG_SIGN = 400001;

    const CERR_EMPTY_AUTH = 400010;
    const CERR_TOKEN_EXPIRE = 400011;
    const CERR_REFRESH_TOKEN_EXPIRE = 400012;
    const CERR_WRONG_IDENTITY = 400013;
    const CERR_WRONG_TOKEN = 400014;
    const CERR_PERMISSION_DENIED = 400015;

    const CERR_WRONG_FIELD = 400100;

    const SERR_SERVICE_EXCEPTION = 500000;
    const SERR_DEFAULT = 500001;

    public static array $message = [
        self::SUCCESS => '成功',
        self::CERR_EMPTY_ROUTE => '访问不存在的资源',
        self::CERR_WRONG_SIGN => '签名错误',
        self::CERR_EMPTY_AUTH => '访问此资源需要登录',
        self::CERR_TOKEN_EXPIRE => '登录身份过期',
        self::CERR_REFRESH_TOKEN_EXPIRE => '登录身份刷新机会过期',
        self::CERR_WRONG_IDENTITY => '登录身份不符',
        self::CERR_WRONG_TOKEN => '认证授权错误',
        self::CERR_PERMISSION_DENIED => '您没有权限访问',
        self::CERR_WRONG_FIELD => '错误的请求数据',
        self::SERR_SERVICE_EXCEPTION => '服务错误',
        self::SERR_DEFAULT => '程序错误',
    ];
}