<?php

namespace App\Livewire;

use Illuminate\Http\Client\ConnectionException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Services\CoingeckoService;

class CryptoDetail extends Component
{
    public $crypto;
    public $cryptoId;

    /**
     * @throws ConnectionException
     */
    public function mount($id, CoingeckoService $service)
    {
        $this->cryptoId = $id;
        $this->crypto = $service->getCryptoById($id);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.crypto-detail');
    }
}
