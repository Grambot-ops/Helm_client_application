<div class="w-max m-auto">
    <div class="mb-8 w-max">
        <h1 class="text-3xl font-bold mb-2">{{ $competition->title }}</h1>
        <p>{{ $competition->description }}</p>
    </div>
    <div>
        <h2 class="text-xl font-bold">Your submission</h2>
        <p>Name and provide your competition submission.</p>
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="my-2">
                <x-input-error for="title" />
                <x-label value="Title" />
                <x-input type="text" id="title" :cols="20" wire:model="title" required/>
            </div>
            <div class="my-2">
                <x-input-error for="description" />
                <x-label value="Description" />
                <x-tmk.form.textarea :rows="6" :cols="20" id="description" wire:model="description" />
            </div>
            <div>
                @if($competition->competition_type->is_file)
                    <p class="mb-4">Accepted formats: {{ $this->mimetype }}</p>
                    @error('uploaded') <p class="text-red-400">{{ $message }}</p> @enderror
                    <input type="file" id="file_input" wire:model="uploaded" required/>
                @else
                    <x-label for="link" value="Link submission" />
                    <x-input type="url" id="link" wire:model="uploaded" required />
                @endif
            </div>
            <button
                class="bg-tm-blue hover:bg-tm-darker-blue transition text-white font-bold py-2 px-4 rounded mt-2"
                type="submit">
                Upload
            </button>
        </form>
    </div>
</div>
