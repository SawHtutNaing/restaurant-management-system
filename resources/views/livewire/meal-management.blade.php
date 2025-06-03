<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Meal Management</h2>

    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- User Search and Filter Section -->
    <div class="mb-6 p-4 bg-white dark:bg-gray-800 rounded shadow">
        <h3 class="text-lg font-medium mb-2">Browse Meals</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input wire:model.live="search" type="text" placeholder="Search meals..."
                   class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            <select wire:model.live="filterCategory" class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <input wire:model.live="filterPriceMin" type="number" placeholder="Min Price"
                       class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 w-[10rem] dark:text-gray-100">
                <input wire:model.live="filterPriceMax" type="number" placeholder="Max Price"
                       class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 w-[10rem] dark:text-gray-100">
            </div>
        </div>
    </div>

    <!-- Create Button for Admins -->
    @if(auth()->user()->isAdmin())
        <button wire:click="openModal" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
            Create Meal
        </button>
    @endif

    <!-- Modal -->
   <!-- Modal -->
@if($showModal)
    <div class="fixed inset-0 bg-gray-600 dark:bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-2xl overflow-y-auto max-h-[80vh]">
            <h3 class="text-lg font-medium mb-4">{{ $editing ? 'Edit Meal' : 'Create Meal' }}</h3>
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input wire:model="name" type="text" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Category</label>
                        <select wire:model="category_id" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Price ($)</label>
                        <input wire:model="price" type="number" step="0.01" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Minimum Price: ${{ $minPrice }}</span>
                        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea wire:model="description" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Image</label>
                        <input wire:model="image" type="file" accept="image/*" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if($image && !$editing)
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="mt-2 max-w-xs">
                        @elseif($editing && $image)
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="mt-2 max-w-xs">
                        @elseif($editing && $mealImage)
                            <img src="{{ asset('storage/' . $mealImage) }}" alt="Current Image" class="mt-2 max-w-xs">
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Is Signature Dish?</label>
                        <input wire:model="is_signature" type="checkbox" class="mt-2 h-5 w-5 text-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        @error('is_signature') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Ingredients</label>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Quantity (kg)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Cost</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($inventories as $inventory)
                                @if(isset($ingredients[$inventory->id]))
                                    <tr>
                                        <td class="px-6 py-4">{{ $inventory->name }}</td>
                                        <td class="px-6 py-4">{{ ucfirst($inventory->type) }}</td>
                                        <td class="px-6 py-4">
                                            <input wire:model="ingredients.{{ $inventory->id }}" type="number" step="0.01"
                                                   class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 w-24">
                                        </td>
                                        <td class="px-6 py-4">${{ number_format($inventory->price_per_kg * ($ingredients[$inventory->id] ?? 0), 2) }}</td>
                                        <td class="px-6 py-4">
                                            <button wire:click="removeIngredient({{ $inventory->id }})"
                                                    class="text-red-600 dark:text-red-400 hover:underline">Remove</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <select wire:change="addIngredient($event.target.value)"
                            class="mt-2 p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        <option value="">Add Ingredient</option>
                        @foreach($inventories as $inventory)
                            @if(!isset($ingredients[$inventory->id]))
                                <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                        {{ $editing ? 'Update' : 'Create' }}
                    </button>
                    <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

    <!-- Meals Table -->
    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ingredients</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Signature</th>
                    @if(auth()->user()->isAdmin() || auth()->user()->isCustomer())
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($meals as $meal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($meal->image)
                                <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <span class="text-gray-500 dark:text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $meal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $meal->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ $meal->price }}</td>
                        <td class="px-6 py-4">
                            @foreach($meal->ingredients as $ingredient)
                                {{ $ingredient->name }} ({{ $ingredient->pivot->quantity }} kg)<br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $meal->is_signature ? 'Yes' : 'No' }}</td>
                        @if(auth()->user()->isAdmin() || auth()->user()->isCustomer())
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(auth()->user()->isAdmin())
                                    <button wire:click="openModal(true, {{ $meal->id }})"
                                            class="text-blue-600 dark:text-blue-400 hover:underline">Edit</button>
                                    <button wire:click="delete({{ $meal->id }})"
                                            class="text-red-600 dark:text-red-400 hover:underline ml-4">Delete</button>
                                @endif
                                @if(auth()->user()->isCustomer())
                                    <div class="flex items-center gap-2">
                                        <input wire:model="orderQuantity.{{ $meal->id }}" type="number" min="1"
                                               class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 w-16">
                                        <button wire:click="placeOrder({{ $meal->id }})"
                                                class="text-green-600 dark:text-green-400 hover:underline">Order</button>
                                    </div>
                                    @error('orderQuantity.' . $meal->id)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $meals->links() }}
        </div>
    </div>
</div>
