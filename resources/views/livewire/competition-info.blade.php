@use('Carbon\Carbon')
@use('App\Models\Competition')

{{-- TODO: add more stuff--}}
<div>
    <div class="bg-white p-8 rounded-xl border border-1 shadow-xl border-gray-200 flex col justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $proposal->title }}</h1>
            <p class="mb-2">{{ $proposal->description }}</p>

            <div class="pb-4">
                <p class="mb-2"><span class="font-bold">Category:</span> {{ $proposal->competition_category ? $proposal->competition_category->name : 'None' }}</p>
                <p class="mb-2"><span class="font-bold">Type:</span> {{ $proposal->competition_type->name }}</p>
            </div>

            <div class="pb-4">
                <p class="mb-2"><span class="font-bold">Start Date:</span> {{ Carbon::parse($proposal->start_date)->format('d/m/Y') }}</p>
                <p class="mb-2"><span class="font-bold">End date:</span> {{ Carbon::parse($proposal->end_date)->format('d/m/Y') }}</p>
                <p class="mb-2"><span class="font-bold">Submission date:</span> {{ Carbon::parse($proposal->submission_date)->format('d/m/Y') }}</p>
            </div>

            <div class="pb-4">
                <p class="mb-2"><span class="font-bold">Winning criteria:</span> {{ $proposal->by_vote ? 'By vote' : 'By selection' }} </p>
                <p class="mb-2"><span class="font-bold">Max number of uploads:</span> {{ $proposal->number_of_uploads != 0 ? $proposal->number_of_uploads : 'Unlimited' }}</p>
                @if($proposal->filetypes)
                    <p class="mb-2"><span class="font-bold">Accepted filetypes:</span>
                        {{ Competition::filetypesToFormats($proposal->filetypes) }}
                    </p>
                @endif
            </div>

            @if($proposal->rules)
                <h2 class="text-xl font-bold">Rules</h2>
                <p class="mb-2">{{ $proposal->rules }}</p>
            @endif

            <h2 class="text-xl font-bold">Prize</h2>
            <p class="mb-2">{{ $proposal->prize }}</p>

            @if($proposal->company)
                <p class="mb-2"><span class="font-bold">Company:</span> {{ $proposal->company }}</p>
            @endif


            <div class="m-auto mt-8">
                <button
                    wire:click="acceptCompetition({{ $proposal->id }})"
                    class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                    Accept
                </button>
                <button
                    wire:click="declineCompetition({{ $proposal->id }})"
                    class="border-tm-orange hover:bg-gray-100 hover:border-tm-darker-orange border-2 transition text-tm-orange hover:text-tm-darker-orange font-bold py-2 px-4 rounded">
                    Decline
                </button>
            </div>
        </div>
        <div class="me-8 my-auto">
            <img src="{{ $proposal->path_to_photo }}" alt="{{ $proposal->name }}"
                 class="w-80 h-80 object-cover">
        </div>
    </div>
</div>
