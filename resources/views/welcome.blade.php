<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAGAN | Modern Myanmar Cuisine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: '#D4AF37',
                        dark: '#333333',
                        light: '#F8F8F8'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-white text-dark">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white shadow-sm" id="navbar">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-xl font-bold">BAGAN</a>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-dark focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-dark hover:text-gold transition duration-300">Home</a>
                    <a href="#about" class="text-dark hover:text-gold transition duration-300">About</a>
                    <a href="#menu" class="text-dark hover:text-gold transition duration-300">Menu</a>
                    <a href="#gallery" class="text-dark hover:text-gold transition duration-300">Gallery</a>
                    <a href="#contact" class="text-dark hover:text-gold transition duration-300">Contact</a>
                    @auth
                        <span class="text-dark hover:text-gold">
                            <a href="{{ route('my_record') }}">My Record</a>
                        </span>
                        <span class="text-dark hover:text-gold">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </span>
                    @else
                        <span class="text-dark hover:text-gold">
                            <a href="/register">Register</a> / <a href="/login">Login</a>
                        </span>
                    @endauth
                </div>
                <div class="hidden md:block">
                    <a href="#reservations" class="px-4 py-2 bg-gold text-white hover:bg-opacity-90 transition duration-300">Reservations</a>
                </div>
            </div>
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <a href="#home" class="block py-2 text-dark hover:text-gold">Home</a>
                <a href="#about" class="block py-2 text-dark hover:text-gold">About</a>
                <a href="#menu" class="block py-2 text-dark hover:text-gold">Menu</a>
                <a href="#gallery" class="block py-2 text-dark hover:text-gold">Gallery</a>
                <a href="#contact" class="block py-2 text-dark hover:text-gold">Contact</a>
                @auth
                    <span class="block py-2 text-dark hover:text-gold">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Logout</a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </span>
                @else
                    <span class="block py-2 text-dark hover:text-gold">
                        <a href="/register">Register</a> / <a href="/login">Login</a>
                    </span>
                @endauth
                <a href="#reservations" class="block py-2 text-gold">Reservations</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-bg h-screen flex items-center justify-center text-white">
        <div class="text-center px-4 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Modern Myanmar Cuisine</h1>
            <p class="text-lg md:text-xl mb-10">Experience authentic flavors with a contemporary approach</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('download.menu') }}" class="px-6 py-3">Download Menu</a>
                <a href="#reservations" class="px-6 py-3 border border-white text-white font-medium hover:bg-white hover:text-dark transition duration-300">Reserve a Table</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                    <img src="https://images.unsplash.com/photo-1577106263724-2c8e03bfe9cf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Chef preparing food" class="w-full h-auto">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold mb-6">Our Story</h2>
                    <p class="text-gray-700 mb-6">
                        Founded by Chef Kyaw Lin, BAGAN brings Myanmar's rich culinary heritage to the modern table. Our dishes honor traditional techniques while embracing contemporary presentation.
                    </p>
                    <p class="text-gray-700 mb-6">
                        Each creation tells a story of Myanmar's diverse regions—from the tea leaf traditions of the Shan highlands to the seafood specialties of the Rakhine coast—presented with simplicity and respect for authentic flavors.
                    </p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" alt="Chef Kyaw Lin" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <p class="font-semibold">Chef Kyaw Lin</p>
                            <p class="text-sm text-gray-500">Executive Chef & Founder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Signature Dishes Section -->
    <section class="py-20 bg-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Signature Dishes</h2>
                <p class="max-w-2xl mx-auto text-gray-600">Our most popular dishes that showcase the authentic flavors of Myanmar</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($signatureMeals as $meal)
                    <div class="bg-white shadow-sm">
                        <div class="h-64">
                            @if($meal->image)
                                <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $meal->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $meal->description ?? 'No description available' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-gold font-medium">${{ number_format($meal->price, 2) }}</span>
                                <span class="text-xs uppercase bg-light px-2 py-1">Signature</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 col-span-3">No signature dishes available.</p>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('download.menu') }}" class="inline-block px-6 py-3 bg-gold text-white font-medium">Download Full Menu</a>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Our Menu</h2>
                <p class="max-w-2xl mx-auto text-gray-600">A selection of authentic Myanmar dishes</p>
            </div>

            <!-- Messages -->
            @if (session('success'))
                <div class="mb-6 text-center text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 text-center text-red-600 font-medium">
                    {{ session('error') }}
                </div>
            @endif
            @unless (auth()->check())
                <div class="mb-6 text-center text-gray-600">
                    Please <a href="/login" class="text-gold hover:underline">login</a> to place an order.
                </div>
            @endunless

            <!-- Menu Categories -->
            <div class="flex flex-wrap justify-center mb-12">
                <a href="{{ route('home') }}" class="py-2 px-4 m-1 transition duration-300 {{ !$selectedCategory ? 'bg-gold text-white' : 'bg-white text-dark hover:bg-gold hover:text-white' }} rounded">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" class="py-2 px-4 m-1 transition duration-300 {{ $selectedCategory == $category->id ? 'bg-gold text-white' : 'bg-white text-dark hover:bg-gold hover:text-white' }} rounded">{{ $category->name }}</a>
                @endforeach
            </div>

            <!-- Menu Items -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                @forelse($meals as $meal)
                    <div class="menu-item">
                        <div class="flex justify-between items-start border-b border-gray-200 pb-4 mb-4">
                            <div class="flex items-start space-x-4">
                                @if($meal->image)
                                    <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" class="w-24 h-24 object-cover rounded">
                                @else
                                    <img src="https://via.placeholder.com/96x96?text=No+Image" alt="No Image" class="w-24 h-24 object-cover rounded">
                                @endif
                                <div>
                                    <h3 class="text-xl font-semibold">{{ $meal->name }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $meal->description ?? 'No description available' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-gold font-medium">${{ number_format($meal->price, 2) }}</span>
                                @auth
                                    <button class="px-4 py-2 bg-gold text-white rounded hover:bg-opacity-90 transition duration-300" onclick="openOrderModal({{ $meal->id }}, '{{ addslashes($meal->name) }}')">Order</button>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 col-span-2">No meals available for this category.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Gallery</h2>
                <p class="max-w-2xl mx-auto text-gray-600">A glimpse into our dishes</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($meals->where('image', '!=', null) as $meal)
                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}" class="w-full h-64 object-cover">
                    </div>
                @empty
                    <p class="text-center text-gray-600 col-span-4">No images available.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">What Our Customers Say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-light p-6">
                    <div class="flex text-gold mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray-600 mb-6">"The tea leaf salad was unlike anything I've ever tasted. So unique and flavorful! The staff was also incredibly knowledgeable about Myanmar cuisine."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80" alt="Customer" class="w-10 h-10 rounded-full object-cover mr-4">
                        <div>
                            <p class="font-semibold">Sarah Johnson</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-6">
                    <div class="flex text-gold mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1 .07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 00-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 a1 1 0 l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 l1.371 1.24 .588-1.81l-2.8 2.034a1 1 0 0 0-.364 1.118l1.07 3.292c.3 .921-.755 1.688 .1-.54 1.118l-1.8-2.034a1 1 0 0 0-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.298a1 1 0 0 0-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-0l3.461a1 1 0 0 0 .951-.69l1.07-3.7z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24 .588-1.81l-2.8 2.034a1 1 0 0 0-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-0L3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 0 0 .95.69h3.462c.969 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 0-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray-600 mb-6">"As someone who grew up with Southeast Asian cuisine, I can say this is some of the most authentic Myanmar food I've had outside the country. The coconut curry is exceptional."</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Customer" class="w-10 h-10 rounded-full object-cover mr-4">
                        <div>
                            <p class="font-semibold">Michael Chen</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-6">
                    <div class="flex text-gold mb-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 0-.364 1.118l1.07 3.292c.3 .921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0-.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927 c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 0 0 .95.69h3.462c.969 0 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 0-.364 1.118l1.07 3.292c.3 .921 -.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0-1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0 -.364-1.118L2.98 8.72c-.783-.57-.38-1.81 .588-1.81h3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927 c.3 -.921 1.603 -.921 1.902 0 l1.07 3.292 a1 1 0 0 0 .95.69h3.462c.969 0 1.371 1.24 .588 1.81 l-2.8 2.034a1 1 0 0 0 -.364 1.118l1.07 3.292c.3 .921 -.755 1.688-1.54 1.118 l-2.8-2.034 a1 1 0 0 0 -1.175 0 l-2.8 2.034 c-.784 .57-1.838-.197-1.539-1.118 l1.07-3.292 a1 1 0 0 0 -.364-1.118L2.98 8.72c-.783 -.57-.38-1.81 .588-1.81 h3.461 a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927 c.3 -.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 0 0 .95.69h3.462c.969 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 0 -.364 1.118l1.07 3.292c.3 .921 -.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0 -1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0 -.364-1.118L2.98 8.72c-.783 -.57-.38-1.81 .588-1.81h3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0 l1.07 3.292a1 1 0 0 0 .95.69h3.462c.969 0 1.371 1.24 .588 1.81l-2.8 2.034a1 1 0 0 0 -.364 1.118l1.07 3.292c.3 .921 -.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 0 0 -1.175 0 l-2.8 2.034c-.784 .57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 0 0 -.364-1.118L2.98 8.72c-.783 -.57-.38-1.81 .588-1.81h3.461a1 1 0 0 0 .951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-gray-600 mb-6">"Clean, simple atmosphere with amazing food. The Mohinga was perfect - just the right balance of flavors. Will definitely be coming back!"</p>
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Customer" class="w-10 h-10 rounded-full object-cover mr-4">
                        <div>
                            <p class="font-semibold">Emily Rodriguez</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Reservations Section -->
    <section id="reservations" class="py-20 bg-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Make a Reservation</h2>
                <p class="max-w-2xl mx-auto text-gray-600">Book your table for an authentic Myanmar dining experience.</p>
            </div>
            <div class="max-w-3xl mx-auto bg-white p-8 shadow-sm">
                <form method="post" action="{{ route('reservation') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="name">Full Name</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="name" name="text" type="text" placeholder="Your Name">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="email" type="email" name="email" placeholder="Your Email">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Phone Number</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="phone" type="tel" name="phone" placeholder="Your Phone">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="guests">Number of Guests</label>
                            <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="guests" name="guests">
                                <option value="">Select Number of Guests</option>
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                                <option value="5">5 People</option>
                                <option value="6">6+ People</option>
                            </select>
                            @error('guests') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="date">Date</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="date" type="date" name="date">
                            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="time">Time</label>
                            <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="time" name="time">
                                <option value="">Select Time</option>
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
                            @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="notes">Special Requests</label>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="notes" name="notes" rows="3" placeholder="Any special requests or notes"></textarea>
                            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <button type="submit" class="px-6 py-3 bg-gold text-white font-medium">Reserve Now</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Contact Us</h2>
                <p class="max-w-2xl mx-auto text-gray-600">We'd love to hear from you! Reach out with any inquiries or feedback.</p>
            </div>
            <div class="max-w-3xl mx-auto">
                <!-- Add your contact form or details here if needed -->
                <p class="text-center text-gray-600">Email: info@bagan.com | Phone: (123) 456-7890</p>
            </div>
        </div>
    </section>

    <!-- Order Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Order <span id="modalMealName"></span></h2>
            <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="meal_id" id="modalMealId">
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" min="1" value="1" required>
                    @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeOrderModal()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gold text-white rounded hover:bg-opacity-90">Place Order</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Modal and Mobile Menu -->
    <script>
        // Order Modal Functions
        function openOrderModal(mealId, mealName) {
            const modal = document.getElementById('orderModal');
            const mealIdInput = document.getElementById('modalMealId');
            const mealNameSpan = document.getElementById('modalMealName');
            const quantityInput = document.getElementById('quantity');

            if (modal && mealIdInput && mealNameSpan && quantityInput) {
                mealIdInput.value = mealId;
                mealNameSpan.textContent = mealName;
                quantityInput.value = 1;
                modal.classList.remove('hidden');
            } else {
                console.error('Modal elements not found');
            }
        }

        function closeOrderModal() {
            const modal = document.getElementById('orderModal');
            const quantityInput = document.getElementById('quantity');
            if (modal && quantityInput) {
                modal.classList.add('hidden');
                quantityInput.value = 1;
            }
        }

        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Optional: Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeOrderModal();
            }
        });
    </script>
</body>
</html>
