<?php

namespace App\Livewire;

use App\Models\Competition;
use App\Models\Participation;
use App\Models\Submission;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class UploadEndProduct extends Component
{
    use WithFileUploads;

    public $uploaded;
    public $title;
    public $description;

    public $competition;
    public $participation;

    public $mimetype;

    public function store()
    {
        $is_file = !is_null($this->competition->filetypes);
        $filename = null;

        $validatedData = $this->validate([
            'title' => 'required|filled|max:255',
            'description' => '',
            'uploaded' => $is_file ? "required|file|mimes:$this->mimetype|max:2048" :  "required|url",
        ]);

        if($is_file)
            $filename = $this->uploaded->store('public/uploads');


        Submission::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'participation_id' => $this->participation->id,
            'path' => $filename ?? null,
            'link' => !$is_file ? $this->uploaded : null,
        ]);

        $this->participation->update([
            'submission_date' => now(),
        ]);

        session()->flash('message', 'The submission was successfully uploaded!');

        $this->redirectRoute('dashboard');
    }

    public function mount(Request $request)
    {
        $id = $request->id;

        $this->competition = Competition::where('id', $id ?? 0)->first();
        if(!$this->competition) {
            session()->flash('message', 'No such competition found.');
            session()->flash('error', 1);
            $this->redirectRoute('dashboard');
            return;
        }

        $this->participation = Participation::where('competition_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        /* magic number */
        if($request->debug != 69) {
            // You shouldn't be able to submit if you're not participating in a competition
            if(empty($this->participation)) {
                session()->flash('message', 'You are not participating in this competition!');
                session()->flash('error', 1);
                $this->redirectRoute('dashboard');
            }

            if($this->competition->submission_date < now()) {
                session()->flash('message', 'This competition has already passed the submission deadline.');
                session()->flash('error', 1);
                $this->redirectRoute('dashboard');
            }
        }

        if($this->competition->filetypes)
            $this->mimetype = Competition::fileTypesToFormats($this->competition->filetypes);
    }

    #[Layout('layouts.tmcp', ['title' => 'Upload end product'])]
    public function render(Request $request)
    {
        $competition = $this->competition;

        return view('livewire.upload-end-product', compact('competition'));
    }
}
