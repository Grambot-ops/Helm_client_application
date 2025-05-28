<div>
    <x-tmk.section class="mb-4 flex flex-wrap gap-2">
        <!-- Search Input -->
        <div class="flex-grow">
            <x-input id="search" type="text" placeholder="Filter category"
                     wire:model.live.debounce.500ms="search"
                     class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-md focus:outline-none focus:border-blue-400 placeholder-gray-500"/>
        </div>

        <!-- New Category Input -->
        <div class="flex-grow">
            <x-input id="newCategory" type="text" placeholder="New category"
                     @keydown.enter="$el.setAttribute('disabled', true); $el.value = '';"
                     @keydown.tab="$el.setAttribute('disabled', true); $el.value = '';"
                     @keydown.esc="$el.setAttribute('disabled', true); $el.value = '';"
                     wire:model="newCategory"
                     wire:keydown.enter="createCategory()"
                     wire:keydown.tab="createCategory()"
                     wire:keydown.escape="resetValues()"
                     class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-md focus:outline-none focus:border-blue-400 placeholder-gray-500"/>
            <x-input-error for="newCategory" class="mt-2 text-red-500"/>
        </div>
    </x-tmk.section>

    {{-- Table with categories --}}
    <x-tmk.section>
        <div class="my-4 w-full">{{ $categories->links() }}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-52">
                <col class="w-60">
                <col class="w-max">
                <col class="w-20">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>Name</th>
                <th>
                    # of competitions in category
                </th>
                <th></th>
                <th>
                    <x-tmk.form.select id="perPage"
                                       wire:model.live="perPage"
                                       class="block mt-1">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </x-tmk.form.select>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr wire:key="{{ $category->id }}"
                    class="border-t border-gray-300">
                    <td>{{ $category->name }}</td>
                    <td>{{ count($category->competitions) }}</td>
                    <td></td>
                    <td>
                        <div class=" text-right border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10">
                            <button
                                wire:click="editCategory({{ $category->id }})"
                                class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                                <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                            </button>
                            <button
                                wire:click="deleteCategory({{ $category->id }})"
                                wire:confirm="Are you sure you want to delete this category?"
                                class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                                <x-phosphor-trash-duotone class="inline-block w-5 h-5"/>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                        <div class="font-bold italic text-sky-800">No categories found</div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="my-4">{{ $categories->links() }}</div>
    </x-tmk.section>

    {{-- Modal for add and update category --}}
    <x-dialog-modal id="categoryModal" wire:model.live="showModal">
        <x-slot name="title">
            <h2>{{ is_null($form->id) ? 'New category' : 'Edit category' }}</h2>
        </x-slot>
        <x-slot name="content">
            {{-- error messages --}}
            @if ($errors->any())
                <x-tmk.alert type="danger">
                    <x-tmk.list>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </x-tmk.list>
                </x-tmk.alert>
            @endif
            <div class="flex flex-row gap-4 mt-4">
                <div class="flex-1 flex-col gap-2">
                    <x-label for="name" value="Name" class="mt-4"/>
                    <x-input id="name" type="text" step="0.01"
                             wire:model="form.name"
                             class="mt-1 block w-full"/>
                </div>
            </div>
        </x-slot>
    <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false">Cancel</x-secondary-button>
            @if(is_null($form->id))
                <x-tmk.form.button color="success"
                                   disabled="{{ $form->name ? 'false' : 'true' }}"
                                   wire:click="createCategory()"
                                   class="ml-2">Save new category
                </x-tmk.form.button>
            @else
                <x-tmk.form.button color="info"
                                   wire:click="updateCategory({{ $form->id }})"
                                   class="ml-2">Save changes
                </x-tmk.form.button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
