<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\CompetitionCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    public $name;
    public $category = '%';
    public $likedOnly = false;

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

}
