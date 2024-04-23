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
             wire:model.live="form.title"
             placeholder=""/>

    <p class="mt-5 ml-3">Description <span class="text-[#fa6432]">*</span></p>
    <x-tmk.form.textarea id="descriptionTextarea" class="w-full textarea-competition"
                         wire:model="form.description"
                         placeholder=""/>

    <div class="grid grid-cols-4 gap-5 mt-7">
        <div></div>
        <div>
            <p>Competition type <span class="text-[#fa6432]">*</span></p>
            <x-tmk.form.select wire:model="form.competition_type_id" id="competition_type_id" class="w-full">
                <option value="">Select a competition type</option>
                @foreach($competition_types as $competitionType)
                    <option value="{{ $competitionType->id }}">{{ $competitionType->name }}</option>
                @endforeach
            </x-tmk.form.select>
        </div>
        <div>
            <p>Competition category</p>
            <x-tmk.form.select wire:model="form.competition_category_id" id="competition_category_id" class="w-full">
                <option value="">Select a competition category</option>
                @foreach($competition_categories as $competitionCategory)
                    <option value="{{ $competitionCategory->id }}">{{ $competitionCategory->name }}</option>
                @endforeach
            </x-tmk.form.select>
        </div>
        <div></div>
    </div>

    <div class="grid grid-cols-4 gap-5 mt-10 text-center">
        <div>
            <p class="mb-2">Select an image</p>
            <img src="/assets/placeholder-image.svg" alt="competition image" class="border-8 border-gray-500">
        </div>
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
        <x-input type="radio"></x-input>
        <label for="">By vote</label>
        <br>
        <x-input type="radio"></x-input>
        <label for="">By selection</label>
    </div>
    <hr>
    <p class="mt-7 ml-3">Terms of Agreement <span class="text-[#fa6432]">*</span></p>
    <div class="mb-7">
        <x-input type="radio"></x-input>
        <label for="">I confirm that this competitions agree with Thomas More's competitions terms and acknowledge that
            the competition could be denied if the terms are not met.</label>
    </div>
    <hr>

    <div class="grid grid-cols-7 gap-1 mt-7 text-center">
        <div></div>
        <div></div>
        <div>
            <button
                class="bg-tm-orange hover:bg-tm-darker-orange transition text-white font-bold py-2 px-4 rounded mb-2 border-2 border-tm-orange hover:border-tm-darker-orange"
                wire:click="createCompetition()">
                propose competition
            </button>
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

