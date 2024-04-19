<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\Participation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use UnhandledMatchError;

class Dashboard extends Component
{
    public $buttonDisabled = false;
    public $name;
    public $category = '%';
    public $likedOnly = false;
    public $ownOnly = false;
    public $competition;
    public $showApplyConfirmationModal = false;
    public $status = -1;

    public function mount()
    {
        // Message to be shown after redirection
        if(session()->get('message')) {
            $is_error = session()->get('error');
            $this->dispatch('swal:toast', [
                'background' => $is_error ? 'danger' : 'success',
                'html' => session()->get('message'),
                'icon' => $is_error ? 'warning' : 'success',
            ]);
        }
    }

    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['name', 'category', 'liked','own']))
            $this->getErrorBag();
    }
    #[Layout('layouts.tmcp', ['title' => 'Competitions', 'description' => 'Thomas More Competition Platform'])]
    public function render()
    {
        $allCategories = CompetitionCategory::all();
        $query = Competition::orderBy('start_date')
            ->searchTitleOrDescription($this->name)
            ->where('competition_category_id', 'like', $this->category);

        if ($this->likedOnly) {
            $query->whereIn('id', function ($query) {
                $query->select('competition_id')
                    ->from('likes')
                    ->where('user_id',Auth::id());
            });
        }

        switch($this->status) {
            // None chosen
            case -1:
                break;
            // Open
            case 0:
                $query->where('start_date', '<', now());
                $query->where('submission_date', '>', now());
                break;
            // Open for voting
            case 1:
                $query->where('end_date', '>', now());
                $query->where('submission_date', '<', now());
                break;
            // Closed
            case 2:
                $query->where('end_date', '<', now());
                break;
            default:
                throw new UnhandledMatchError("No such competition status.");
        }

        if ($this->ownOnly) {
            $query->whereIn('id', function ($query) {
                $query->select('id')
                    ->from('competitions')
                    ->where('user_id',Auth::id());
            });
        }

        $competitions = $query->get();
        return view('livewire.dashboard', compact('competitions', 'allCategories'));
    }
    public function toggleLikedOnly()
    {
        $this->likedOnly = !$this->likedOnly;
    }
    public function apply()
    {
        // Retrieve the competition based on the provided ID

        // Check if the user is already a participant
        $isParticipant = Participation::where('competition_id', $this->competition->id)
            ->where('user_id', auth()->id())
            ->exists();

        $this->showApplyConfirmationModal = false;

        // Handle if the user is already a participant
        if ($isParticipant) {
            $this->dispatch('swal:toast', [
                'background' => 'warning',
                'html' => "You are already a participant in this competition.",
                'icon' => 'warning',
            ]);
            return;
        }

        // Proceed with applying if the user is not already a participant
        $this->buttonDisabled = true;
        Participation::create([
            'competition_id' => $this->competition->id,
            'user_id' => auth()->id(),
            'ranking' => 0,
            'disqualified' => false,
        ]);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "You have applied!",
            'icon' => 'success',
        ]);
    }


    public function toggleOwnOnly()
    {
        $this->ownOnly = !$this->ownOnly;
    }
    public function applyConfirmation(Competition $competition)
    {
        $this->competition = $competition;
        $this->showApplyConfirmationModal = true;
    }
}
