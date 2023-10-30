<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewSurvey extends Component
{

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.view-survey');
    }
}
