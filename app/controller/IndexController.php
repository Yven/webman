<?php
declare (strict_types=1);

namespace app\controller;

use support\Request;
use support\Response;

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
}
