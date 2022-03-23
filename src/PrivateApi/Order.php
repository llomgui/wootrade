<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Order extends WootradeApi
{
    // POST /v1/order
    // https://docs.woo.org/#send-order
    public function create(array $order): array
    {
        $response = $this->call(Request::METHOD_POST, '/v1/order', $order);
        return $response->getApiData();
    }

    // DELETE /v1/order
    // https://docs.woo.org/#cancel-order
    public function cancel(string $symbol, int $orderId): array
    {
        $response = $this->call(Request::METHOD_DELETE, '/v1/order', ['symbol' => $symbol, 'order_id' => $orderId]);
        return $response->getApiData();
    }

    // DELETE /v1/order
    // https://docs.woo.org/#cancel-order-by-client_order_id
    public function cancelByClientOrderId(string $symbol, int $clientOrderId): array
    {
        $response = $this->call(Request::METHOD_DELETE, '/v1/client/order', ['symbol' => $symbol, 'client_order_id' => $clientOrderId]);
        return $response->getApiData();
    }

    // DELETE /v1/orders
    // https://docs.woo.org/#cancel-orders
    public function cancelAll(string $symbol): array
    {
        $response = $this->call(Request::METHOD_DELETE, '/v1/orders', compact('symbol'));
        return $response->getApiData();
    }

    // GET /v1/order/:oid
    // https://docs.woo.org/#get-order
    public function get(int $orderId): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/order/' . $orderId);
        return $response->getApiData();
    }

    // GET /v1/order/:oid
    // https://docs.woo.org/#get-order-by-client_order_id
    public function getByClientOrderId(int $clientOrderId): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/client/order/'. $clientOrderId);
        return $response->getApiData();
    }

    // GET /v1/orders
    // https://docs.woo.org/#get-orders
    public function getAll(array $data = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/orders', $data);
        return $response->getApiData();
    }
}
