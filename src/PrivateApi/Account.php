<?php

namespace llomgui\Wootrade\PrivateApi;

use llomgui\Wootrade\Http\Request;
use llomgui\Wootrade\WootradeApi;

class Account extends WootradeApi
{
    // GET /{v1/v2}/client/holding
    // https://docs.woo.org/#get-current-holding
    public function getCurrentHolding(string $version = 'v1', string $all = 'false'): array
    {
        $response = $this->call(Request::METHOD_GET, '/' . $version . '/client/holding', compact('all'));
        return $response->getApiData();
    }

    // GET /v1/client/info
    // https://docs.woo.org/#get-account-information
    public function getInformation(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/client/info');
        return $response->getApiData();
    }

    // GET /v1/asset/deposit
    // https://docs.woo.org/#get-token-deposit-address
    public function getTokenDepositAddress(string $token): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/asset/deposit', compact('token'));
        return $response->getApiData();
    }

    // GET /v1/asset/history
    // https://docs.woo.org/#get-asset-history
    public function getAssetHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/asset/history', $request);
        return $response->getApiData();
    }

    // GET /v1/asset/transfer_history
    // https://docs.woo.org/#get-asset-transfer-history
    public function getAssetTransferHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/asset/transfer_history', $request);
        return $response->getApiData();
    }

    // GET /v1/token_interest
    // https://docs.woo.org/#margin-interest-rates
    public function getMarginInterestRates(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/token_interest');
        return $response->getApiData();
    }

    // GET /v1/token_interest/:token
    // https://docs.woo.org/#margin-interest-rate-of-token
    public function getMarginInterestRatesByToken(string $token): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/token_interest/' . $token);
        return $response->getApiData();
    }

    // GET /v1/interest/history
    // https://docs.woo.org/#get-interest-history
    public function getInterestHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/interest/history', $request);
        return $response->getApiData();
    }

    // POST /v1/interest/repay
    // https://docs.woo.org/#repay-interest
    public function repayInterest(string $token, int|float $amount): array
    {
        $response = $this->call(Request::METHOD_POST, '/v1/interest/repay', ['token' => $token, 'amount' => $amount]);
        return $response->getApiData();
    }

    // GET /v1/sub_account/all
    // https://docs.woo.org/#get-subaccounts
    public function getSubaccounts(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/sub_account/all');
        return $response->getApiData();
    }

    // GET /v1/sub_account/assets
    // https://docs.woo.org/#get-assets-of-subaccounts
    public function getSubaccountsAssets(): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/sub_account/assets');
        return $response->getApiData();
    }

    // GET /v1/sub_account/asset_detail
    // https://docs.woo.org/#get-asset-detail-of-a-subaccount
    public function getSubaccountsAssetsDetail(string $applicationId): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/sub_account/asset_detail', ['application_id' => $applicationId]);
        return $response->getApiData();
    }

    // GET /v1/sub_account/ip_restriction
    // https://docs.woo.org/#get-ip-restriction
    public function getSubaccountsIpRestriction(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/sub_account/ip_restriction', $request);
        return $response->getApiData();
    }

    // GET /v1/asset/main_sub_transfer_history
    // https://docs.woo.org/#get-transfer-history
    public function getTransferHistory(array $request = []): array
    {
        $response = $this->call(Request::METHOD_GET, '/v1/asset/main_sub_transfer_history', $request);
        return $response->getApiData();
    }

    // POST /v1/asset/main_sub_transfer
    // https://docs.woo.org/#transfer-assets
    public function transferAssets(array $request): array
    {
        $response = $this->call(Request::METHOD_POST, '/v1/asset/main_sub_transfer', $request);
        return $response->getApiData();
    }

    // POST /v1/client/account_mode
    // https://docs.woo.org/#update-account-mode
    public function updateMode(string $accountMode): array
    {
        $response = $this->call(Request::METHOD_POST, '/v1/client/account_mode', ['account_mode' => $accountMode]);
        return $response->getApiData();
    }

    // POST /v1/client/leverage
    // https://docs.woo.org/#update-leverage-setting
    public function updateLeverage(int $leverage): array
    {
        $response = $this->call(Request::METHOD_POST, '/v1/client/leverage', compact('leverage'));
        return $response->getApiData();
    }
}
