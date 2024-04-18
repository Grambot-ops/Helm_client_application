<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\Participation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    public $buttonDisabled = false;
    public $name;
    public $category = '%';
    public $likedOnly = false;
    public $competition;
    public $showApplyConfirmationModal = false;


    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['name', 'category', 'liked']))
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
    public function applyConfirmation(Competition $competition)
    {
        $this->competition = $competition;
        $this->showApplyConfirmationModal = true;
    }
}
