<div class="p-6 max-w-7xl mx-auto bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <!-- Tabs for switching between Orders and Reservations -->
    <div class="mb-8">
        <div class="flex justify-center space-x-4">
            <button wire:click="setTab('orders')"
                    class="px-6 py-3 text-lg font-semibold rounded-lg transition-all duration-300
                           {{ $activeTab === 'orders' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Orders
            </button>
            <button wire:click="setTab('reservations')"
                    class="px-6 py-3 text-lg font-semibold rounded-lg transition-all duration-300
                           {{ $activeTab === 'reservations' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 dark:bg-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Reservations
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex gap-4">
            <select wire:model.live="statusFilter" class="p-2 border rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                <option value="">All Statuses</option>
                @if($activeTab === 'orders')
                    <option value="ordered">Ordered</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                @else
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="rejected">Rejected</option>
                @endif
            </select>
            <input wire:model.live.debounce.500ms="search" type="text" placeholder="Search..."
                   class="p-2 border rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400" />
        </div>
    </div>

    <!-- Orders Section -->
    @if($activeTab === 'orders')
        @if($orders->isEmpty())
            <div class="bg-yellow-50 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300 p-6 rounded-lg mb-8 text-center">
                You have not placed any orders yet.
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
                @foreach ($orders as $order)
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">Order #{{ $order->id }}</span>
                            <span class="text-sm text-white px-3 py-1 rounded-full
                                {{ $order->status === 'confirmed' ? 'bg-green-500' : ($order->status === 'cancelled' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="text-gray-700 dark:text-gray-200 space-y-2">
                            <p><strong>Meal:</strong> {{ $order->meal->name ?? 'N/A' }}</p>
                            <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                            <p><strong>Ordered At:</strong> {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                            @if ($order->notes)
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic">Note: {{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    @endif

    <!-- Reservations Section -->
    @if($activeTab === 'reservations')
        @if($reservations->isEmpty())
            <div class="bg-yellow-50 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300 p-6 rounded-lg text-center">
                You have no reservations yet.
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($reservations as $reservation)
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">Reservation #{{ $reservation->id }}</span>
                            <span class="text-sm text-white px-3 py-1 rounded-full
                                {{ $reservation->status === 'confirmed' ? 'bg-green-500' : ($reservation->status === 'cancelled' || $reservation->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>
                        <div class="text-gray-700 dark:text-gray-200 space-y-2">
                            <p><strong>Name:</strong> {{ $reservation->name }}</p>
                            <p><strong>Email:</strong> {{ $reservation->email }}</p>
                            <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                            <p><strong>Guests:</strong> {{ $reservation->guests }}</p>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</p>
                            <p><strong>Time:</strong> {{ $reservation->time }}</p>
                            @if ($reservation->notes)
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic">Note: {{ $reservation->notes }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $reservations->links() }}
            </div>
        @endif
    @endif
</div>
