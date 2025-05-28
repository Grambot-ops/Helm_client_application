@php use App\Models\Like;use App\Models\Vote; @endphp
<div>
    <x-slot name="title">Ranking {{ $competition -> title}}</x-slot>
    <h1 class="text-3xl mb-4 font-bold">Ranking - {{ $competition -> title}}</h1>
    @if($competition->by_vote)
        <div id="rankingbigdiv" class="relative flex justify-between">
            <div>
        <svg class="mb-4" width="350" height="200" xmlns="http://www.w3.org/2000/svg">
        <rect width="100" height="100" x="0" y="100" fill="gray"/>
        <rect width="100" height="150" x="100" y="50" fill="gold"></rect>
        <rect width="100" height="50" x="200" y="150" fill="orange"></rect>
        {{$i=1}}
        {{$j=0}}
            <defs>
                <circle id="circle" cx="{{150}}" cy="{{45}}" r="25"/>
                <clipPath id="round">
                    <use xlink:href="#circle"/>
                </clipPath>
                <circle id="circle1" cx="{{50}}" cy="{{95}}" r="25"/>
                <clipPath id="round1">
                    <use xlink:href="#circle1"/>
                </clipPath>
                <circle id="circle2" cx="{{250}}" cy="{{145}}" r="25"/>
                <clipPath id="round2">
                    <use xlink:href="#circle2"/>
                </clipPath>
            </defs>
        @foreach($podium as $place)
                @if($i == 1)
                    @if($place->votes_count > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round)"
                                   href="{{Storage::url($place->first()->user->profile_photo_path)}}"/>
                        @endif
                    @endif
                    {{$i=0}}
                @elseif($i==0)
                    @if($place->votes_count > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round1)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round1)"
                                   href="{{Storage::url($place->first()->user->profile_photo_path)}}"/>
                        @endif
                    @endif
                {{$i=2}}
                @else
                    @if($place->votes_count > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round2)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round2)"
                                   href="{{Storage::url($place->first()->user->profile_photo_path)}}"/>
                        @endif
                    @endif
            @endif
            {{$j++}}
        @endforeach


        {{$i=1}}
    </svg>
                </div>
                <div id="rankingrightdiv" class="absolute bottom-4 right-0">
                    <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                        <button
                            class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                            View all submissions
                        </button>
                    </a>
                </div>
            </div>

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
                <th>Profile picture</th>
                <th>Name</th>
                <th># of votes</th>
            </thead>
            <tbody>
            @foreach($participations as $participation)
                <tr class="border-b border-gray-300">
                    <td>{{$i++}}</td>
                    @if($participation->first()->user->profile_photo_path==null)
                        <td><img width="50px" height="50px" src="{{asset('assets/profile_pictures/default.jpg')}}"
                                 alt=""/></td>
                    @else
                        <td><img width="50px" height="50px"
                                 src="{{Storage::url($participation->first()->user->profile_photo_path)}}"
                                 alt=""/></td>
                    @endif
                    <td>{{$participation->first()->user->name}} {{$participation->first()->user->surname}}</td>
                    <td>{{$participation->votes_count}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-tmk.section>
    @else
        <div id="rankingbigdiv" class="relative flex justify-between">
            <div>
        <svg class="mb-4" width="350" height="250" xmlns="http://www.w3.org/2000/svg">
            <rect width="100" height="100" x="0" y="150" fill="gray"/>
            <rect width="100" height="150" x="100" y="100" fill="gold"></rect>
            <rect width="100" height="50" x="200" y="200" fill="orange"></rect>
            {{$i=1}}
            {{$j=0}}
            <defs>
                <circle id="circle" cx="{{150}}" cy="{{45}}" r="25"/>
                <clipPath id="round">
                    <use xlink:href="#circle"/>
                </clipPath>
                <circle id="circle1" cx="{{50}}" cy="{{95}}" r="25"/>
                <clipPath id="round1">
                    <use xlink:href="#circle1"/>
                </clipPath>
                <circle id="circle2" cx="{{250}}" cy="{{145}}" r="25"/>
                <clipPath id="round2">
                    <use xlink:href="#circle2"/>
                </clipPath>
            </defs>
            @foreach($podium as $place)
                @if($i == 1)
                    @if($place->ranking > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round)" href="{{Storage::url($place->user->profile_photo_path)}}"/>
                        @endif
                        <text x={{$i*100}} y={{95+$j*50}} >
                            {{$place->user->name}} {{$place->user->surname}}
                        </text>
                    @else
                        No votes
                    @endif
                    {{$i=0}}
                @elseif($i==0)
                    @if($place->ranking > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round1)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round1)" href="{{Storage::url($place->user->profile_photo_path)}}"/>
                        @endif
                        <text x={{$i*100}} y={{95+$j*50}} >
                            {{$place->user->name}} {{$place->user->surname}}
                        </text>
                    @else
                        No votes
                    @endif
                    {{$i=2}}
                @else
                    @if($place->ranking > 0)
                        @if($place->first()->user->profile_photo_path==null)
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" alt="profile" height="50px" width="50px"
                                   clip-path="url(#round2)" href="{{asset('assets/profile_pictures/default.jpg')}}"/>
                        @else
                            <image x="{{$i*100+25}}" y="{{20+$j*50}}" height="50px" width="50px" alt="profile"
                                   clip-path="url(#round2)" href="{{Storage::url($place->user->profile_photo_path)}}"/>
                        @endif
                        <text x={{$i*100}} y={{95+$j*50}} >
                            {{$place->user->name}} {{$place->user->surname}}
                        </text>
                    @else
                        No votes
                    @endif
                @endif
                {{$j++}}
            @endforeach
            {{$i=1}}
        </svg>
        </div>
            <div id="rankingrightdiv" class="absolute bottom-4 right-0">
                <a href="{{ route('all-submissions', ['id' => urlencode($competition->id)]) }}">
                    <button
                        class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded">
                        View all submissions
                    </button>
                </a>
            </div>
        </div>

        <x-tmk.section>
            @if($podium->count()<1)
                <p>No ranking available yet. When the competition organiser has chosen the winners, they will appear
                    here.</p>
            @else
                <p>This ranking has been determined by the competition organiser.</p>
            @endif
        </x-tmk.section>
    @endif
</div>
