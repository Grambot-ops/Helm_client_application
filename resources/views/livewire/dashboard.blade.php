<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Competitions</h1>

    <div class="container mx-auto px-14">
        <div class="grid grid-cols-3 gap-12">
            @foreach($competitions as $competition)
            <div class="w-full rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="justify-between flex mb-2">
                        <div class="font-bold text-xl mb-2">{{ $competition->title }}</div>
                        <div class="text-red-800 font-bold mt-1">closed
                            <x-phosphor-lock-simple class="inline-block w-6 h-6 mb-1"/>
                        </div>
                    </div>
                    <p class="text-gray-700 text-base">
                        {{ $competition->description }}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">test</span>
                </div>
                <div class="px-6 pt-2 pb-4 flex justify-between">
                    <div>
                        <button
                            class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
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
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @push('script')
        <script>
            console.log('The TMCP JavaScript works! 🙂')
        </script>
    @endpush
</div>

