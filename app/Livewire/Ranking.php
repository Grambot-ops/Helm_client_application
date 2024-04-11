<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Like;
use App\Models\Participation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Request;

class Ranking extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'Ranking', 'description' => 'Ranking of the competition'])]
    public function render()
    {
        $id = request('id');
        $competition = Competition::where('id', $id)
            ->with('participations')
            ->with('participations.submissions')
            ->with('participations.submissions.votes')
            ->with('participations.user')
            ->first();
        $participations = Participation::where('competition_id', $id)
            ->with(['submissions', 'user'])
            ->get();

        foreach ($participations as $participation) {
            $votesCount = 0;
            foreach ($participation->submissions as $submission) {
                $votesCount += $submission->votes->count();
            }
            $participation->votes_count = $votesCount;
        }
        $participations = $participations->sortByDesc('votes_count');
        $podium = $participations->map(function ($participation) {
            return $participation->user;
        })->take(3);
        $i = 1;
        return view('livewire.ranking', compact('competition', 'participations', 'i', 'podium'));
    }

    public function likesById($userId, $competitionId)
    {
        return Like::where('user_id', $userId)->where('competition_id', $competitionId)->count();
    }
}
