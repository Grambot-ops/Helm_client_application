<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Competitions</h1>

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
                <button class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mb-5">
                    Saved competitions
                </button>
            </div>
            <x-input class="row-span-3 col-span-3 m-7"
                     placeholder="Filter on title or description"/>
        </div>
        <div class="grid lg:grid-cols-3 gap-12">
            @foreach($competitions as $competition)
                @if($competition->accepted)
                    <x-tmk.card title="{{ $competition->title }}"
                                closed="{{ $competition->closed }}"
                                description="{{ $competition->description }}"
                                picture="{{ $competition->path_to_photo ?? '/assets/card-top.jpg'}}">
                        <div>
                            <button
                                class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 my-2 rounded">
                                See more info
                            </button>
                            <button
                                class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded">
                                Ranking
                            </button>
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

