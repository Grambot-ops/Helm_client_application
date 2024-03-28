<div>
    <x-slot name="subtitle">Manage notifications</x-slot>
    <div class="pb-6">
        <h1 class="text-center text-3xl mb-4 font-bold">Submissions for competition {{ $competition_name }}</h1>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-12">
                @foreach($submissions as $submission)
                    @if($submission->participation->competition_id == $competition)
                        <div class="w-full rounded overflow-hidden shadow-lg"
                        wire:key="{{ $submission->id }}">
                        <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="justify-between flex">
                                <div class="font-bold text-xl mb-2">{{$submission->participation->user->name}}</div>
                                <div class="font-bold mt-1">
                                    <x-button wire:click="openInfo({{$submission}})" class="bg-transparent hover:bg-transparent enabled:bg-transparent focus:bg-transparent px-0.5 mx-05" href="#">
                                    <x-phosphor-info class="inline-block w-6 h-6 mb-1 text-blue-400"/>
                                    </x-button>
                                    <x-button wire:click="openDelete({{$submission}})" class="bg-transparent hover:bg-transparent active:bg-transparent enabled:bg-transparent focus:bg-transparent px-0.5 mx-0.5" href="#">
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
            <h2>More info about the submission from <span class="font-bold"> {{ $submissionToShowInfo ? $submissionToShowInfo->participation->user->name : '' }}</h2>
        </x-slot>
        <x-slot name="content">
                <div class="flex">
                    <div class="text-base">
                        <p class="py-3">
                            Title: <span class="font-bold text-blue-300"> {{ $submissionToShowInfo ? $submissionToShowInfo->participation->user->name : ''  }}</span>
                        </p>
                        <p class="py-3">
                            Description: <span class="font-bold"> {{ $submissionToShowInfo ? $submissionToShowInfo->description : ''  }}</span>
                        </p>
                    </div>
                    <div>
                        <img class="w-full" src="{{  URL::asset('/assets/card-top.jpg')  }}" alt="Sunset in the mountains">
                    </div>
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeInfo">Close</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
