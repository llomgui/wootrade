<?php

namespace llomgui\Wootrade\Http;

use GuzzleHttp\Client;
use llomgui\Wootrade\Exceptions\HttpException;
use llomgui\Wootrade\Exceptions\InvalidApiUriException;

class GuzzleHttp extends BaseHttp
{
    protected static $clients = [];

    protected static function getClient(array $config): CLient
    {
        $key = md5(json_encode($config));
        if (isset(static::$clients[$key])) {
            return static::$clients[$key];
        }

        static::$clients[$key] = new Client($config);
        return static::$clients[$key];
    }

    public function request(Request $request, int $timeout = 30): Response
    {
        if (!$request->getBaseUri() && strpos($request->getUri(), '://') === false) {
            $exception = new InvalidApiUriException('Invalid base_uri or uri, must set base_uri or set uri to a full url');
            $exception->setBaseUri($request->getBaseUri());
            $exception->setUri($request->getUri());
            throw $exception;
        }

        $config = [
            'base_uri'        => $request->getBaseUri(),
            'timeout'         => $timeout,
            'connect_timeout' => 30,
            'http_errors'     => false,
            'verify'          => isset($this->config['verify']) ? $this->config['verify'] : empty($this->config['skipVerifyTls']),
        ] + $this->config;
        $client = static::getClient($config);
        $options = [
            'headers' => $request->getHeaders(),
        ];
        $method = $request->getMethod();
        $params = $request->getParams();
        $hasParam = !empty($params);
        switch ($method) {
            case Request::METHOD_GET:
                $hasParam and $options['query'] = $params;
                break;
            case Request::METHOD_PUT:
            case Request::METHOD_POST:
            case Request::METHOD_DELETE:
                if ($hasParam) {
                    $options['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
                    $options['form_params'] = $request->getBodyParams();
                }
                break;
            default:
                $exception = new HttpException('Unsupported method ' . $method, 0);
                $exception->setRequest($request);
                throw $exception;
        }
        try {
            $guzzleResponse = $client->request($request->getMethod(), $request->getUri(), $options);
            $response = new Response($guzzleResponse->getBody()->__toString(), $guzzleResponse->getStatusCode(), $guzzleResponse->getHeaders());
            $response->setRequest($request);
            return $response;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $exception = new HttpException($e->getMessage(), $e->getCode(), $e);
            $exception->setRequest($request);
            throw $exception;
        } catch (\Exception $e) {
            $exception = new HttpException($e->getMessage(), $e->getCode(), $e);
            $exception->setRequest($request);
            throw $exception;
        }
    }
}
