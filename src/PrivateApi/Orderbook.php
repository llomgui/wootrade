<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Orderbook extends WootradeApi
{
    // GET /v1/orderbook/:symbol
    // https://docs.woo.org/#orderbook-snapshot
    public function getSnapshot(string $symbol, int $maxLevel = 100): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/orderbook/' . $symbol, ['max_level' => $maxLevel]);
        return $response->getApiData();
    }
}
