<div>
    <x-slot name="subtitle">Manage notifications</x-slot>
    <div class="pb-6">
        <h1 class="text-center text-3xl mb-4 font-bold">@if( $competition->user_id == Auth::id()) Your competition: "{{ $competition->title }}" @else Submissions for competition: "{{ $competition->title }}"@endif</h1>
        @if($competition->user_id == Auth::id() && !$competition->by_vote && $competition->submission_date < date('Y-m-d'))
        <div class="mx-auto max-w-7xl px-6 lg:px-8 my-4 bg-white rounded-lg">
            <h1 class="pt-5">
                @if(count($usersWithSubmissions) == 1)
                    Choose the winner
                @elseif(count($usersWithSubmissions) == 2)
                    Choose the 2 winners
                @else
                    Choose the top 3 winners
                @endif
            </h1>
            <div class="mx-auto max-w-7xl px-6 lg:px-8 my-1 bg-white">
                <form wire:submit.prevent="assignPlaces" class="pb-10">
                    <div class="space-y-4 flex w-full">
                        <div class="p-4 m-2">
                            <x-label for="firstPlace" value="Select first place"/>
                            <x-tmk.form.select id="firstPlace"
                                               wire:model.live="firstPlace"
                                               class="block mt-1 w-full"
                                               :disabled="$placesSaved">
                                <option value="">@if($placesSaved)
                                        {{  $firstPlace  }}
                                    @endif</option>
                                @foreach($usersWithSubmissions as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} {{ $user->surname }}
                                    </option>
                                @endforeach
                            </x-tmk.form.select>
                        </div>
                        @if(count($usersWithSubmissions) > 1)
                        <div class="p-4 m-2 mb-0.5">
                            <x-label for="secondPlace" value="Select second place"/>
                            <x-tmk.form.select id="secondPlace"
                                               wire:model.live="secondPlace"
                                               class="block mt-1 w-full"
                                               :disabled="$placesSaved">
                                <option value="">@if($placesSaved)
                                        {{  $secondPlace  }}
                                    @endif</option>
                                @foreach($usersWithSubmissions as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} {{ $user->surname }}
                                    </option>
                                @endforeach
                            </x-tmk.form.select>
                        </div>
                        @endif
                        @if(count($usersWithSubmissions) > 2)
                        <div class="p-4 m-2 mb-0.5">
                            <x-label for="thirdPlace" value="Select third place"/>
                            <x-tmk.form.select id="thirdPlace"
                                               wire:model.live="thirdPlace"
                                               class="block mt-1 w-full"
                                               :disabled="$placesSaved">
                                <option value="">@if($placesSaved)
                                        {{  $thirdPlace  }}
                                    @endif</option>
                                @foreach($usersWithSubmissions as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} {{ $user->surname }}
                                    </option>
                                @endforeach
                            </x-tmk.form.select>
                        </div>
                        @endif
                    </div>
                    @if(count($usersWithSubmissions) > 2)
                        @if($placesSaved || ($this->firstPlace == "" || $this->secondPlace == "" || $this->thirdPlace == ""))
                            <x-button type="submit" class="float-right bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Save Places</x-button>
                        @else
                            @if(($this->firstPlace == $this->secondPlace) || ($this->firstPlace == $this->thirdPlace) || ($this->secondPlace == $this->thirdPlace))
                                <p class="text-red-600">You're not allowed to pick the same person for multiple places</p>
                                <x-button type="submit" class="float-right bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Save Places</x-button>
                            @else
                                <x-button type="submit" class="float-right">Save Places</x-button>
                            @endif
                        @endif
                    @elseif(count($usersWithSubmissions) == 2)
                        @if($placesSaved || ($this->firstPlace == "" || $this->secondPlace == ""))
                            <x-button type="submit" class="float-right bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Save Places</x-button>
                        @else
                            @if($this->firstPlace == $this->secondPlace)
                                <p class="text-red-600">You're not allowed to pick the same person for multiple places</p>
                                <x-button type="submit" class="float-right bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Save Places</x-button>
                            @else
                                <x-button type="submit" class="float-right">Save Places</x-button>
                            @endif
                        @endif
                    @else
                        @if($placesSaved || ($this->firstPlace == ""))
                            <x-button type="submit" class="float-right bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Save Place</x-button>
                        @else
                            <x-button type="submit" class="float-right">Save Place</x-button>
                        @endif
                    @endif
                </form>
            </div>
        </div>
        @endif

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            @if(count($submissions))
                <x-tmk.card-container>
                    @foreach($submissions as $submission)
                        <div class="w-full rounded overflow-hidden shadow-lg" wire:key="submission-{{ $submission->id }}">
                            <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                            <div class="px-6 py-4">
                                <div class="justify-between flex">
                                    <div class="font-bold text-xl mb-2">{{$submission->participation->user->name }} {{$submission->participation->user->surname }}</div>
                                    <div class="font-bold mb-2">
                                        <x-button wire:click="openInfo({{$submission}})" class="bg-transparent hover:bg-transparent enabled:bg-transparent focus:bg-transparent px-0.5 mx-05" href="#">
                                            <x-phosphor-info class="inline-block w-5 h-5 text-blue-400"/>
                                        </x-button>
                                        @if((auth()->user()->admin && !$placesSaved) || (auth()->user()->id==$competition->organiser_id && !$placesSaved))
                                        <x-button wire:click="openDelete({{$submission}})" class="bg-transparent hover:bg-transparent active:bg-transparent enabled:bg-transparent focus:bg-transparent px-0.5 mx-0.5" href="#">
                                            <x-phosphor-trash class="inline-block w-5 h-5 text-red-600"/>
                                        </x-button>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-blue-300 text-sm mb-2">
                                    {{ $submission->title }}
                                </p>
                                <p class="text-gray-700 text-base">
                                    {{ $submission->description }}
                                </p>
                                <br>
                                @if($competition->by_vote)
                                <label>
                                    <span class="text-gray-700 text-base font-bold">Vote for submission: </span>
                                    <input type="checkbox" class="toggle-checkbox w-5 h-5 rounded-full bg-white
                                        border-4 appearance-none cursor-pointer"
                                           wire:model="checked.{{ $submission->id }}"
                                           wire:change="vote({{$submission}})" {{ $submission->votes->contains('user_id', auth()->id()) ? 'checked' : '' }}>
                                </label>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </x-tmk.card-container>
            @else
                <p class="text-center">No submissions found for this competition.</p>
            @endif
        </div>
    </div>
    <x-dialog-modal wire:model="showModalDelete">
        <x-slot name="title">
        </x-slot>
        <x-slot name="content">
            <div class="flex">
                <div class="text-base">
                    <p class="py-3">
                        Are you sure you want to delete <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->title : '' }} ?</span>
                    </p>
                    <p class="py-3">
                       participant: <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->participation->user->name : ''  }}</span>
                    </p>
                    <p class="py-3">
                        Description: <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->description : ''  }}</span>
                    </p>
                </div>
                <div>
                    <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                    <x-button wire:click="disqualifyParticipant"
                              wire:confirm="Are you sure you want to disqualify this participant? All the submissions by this user for this competitions will also be disqualified!"
                              class="bg-red-500 hover:bg-red-700 active:bg-red-700">Disqualify</x-button>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDelete" class="mx-3">Cancel</x-secondary-button>
            <x-button wire:click="deleteSubmission">Delete</x-button>
        </x-slot>
    </x-dialog-modal>



    <x-dialog-modal wire:model="showModalInfo">
        <x-slot name="title">
            <h2>More info about the submission from <span class="font-bold"> {{ $submissionToShowInfo ? $submissionToShowInfo->participation->user->name : '' }}</h2>
        </x-slot>
        <x-slot name="content">
                <div class="flex">
                    <div class="text-base">
                        <p class="py-3">
                            Title: <span class="font-bold text-blue-300"> {{ $submissionToShowInfo ? $submissionToShowInfo->title : ''  }}</span>
                        </p>
                        <p class="py-3">
                            Description: <span class="font-bold"> {{ $submissionToShowInfo ? $submissionToShowInfo->description : ''  }}</span>
                        </p>
                            <p class="py-3">
                                Link: <span class="font-bold"> {{ $submissionToShowInfo ? $submissionToShowInfo->link : ''  }}</span>
                            </p>
                    </div>
                    <div>
                        <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                    </div>
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeInfo">Close</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
