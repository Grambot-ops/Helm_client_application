<div>
    <x-dialog-modal wire:model="showApplyConfirmationModal">
        <x-slot name="title">Confirmation</x-slot>

        <x-slot name="content">
            Are you sure you want to apply for this competition?
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="apply" class="bg-tm-blue text-white px-4 py-2 mr-2">Confirm</x-button>
            <x-secondary-button @click="$wire.showApplyConfirmationModal = false" class="px-4 py-2">Cancel</x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">@if($likedOnly == True) Saved @endif Competition</h1>

    <div class="container mx-auto px-14">
        <div class="grid grid-rows-3 grid-flow-col gap-4">
            <div class="row-span-3">
                <button class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-2">
                    Propose Competition
                </button>
                <button class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-2">
                    View own competitions
                </button>
                <br>
                <button wire:click="toggleLikedOnly" class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-5">
                    Saved competitions
                </button>
            </div>
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-10 md:col-span-5 lg:col-span-3">
                    <x-label for="name" value="Filter"/>
                    <div class="relative">
                        <x-input id="name" type="text"
                                 wire:model.live.debounce.500ms="name"
                                 class="block mt-1 w-full" placeholder="Filter Title Or Description"/>
                        <button
                            @click="$wire.set('name', '')"
                            class="w-5 absolute right-4 top-3">
                            <x-phosphor-x/>
                        </button>
                    </div>
                </div>

                <div class="col-span-5 md:col-span-2 lg:col-span-2">
                    <x-label for="category" value="Category"/>
                    <x-tmk.form.select id="category"
                                       wire:model.live="category"
                                       class="block mt-1 w-full">
                        <option value="%">All Categories</option>
                        @foreach($allCategories as $g)
                            <option value="{{ $g->id }}">
                                {{ $g->name }}
                            </option>
                        @endforeach
                    </x-tmk.form.select>
                </div>
            </div>
        </div>
        {{-- No records found --}}
        @if($competitions->isEmpty())
            <x-tmk.alert type="danger" class="w-full">
                Can't find any competitions with <b>'{{ $name }}'</b> as a search-term
            </x-tmk.alert>
        @endif
        <x-tmk.card-container>
            @foreach($competitions as $competition)
                @if($competition->accepted)
                    <x-tmk.card title="{{ $competition->title }}"
                                closed="{{ $competition->closed }}"
                                description="{{ $competition->description }}"
                                picture="{{ $competition->path_to_photo ?? '/assets/card-top.jpg'}}"
                                hashtags="{{ $competition->competition_category->name }}">
                        <div>
                            <a href="{{ route('apply', ['id' => urlencode($competition->id)]) }}">
                                <button
                                    class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                    See more info
                                </button>
                            </a>
                            @if( date('Y-m-d') < $competition->start_date)
                                <button
                                    wire:click="applyConfirmation({{ $competition->id }})"
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    Apply
                                </button>
                            @elseif( $competition->start_date < date('Y-m-d') &&  date('Y-m-d') < $competition->submission_date)
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    Submit
                                </button>
                            @elseif( $competition->submission_date < date('Y-m-d') &&  date('Y-m-d') < $competition->end_date)
                                <a href="{{ route('all-submissions', ['id' => urlencode($competition->id), 'title' => urlencode($competition->title)]) }}">
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        Vote
                                </button>
                                </a>
                            @elseif( $competition->submission_date < date('Y-m-d'))
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
                                        Ranking
                                    </a>
                                </button>
                            @endif
                        </div>
                        <button
                            class="text-gray-400 hover:text-yellow-300 transition border-gray-300">
                            <x-phosphor-star-duotone class="inline-block w-7 h-7"/>
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

