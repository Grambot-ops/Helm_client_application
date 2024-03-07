<div>
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Competitions</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Competitions</h1>

    <div class="container mx-auto px-14">
        <div class="grid grid-cols-3 gap-12">
            @foreach($competitions as $competition)
            <x-tmk.card >

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

