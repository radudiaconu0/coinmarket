<?php

namespace App\Livewire;

use Livewire\Component;

class CryptoElement extends Component
{
    public $crypto;
    public function render()
    {
        return view('livewire.crypto-element', [
            'crypto' => $this->crypto
        ]);
    }
}
