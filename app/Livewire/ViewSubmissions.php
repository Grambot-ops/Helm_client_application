<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSubmissions extends Component
{
    public $showModalDelete = false;
    public $showModalInfo = false;
    public $submissionToDelete;
    public $submissionToShowInfo;
    public $checked = [];

    public $competition;
    public $firstPlace;
    public $secondPlace;
    public $thirdPlace;
    public $placesSaved = false;


    public function mount(Request $request)
    {
        $id = $request->id;
        if(!isset($id))
            abort(404);

        // Get competition
        $this->competition = Competition::where('id', $id)
            ->firstOrFail();
        $submissions = Submission::whereIn(
            'participation_id',
            Participation::select('id')
                ->where('competition_id', $this->competition->id)
                ->where('disqualified', false)
                ->get()
        )->get();
        foreach ($submissions as $submission) {
            if ($submission->votes->contains('user_id', auth()->user()->id))
                $this->checked[$submission->id] = true;
            else
                $this->checked[$submission->id] = false;
        }

        if (Participation::where('ranking', 1)
            ->where('competition_id', $this->competition->id) // Change 3 to the ID of your competition
            ->exists()){
            $firstPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                ->where('ranking', 1)
                ->first();
            $this->firstPlace = $firstPlaceParticipation->user->name . ' ' . $firstPlaceParticipation->user->surname;
            if (Participation::where('ranking', 2)
                ->where('competition_id', $this->competition->id) // Change 3 to the ID of your competition
                ->exists()) {
                $secondPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                    ->where('ranking', 2)
                    ->first();
                $this->secondPlace = $secondPlaceParticipation->user->name . ' ' . $secondPlaceParticipation->user->surname;
                if (Participation::where('ranking', 3)
                    ->where('competition_id', $this->competition->id) // Change 3 to the ID of your competition
                    ->exists()) {
                    $thirdPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                        ->where('ranking', 3)
                        ->first();
                    $this->thirdPlace = $thirdPlaceParticipation->user->name . ' ' . $thirdPlaceParticipation->user->surname;
                }
            }
            $this->placesSaved = true;
        }
    }


    #[Layout('layouts.tmcp', ['title' => 'Submissions', 'description' => 'all submissions from the competitions','page_author' => 'Ian'])]
    public function render()
    {
        $competition = $this->competition;


        $submissions = Submission::whereIn(
            'participation_id',
            Participation::select('id')
                ->where('competition_id', $this->competition->id)
                ->where('disqualified', false)
                ->get()
        )->get();

        $usersWithSubmissions = User::whereHas('participations.submissions', function ($query) use ($competition) {
            $query->where('participations.competition_id', $competition->id)
            ->where('participations.disqualified', false);
        })->select('id', 'name', 'surname')->distinct()->get();

        return view('livewire.view-submissions', compact('competition', 'submissions', 'usersWithSubmissions'));
    }

    public function assignPlaces()
    {
        // Update the ranking for the user selected in the first place dropdown
        if ($this->firstPlace) {
            $participation = Participation::where('user_id', $this->firstPlace)
                ->where('competition_id', $this->competition->id)
                ->first();

            if ($participation) {
                $participation->update(['ranking' => 1]);
            }
        }

        if ($this->secondPlace) {
            $participation = Participation::where('user_id', $this->secondPlace)
                ->where('competition_id', $this->competition->id)
                ->first();

            if ($participation) {
                $participation->update(['ranking' => 2]);
            }
        }

        if ($this->thirdPlace) {
            $participation = Participation::where('user_id', $this->thirdPlace)
                ->where('competition_id', $this->competition->id)
                ->first();

            if ($participation) {
                $participation->update(['ranking' => 3]);
            }
        }
        $this->competition->update(['end_date' => date('Y-m-d h:i:s')]);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The winners have been chosen",
            'icon' => 'success',
        ]);
        $this->placesSaved = true;

    }

    public function openDelete(Submission $submission)
    {
        $this->submissionToDelete = $submission;
        $this->showModalDelete = true;
    }
    public function closeDelete(){
        $this->showModalDelete = false;
    }

    public function deleteSubmission()
    {
        $this->submissionToDelete->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The submission \"<b><i>{$this->submissionToDelete->title}</i></b>\" has been deleted",
        ]);
        $this->submissionToDelete = null;
        $this->showModalDelete = false;
    }
    public function disqualifyParticipant(){
        $this->submissionToDelete->participation->update(['disqualified' => true]);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The User <b><i>{$this->submissionToDelete->participation->user->name}</i></b> has been disqualified",
        ]);
        $this->submissionToDelete = null;
        $this->showModalDelete = false;
        return redirect(request()->header('Referer'));
    }

    public function openInfo(Submission $submission){
        $this->submissionToShowInfo = $submission;
        $this->showModalInfo = true;
    }
    public function closeInfo(){
        $this->showModalInfo = false;
        // Not setting this to `null` triggers a bug where the modal tries to
        // show info about a modal that doesn't exist anymore, causing Livewire
        // to throw a 404
        $this->submissionToShowInfo = null;
    }

    public function vote(Submission $submission)
    {
        // If the user has already voted, delete the vote
        if ($submission->votes->contains('user_id', auth()->id())) {
            $submission->votes()->where('user_id', auth()->id())->delete();
        } else {
            $amount_votes = $submission->participation->competition->number_of_votes_allowed;
            $submissions = $submissions = Submission::whereIn(
                'participation_id',
                Participation::select('id')
                    ->where('competition_id', $this->competition->id)
                    ->get()
            )->get();
            $amount_user_votes = 0;
            foreach ($submissions as $countVote) {
                if ($countVote->votes->contains('user_id', auth()->id())) {
                    $amount_user_votes++;
                }
            }
            if ($amount_user_votes >= $amount_votes) {
                $this->dispatch('swal:toast',
                    [
                        'background' => 'error',
                        'html' => "You have already voted {$amount_votes} time(s)",
                        'icon' => 'error'
                    ]
                );
                $this->checked[$submission->id] = false;
                return;
            }
            $vote = new Vote;
            $vote->user_id = auth()->id();
            $submission->votes()->save($vote);
        }
    }
}
