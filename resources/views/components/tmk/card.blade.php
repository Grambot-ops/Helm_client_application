@props([
    'title' => '',
    'description' => '',
    'closed' => false,
    'hashtags' => [],
])

<div class="w-full rounded overflow-hidden shadow-lg">
    <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
    <div class="px-6 py-4">
        <div class="justify-between flex mb-2">
            <div class="font-bold text-xl mb-2">{{ $title }}</div>
            @if($closed)
            <div class="text-red-800 font-bold mt-1">closed
                <x-phosphor-lock-simple class="inline-block w-6 h-6 mb-1"/>
            </div>
            @endif
        </div>
        <p class="text-gray-700 text-base">
            {{ $description }}
        </p>
    </div>
    @foreach($hashtags as $hashtag)
    <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
            {{ $hashtags }}
        </span>
    </div>
    @endforeach
    <div class="px-6 pt-2 pb-4 flex justify-between">
        {{ $slot }}
    </div>
</div>
