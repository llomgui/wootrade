<?php

namespace llomgui\Wootrade\PublicApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Exchange extends WootradeApi
{
    // GET /v1/public/info/
    // https://docs.woo.org/#available-symbols-public
    public function getAll(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/info');
        return $response->getApiData();
    }

    // GET /v1/public/info/:symbol
    // https://docs.woo.org/#exchange-information
    public function get(string $symbol): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/info/' . $symbol);
        return $response->getApiData();
    }

    // GET /v1/public/market_trades
    // https://docs.woo.org/#market-trades-public
    public function getMarketTrades(string $symbol, int $limit = 10): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/market_trades', compact('symbol', 'limit'));
        return $response->getApiData();
    }

    // GET /v1/public/token
    // https://docs.woo.org/#available-token-public
    public function getTokens(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/token');
        return $response->getApiData();
    }

    // GET /v1/public/token_network
    // https://docs.woo.org/#token-network-public
    public function getTokenNetworks(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/public/token_network');
        return $response->getApiData();
    }
}
