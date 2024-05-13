<?php

// app/Http/Livewire/CryptoList.php
namespace App\Livewire;

use Illuminate\Http\Client\ConnectionException;
use Livewire\Component;
use App\Services\CoingeckoService;

class CryptoList extends Component
{
    public $cryptos;
    public $search = '';
    public $searchResults = [];

    /**
     * @throws ConnectionException
     */
    public function mount(CoingeckoService $service): void
    {
        $this->cryptos = $service->getTopCryptos();
    }

    public function render(CoingeckoService $service)
    {
        if ($this->search) {
            $this->searchResults = $service->searchCoin($this->search);
            return view('livewire.crypto-list', [
                'cryptos' => $this->cryptos,
                'searchResults' => $this->searchResults
            ]);
        }
        return view('livewire.crypto-list', [
            'cryptos' => $this->cryptos
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function refreshData(CoingeckoService $service): void
    {
        $this->cryptos = $service->getTopCryptos();
    }

    /**
     * @throws ConnectionException
     */
    public function search(CoingeckoService $service): void
    {

    }
}

