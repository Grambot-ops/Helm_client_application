<div class="lg:px-14">
    <h1 class="font-bold text-2xl">View/accept proposals</h1>
    <p class="mb-2">
        {{ count($proposals) != 0 ? 'Accept or deny the proposed competitions below.' : 'No proposals at the moment. Please check again later!' }}
    </p>
    @if(count($proposals))
    <x-tmk.card-container>
        @foreach($proposals as $proposal)
            <x-tmk.card title="{{ $proposal->title }}"
                        wire:key="{{ $proposal->id }}"
                        picture="{{ $proposal->path_to_photo }}"
                        description="{{ $proposal->description }}">
                <div class="m-auto">
                    <a href="{{ route('admin.accept-competition', ['id' => urlencode($proposal->id)]) }}">
                    <button class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-8 my-2 rounded">
                            See more info
                    </button>
                    </a>
                </div>
            </x-tmk.card>
        @endforeach
    </x-tmk.card-container>
    @endif
</div>
