<div>
    @if(!count($proposals))
        <h1 class="text-2xl font-bold text-center">No proposals at the moment. Please check again later!</h1>
    @else
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
