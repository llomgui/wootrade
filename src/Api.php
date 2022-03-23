<?php

namespace llomgui\Wootrade;

use llomgui\Wootrade\Http\GuzzleHttp;
use llomgui\Wootrade\Http\Http;
use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\Http\Response;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class Api
{
    protected static $baseUri = 'https://api.woo.org';
    protected static $skipVerifyTls = false;
    protected static $debugMode = false;
    protected static $logPath = '/tmp';
    protected static $logger;
    protected static $logLevel = Logger::DEBUG;
    protected static $customHeaders;
    protected $auth;
    protected $http;

    public function __construct(Auth $auth = null, Http $http = null)
    {
        if ($http === null) {
            $http = new GuzzleHttp(['skipVerifyTls' => &self::$skipVerifyTls]);
        }
        $this->auth = $auth;
        $this->http = $http;
    }

    public static function getBaseUri(): string
    {
        return static::$baseUri;
    }

    public static function setBaseUri(string $baseUri): void
    {
        static::$baseUri = $baseUri;
    }

    public static function isSkipVerifyTls(): bool
    {
        return static::$skipVerifyTls;
    }

    public static function setSkipVerifyTls(bool $skipVerifyTls): void
    {
        static::$skipVerifyTls = $skipVerifyTls;
    }

    public static function isDebugMode(): bool
    {
        return self::$debugMode;
    }

    public static function setDebugMode(bool $debugMode): void
    {
        self::$debugMode = $debugMode;
    }

    public static function setLogger(LoggerInterface $logger): void
    {
        self::$logger = $logger;
    }

    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            self::$logger = new Logger('wootrade');
            $handler = new RotatingFileHandler(static::getLogPath() . '/wootrade.log', 0, static::$logLevel);
            $formatter = new LineFormatter(null, null, false, true);
            $handler->setFormatter($formatter);
            self::$logger->pushHandler($handler);
        }
        return self::$logger;
    }

    public static function getLogPath(): string
    {
        return self::$logPath;
    }

    public static function setLogPath(string $logPath): void
    {
        self::$logPath = $logPath;
    }

    public static function getLogLevel(): string
    {
        return self::$logLevel;
    }

    public static function setLogLevel(string $logLevel): void
    {
        self::$logLevel = $logLevel;
    }

    public static function setCustomHeaders(array $headers): void
    {
        self::$customHeaders = $headers;
    }

    public static function getCustomHeaders(): array
    {
        return self::$customHeaders;
    }

    public function call(string $method, string $uri, array $params = [], array $headers = [], int $timeout = 30)
    {
        $request = new Request();
        $request->setMethod($method);
        $request->setBaseUri(static::getBaseUri());
        $request->setUri($uri);
        $request->setParams($params);

        if ($this->auth) {
            $authHeaders = $this->auth->getHeaders(
                $request->getMethod(),
                $request->getParams(),
            );
            $headers = array_merge($headers, $authHeaders);
        }

        if (self::$customHeaders) {
            $headers = array_merge($headers, self::$customHeaders);
        }

        $request->setHeaders($headers);

        $requestId = uniqid();

        if (self::isDebugMode()) {
            static::getLogger()->debug(sprintf('Sent a HTTP request#%s: %s', $requestId, $request));
        }
        $requestStart = microtime(true);
        $response = $this->http->request($request, $timeout);
        if (self::isDebugMode()) {
            $cost = (microtime(true) - $requestStart) * 1000;
            static::getLogger()->debug(sprintf('Received a HTTP response#%s: cost %.2fms, %s', $requestId, $cost, $response));
        }

        return $response;
    }
}
