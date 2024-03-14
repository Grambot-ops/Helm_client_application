@php use App\Models\Like; @endphp
<div>
    <x-slot name="title">Ranking {{ $competition -> title}}</x-slot>
    <h1 class="text-3xl mb-4 font-bold">Ranking</h1>
    <br>
    <h1 class="text-3xl mb-4 font-bold">{{ $competition -> title}}</h1>
    <x-tmk.section>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-14">
                <col class="w-40">
                <col class="w-max">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>#</th>
                <th>Name</th>
                <th># of votes</th>
            </thead>
            <tbody>
            @forelse($likes as $like)
                <tr
                    wire:key="{{ $like->id }}"
                    class="border-t border-gray-300">
                    <td>{{$i++}}</td>
                    <td>{{$like->user->name}} {{$like->user->surname}}</td>
                    <td>{{$this -> likesById($like->user_id,$like->competition_id)}}</td>
            @empty
                <tr>
                    <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <div class="font-bold italic text-sky-800">No users found</div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-tmk.section>
</div>
