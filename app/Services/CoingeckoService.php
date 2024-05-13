<?php

// app/Services/CoingeckoService.php
namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class CoingeckoService
{
    /**
     * @throws ConnectionException
     */
    public function getTopCryptos($limit = 100)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'x-cg-pro-api-key' => config('coingecko.api_key')
        ])->withQueryParameters([
            'vs_currency' => 'usd',
            'order' => 'market_cap_desc',
            'per_page' => $limit,
            'page' => 1,
            'sparkline' => 'true',
            'precision' => 2,
            'price_change_percentage' => '1h,24h,7d'
        ])->get('https://api.coingecko.com/api/v3/coins/markets');

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function getCryptoById($id)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'x-cg-pro-api-key' => config('coingecko.api_key')
        ])->withQueryParameters([
            'sparkline' => 'true',
        ])
            ->get("https://api.coingecko.com/api/v3/coins/{$id}");
        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function searchCoin($query)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'x-cg-pro-api-key' => config('coingecko.api_key')
        ])->withQueryParameters([
            'query' => $query,
        ])->get('https://api.coingecko.com/api/v3/search');
        return $response['coins'];
    }
}
