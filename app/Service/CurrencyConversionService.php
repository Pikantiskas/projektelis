<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CurrencyConversionService
{
    private const CURRENCY_API_URL = 'https://free.currconv.com/api/v7/convert';

    public function convertPriceToUsd($price): float
    {
        $currencyRate = Cache::get('eurUsdCurrencyRate');

        if ($currencyRate === null) {
            $currencyRate = $this->getUsdEurCurrencyRate();
            Cache::add('eurUsdCurrencyRate', $currencyRate, 60);
        }


        return round($price * $currencyRate, 2);
    }

    private function getUsdEurCurrencyRate()
    {
        $apiKey = env('CURRENCY_CONVERTER_API_KEY');

        $query = [
            'q' => 'EUR_USD',
            'compact' => 'ultra',
            'apiKey' => $apiKey,
        ];

        $response = Http::get(self::CURRENCY_API_URL, $query);

        $responseBody = json_decode($response->body(), true);

        return $responseBody['EUR_USD'];
    }
}
