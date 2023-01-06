<?php
declare (strict_types=1);

namespace app\controller;

use support\exception\SupportException;
use support\Request;
use support\Response;
use support\StatusCode;

class IndexController
{
    public function index(Request $request): Response
    {
        return response('hello webman');
    }

    public function view(Request $request): Response
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request): Response
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

    public function exception(Request $request): Response
    {
        throw new SupportException('测试异常状态', StatusCode::SERR_SERVICE_EXCEPTION);
    }
}
