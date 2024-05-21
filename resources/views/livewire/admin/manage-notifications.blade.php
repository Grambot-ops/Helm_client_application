<div>
    <x-slot name="subtitle">Manage notifications</x-slot>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Manage notifications</h1>
            <x-button class="bg-tm-blue hover:bg-tm-darker-blue focus:bg-tm-darker-blue"
                      @click="$wire.showNewModal = true">
                Add new notification
            </x-button>
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                @foreach($notifications as $noti)
                <article class="flex max-w-xl flex-col items-start justify-between border-e-2">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <span class="absolute inset-0"></span>
                            {{$noti->title}}
                        </h3>
                        <p class="mt-5  text-sm leading-6 text-gray-600">
                            {{ $noti->description }} </p>
                    </div>
                    <div class="relative mt-8 flex items-center gap-x-4">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                                <x-button wire:click="openEdit({{$noti->id}})" class="bg-tm-blue" href="#">
                                    Edit
                                </x-button>
                            </p>
                        </div>
                        <div class="text-sm leading-6">
                        <x-button
                            wire:click="deleteNoti({{$noti}})"
                            wire:confirm="Are you sure you want to delete this notification?"
                            class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                            <x-phosphor-trash-duotone class="inline-block w-5 h-5"/>
                        </x-button>
                        </div>
                    </div>
                    <div class="relative mt-8 flex items-center gap-x-4">

                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
        <x-dialog-modal wire:model="showNewModal">
            <x-slot name="title">
                Add new notification
            </x-slot>
            <x-slot name="content">
                <div class="flex-grow">
                    <h3>Title</h3>
                    <x-input id="notiTitle" type="text" placeholder="Title" wire:model="title"
                             class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-md focus:outline-none focus:border-blue-400 placeholder-gray-500"/>
                    <br>
                    <h3 class="mt-2">Description</h3>
                    <x-tmk.form.textarea rows="6" class="w-full mb-1" id="description" type="text" placeholder="description" wire:model="description">
                    </x-tmk.form.textarea>
                    <p class="mt-2">Time before competition that the notification will be sent</p>
                    <x-input class="w-full mb-3" id="interval" type="text" placeholder="interval" wire:model="interval"/>
                </div>
                <label class="inline-flex items-center mt-3">
                    <input type="radio" class="form-radio" value="begin" wire:model="notificationType">
                    <span class="ml-2">Begin</span>
                </label>
                <label class="inline-flex items-center mt-3">
                    <input type="radio" class="form-radio" value="end" wire:model="notificationType">
                    <span class="ml-2">End</span>
                </label>
                <label class="inline-flex items-center mt-3">
                    <input type="radio" class="form-radio" value="submission" wire:model="notificationType">
                    <span class="ml-2">Submission</span>
                </label>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="createNotification()" class="bg-tm-blue hover:bg-tm-darker-blue mx-2">
                    Add new notification
                </x-button>
                <x-secondary-button @click="$wire.showNewModal = false">
                    Cancel
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal wire:model.blur="showModalEdit">
            <x-slot name="title">
                <h2>Edit notification</h2>
            </x-slot>
            <x-slot name="content" class="mx-auto">
                <p>Title</p>
                <x-input class="w-full mb-3" id="title" type="text" placeholder="Title" wire:model="editNotification.title"/>
                <br>
                <p>Description</p>
                <x-tmk.form.textarea rows="6" class="w-full mb-3" id="description" type="text" placeholder="Description" wire:model="editNotification.description"/>
                <br>
                <p class="mb-2">Before what event should the notification be sent?</p>
                <label>
                    <input type="radio" wire:model="editNotification.interval_before_date" value="begin" @if($editNotification['interval_before_date'] == 'begin') checked @endif> Begin
                </label>
                <label>
                    <input type="radio" wire:model="editNotification.interval_before_date" value="submission" @if($editNotification['interval_before_date'] == 'submission') checked @endif> Submission
                </label>
                <label>
                    <input type="radio" wire:model="editNotification.interval_before_date" value="end" @if($editNotification['interval_before_date'] == 'end') checked @endif> End
                </label>
                <p class="mt-3">Days before the notifications will be sent</p>
                <x-input class="w-full mb-3" id="interval" type="text" placeholder="Interval" wire:model="editNotification.interval_default"/>
                <br>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button class="mr-2" wire:click="closeEdit">Cancel</x-secondary-button>
                <x-button wire:click="editNoti({{$noti->id}})">Update notification</x-button>
            </x-slot>
        </x-dialog-modal>


</div>
