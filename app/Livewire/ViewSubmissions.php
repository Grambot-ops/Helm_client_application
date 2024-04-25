<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSubmissions extends Component
{
    public $showModalDelete = false;
    public $showModalInfo = false;
    public $submissionToDelete;
    public $submissionToShowInfo;

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

        if (Participation::where('ranking', 1)
            ->where('competition_id', $this->competition->id) // Change 3 to the ID of your competition
            ->exists()){
            $firstPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                ->where('ranking', 1)
                ->first();
            $this->firstPlace = $firstPlaceParticipation->user->name . ' ' . $firstPlaceParticipation->user->surname;

            $secondPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                ->where('ranking', 2)
                ->first();
            $this->secondPlace = $secondPlaceParticipation->user->name . ' ' . $secondPlaceParticipation->user->surname;

            $thirdPlaceParticipation = Participation::where('competition_id', $this->competition->id)
                ->where('ranking', 3)
                ->first();
            $this->thirdPlace = $thirdPlaceParticipation->user->name . ' ' . $thirdPlaceParticipation->user->surname;
            $this->placesSaved = true;
        }
    }


    #[Layout('layouts.tmcp', ['title' => 'Submissions', 'description' => 'all submissions from the competitions'])]
    public function render()
    {
        $competition = $this->competition;


        $submissions = Submission::whereIn(
            'participation_id',
            Participation::select('id')
                ->where('competition_id', $this->competition->id)
                ->get()
        )->get();

        $usersWithSubmissions = User::whereHas('participations.submissions', function ($query) use ($competition) {
            $query->where('participations.competition_id', $competition->id);
        })->select('id', 'name', 'surname')->distinct()->get();

        return view('livewire.view-submissions', compact('competition', 'submissions', 'usersWithSubmissions'));
    }

    public function assignPlaces()
    {
        $this->competition->update([
            'first_place' => $this->firstPlace,
            'second_place' => $this->secondPlace,
            'third_place' => $this->thirdPlace,
        ]);
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
}
