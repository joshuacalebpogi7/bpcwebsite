<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Counter extends Component
{
    public $comments = [
        'body' => 'sdfsdfsdf'
    ];

    public function addComments()
    {
        array_unshift($this->comments, [
            'comments' => 'hellow',
            'currentstamp' => Carbon::now()->diffForHumans()
        ]);


    }
    public function render()
    {
        return view('livewire.counter');
    }
}