<div>
    <x-tmk.section class="mb-4 flex gap-2">
        <div class="flex-1">
            <x-input id="search" type="text" placeholder="Filter Name"
                     wire:model.live.debounce.500ms="search"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
    </x-tmk.section>
    <x-tmk.section>
        <div class="my-4"></div>
        <div class="my-4">{{ $users->links()}}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-max">
                <col class="w-max">
                <col class="w-20">
                <col class="w-24">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>Name</th>
                <th>Role</th>
                <th>Active</th>
                <th>
                    <x-tmk.form.select id="perPage"
                                       wire:model.live="perPage"
                                       class="block mt-1 w-full">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </x-tmk.form.select>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr wire:key="{{ $user->id }}" class="border-t border-gray-300">
                    <td>{{ $user->name }} {{ $user->surname }}</td>
                    <td>
                        @forelse($user->user_roles as $key => $userRole)
                            @if($userRole->role)
                                {{ $userRole->role->name }}
                                @if (!$loop->last)
                                    |
                                @endif
                            @endif
                        @empty
                            Guest
                        @endforelse

                    </td>
                    <td>
                        @if($user->active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td>
                        <div class="border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10">
                            <button
                                wire:click="editUsers({{ $user }})"
                                class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                                <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                            </button>
                            <button
                                wire:click="deleteUser({{ $user->id }})"
                                wire:confirm="Are you sure you want to delete this user?"
                                class="text-gray-400 hover:text-red-100 hover:bg-red-500 transition">
                                <x-phosphor-trash-duotone class="inline-block w-5 h-5"/>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                    <tr>
                        <td colspan="6" class="border-t border-gray-300 p-4 text-center text-gray-500">
                            <div class="font-bold italic text-sky-800">No users found</div>
                        </td>
                    </tr>
            @endforelse
            </tbody>
        </table>
        <div class="my-4">{{ $users->links() }}</div>
    </x-tmk.section>
    {{-- Modal for editing a user --}}
    <x-dialog-modal id="userModal"
                    wire:model.live="showModal">
        <x-slot name="title">
            <h2>Edit user</h2>
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
                    <x-label for="surname" value="Surname" class="mt-4"/>
                    <x-input id="surname" type="text" step="0.01"
                             wire:model="form.surname"
                             class="mt-1 block w-full"/>
                    <x-label for="active" value="Active" class="mt-4"/>
                    <x-input id="active" type="checkbox"
                             wire:model="form.active"
                             class="mt-1 block"/>
                    <x-label for="roles" value="Roles" class="mt-4"/>
                    <ul>
                        @foreach($roles as $role)
                            <li>
                                <x-input id="role_{{ $role->id }}" type="checkbox"
                                         wire:model="temporaryCheckedRoles.{{ $role->id }}"
                                ></x-input>
                                {{ $role->name }}
                            </li>
                        @endforeach

                    </ul>


                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false">Cancel</x-secondary-button>
            <x-tmk.form.button color="info"
                               wire:click="updateUser({{ $form->id }})"
                               class="ml-2">Save changes
            </x-tmk.form.button>
        </x-slot>
    </x-dialog-modal>
</div>

