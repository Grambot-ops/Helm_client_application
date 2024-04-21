<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\Like;
use App\Models\Participation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    public $competitions;
    public $buttonDisabled = false;
    public $name;
    public $category = '%';
    public $likedOnly = false;
    public $competition;
    public $showApplyConfirmationModal = false;


    public function updated($property, $value)
    {
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
                    ->where('user_id', Auth::id());
            });
        }
        $competitions = $query->get();
        return view('livewire.dashboard', compact('competitions', 'allCategories'));
    }

    public function mount()
    {
        $this->loadCompetitions();
    }

    public function toggleLiked($competitionId)
    {
        $competition = Competition::findOrFail($competitionId);

        $liked = $competition->likes()->where('user_id', auth()->user()->id)->exists();

        if ($liked) {
            $competition->likes()->where('user_id', auth()->user()->id)->delete();
        } else {
            Like::create([
                'user_id' => auth()->user()->id,
                'competition_id' => $competition->id,
            ]);
        }
        $this->loadCompetitions();
    }

    public function apply()
    {
        $isParticipant = Participation::where('competition_id', $this->competition->id)
            ->where('user_id', auth()->id())
            ->exists();

        $this->showApplyConfirmationModal = false;
        if ($isParticipant) {
            $this->dispatch('swal:toast', [
                'background' => 'warning',
                'html' => "You are already a participant in this competition.",
                'icon' => 'warning',
            ]);
            return;
        }

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

    public function loadCompetitions()
    {
        $query = Competition::orderBy('start_date')
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->name . '%')
                    ->orWhere('description', 'like', '%' . $this->name . '%');
            })
            ->where('competition_category_id', 'like', $this->category);

        if ($this->likedOnly) {
            $query->whereHas('likes', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }
        $this->competitions = $query->get();
        $this->competitions->each(function ($competition) {
            $competition->liked = $competition->likes()->where('user_id', Auth::id())->exists();
        });
    }

    public function toggleLikedOnly()
    {
        $this->likedOnly = !$this->likedOnly;
        $this->loadCompetitions();
    }

}
