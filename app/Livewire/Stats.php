<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;

class Stats extends Component
{


    public function render()
    {
        return view('livewire.stats')->with([
            'users' => User::get(),
        ]);
    }
}
