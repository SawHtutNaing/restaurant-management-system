<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Inventory Management</h2>

    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search -->
    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Search inventory..."
               class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
    </div>

    <!-- Create Button -->
    <button wire:click="openModal" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
        Create Inventory
    </button>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-2xl">
                <h3 class="text-lg font-medium mb-4">{{ $editing ? 'Edit Inventory' : 'Create Inventory' }}</h3>
                <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Name</label>
                            <input wire:model="name" type="text" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Type</label>
                            <select wire:model="type" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">Select Type</option>
                                <option value="meat">Meat</option>
                                <option value="fruit">Fruit</option>
                                <option value="vegetable">Vegetable</option>
                            </select>
                            @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Stock (kg)</label>
                            <input wire:model="stock" type="number" step="0.01" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Price per kg</label>
                            <input wire:model="price_per_kg" type="number" step="0.01" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('price_per_kg') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                            {{ $editing ? 'Update' : 'Create' }}
                        </button>
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price/kg</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($inventories as $inventory)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $inventory->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($inventory->type) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($inventory->stock, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($inventory->price_per_kg, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="openModal(true, {{ $inventory->id }})" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</button>
                            <button wire:click="delete({{ $inventory->id }})" class="text-red-600 dark:text-red-400 hover:underline ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $inventories->links() }}
        </div>
    </div>
</div>
