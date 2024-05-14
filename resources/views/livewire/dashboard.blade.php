<div>
    <x-dialog-modal wire:model="showApplyConfirmationModal">
        <x-slot name="title">Confirmation</x-slot>

        <x-slot name="content">
            Are you sure you want to apply for this competition?
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="apply" class="bg-tm-blue text-white px-4 py-2 mr-2">Confirm</x-button>
            <x-secondary-button @click="$wire.showApplyConfirmationModal = false" class="px-4 py-2">Cancel
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{--
        HACK: this tag does nothing. But Tailwind does not want to compile the
        classes that I use in my components, so I just am going to stuff it
        with all the classes that I use in my components to trick Tailwind into
        using them. The `invisible` class will tell it not to show it.
        --}}
    <div
        class="text-tm-orange border-tm-orange border-tm-darker-orange border-tm-darker-blue text-tm-blue border-tm-blue border-2 invisible">
    </div>

    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <div class="lg:px-16 m-auto">
        <div class="flex space-x-2 justify-between">
            <h1 class="text-3xl w-max mb-4 font-bold">
                @if($likedOnly)
                    Saved competitions
                @elseif ($ownOnly)
                    My competitions
                @else
                    Competitions
                @endif
            </h1>
            <x-tmk.button href="{{ route('propose-competition') }}" orange="true">
                Propose a competition
            </x-tmk.button>
        </div>
    </div>

    <div class="mx-auto lg:px-14">
        <div class="xl:flex flex-row-reverse justify-center lg:justify-between px-4 items-end mb-16 bg-white/80 py-2 rounded rounded-lg border-2">
            <div class="md:flex justify-center py-2 md:space-x-2">
                <div class="">
                    <div class="relative">
                        <x-input id="name" type="text"
                                 wire:model.live.debounce.500ms="name"
                                 class="block mt-1 w-full" placeholder="Search competition"/>
                        <button
                            @click="$wire.set('name', '')"
                            class="w-5 absolute right-4 top-3">
                            <x-phosphor-x/>
                        </button>
                    </div>
                </div>
                <div>
                    <x-tmk.form.select id="category"
                                       wire:model.live="category"
                                       class="block mt-1 w-full">
                        <option value="%">Category</option>
                        @foreach($allCategories as $g)
                            <option value="{{ $g->id }}">
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </x-tmk.form.select>
                </div>
                <div>
                    <x-tmk.form.select id="status"
                                       wire:model.live="status"
                                       class="block mt-1 w-full">
                        <option value="-1">Status</option>
                        @foreach(['Open', 'Upload', 'Open for voting', 'Closed'] as $key => $state)
                            <option value="{{ $key }}">
                                {{ $state }}
                            </option>
                        @endforeach
                    </x-tmk.form.select>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row w-max mx-auto xl:mx-1 space-x-2 justify-center items-center">
                <x-tmk.button activated="{{ $ownOnly }}" wire:click="toggleOwnOnly">
                    View own competitions
                </x-tmk.button>
                <x-tmk.button activated="{{$likedOnly}}" wire:click="toggleLikedOnly">
                    Saved competitions
                </x-tmk.button>
            </div>
        </div>
        {{-- No records found --}}
        @if($competitions->isEmpty())
            <x-tmk.alert type="danger" class="w-full">
                No search results found.
            </x-tmk.alert>
        @endif
        <x-tmk.card-container>
            @foreach($competitions as $competition)
                @if($competition->accepted)
                    <x-tmk.card title="{{ $competition->title }}"
                                closed="{{ $competition->closed }}"
                                open="{{ $competition->open }}"
                                vote="{{ $competition->vote }}"
                                upload="{{ $competition->upload }}"
                                description="{{ $competition->description }}"
                                picture="{{ $competition->path_to_photo ?? '/assets/card-top.jpg'}}"
                                hashtags="{{ $competition->competition_category->name }}"
                                user_id="{{ $competition->user_id }}"
                                by_vote="{{ $competition->by_vote }}">
                        <div>
                            <a href="{{ route('apply', ['id' => urlencode($competition->id)]) }}">
                                <button
                                    class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                    See more info
                                </button>
                            </a>
                            @if( date('Y-m-d') < $competition->start_date)
                                    @if($competition->participations()->where('user_id', auth()->user()->id)->exists())
                                        <button
                                            class="bg-gray-400 text-white py-2 px-6 rounded inline-block cursor-not-allowed"
                                            disabled>
                                            Applied
                                        </button>
                                    @else
                                        <button
                                            wire:click="applyConfirmation({{ $competition->id }})"
                                            class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                            Apply
                                        </button>
                                    @endif

                            @elseif( $competition->start_date < date('Y-m-d') &&  date('Y-m-d') < $competition->submission_date
                            && $competition->participations()->where('user_id', auth()->user()->id)->exists())
                                <a href="{{ route('upload', ['id' => $competition->id]) }}">
                                <button class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        Submit
                                </button>
                                </a>

                            @elseif( $competition->submission_date < date('Y-m-d') &&  date('Y-m-d') < $competition->end_date)
                                @if( $competition->by_vote)
                                <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                                        <button
                                            class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                            Vote
                                        </button>
                                </a>
                                @endif
                            @elseif( $competition->end_date < date('Y-m-d'))
                                    <button
                                        class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
                                            Ranking
                                        </a>
                                    </button>
                            @endif
                        </div>
                        <button wire:click="toggleLiked({{ $competition->id }})" class="text-gray-400 hover:text-yellow-300 transition border-gray-300">
                            <x-phosphor-star-duotone class="inline-block w-7 h-7 {{ $competition->liked ? 'text-yellow-300' : '' }}"/>
                        </button>
                    </x-tmk.card>
                @endif
            @endforeach
        </x-tmk.card-container>
    </div>

    @push('script')
        <script>
            console.log('The TMCP JavaScript works! 🙂')
        </script>
    @endpush
</div>

