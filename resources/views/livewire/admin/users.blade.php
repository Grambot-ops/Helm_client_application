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
                <col class="w-14">
                <col class="w-max">
                <col class="w-max">
                <col class="w-20">
                <col class="w-24">
            </colgroup>
            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2">
                <th>#</th>
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
                <tr
                    wire:key="{{ $user->id }}"
                    class="border-t border-gray-300">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}} {{$user->surname}}</td>
                    <td>
                        @if($user->admin)
                            Admin
                        @else
                            User
                        @endif
                    </td>
                    <td>@if($user-> active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td>
                        <div class="border border-gray-300 rounded-md overflow-hidden m-2 grid grid-cols-2 h-10">
                            <button
                                wire:click="edituser({{ $user->id }})"
                                class="text-gray-400 hover:text-sky-100 hover:bg-sky-500 transition border-r border-gray-300">
                                <x-phosphor-pencil-line-duotone class="inline-block w-5 h-5"/>
                            </button>
                            <button
                                wire:click="deleteuser({{ $user->id }})"
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
        {{--<div class="my-4">{{ $users->links() }}</div>--}}
    </x-tmk.section>
</div>

