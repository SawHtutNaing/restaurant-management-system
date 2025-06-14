<div class="p-4 sm:p-6 max-w-7xl mx-auto">
    <h2 class="text-xl sm:text-2xl font-bold mb-4">Order Management</h2>

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

    <!-- Search and Filter -->
    <div class="mb-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live="search" type="text" placeholder="Search by user or meal name..."
               class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 w-full sm:flex-1">
        <select wire:model.live="filterStatus" class="p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 w-full sm:w-48">
            <option value="">All Statuses</option>
            <option value="ordered">Ordered</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Meal</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Price</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">{{ $order->meal->name }}</td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">{{ $order->quantity }}</td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">${{ $order->total_price }}</td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">{{ ucfirst($order->status) }}</td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            @if($isAdmin)
                                @if($order->status !== 'ordered')
                                    <button wire:click="updateStatus({{ $order->id }}, 'ordered')"
                                            class="text-blue-600 dark:text-blue-400 hover:underline mr-2">Set Ordered</button>
                                @endif
                                @if($order->status !== 'confirmed')
                                    <button wire:click="updateStatus({{ $order->id }}, 'confirmed')"
                                            class="text-green-600 dark:text-green-400 hover:underline mr-2">Confirm</button>
                                @endif
                                @if($order->status !== 'cancelled')
                                    <button wire:click="updateStatus({{ $order->id }}, 'cancelled')"
                                            class="text-red-600 dark:text-red-400 hover:underline">Cancel</button>
                                @endif
                            @else
                                @if($order->status !== 'confirmed' && $order->status !== 'cancelled')
                                    <button wire:click="updateStatus({{ $order->id }}, 'cancelled')"
                                            class="text-red-600 dark:text-red-400 hover:underline">Cancel</button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
