<?php

namespace App\Livewire;

use App\Models\Competition;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Request;

class Ranking extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Ranking', 'description' => 'Ranking of the competition'])]
    public function render()
    {
        $id = request('id');
        $competition = Competition::find($id);
        return view('livewire.ranking', compact('competition'));
    }
}
