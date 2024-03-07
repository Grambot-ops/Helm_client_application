<?php

namespace App\Livewire;

use App\Models\Competition;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Competitions', 'description' => 'Thomas More Competition Platform'])]
    public function render()
    {
        $competitions = Competition::orderBy('title')
            ->get();
        return view('livewire.dashboard', compact('competitions'));
    }
}
