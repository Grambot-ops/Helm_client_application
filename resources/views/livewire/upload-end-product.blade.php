<div class="m-auto w-1/2">
    <div class="mb-8 w-max">
        <h1 class="text-3xl font-bold mb-2">{{ $competition->title }}</h1>
        <p>{{ Str::limit($competition->description, 103, $end="...") }}</p>
    </div>
    <div>
        <h2 class="text-xl font-bold">Your submission</h2>
        <p>Name and provide your competition submission.</p>
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="my-2">
                <x-input-error for="title" />
                <x-label value="Title" />
                <x-input type="text" id="title" :cols="20" wire:model="title" class="w-full" required/>
            </div>
            <div>
                <x-label value="Photo" />
                @if($this->photo)
                    <a id="imageLink" href="#">
                        <img id="placeholderImage" src="{{ $this->photo->temporaryUrl()  }}" alt="competition image" onclick="uploadImage()" class="border-8 mt-0.5 border-gray-500">
                    </a>
                @else
                    <a id="imageLink" href="#">
                        <img id="placeholderImage" src="/assets/placeholder-image.svg" alt="competition image" onclick="uploadImage()" class="border-8 mt-0.5 border-gray-500">
                    </a>
                @endif

                <script>
                    // Function to handle the click event and trigger the file upload dialog
                    function uploadImage() {
                        document.getElementById('imageInput').click();
                    }
                </script>

                <!-- Hidden input element for file upload -->
                <input type="file" id="imageInput" wire:model="photo" style="display: none;">
            </div>
            <div class="my-2">
                <x-input-error for="description" />
                <x-label value="Description" />
                <x-tmk.form.textarea :rows="8" class="w-full" id="description" wire:model="description" />
            </div>
            <div>
                @if($this->mimetype)
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
