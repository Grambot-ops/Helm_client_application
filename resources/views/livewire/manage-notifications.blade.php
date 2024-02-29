<div>
    <x-slot name="subtitle">Manage notifications</x-slot>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($notifications as $noti)
                <article class="flex max-w-xl flex-col items-start justify-between border-e-2">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <span class="absolute inset-0"></span>
                                Notification: Begin Competition
                        </h3>
                        <p class="mt-5  text-sm leading-6 text-gray-600">
                            {{ $noti->description }} </p>
                    </div>
                    <div class="relative mt-8 flex items-center gap-x-4">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                                <x-button class="bg-tm-orange" href="#">
                                    <span class="absolute inset-0"></span>
                                    Edit
                                </x-button>
                            </p>
                        </div>
                    </div>
                </article>
                @endforeach
                <!-- More posts... -->
            </div>
        </div>
    </div>

</div>
