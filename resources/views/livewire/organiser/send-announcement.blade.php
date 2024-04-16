<div class="p-6">
    <form wire:submit.prevent="submit" class="flex flex-col">
        <label for="subject" class="block">
            <span class="text-gray-700">Name</span>
            <input class="block w-full mt-1 form-input" wire:model="title" placeholder="Subject" id="subject"
                   type="text" autocomplete="off" required>
        </label>
        <label class="block mt-4">
            <span class="text-gray-700">Message</span>
            <textarea class="block w-full mt-1 form-textarea" wire:model="message" rows="3"
                      placeholder="Write here your announcement."></textarea>
        </label>

        <button
            class="px-4 py-2 mt-8 font-semibold text-gray-800 bg-white border border-gray-300 rounded shadow hover:bg-gray-100">
            Send the announcement
        </button>
    </form>
</div>
