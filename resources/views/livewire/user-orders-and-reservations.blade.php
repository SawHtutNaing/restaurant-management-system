<div class="p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-white-800">Your Orders</h2>

    @if($orders->isEmpty())
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded mb-8">
            You have not placed any orders yet.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            @foreach ($orders as $order)
                <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Order #{{ $order->id }}</span>
                        <span class="text-sm text-white px-2 py-1 rounded-full 
                            {{ $order->status === 'confirmed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="mt-2 text-gray-700">
                        <p><strong>Meal:</strong> {{ $order->meal->name ?? 'N/A' }}</p>
                        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                        <p><strong>Ordered At:</strong> {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                        @if ($order->notes)
                            <p class="mt-2 text-sm text-gray-500 italic">Note: {{ $order->notes }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6 text-white-800">Your Reservations</h2>

    @if($reservations->isEmpty())
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
            You have no reservations yet.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($reservations as $reservation)
                <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Reservation #{{ $reservation->id }}</span>
                        <span class="text-sm text-white px-2 py-1 rounded-full 
                            {{ $reservation->status === 'confirmed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                    <div class="mt-2 text-gray-700">
                        <p><strong>Name:</strong> {{ $reservation->name }}</p>
                        <p><strong>Email:</strong> {{ $reservation->email }}</p>
                        <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                        <p><strong>Guests:</strong> {{ $reservation->guests }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $reservation->time }}</p>
                        @if ($reservation->notes)
                            <p class="mt-2 text-sm text-gray-500 italic">Note: {{ $reservation->notes }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
