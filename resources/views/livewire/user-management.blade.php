<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">User Management</h2>

    <!-- Search -->
    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Search users by name or email..."
               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
    </div>

    <!-- Form -->
    <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}" class="mb-6 p-4 bg-white dark:bg-gray-800 rounded shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input wire:model="name" type="text" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input wire:model="email" type="email" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Password</label>
                <input wire:model="password" type="password" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                       placeholder="{{ $editing ? 'Leave blank to keep unchanged' : '' }}">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Role</label>
                <select wire:model="role" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                    <option value="">Select Role</option>
                    <option value="customer">Customer</option>
                    <option value="waiter">Waiter</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
            {{ $editing ? 'Update' : 'Create' }}
        </button>
        @if($editing)
            <button type="button" wire:click="resetForm" class="mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">
                Cancel
            </button>
        @endif
    </form>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $user->id }})" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</button>
                            <button wire:click="delete({{ $user->id }})" class="text-red-600 dark:text-red-400 hover:underline ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
