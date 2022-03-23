# PHP SDK for Wootrade API

> The detailed document [https://docs.woo.org/](https://docs.woo.org/)

## Requirements

| Dependency | Requirement |
| -------- | -------- |
| [PHP](https://secure.php.net/manual/en/install.php) | `>=8.0.0` |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) | `^6.0\|^7.0` |

## Install
> Install package via [Composer](https://getcomposer.org/).

```shell
composer require "llomgui/wootrade"
```

### Debug mode & logging

```php
use llomgui\Wootrade\WootradeApi;

// Debug mode will record the logs of API to files in the directory "WootradeApi::getLogPath()" according to the minimum log level "WootradeApi::getLogLevel()".
WootradeApi::setDebugMode(true);

// Logging in your code
// WootradeApi::setLogPath('/tmp');
// WootradeApi::setLogLevel(Monolog\Logger::DEBUG);
WootradeApi::getLogger()->debug("I'm a debug message");
```

### Examples
#### Example of API on `public` endpoints

```php
use llomgui\Wootrade\PublicApi\Exchange;

$exchange = new Exchange();
$result = $exchange->get('SPOT_BTC_USDT');
var_dump($result);
```

#### Example of API on `private` endpoints

```php
use llomgui\Wootrade\Auth;
use llomgui\Wootrade\PrivateApi\Account;
use llomgui\Wootrade\Exceptions\HttpException;
use llomgui\Wootrade\Exceptions\BusinessException;

$auth = new Auth('API_KEY', 'API_SECRET');
$account = new Account($auth);

try {
    $result = $account->getInformation();
    var_dump($result);
} catch (HttpException $e) {
    var_dump($e->getMessage());
} catch (BusinessException $e) {
    var_dump($e->getMessage());
}
```

### API list
#### Public
<details>
<summary>llomgui\Wootrade\PublicApi\Exchange</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PublicApi\Exchange::getAll() | NO | https://docs.woo.org/#available-symbols-public |
| llomgui\Wootrade\PublicApi\Exchange::get() | NO | https://docs.woo.org/#exchange-information |
| llomgui\Wootrade\PublicApi\Exchange::getMarketTrades() | NO | https://docs.woo.org/#market-trades-public |
| llomgui\Wootrade\PublicApi\Exchange::getTokens() | NO | https://docs.woo.org/#available-token-public |
| llomgui\Wootrade\PublicApi\Exchange::getTokenNetworks() | NO | https://docs.woo.org/#token-network-public |

</details>

<details>
<summary>llomgui\Wootrade\PublicApi\Futures</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PublicApi\Futures::getAll() | NO | https://docs.woo.org/#get-futures-info-for-all-markets-public |
| llomgui\Wootrade\PublicApi\Futures::get() | NO | https://docs.woo.org/#get-futures-for-one-market-public |
| llomgui\Wootrade\PublicApi\Futures::getAllFundingRates() | NO | https://docs.woo.org/#get-predicted-funding-rate-for-all-markets-public |
| llomgui\Wootrade\PublicApi\Futures::getFundingRates() | NO | https://docs.woo.org/#get-predicted-funding-rate-for-one-market-public |
| llomgui\Wootrade\PublicApi\Futures::getFundingRateHistory() | NO | https://docs.woo.org/#get-funding-rate-history-for-one-market-public |

</details>

#### Private
<details>
<summary>llomgui\Wootrade\PrivateApi\Account</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Account::getCurrentHolding() | YES | https://docs.woo.org/#get-current-holding |
| llomgui\Wootrade\PrivateApi\Account::getInformation() | YES | https://docs.woo.org/#get-account-information |
| llomgui\Wootrade\PrivateApi\Account::getTokenDepositAddress() | YES | https://docs.woo.org/#get-token-deposit-address |
| llomgui\Wootrade\PrivateApi\Account::getAssetHistory() | YES | https://docs.woo.org/#get-asset-history |
| llomgui\Wootrade\PrivateApi\Account::getAssetTransferHistory() | YES | https://docs.woo.org/#get-asset-transfer-history |
| llomgui\Wootrade\PrivateApi\Account::getMarginInterestRates() | YES | https://docs.woo.org/#margin-interest-rates |
| llomgui\Wootrade\PrivateApi\Account::getMarginInterestRatesByToken() | YES | https://docs.woo.org/#margin-interest-rate-of-token |
| llomgui\Wootrade\PrivateApi\Account::getInterestHistory() | YES | https://docs.woo.org/#get-interest-history |
| llomgui\Wootrade\PrivateApi\Account::repayInterest() | YES | https://docs.woo.org/#repay-interest |
| llomgui\Wootrade\PrivateApi\Account::getSubaccounts() | YES | https://docs.woo.org/#get-subaccounts |
| llomgui\Wootrade\PrivateApi\Account::getSubaccountsAssets() | YES | https://docs.woo.org/#get-assets-of-subaccounts |
| llomgui\Wootrade\PrivateApi\Account::getSubaccountsAssetsDetail() | YES | https://docs.woo.org/#get-asset-detail-of-a-subaccount |
| llomgui\Wootrade\PrivateApi\Account::getSubaccountsIpRestriction() | YES | https://docs.woo.org/#get-ip-restriction |
| llomgui\Wootrade\PrivateApi\Account::getTransferHistory() | YES | https://docs.woo.org/#get-transfer-history |
| llomgui\Wootrade\PrivateApi\Account::transferAssets() | YES | https://docs.woo.org/#transfer-assets |
| llomgui\Wootrade\PrivateApi\Account::updateMode() | YES | https://docs.woo.org/#update-account-mode |
| llomgui\Wootrade\PrivateApi\Account::updateLeverage() | YES | https://docs.woo.org/#update-leverage-setting |

</details>

<details>
<summary>llomgui\Wootrade\PrivateApi\Futures</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Futures::getAllPositions() | YES | https://docs.woo.org/#get-all-position-info |
| llomgui\Wootrade\PrivateApi\Futures::getPosition() | YES | https://docs.woo.org/#get-one-position-info |
| llomgui\Wootrade\PrivateApi\Futures::getFundingFeeHistory() | YES | https://docs.woo.org/#get-funding-fee-history |

</details>

<details>
<summary>llomgui\Wootrade\PrivateApi\Kline</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Kline::get() | YES | https://docs.woo.org/#kline |

</details>

<details>
<summary>llomgui\Wootrade\PrivateApi\Order</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Order::create() | YES | https://docs.woo.org/#send-order |
| llomgui\Wootrade\PrivateApi\Order::cancel() | YES | https://docs.woo.org/#cancel-order |
| llomgui\Wootrade\PrivateApi\Order::cancelByClientOrderId() | YES | https://docs.woo.org/#cancel-order-by-client_order_id |
| llomgui\Wootrade\PrivateApi\Order::cancelAll() | YES | https://docs.woo.org/#cancel-orders |
| llomgui\Wootrade\PrivateApi\Order::get() | YES | https://docs.woo.org/#get-order |
| llomgui\Wootrade\PrivateApi\Order::getByClientOrderId() | YES | https://docs.woo.org/#get-order-by-client_order_id |
| llomgui\Wootrade\PrivateApi\Order::getAll() | YES | https://docs.woo.org/#get-orders |

</details>

<details>
<summary>llomgui\Wootrade\PrivateApi\Orderbook</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Orderbook::getSnapshot() | YES | https://docs.woo.org/#orderbook-snapshot |

</details>

<details>
<summary>llomgui\Wootrade\PrivateApi\Trade</summary>

| API | Authentication | Description |
| -------- | -------- | -------- |
| llomgui\Wootrade\PrivateApi\Trade::get() | YES | https://docs.woo.org/#get-trade |
| llomgui\Wootrade\PrivateApi\Trade::getByOrderId() | YES | https://docs.woo.org/#get-trades |
| llomgui\Wootrade\PrivateApi\Trade::getHistory() | YES | https://docs.woo.org/#get-history-trades |

</details>

## License

[MIT](LICENSE)
