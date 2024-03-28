<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Like;
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
        $podium = $competition->likes->unique('user_id')->sort(function ($a, $b) {
            return $b->user->likes->count() <=> $a->user->likes->count();
        })->take(4);
        $likes = $competition->likes->unique('user_id')->sort(function ($a, $b) {
            return $b->user->likes->count() <=> $a->user->likes->count();
        });
        $i = 1;
        return view('livewire.ranking', compact('competition', 'likes', 'i', 'podium'));
    }

    public function likesById($userId, $competitionId)
    {
        return Like::where('user_id', $userId)->where('competition_id', $competitionId)->count();
    }
}
