<div class="container mx-auto px-28">
    <div class="flex items-center mb-4">
        <div class="flex-grow">
            <div>
                <h1 class="text-3xl font-bold mb-10 text-black">{{ $competition->title }}</h1>
                <p class="text-black text-lg mb-7">{{ $competition->description }}</p>
                <p class="mb-3 text-lg"><strong
                        class="text-black">Category:</strong> {{ $competition->competition_category->name }}</p>
                <p class="mb-3 text-lg"><strong
                        class="text-black">Type:</strong> {{ $competition->competition_type->name }}</p>
                <p text-lg><strong class="text-black">Company:</strong> {{ $competition->company }}</p>
            </div>
            <div class="mt-auto">
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="flex justify-center items-center flex-grow">
                <div class="border-tm-darker-blue rounded overflow-hidden" style="border-width: 16px;">
                    <img src="{{ $competition->path_to_photo }}" alt="{{ $competition->name }}"
                         class="w-72 h-72 object-cover">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <h1 class="text-2xl mb-4"><strong>Timeline</strong></h1>

        <div class="hidden lg:flex flex-col lg:flex-row items-center justify-between overflow-x-auto">
            <!-- Start Date -->
            <div class="flex flex-col items-center mb-4 sm:mb-0 mr-4">
                <div class="w-3 h-3 bg-green-800 rounded-full"></div>
                <p class="text-md font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->start_date)) }}</p>
                <p class="text-md text-gray-500">Start Date</p>
            </div>

            <div class="flex-grow border-b-2 border-black hidden sm:block"></div>

            @if($applicationDate)
                <div class="flex flex-col items-center mb-4 sm:mb-0 mx-auto mr-4 ml-4">
                    <x-phosphor-check-circle class="inline-block w-6 h-6 mb-1"/>
                    <p class="text-sm font-semibold mt-2">{{ date('Y-m-d', strtotime($applicationDate)) }}</p>
                    <p class="text-xs text-gray-500">Applied</p>
                </div>
                <div class="flex-grow border-b-2 border-black mx-2 hidden sm:block"></div>
            @endif

            <div class="flex flex-col items-center mb-4 sm:mb-0">
                <div class="w-3 h-3 bg-yellow-600 rounded-full"></div>
                <p class="text-md font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->submission_date)) }}</p>
                <p class="text-md text-gray-500">Submission Date</p>
            </div>

            <div class="flex-grow border-b-2 border-black hidden sm:block"></div>

            @if($submissionDate)
                <div class="flex flex-col items-center mb-4 sm:mb-0 mr-4 ml-4">
                    <x-phosphor-upload-simple class="inline-block w-6 h-6 mb-1"/>
                    <p class="text-sm font-semibold mt-2">{{ date('Y-m-d', strtotime($submissionDate)) }}</p>
                    <p class="text-xs text-gray-500">Submitted</p>
                </div>
                <div class="flex-grow border-b-2 border-black mx-2 hidden sm:block"></div>
            @endif

            <div class="flex flex-col items-center mb-4 sm:mb-0 ml-4">
                <div class="w-3 h-3 bg-red-800 rounded-full"></div>
                <p class="text-md font-semibold mt-2">{{ date('Y-m-d', strtotime($competition->end_date)) }}</p>
                <p class="text-md text-gray-500">End Date</p>
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
        <p class="mb-5 text-black">{{ $competition->rules }}</p>

        <h2 class="text-xl font-bold mb-2 text-black">Prize</h2>
        <p class="mb-7 text-black">{{ $competition->prize }}</p>
    </div>
    @if( $competition->submission_date < date('Y-m-d'))
        <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}"
           class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
            <button>
                Ranking
            </button>
        </a>
    @elseif($competition->start_date < date('Y-m-d') && date('Y-m-d') < $competition->submission_date )
        <a href=""
           class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
            <button>
                Submit
            </button>
        </a>
    @else
        <button wire:click="apply" wire:target="apply"
                @if($buttonDisabled)
                    disabled
                @endif
                class="bg-tm-blue hover:bg-tm-darker-blue text-white py-2 px-6 rounded inline-block">
            Apply for competition
        </button>
    @endif
</div>
