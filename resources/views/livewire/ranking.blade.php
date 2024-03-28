@php use App\Models\Like; @endphp
<div>
    <x-slot name="title">Ranking {{ $competition -> title}}</x-slot>
    <h1 class="text-3xl mb-4 font-bold">Ranking - {{ $competition -> title}}</h1>
    <svg class="mb-4" width="300" height="200" xmlns="http://www.w3.org/2000/svg">
        <rect width="100" height="100" x="0" y="100" fill="gray"/>
        <rect width="100" height="150" x="100" y="50" fill="gold"></rect>
        <rect width="100" height="50" x="200" y="150" fill="orange"></rect>
        {{$i=1}}
        @foreach($podium as $place)
            <text x={{$i*100}} y="190" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                @if($place)
                    {{$place->user->surname}}
                @else
                    No votes
                @endif
            </text>
            @if($i == 1)
                {{$i=0}}
            @else
                {{$i=2}}
            @endif
        @endforeach
        {{$i=1}}
    </svg>
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
                    <td class="p-2">{{$i++}}</td>
                    <td class="p-2">{{$like->user->name}} {{$like->user->surname}}</td>
                    <td class="p-2">{{$this -> likesById($like->user_id,$like->competition_id)}}</td>
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
