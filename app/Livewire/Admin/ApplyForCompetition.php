<?php

namespace App\Livewire\Admin;

use App\Models\Competition;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class ApplyForCompetition extends Component
{
    #[Layout('layouts.tmcp', ['title' => 'apply', 'description' => 'Apply for competition',])]

    public function render(Request $request)
    {
        $competitionName = urldecode($request->query('competitionName'));
        $competition = Competition::where('title', $competitionName)->firstOrFail();
        $competitionDescription = $competition->description;
        $competitionCategory = $competition->competition_category->name;
        $competitionType = $competition->competition_type->name;

        $competitionStartDate = Carbon::parse($competition->start_date)->toFormattedDateString();
        $competitionSubmissionDate = Carbon::parse($competition->submission_date)->toFormattedDateString();
        $competitionEndDate = Carbon::parse($competition->end_date)->toFormattedDateString();

        $competitionPicture = $competition->path_to_photo;

        $competitionRules = $competition->rules;
        $competitionPrize = $competition->prize;

        return view('livewire.admin.apply-for-competition', compact('competitionName', 'competitionDescription', 'competitionCategory','competitionType', 'competitionStartDate', 'competitionSubmissionDate', 'competitionEndDate', 'competitionPicture', 'competitionRules','competitionPrize'));
    }

}
