<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Kline extends WootradeApi
{
    // GET /v1/kline
    // https://docs.woo.org/#kline
    public function get(string $symbol, string $type, int $limit = 100): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/kline', ['symbol' => $symbol, 'type' => $type, 'limit' => $limit]);
        return $response->getApiData();
    }
}
