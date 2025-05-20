<div class="max-w-3xl mx-auto bg-white p-8 shadow-sm">
    @if (session('success'))
        <div class="mb-6 text-center text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-6 text-center text-red-600 font-medium">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form wire:submit="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="name">Full Name</label>
                <input wire:model="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="name" type="text" placeholder="Your Name">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                <input wire:model="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="email" type="email" placeholder="Your Email">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Phone Number</label>
                <input wire:model="phone" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="phone" type="tel" placeholder="Your Phone">
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="guests">Number of Guests</label>
                <select wire:model="guests" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="guests">
                    <option value="" disabled selected>Select Number of Guests</option>
                    <option value="1">1 Person</option>
                    <option value="2">2 People</option>
                    <option value="3">3 People</option>
                    <option value="4">4 People</option>
                    <option value="5">5 People</option>
                    <option value="6">6+ People</option>
                </select>
                @error('guests') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="date">Date</label>
                <input wire:model="date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="date" type="date">
                @error('date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="time">Time</label>
                <select wire:model="time" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="time">
                    <option value="" disabled selected>Select Time</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="17:30">5:30 PM</option>
                    <option value="18:00">6:00 PM</option>
                    <option value="18:30">6:30 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="19:30">7:30 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="20:30">8:30 PM</option>
                    <option value="21:00">9:00 PM</option>
                </select>
                @error('time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="notes">Special Requests</label>
                <textarea wire:model="notes" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="notes" rows="3" placeholder="Any special requests or notes"></textarea>
                @error('notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-6 text-center">
            <button type="submit" class="px-6 py-3 bg-gold text-white font-medium hover:bg-opacity-90 transition duration-300">Reserve Now</button>
        </div>
    </form>
</div>