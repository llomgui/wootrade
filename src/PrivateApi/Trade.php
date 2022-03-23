<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Trade extends WootradeApi
{
    // GET /v1/client/trade/:tid
    // https://docs.woo.org/#get-trade
    public function get(int $tradeId): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/client/trade/' . $tradeId);
        return $response->getApiData();
    }

    // GET /v1/order/:oid/trades
    // https://docs.woo.org/#get-trades
    public function getByOrderId(int $orderId): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/order/' . $orderId . '/trades');
        return $response->getApiData();
    }

    // GET /v1/client/trades
    // https://docs.woo.org/#get-history-trades
    public function getHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/client/trades', $request);
        return $response->getApiData();
    }
}
