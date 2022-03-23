<?php

namespace llomgui\Wootrade\Exceptions;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\Http\Response;

class HttpException extends \Exception
{
    protected $request;
    protected $response;

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }
}
