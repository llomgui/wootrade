<?php

namespace llomgui\Wootrade\Exceptions;

use llomgui\Wootrade\Http\ApiResponse;

class BusinessException extends \Exception
{
    protected $response;

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }
}
