<div class="container">
    <x-slot name="description">Thomas More Competition Platform</x-slot>

    <x-slot name="title">Propose Competition</x-slot>

    <h1 class="text-center text-3xl mb-4 font-bold">Propose Competition</h1>
    <p class="text-center text-gray-500">Welcome to the competition creation page! To initiate the process, kindly fill
        out the required fields marked with an asterisk (*). Please note that all applications will undergo a review
        process, and acceptance notifications will be issued within 1-3 working days.</p>


    @if ($errors->any())
        <x-tmk.alert type="danger">
            <x-tmk.list>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </x-tmk.list>
        </x-tmk.alert>
    @endif


    <p class="mt-7 ml-3">Title <span class="text-[#fa6432]">*</span></p>
    <x-input class="w-full"
             wire:model="form.title"
             placeholder=""/>

    <p class="mt-5 ml-3">Description <span class="text-[#fa6432]">*</span></p>
    <x-tmk.form.textarea id="descriptionTextarea" class="w-full textarea-competition"
                         wire:model="form.description"
                         placeholder=""/>

    <div class="grid grid-cols-3 gap-5 mt-7">
        <div>
            <p class="mb-2">Select an image</p>
            <!-- Placeholder Image -->
            <a id="imageLink" href="#">
                <img id="placeholderImage" src="/assets/placeholder-image.svg" alt="competition image" onclick="uploadImage()" class="border-8 border-gray-500">
            </a>

            <script>
                // Function to handle the click event and trigger the file upload dialog
                function uploadImage() {
                    document.getElementById('imageInput').click();
                }
            </script>

            <!-- Hidden input element for file upload -->
            <input type="file" id="imageInput" wire:model="form.photo" style="display: none;">
        </div>
        <div class="col-span-2">
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <p class="mb-2">Competition type <span class="text-[#fa6432]">*</span></p>
                    <x-tmk.form.select wire:model="form.competition_type_id" id="competition_type_id" class="w-full">
                        <option value="">Select a competition type</option>
                        @foreach($competition_types as $competitionType)
                            <option value="{{ $competitionType->id }}">{{ $competitionType->name }}</option>
                        @endforeach
                    </x-tmk.form.select>
                </div>
                <div>
                    <p class="mb-2">Competition category</p>
                    <x-tmk.form.select wire:model="form.competition_category_id" id="competition_category_id" class="w-full">
                        <option value="">Select a competition category</option>
                        @foreach($competition_categories as $competitionCategory)
                            <option value="{{ $competitionCategory->id }}">{{ $competitionCategory->name }}</option>
                        @endforeach
                    </x-tmk.form.select>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5 mt-16">
                <div>
                    <p class="mb-2">Start Date <span class="text-[#fa6432]">*</span></p>
                    <x-input class="w-full"
                             wire:model="form.start_date"
                             placeholder=""
                             type="date"/>
                </div>
                <div>
                    <p class="mb-2">Submission Date <span class="text-[#fa6432]">*</span></p>
                    <x-input class="w-full"
                             wire:model="form.submission_date"
                             placeholder=""
                             type="date"/>
                </div>
                <div>
                    <p class="mb-2">End Date <span class="text-[#fa6432]">*</span></p>
                    <x-input class="w-full"
                             wire:model="form.end_date"
                             placeholder=""
                             type="date"/>
                </div>
            </div>
        </div>
    </div>


    <p class="mt-7 ml-3">Rules</p>
    <x-input class="w-full"
             wire:model="form._rules"
             placeholder=""/>

    <p class="mt-7 ml-3">Prizes <span class="text-[#fa6432]">*</span></p>
    <x-input class="w-full"
             wire:model="form.prize"
             placeholder=""/>

    <p class="mt-7 ml-3">Winner criteria <span class="text-[#fa6432]">*</span></p>
    <div class="mb-7">
        <x-input type="radio" id="by-vote" name="by-vote-selection" value="1" wire:model="form.by_vote"></x-input>
        <label for="by-vote">by vote</label>
        <br>
        <x-input type="radio" id="by-selection" name="by-vote-selection" value="0" wire:model="form.by_vote"></x-input>
        <label for="by-selection">by selection</label>
    </div>
    <hr>
    <p class="mt-7 ml-3">Terms of Agreement <span class="text-[#fa6432]">*</span></p>
    <div class="mb-7">
        <x-input type="checkbox" wire:model.live="termsOfAgreement"></x-input>
        <label for="">I confirm that this competitions agree with Thomas More's competitions terms and acknowledge that
            the competition could be denied if the terms are not met.</label>
    </div>
    <hr>

    <div class="grid grid-cols-7 gap-1 mt-7 text-center">
        <div></div>
        <div></div>
        <div>
            @if($termsOfAgreement)
                    <button
                        class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded mb-2 border-2 border-tm-orange hover:border-tm-darker-orange"
                        wire:click="createCompetition()">
                        propose competition
                    </button>
            @else
                <button
                    class="bg-gray-300 opacity-50 transition font-bold py-2 px-4 rounded mb-2 border-2 border-gray-300"
                    wire:click="createCompetition()" disabled>
                    propose competition
                </button>
            @endif
        </div>
        <div>
            <button class="font-bold py-2 px-4 rounded mb-2 border-2">
                cancel
            </button>
        </div>
        <div>
            <button class="font-bold py-2 px-4 rounded mb-2 border-2">
                Back to homepage
            </button>
        </div>
        <div></div>
        <div></div>
    </div>
</div>

