<?php

namespace llomgui\Wootrade\PublicApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Futures extends WootradeApi
{
    // GET /v1/public/futures
    // https://docs.woo.org/#get-futures-info-for-all-markets-public
    public function getAll(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/futures');
        return $response->getApiData();
    }

    // GET /v1/public/futures/:symbol
    // https://docs.woo.org/#get-futures-for-one-market-public
    public function get(string $symbol): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/futures/' . $symbol);
        return $response->getApiData();
    }

    // GET /v1/public/funding_rates
    // https://docs.woo.org/#get-predicted-funding-rate-for-all-markets-public
    public function getAllFundingRates(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/funding_rates');
        return $response->getApiData();
    }

    // GET /v1/public/funding_rates/:symbol
    // https://docs.woo.org/#get-predicted-funding-rate-for-one-market-public
    public function getFundingRates(string $symbol): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/funding_rate/' . $symbol);
        return $response->getApiData();
    }

    // GET /v1/public/funding_rate_history/:symbol
    // https://docs.woo.org/#get-funding-rate-history-for-one-market-public
    public function getFundingRateHistory(string $symbol, int $startTime = null, int $endTime = null, int $page = null): array
    {
        $response = $this->call(
            Request::METHOD_GET,
            '/v1/public/funding_rate_history',
            [
                'symbol' => $symbol,
                'start_t' => $startTime,
                'end_t' => $endTime,
                'page' => $page
            ]
        );
        return $response->getApiData();
    }
}
