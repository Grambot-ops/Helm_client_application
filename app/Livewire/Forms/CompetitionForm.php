<?php

namespace App\Livewire\Forms;

use App\Models\Competition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompetitionForm extends Form
{
    use WithFileUploads;

    public $id = null;
    #[Validate('required|min:3', as: 'title')]
    public $title = null;
    #[Validate('required', as: 'description')]
    public $description = null;
    #[Validate('required', as: 'competition type')]
    public $competition_type_id = null;
    #[Validate('required', as: 'start date')]
    public $start_date = null;
    #[Validate('required', as: 'end date')]
    public $end_date = null;
    #[Validate('required', as: 'submission date')]
    public $submission_date = null;
    public $competition_category_id = null;
    public $path_to_photo = null;
    // !!!!!!!!!!!!!! do not name a variable rules and set it to null !!!!!!!!!!!!
    public $_rules = null;
    //#[Validate('required', as: 'winner criteria')]
    public $by_vote = null;
    #[Validate('required', as: 'prize')]
    public $prize = null;

    public $photo;


    public function read(Competition $competition)
    {
        $this->id = $competition->id;
        $this->competition_category_id = $competition->competition_category_id;
        $this->competition_type_id = $competition->competition_type_id;
        $this->title = $competition->title;
        $this->_rules = $competition->rules;
        $this->by_vote = $competition->by_vote;
        $this->path_to_photo = $competition->path_to_photo;
        $this->prize = $competition->prize;
        $this->description = $competition->description;
        $this->start_date = $competition->start_date;
        $this->end_date = $competition->end_date;
        $this->submission_date = $competition->submission_date;
    }

    // create a new record
    public function create()
    {
        $this->validate();

        if ($this->photo) {
            $originalPhoto = Image::make($this->photo)->encode('jpg', 75);
            $this->path_to_photo = 'competition-pictures/' . Str::random(10) . '.jpg';
            Storage::disk('public')->put($this->path_to_photo, $originalPhoto);
            $this->path_to_photo = '/storage/' . $this->path_to_photo;
        } else {
            $this->path_to_photo = '/assets/card-top.jpg';
        }

        Competition::create([
            'competition_category_id' => $this->competition_category_id,
            'competition_type_id' => $this->competition_type_id,
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'by_vote' => $this->by_vote,
            'path_to_photo' => $this->path_to_photo,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'submission_date' => $this->submission_date,
            'rules' => $this->_rules,
            'prize' => $this->prize,
        ]);
    }
    // delete the selected record
    public function delete(Competition $competition)
    {
        $competition->delete();
    }
}
