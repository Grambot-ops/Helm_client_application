@use('Carbon\Carbon')
<div>
    <div class="bg-white p-8 rounded-xl border border-1 shadow-xl border-gray-200 flex col justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $submission->title }}</h1>
            <p class="mb-2">
                @if($submission->description)
                    {{ $submission->description }}
                @else
                    <i class="text-gray-400">No description</i>
                @endif
            </p>

            <div class="pb-4">
                <p class="mb-2"><span class="font-bold">By:</span> {{ $submission->participation->user->fullname }}</p>
            </div>

            <div class="pb-4">
                <p class="mb-2"><span class="font-bold">Submission date:</span> {{ Carbon::parse($submission->created_at)->format('d/m/Y H:i') }}</p>
            </div>

            <div class="pb-4">
                @if(is_null($competition->filetypes))
                    <p class="mb-2"><span class="font-bold">Link:</span>{{ $submission->link }}</p>
                @else
                    <p class="mb-2"><span class="font-bold">File:</span> <a class="text-blue-500 underline" href="{{ Storage::url($submission->path) }}">click to view submitted file</a></p>
                @endif
            </div>
        </div>
        <div class="me-8 my-auto">
            <img src="{{ $submission->path_to_photo ?? asset('assets/card-top.jpg') }}" alt="{{ $submission->name }}"
                 class="w-80 h-80 object-cover">
        </div>
    </div>
</div>
