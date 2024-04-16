<div class="container mx-auto px-4" xmlns="http://www.w3.org/1999/html">
    <div class="flex items-center mb-4">
        <div class="flex-grow">
            <div>
                <h1 class="text-3xl font-bold mb-10 text-black">{{ $competition->title }}</h1>
                <p class="text-black mb-7">{{ $competition->description }}</p>
                <p class="mb-3"><strong class="text-black">Category:</strong> {{ $competition->competition_category->name }}</p>
                <p><strong class="text-black">Type:</strong> {{ $competition->competition_type->name }}</p>
            </div>
            <div class="mt-auto">
            </div>
        </div>
        <div class="hidden sm:block">
        <div class="flex justify-center items-center flex-grow">
            <div class="border-tm-darker-blue rounded overflow-hidden" style="border-width: 16px;">
                <img src="{{ $competition->path_to_photo }}" alt="{{ $competition->name }}" class="w-52 h-52 object-cover">
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <h1 class="text-2xl mb-4"><strong>Timeline</strong></h1>

    <div class="sm:hidden"> <!-- This will be visible on small screens -->
        <ol class="border-s border-tm-darker-blue">
            <li>
                <div class="flex-start flex items-center pt-3">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                    <p class="text-sm text-black">
                        {{ $competition->start_date }}
                    </p>
                </div>
                <div class="mb-6 ms-4 mt-2">
                    <h2 class="mb-1.5 text-lg font-semibold text-black">Start Date</h2>
                </div>
            </li>

            <li>
                <div class="flex-start flex items-center pt-2">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                    <p class="text-sm text-black">
                        {{ $competition->submission_date }}
                    </p>
                </div>
                <div class="mb-6 ms-4 mt-2">
                    <h2 class="mb-1.5 text-lg font-semibold text-black">Submission Deadline</h2>
                </div>
            </li>

            <li>
                <div class="flex-start flex items-center pt-2">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                    <p class="text-sm text-black">
                        {{ $competition->end_date }}
                    </p>
                </div>
                <div class="ms-4 mt-2 pb-5">
                    <h2 class="mb-1.5 text-lg font-semibold text-black">End Date</h2>
                </div>
            </li>
        </ol>
    </div>

        <div class="hidden sm:block">
        <ol class="grid grid-cols-1 sm:grid-cols-3 ml-7">
            <li class="relative text-left mb-6">
                <div class="flex items-center justify-center ml-5 mb-5">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('Y-m-d', strtotime($competition->start_date)) }}</p>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Start date</p>
                </div>
            </li>
            <li class="relative text-center mb-6">
                <div class="flex items-center mb-5">
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3">
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('Y-m-d', strtotime($competition->submission_date)) }}</p>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Submission date</p>
                </div>
            </li>
            <li class="relative text-right mb-6">
                <div class="flex items-center mb-5 mr-12">
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('Y-m-d', strtotime($competition->end_date)) }}</p>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">End date</p>
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
    @else
        <button wire:click="apply" class="bg-tm-blue hover:bg-tm-darker-blue text-white py-2 px-6 rounded inline-block">
            Apply for competition
        </button>
    @endif

</div>
