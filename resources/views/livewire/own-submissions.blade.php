<div>
    <x-tmk.card-container>
        @forelse($submissions as $submission)
            <x-tmk.card title="{{ $submission->title }}"
                        wire:key="submission_{{ $submission->id }}"
                        description="{{ $submission->description }}"
                        picture="{{ $submission->path_to_photo ?? '/assets/card-top.jpg'}}">
                <p class="text-gray-400">Belongs to: {{ $competition->title }}</p>
                <div>
                    <x-tmk.button orange="true" href="{{ route('submission', ['id' => urlencode($submission->id)]) }}">
                        More info
                    </x-tmk.button>
                    <x-tmk.button wire:click="deleteSubmission({{ $submission->id }})" wire:confirm="Are you sure you want to delete this submission?">
                        Remove
                    </x-tmk.button>
                </div>
            </x-tmk.card>
        @empty
            <p>You have not submitted anything for this competition yet.</p>
        @endforelse
    </x-tmk.card-container>
</div>
