<div class="p-6">
    <h1 class="text-2xl mb-4"><strong>Send Announcement</strong></h1>
    @if(count($competitions)>0)
        <form wire:submit.prevent="submit" class="flex flex-col">
            <label class="block mt-2" for="Select competition">
                <span class="text-gray-700">Select a competition</span>
                <select class="block  mt-1 form-select rounded" wire:model="form.competitionId" name="competition_id">
                    @foreach($competitions as $competition)
                        <option value="{{ $competition->id }}">{{ $competition->title }}</option>
                    @endforeach
                </select>
            </label>
            <label for="subject" class="block mt-4">
                <span class="text-gray-700">Name</span>
                <input class="block w-full mt-1 form-input rounded" wire:model="form.subject" placeholder="Subject"
                       id="subject"
                       type="text" autocomplete="off" required>
            </label>
            <label class="block mt-4">
                <span class="text-gray-700">Message</span>
                <textarea class="block w-full mt-1 form-textarea rounded" wire:model="form.message" rows="3"
                          placeholder="Write here your announcement."></textarea>
            </label>

            <button
                class="px-4 py-2 mt-8 font-semibold text-gray-800 bg-white border border-gray-300 rounded shadow hover:bg-gray-100">
                Send the announcement
            </button>
        </form>
    @else
        <p>You are not the organiser of any competitions</p>
    @endif

</div>
