<div class="container mx-auto lg:px-28  px-4 md:px-16 sm:px-16">

    <!-- Competition Details -->
    <div class="mb-8 flex flex-col lg:flex-row">
        <div class="lg:mr-8 p-0 mb-4">
            <img src="{{ $competition->path_to_photo }}" alt="{{ $competition->name }}"
                 class="w-full lg:w-64 lg:h-64 rounded-lg object-cover lg:block">
        </div>
        <div>
            <h1 class="text-3xl font-bold mb-4 text-black">{{ $competition->title }}</h1>
            <p class="text-lg mb-4">{{ $competition->description }}</p>
            <div class="mb-4 text-lg">
                <strong class="text-black">Category:</strong> {{ $competition->competition_category->name ?? '/' }}
            </div>
            <div class="mb-4 text-lg">
                <strong class="text-black">Type:</strong> {{ $competition->competition_type->name }}
            </div>
            <div class="mb-4 text-lg">
                <strong class="text-black">Company:</strong> {{ $competition->company }}
            </div>
            @if( $competition->user_id == Auth::id())
                @if( $competition->submission_date > date('Y-m-d h:i:sa'))
                    <a href="{{ route('propose-competition', ['id' => urlencode($competition->id)]) }}">
                        <button
                            class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                            Manage competition
                        </button>
                    </a>
                @elseif( $competition->submission_date < date('Y-m-d h:i:sa') && $competition->end_date > date('Y-m-d h:i:sa') && !$competition->by_vote)
                    <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                        <button
                            class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                            Determine Winners
                        </button>
                    </a>
                @endif
                    <a href="{{ route('announcement') }}">
                        <button
                            class="bg-tm-blue hover:bg-tm-darker-blue text-white font-bold py-2 px-4 rounded ">
                            Send announcement
                        </button>
                    </a>
                <div class="border-t border-gray-100"></div>
            @endif
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <h1 class="text-3xl mb-4"><strong>Timeline</strong></h1>

        <div class="hidden lg:flex flex-col lg:flex-row items-center justify-between overflow-x-auto">
            <!-- Start Date -->
            <div class="flex flex-col items-center mb-4 sm:mb-0 mr-4">
                <div class="w-3 h-3 bg-green-800 rounded-full"></div>
                <p class="text-lg font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->start_date)) }}</p>
                <p class="text-lg text-gray-500">Start Date</p>
            </div>

            <div class="flex-grow border-b-2 border-black hidden sm:block"></div>

            @if($applicationDate)
                <div class="flex flex-col items-center mb-4 sm:mb-0 mx-auto mr-4 ml-4">
                    <x-phosphor-check-circle class="inline-block w-6 h-6 mb-1"/>
                    <p class="text-md font-semibold mt-2">{{ date('Y-m-d', strtotime($applicationDate)) }}</p>
                    <p class="text-md text-gray-500">Applied</p>
                </div>
                <div class="flex-grow border-b-2 border-black mx-2 hidden sm:block"></div>
            @endif

            <div class="flex flex-col items-center mb-4 sm:mb-0">
                <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                <p class="text-lg font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->submission_date)) }}</p>
                <p class="text-lg text-gray-500">Submission Date</p>
            </div>

            <div class="flex-grow border-b-2 border-black hidden sm:block"></div>

            @if($submissionDate)
                <div class="flex flex-col items-center mb-4 sm:mb-0 mr-4 ml-4">
                    <x-phosphor-upload-simple class="inline-block w-6 h-6 mb-1"/>
                    <p class="text-md font-semibold mt-2">{{ date('Y-m-d', strtotime($submissionDate)) }}</p>
                    <p class="text-md text-gray-500">Submitted</p>
                </div>
                <div class="flex-grow border-b-2 border-black mx-2 hidden sm:block"></div>
            @endif

            <div class="flex flex-col items-center mb-4 sm:mb-0 ml-4">
                <div class="w-3 h-3 bg-red-800 rounded-full"></div>
                <p class="text-lg font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->end_date)) }}</p>
                <p class="text-lg text-gray-500">End Date</p>
            </div>
        </div>
            <div class="lg:hidden">
                <ol class="border-s border-tm-darker-blue">
                    <li>
                        <div class="flex-start flex items-center pt-3">
                            <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                            <p class="text-sm text-black">{{ date('Y-m-d', strtotime($competition->start_date)) }}</p>
                        </div>
                        <div class="mb-6 ms-4 mt-2">
                            <h2 class="mb-1.5 text-lg font-semibold text-black">Start Date</h2>
                        </div>
                    </li>
                    <li>
                        <div class="flex-start flex items-center pt-2">
                            <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                            <p class="text-sm text-black">{{ date('Y-m-d', strtotime($competition->submission_date)) }}</p>
                        </div>
                        <div class="mb-6 ms-4 mt-2">
                            <h2 class="mb-1.5 text-lg font-semibold text-black">Submission Deadline</h2>
                        </div>
                    </li>
                    <li>
                        <div class="flex-start flex items-center pt-2">
                            <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                            <p class="text-sm text-black">{{ date('Y-m-d', strtotime($competition->end_date)) }}</p>
                        </div>
                        <div class="ms-4 mt-2 pb-5">
                            <h2 class="mb-1.5 text-lg font-semibold text-black">End Date</h2>
                        </div>
                    </li>
                </ol>
            </div>
    </div>


    <div class="mt-7">
        <h2 class="text-xl font-bold mb-2 text-black">Rules</h2>
        <p class="mb-5 text-md text-black">{{ $competition->rules ?? '/'}}</p>

        <h2 class="text-xl font-bold mb-2 text-black">Prize</h2>
        <p class="mb-7 text-md text-black">{{ $competition->prize }}</p>
    </div>
    @if( $competition->submission_date < date('Y-m-d h:i:sa') &&  date('Y-m-d h:i:sa') < $competition->end_date)
        @if( $competition->by_vote)
            <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                <button
                    class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                    Vote
                </button>
            </a>
            <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
            <button
                class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                    Ranking
            </button>
            </a>
        @else
            <p class="text-red-600 py-2 text-xl font-bold inline-block">
                Voting is disabled for this competition, the organizer will choose the winner
            </p>
        @endif
    @elseif( $competition->end_date < date('Y-m-d  h:i:sa'))
        <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
        <button
            class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                Ranking
        </button>
        </a>
    @elseif($competition->start_date < date('Y-m-d h:i:sa') && date('Y-m-d h:i:sa') < $competition->submission_date
               && $isParticipant)
        <x-tmk.button href="{{ route('upload', ['id' => urlencode($competition->id)]) }}">
            Submit
        </x-tmk.button>
        <x-tmk.button orange href="{{ route('own-submissions', ['id' => urlencode($competition->id)]) }}">
            View own submissions
        </x-tmk.button>
    @elseif($competition->start_date < date('Y-m-d h:i:sa') && date('Y-m-d h:i:sa') < $competition->submission_date
           && !$isParticipant)
        <p class="text-red-600 py-2 text-xl font-bold inline-block">
            You can't enter anymore, the competition has started
        </p>
    @elseif($competition->participations()->where('user_id', auth()->user()->id)->exists())
        <button
            class="bg-gray-400 text-white py-2 px-6 rounded inline-block cursor-not-allowed"
            disabled>
            Applied
        </button>
    @elseif($competition->start_date > date('Y-m-d h:i:sa'))
        <button wire:click="apply" wire:target="apply"
                @if($buttonDisabled)
                    disabled
                @endif
                class="bg-tm-blue hover:bg-tm-darker-blue text-white py-2 px-6 rounded inline-block">
            Apply for competition
        </button>
    @endif
</div>
