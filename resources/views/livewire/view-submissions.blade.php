<div>
    <x-slot name="subtitle">Manage notifications</x-slot>
    <div class="bg-white pb-6">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($submissions as $submission)
                    @if($submission->participation->competition_id == 9)
                        <div class="w-full rounded overflow-hidden shadow-lg"
                        wire:key="{{ $submission->id }}">
                        <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="justify-between flex">
                                <div class="font-bold text-xl mb-2">{{$submission->participation->user->name}}</div>
                                <div class="font-bold mt-1">

                                    <x-button wire:click="openInfo({{$submission}})" class="bg-white px-0.5 mx-05 hover:bg-white" href="#">
                                    <x-phosphor-info class="inline-block w-6 h-6 mb-1 text-blue-400"/>
                                    </x-button>
                                    <x-button wire:click="openDelete({{$submission}})" class="bg-white px-0.5 mx-0.5 hover:bg-white" href="#">
                                    <x-phosphor-trash class="inline-block w-6 h-6 mb-1 text-red-600"/>
                                    </x-button>
                                </div>
                            </div>
                            <p class="text-blue-300 text-sm mb-2">
                                {{ $submission->participation->user->name }}
                            </p>
                            <p class="text-gray-700 text-base">
                                {{ $submission->description }}
                            </p>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <x-dialog-modal wire:model="showModalDelete">
        <x-slot name="title">
        </x-slot>
        <x-slot name="content">
            <div class="flex">
                <div class="text-base">
                    <p class="py-3">
                        Are you sure you want to delete <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->id : '' }} ?</span>
                    </p>
                    <p class="py-3">
                       participant: <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->participation->user->name : ''  }}</span>
                    </p>
                    <p class="py-3">
                        Description: <span class="font-bold"> {{ $submissionToDelete ? $submissionToDelete->description : ''  }}</span>
                    </p>
                </div>
                <div>
                    <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDelete" class="mx-3">Cancel</x-secondary-button>
            <x-button wire:click="deleteSubmission">Delete</x-button>
        </x-slot>
    </x-dialog-modal>



    <x-dialog-modal wire:model="showModalInfo">
        <x-slot name="title">
            <h2>{{ $submissionToShowInfo ? $submissionToShowInfo->id : '' }} submission</h2>
        </x-slot>
        <x-slot name="content">
            <p>
                hello
            </p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeInfo">Close</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
