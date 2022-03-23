<?php

namespace llomgui\Wootrade;

use llomgui\Wootrade\Http\ApiResponse;

abstract class WootradeApi extends Api
{
    public function call(string $method, string $uri, array $params = [], array $headers = [], int $timeout = 30): ApiResponse
    {
        $response = parent::call($method, $uri, $params, $headers, $timeout);
        return new ApiResponse($response);
    }
}
