<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Category Management</h2>

    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="mb-4 p-4 bg-yellow-100 dark:bg-yellow-800 text-yellow-700 dark:text-yellow-200 rounded">
            {{ session('warning') }}
        </div>
    @endif

    <!-- Search -->
    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Search categories..."
               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
    </div>

    <!-- Form -->
    <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}" class="mb-6 p-4 bg-white dark:bg-gray-800 rounded shadow">
        <div>
            <label class="block text-sm font-medium">Category Name</label>
            <input wire:model="name" type="text" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $category->id }})" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</button>
                            <button wire:click="delete({{ $category->id }})" class="text-red-600 dark:text-red-400 hover:underline ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
