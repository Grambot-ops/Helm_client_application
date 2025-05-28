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
    #[Layout('layouts.tmcp', ['title' => 'Ranking', 'description' => 'Ranking of the competition','page_author' => 'Stef'])]
    public function render()
    {
        $id = request('id');
        $competition = Competition::where('id', $id)
            ->with('participations')
            ->with('participations.submissions')
            ->with('participations.submissions.votes')
            ->with('participations.user')
            ->first();
        if ($competition->by_vote) {
            $participations = Participation::where('competition_id', $id)
                ->with(['submissions', 'user'])
                ->with('submissions.votes')
                ->get()
                ->groupBy('user_id');
            foreach ($participations as $participation) {
                $votesCount = 0;
                foreach ($participation as $participationItem) {
                    if ($participationItem->submissions != null)
                        foreach ($participationItem->submissions as $submission)
                            $votesCount += $submission->votes->count();
                }
                $participation->votes_count = $votesCount;
            }
            $participations = $participations->sortByDesc('votes_count');
        } else {
            $participants = Participation::where('competition_id', $id)
                ->with(['submissions', 'user'])
                ->get();
            $topParticipations = collect();
            foreach ($participants as $participation) {
                if ($participation->ranking > 0)
                    $topParticipations->add($participation);
            }
            if ($topParticipations != null)
                $participations = $topParticipations->sortBy('ranking');

        }
        $podium = $participations->map(function ($participation) {
            return $participation;
        })->take(3);
        //dd($podium);
        $i = 1;
        return view('livewire.ranking', compact('competition', 'participations', 'i', 'podium'));
    }

    public function likesById($userId, $competitionId)
    {
        return Like::where('user_id', $userId)->where('competition_id', $competitionId)->count();
    }
}
