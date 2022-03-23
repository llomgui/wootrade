<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Futures extends WootradeApi
{
    // GET /v1/positions
    // https://docs.woo.org/#get-all-position-info
    public function getAllPositions(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/positions');
        return $response->getApiData();
    }

    // GET /v1/positions
    // https://docs.woo.org/#get-one-position-info
    public function getPosition(string $symbol): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/position/' . $symbol);
        return $response->getApiData();
    }

    // GET /v1/funding_fee/history
    // https://docs.woo.org/#get-funding-fee-history
    public function getFundingFeeHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/funding_fee/history', $request);
        return $response->getApiData();
    }
}
