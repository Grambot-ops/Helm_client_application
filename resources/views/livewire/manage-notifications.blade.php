<div>
    <x-slot name="subtitle">Manage notifications</x-slot>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <article class="flex max-w-xl flex-col items-start justify-between border-e-2">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <span class="absolute inset-0"></span>
                                Notification: Begin Competition
                        </h3>
                        <p class="mt-5  text-sm leading-6 text-gray-600">
                            Get ready to unleash your talents, ignite your passions and embark on a thrilling
                        journey of competition! We are thrilled to announce the commencement of our much-anticipated
                        competition!!!</p>
                    </div>
                    <p>Amount of days before the deadline that this notification will be sent out:</p>
                    <x-input></x-input>
                    <div class="relative mt-8 flex items-center gap-x-4">

                        <div class="text-sm leading-6">

                            <p class="font-semibold text-gray-900">
                                <x-button href="#">
                                    <span class="absolute inset-0"></span>
                                    Edit
                                </x-button>
                            </p>
                        </div>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between border-e-2">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Notification: Deadline warning
                        </h3>
                        <p class="mt-5 text-sm leading-6 text-gray-600">
                            We hope this message finds you well and we are filled with excitement
                        to see all of your submissions. As the competition heats up, we're reaching
                        out with an important deadline reminder.</p>
                    </div>
                    <p>Amount of days before the deadline that this notification will be sent out:</p>
                    <x-input></x-input>
                    <div class="relative mt-8 flex items-center gap-x-4">

                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">

                                <x-button href="#">
                                    <span class="absolute inset-0"></span>
                                    Edit
                                </x-button>
                            </p>
                        </div>
                    </div>
                </article>
                <article class="flex max-w-xl flex-col items-start justify-between">
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <span class="absolute inset-0"></span>
                            Notification: End Competition
                        </h3>
                        <p class="mt-5 text-sm leading-6 text-gray-600">
                            With great excitement and a sense of accomplishment, we are thrilled to
                            announce the conclusion of our competition! This marks the end of an incredible
                            journey filled with creativity, innovation and passion from talented individuals like you.</p>
                    </div>
                    <p>Amount of days before the deadline that this notification will be sent out:</p>
                    <x-input></x-input>
                    <div class="relative mt-8 flex items-center gap-x-4">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                                <x-button href="#">
                                    <span class="absolute inset-0"></span>
                                    Edit
                                </x-button>
                            </p>
                        </div>
                    </div>
                </article>
                <!-- More posts... -->
            </div>
        </div>
    </div>

</div>
