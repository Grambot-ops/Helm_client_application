<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Competitions</h1>

    <div class="container mx-auto px-14">
        <div class="grid grid-cols-3 gap-12">
            @foreach($competitions as $competition)
<<<<<<< HEAD
            <x-tmk.card >

=======
            <x-tmk.card title="{{ $competition->title }}"
                        closed="{{ $competition->closed }}"
                        description="{{ $competition->description }}">
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
>>>>>>> c30f5af8cd496815873f333b095c250b8722ae8d
            </x-tmk.card>
            @endforeach
        </div>
    </div>

    @push('script')
        <script>
            console.log('The TMCP JavaScript works! 🙂')
        </script>
    @endpush
</div>

