<div class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="p-6 max-w-7xl mx-auto">
        <!-- Filters -->
        <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex gap-4">
                <select wire:model.live="dateFilter" class="p-2 border rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
                <select wire:model.live="statusFilter" class="p-2 border rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400">
                    <option value="">All Statuses</option>
                    <option value="ordered">Ordered</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 dark:text-white">Orders Report</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Orders</h3>
                    <p class="text-2xl font-bold dark:text-white">{{ $ordersSummary->total_orders }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Revenue</h3>
                    <p class="text-2xl font-bold dark:text-white">${{ number_format($ordersSummary->total_revenue, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Status Breakdown</h3>
                    <ul class="mt-2 text-gray-700 dark:text-gray-200">
                        @foreach($ordersByStatus as $status => $count)
                            <li>{{ ucfirst($status) }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <canvas id="ordersChart" wire:ignore></canvas>
            </div>
        </div>
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

        <!-- Reservations Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 dark:text-white">Reservations Report</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Reservations</h3>
                    <p class="text-2xl font-bold dark:text-white">{{ $reservationsSummary->total_reservations }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Guests</h3>
                    <p class="text-2xl font-bold dark:text-white">{{ $reservationsSummary->total_guests }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <canvas id="reservationsChart" wire:ignore></canvas>
            </div>
        </div>
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

        <!-- Financials Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 dark:text-white">Financial Report</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Income</h3>
                    <p class="text-2xl font-bold dark:text-white">${{ number_format($totalIncome, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold dark:text-gray-200">Total Expense</h3>
                    <p class="text-2xl font-bold dark:text-white">${{ number_format($totalExpense, 2) }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <canvas id="financialChart" wire:ignore></canvas>
            </div>
        </div>
    </div>

    <script>
        // Store chart instances to destroy them before reinitializing
        let ordersChartInstance = null;
        let reservationsChartInstance = null;
        let financialChartInstance = null;

        function initCharts() {
            // Destroy existing charts to prevent duplicates
            if (ordersChartInstance) ordersChartInstance.destroy();
            if (reservationsChartInstance) reservationsChartInstance.destroy();
            if (financialChartInstance) financialChartInstance.destroy();

            // Orders Chart
            const ordersCtx = document.getElementById('ordersChart')?.getContext('2d');
            if (ordersCtx) {
                const ordersOverTime = @json($ordersOverTime);
                ordersChartInstance = new Chart(ordersCtx, {
                    type: 'line',
                    data: {
                        labels: Object.keys(ordersOverTime),
                        datasets: [{
                            label: 'Orders Over Time',
                            data: Object.values(ordersOverTime),
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.2)',
                            fill: true,
                            tension: 0.4,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: { title: { display: true, text: 'Date' } },
                            y: { title: { display: true, text: 'Number of Orders' }, beginAtZero: true },
                        },
                    },
                });
            }

            // Reservations Chart
            const reservationsCtx = document.getElementById('reservationsChart')?.getContext('2d');
            if (reservationsCtx) {
                const reservationsByDate = @json($reservationsByDate);
                reservationsChartInstance = new Chart(reservationsCtx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(reservationsByDate),
                        datasets: [{
                            label: 'Reservations by Date',
                            data: Object.values(reservationsByDate),
                            backgroundColor: '#10b981',
                            borderColor: '#10b981',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: { title: { display: true, text: 'Date' } },
                            y: { title: { display: true, text: 'Number of Reservations' }, beginAtZero: true },
                        },
                    },
                });
            }

            // Financial Chart
            const financialCtx = document.getElementById('financialChart')?.getContext('2d');
            if (financialCtx) {
                const totalIncome = @json($totalIncome);
                const totalExpense = @json($totalExpense);
                financialChartInstance = new Chart(financialCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Income', 'Expense'],
                        datasets: [{
                            label: 'Financials',
                            data: [totalIncome, totalExpense],
                            backgroundColor: ['#4f46e5', '#ef4444'],
                            borderColor: ['#4f46e5', '#ef4444'],
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { title: { display: true, text: 'Amount ($)' }, beginAtZero: true },
                        },
                    },
                });
            }
        }

        // Initialize charts on DOM content loaded
        document.addEventListener('DOMContentLoaded', () => {
            initCharts();
        });

        // Reinitialize charts after Livewire updates
        document.addEventListener('livewire:navigated', () => {
            initCharts();
        });
    </script>
</div>
