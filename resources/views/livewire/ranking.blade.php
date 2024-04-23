@php use App\Models\Like;use App\Models\Vote; @endphp
<div>
    <x-slot name="title">Ranking {{ $competition -> title}}</x-slot>
    <h1 class="text-3xl mb-4 font-bold">Ranking - {{ $competition -> title}}</h1>
    <svg class="mb-4" width="300" height="200" xmlns="http://www.w3.org/2000/svg">
        <rect width="100" height="100" x="0" y="100" fill="gray"/>
        <rect width="100" height="150" x="100" y="50" fill="gold"></rect>
        <rect width="100" height="50" x="200" y="150" fill="orange"></rect>
        {{$i=1}}
        {{$j=0}}

        @foreach($podium as $place)
            <text x={{$i*100}} y={{50+$j*50}} textLength="90">
                @if($place)
                    {{$place->name}} {{$place->surname}}
                @else
                    No votes
                @endif
            </text>
            @if($i == 1)
                {{$i=0}}
            @else
                {{$i=2}}
            @endif
            {{$j++}}
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
            @foreach($participations as $participation)
                <tr class="border-b border-gray-300">
                    <td>{{$i++}}</td>
                    <td>{{$participation->first()->user->name}} {{$participation->first()->user->surname}}</td>
                    <td>{{$participation->votes_count}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-tmk.section>
</div>
