<?php

namespace llomgui\Wootrade;

class Auth
{
    public function __construct(
        private string $key,
        private string $secret
    ) {
    }

    public function signature(string $method, array $params, int $timestamp): string
    {
        $query = '';
        if (!empty($params)) {
            // Sort params (alphabet order)
            ksort($params);

            foreach ($params as $key => $val) {
                if (is_array($val)) {
                    $query .= $key . '=' . urlencode(json_encode($val)) . '&';
                } else {
                    $query .= $key . '=' . $val . '&';
                }
            }
            $query = substr($query, 0, -1);
        }

        $signature = hash_hmac('sha256', $query . '|' . $timestamp, $this->secret);

        return $signature;
    }

    public function getHeaders(string $method, array $params): array
    {
        $timestamp = floor(microtime(true) * 1000);
        $headers = [
            'x-api-key'        => $this->key,
            'x-api-timestamp'  => $timestamp,
            'x-api-signature'  => $this->signature($method, $params, $timestamp),
        ];

        return $headers;
    }
}
