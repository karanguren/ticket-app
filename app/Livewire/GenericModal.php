<?php

namespace App\Livewire;

use Livewire\Component;

class GenericModal extends Component
{
    public $showModal = false;

    public function mount()
    {
        $this->showModal = true;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.generic-modal');
    }
}