<div class="container mx-auto px-6 py-10 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-bold mb-6">Manage Reservations</h1>
    @if (session('success'))
        <div class="mb-6 text-center text-green-600 dark:text-green-400 font-medium">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white dark:bg-gray-800 shadow-sm p-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Phone</th>
                    <th class="px-4 py-2 text-left">Guests</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Time</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-2">{{ $reservation->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->email }}</td>
                        <td class="px-4 py-2">{{ $reservation->phone }}</td>
                        <td class="px-4 py-2">{{ $reservation->guests }}</td>
                        <td class="px-4 py-2">{{ $reservation->date->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">{{ $reservation->time }}</td>
                        <td class="px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="confirm({{ $reservation->id }})" class="text-green-600 dark:text-green-400 hover:underline" {{ $reservation->status === 'confirmed' ? 'disabled' : '' }}>Confirm</button> |
                            <button wire:click="reject({{ $reservation->id }})" class="text-red-600 dark:text-red-400 hover:underline" {{ $reservation->status === 'rejected' ? 'disabled' : '' }}>Reject</button> |
                            <button wire:click="pending({{ $reservation->id }})" class="text-yellow-600 dark:text-yellow-400 hover:underline" {{ $reservation->status === 'pending' ? 'disabled' : '' }}>Pending</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center">No reservations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <a href="{{ route('home') }}" class="px-4 py-2 bg-gold text-white hover:bg-opacity-90 transition duration-300 dark:bg-yellow-600 dark:hover:bg-yellow-500">Back to Home</a>
    </div>
</div>
