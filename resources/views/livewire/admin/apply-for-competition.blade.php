<div class="container mx-auto px-4">
    <div class="flex items-center mb-4">
        <div class="flex-grow">
            <div>
                <h1 class="text-3xl font-bold mb-10 text-black">{{ $competitionName }}</h1>
                <p class="text-black mb-7">{{ $competitionDescription }}</p>
                <p class="mb-3"><strong class="text-black">Category:</strong> {{ $competitionCategory }}</p>
                <p><strong class="text-black">Type:</strong> {{ $competitionType }}</p>
            </div>
            <div class="mt-auto">
            </div>
        </div>
        <div class="flex justify-center items-center flex-grow">
            <div class="border-tm-darker-blue rounded overflow-hidden" style="border-width: 16px;">
                <img src="{{ $competitionPicture }}" alt="{{ $competitionName }}" class="w-52 h-52 object-cover">
            </div>
        </div>

    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-4">
        <h1 class="text-2xl mb-4"><strong>Timeline</strong></h1>
        <ol class="border-s border-tm-darker-blue">
            <li>
                <div class="flex-start flex items-center pt-3">
                    <div class="-ms-[5px] me-3 h-[9px] w-[9px] rounded-full bg-tm-blue"></div>
                    <p class="text-sm text-black">
                        {{ $competitionStartDate }}
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
                        {{ $competitionSubmissionDate }}
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
                        {{ $competitionEndDate }}
                    </p>
                </div>
                <div class="ms-4 mt-2 pb-5">
                    <h2 class="mb-1.5 text-lg font-semibold text-black">End Date</h2>
                </div>
            </li>
        </ol>
    </div class="bg-white rounded-lg shadow-md p-4 mb-4">

    <div class="mt-7">
        <h2 class="text-xl font-bold mb-2 text-black">Rules</h2>
        <p class="mb-5 text-black">{{ $competitionRules }}</p>

        <h2 class="text-xl font-bold mb-2 text-black">Prize</h2>
        <p class="mb-7 text-black">{{ $competitionPrize }}</p>
    </div>
    <a href="#" class="bg-tm-blue hover:bg-tm-darker-blue text-white py-2 px-6 rounded inline-block">Apply for competition</a>
</div>
