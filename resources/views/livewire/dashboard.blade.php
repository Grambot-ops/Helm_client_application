<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">@if($likedOnly == True) Saved @endif @if($ownOnly == True) My Own @endif Competition @if($ownOnly == True)'s @endif</h1>

    <div class="container mx-auto px-14">
        <div class="grid grid-rows-3 grid-flow-col gap-4">
            <div class="row-span-3">
                <button class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-2">
                    Propose Competition
                </button>
                <button wire:click="toggleOwnOnly" class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-2">
                    View own competitions
                </button>
                <br>
                <button wire:click="toggleLikedOnly" class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-2">
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
                                open="{{ $competition->open }}"
                                vote="{{ $competition->vote }}"
                                upload="{{ $competition->upload }}"
                                description="{{ $competition->description }}"
                                picture="{{ $competition->path_to_photo ?? '/assets/card-top.jpg'}}"
                                hashtags="{{ $competition->competition_category->name }}">
                        <div>
                            <a href="{{ route('apply', ['id' => urlencode($competition->id)]) }}">
                                @if( $competition->user_id == Auth::id())
                                    <button
                                        class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                                        Manage submissions
                                    </button>
                                @else
                                    <button
                                        class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                        See more info
                                    </button>
                                @endif
                            </a>
                            @if( date('Y-m-d') < $competition->start_date)
                                @if( $competition->user_id == Auth::id())
                                    <button
                                        class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        Manage
                                    </button>
                                @else
                                    <button
                                        class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        Apply
                                    </button>
                                @endif
                            @elseif( $competition->submission_date < date('Y-m-d') &&  date('Y-m-d') < $competition->end_date)
                                <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                                    @if( $competition->user_id == Auth::id())
                                        <button
                                            class="bg-yellow-600 hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                            Determine Winners
                                        </button>
                                    @else
                                        <button
                                            class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                            Vote
                                        </button>
                                    @endif
                                </a>
                            @elseif( $competition->end_date < date('Y-m-d'))

                                @if( $competition->user_id == Auth::id())
                                    <button
                                        class="bg-tm-blue hover:bg-yellow-600 transition text-white font-bold py-2 px-4 rounded">
                                        <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
                                           Ranking
                                        </a>
                                    </button>
                                @else
                                    <button
                                        class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                        <a href="{{ route('ranking', ['id' => urlencode($competition->id)]) }}">
                                            Ranking
                                        </a>
                                    </button>
                                @endif
                            @elseif( $competition->start_date < date('Y-m-d') && date('Y-m-d') < $competition->submission_date)
                                    @if( $competition->user_id == Auth::id())
                                        <button
                                            class="bg-tm-blue hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                                            Manage
                                        </button>
                                    @else
                                        <button
                                            class="bg-tm-blue hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                            Upload
                                        </button>
                                    @endif
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

