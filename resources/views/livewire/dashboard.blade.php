<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Competitions</h1>

    <div class="container mx-auto px-14">
        <div class="grid lg:grid-cols-3 gap-12">
            @foreach($competitions as $competition)
                @if($competition->accepted)
                    <x-tmk.card title="{{ $competition->title }}"
                                closed="{{ $competition->closed }}"
                                description="{{ $competition->description }}"
                                picture="{{ $competition->path_to_photo ?? '/assets/card-top.jpg'}}"
                                hashtags="{{ $competition->competition_category->name }}">
                        <div>
                            <button
                                class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                <a href="{{ route('apply', ['competitionName' => urlencode($competition->title)]) }}" class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                    See more info
                                </a>
                            </button>
                            @if( date('Y-m-d') < $competition->start_date)
                            <button
                                class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                Apply
                            </button>
                            @elseif( $competition->start_date < date('Y-m-d') ||  date('Y-m-d') < $competition->submission_date)
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    Submit
                                </button>
                            @elseif( $competition->submission_date < date('Y-m-d') ||  date('Y-m-d') < $competition->end_date)
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    Vote
                                </button>
                            @elseif( $competition->submission_date < date('Y-m-d'))
                                <button
                                    class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                    Ranking
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
        </div>
    </div>

    @push('script')
        <script>
            console.log('The TMCP JavaScript works! 🙂')
        </script>
    @endpush
</div>

