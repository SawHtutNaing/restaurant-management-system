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
                        <a href="{{ route('my_record') }}" >My Record</a>
                        
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
                <a href="#menu" class="px-6 py-3 bg-gold text-white font-medium">View Menu</a>
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
                <div class="bg-white shadow-sm">
                    <div class="h-64">
                        <img src="https://images.unsplash.com/photo-1593001872095-7d5b3868fb1d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Tea Leaf Salad" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Tea Leaf Salad</h3>
                        <p class="text-gray-600 mb-4">Fermented tea leaves with crispy textures, tomatoes, and sesame seeds</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-medium">$14</span>
                            <span class="text-xs uppercase bg-light px-2 py-1">Vegetarian</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-sm">
                    <div class="h-64">
                        <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Mohinga" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Mohinga</h3>
                        <p class="text-gray-600 mb-4">Rice noodles in fish broth with crispy fritters and hard-boiled egg</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-medium">$16</span>
                            <span class="text-xs uppercase bg-light px-2 py-1">Signature</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-sm">
                    <div class="h-64">
                        <img src="https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Coconut Chicken Curry" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Coconut Chicken Curry</h3>
                        <p class="text-gray-600 mb-4">Tender chicken in a rich coconut curry with lemongrass and ginger</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-medium">$18</span>
                            <span class="text-xs uppercase bg-light px-2 py-1">Popular</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="#menu" class="inline-block px-6 py-3 bg-gold text-white font-medium">View Full Menu</a>
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
                            <div>
                                <h3 class="text-xl font-semibold">{{ $meal->name }}</h3>
                                <p class="text-gray-600 mt-1">{{ $meal->description ?? 'No description available' }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-gold font-medium">${{ number_format($meal->price, 2) }}</span>
                                @auth
                                    <button class="px-4 py-2 bg-gold text-white rounded hover:bg-opacity-90 transition duration-300" onclick="openOrderModal({{ $meal->id }}, '{{ $meal->name }}')">Order</button>
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
                <p class="max-w-2xl mx-auto text-gray-600">A glimpse into our restaurant and dishes</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Restaurant Interior" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1593001872095-7d5b3868fb1d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Tea Leaf Salad" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Mohinga" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Dining Area" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Coconut Curry" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1577106263724-2c8e03bfe9cf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Chef Cooking" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Shan Noodles" class="w-full h-64 object-cover">
                </div>
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1525268323446-0505b6fe7778?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80" alt="Restaurant Bar" class="w-full h-64 object-cover">
                </div>
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
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
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
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
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
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
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
        </div>
    </section>

    <!-- Reservations Section -->
    <section id="reservations" class="py-20 bg-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Make a Reservation</h2>
                <p class="max-w-2xl mx-auto text-gray-600">Book your table for an authentic Myanmar dining experience</p>
            </div>
            <div class="max-w-3xl mx-auto bg-white p-8 shadow-sm">
                <form method="post" action="{{ route('reservation') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="name">Full Name</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="name"  name='name' type="text" placeholder="Your Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="email" type="email" name='email' placeholder="Your Email">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Phone Number</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="phone" type="tel" placeholder="Your Phone" name='phone'>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="guests">Number of Guests</label>
                            <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="guests" name='guests'>
                                <option value=''>Select Number of Guests</option>
                                <option value='1'> 1 Person</option>
                                <option value='2'> 2 People</option>
                                <option value='3'> 3 People</option>
                                <option value='4'> 4 People</option>
                                <option value='5'> 5 People</option>
                                <option value='6'> 6+ People</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="date">Date</label>
                            <input class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="date" type="date"
                            name='date'
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="time">Time</label>
                            <select
                            name='time'
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="time">
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
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="message">Special Requests</label>
                            <textarea
                            name='notes'
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" id="message" rows="3" placeholder="Any special requests or notes"></textarea>
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
                <p class="max-w-2xl mx-auto text-gray-600">Get in touch with us for any inquiries</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 bg-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Address</h3>
                    <p class="text-gray-600">123 Main Street</p>
                    <p class="text-gray-600">City, State 12345</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Phone</h3>
                    <p class="text-gray-600">(123) 456-7890</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Email</h3>
                    <p class="text-gray-600">info@baganrestaurant.com</p>
                </div>
            </div>
            <div class="mt-12 h-80 bg-gray-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215151464843!2d-73.98784492346392!3d40.75850083646641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1683650101780!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="#" class="text-xl font-bold mb-4 inline-block">BAGAN</a>
                    <p class="text-gray-400 max-w-xs">Authentic Myanmar cuisine with a modern approach. Experience the flavors of Myanmar in a contemporary setting.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#home" class="text-gray-400 hover:text-gold transition duration-300">Home</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-gold transition duration-300">About</a></li>
                            <li><a href="#menu" class="text-gray-400 hover:text-gold transition duration-300">Menu</a></li>
                            <li><a href="#gallery" class="text-gray-400 hover:text-gold transition duration-300">Gallery</a></li>
                            <li><a href="#contact" class="text-gray-400 hover:text-gold transition duration-300">Contact</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Hours</h4>
                        <ul class="space-y-2">
                            <li class="text-gray-400">Mon-Thu: 11am - 10pm</li>
                            <li class="text-gray-400">Fri-Sat: 11am - 11pm</li>
                            <li class="text-gray-400">Sunday: 12pm - 9pm</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-gold transition duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gold transition duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.067-.06-1.407-.06-4.123v-.08c0-2.643.012-2.987.06-4.043.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.885 2.525c.636-.247 1.363-.416 2.427-.465C10.332 2.013 10.672 2 13.315 2h-.08m0 1.802a9.555 9.555 0 00-3.208.06c-.804.037-1.352.165-1.832.333a3.104 3.104 0 00-1.125.732 3.104 3.104 0 00-.732 1.125c-.168.48-.296 1.028-.333 1.832a9.555 9.555 0 00-.06 3.208v.08a9.555 9.555 0 00.06 3.208c.037.804.165 1.352.333 1.832.167.48.416.88.732 1.125a3.104 3.104 0 001.125.732c.48.168 1.028.296 1.832.333a9.555 9.555 0 003.208.06h.08a9.555 9.555 0 003.208-.06c.804-.037 1.352-.165 1.832-.333a3.104 3.104 0 001.125-.732 3.104 3.104 0 00.732-1.125c.168-.48.296-1.028.333-1.832a9.555 9.555 0 00.06-3.208v-.08a9.555 9.555 0 00-.06-3.208c-.037-.804-.165-1.352-.333-1.832a3.104 3.104 0 00-.732-1.125 3.104 3.104 0 00-1.125-.732c-.48-.168-1.028-.296-1.832-.333a9.555 9.555 0 00-3.208-.06zm4.195 3.89a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM12 15.75a3.75 3.75 0 110-7.5 3.75 3.75 0 010 7.5z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Order Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-8 rounded-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6">Order <span id="modalMealName"></span></h2>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="meal_id" id="modalMealId">
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" min="1" value="1" required>
                </div>
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Special Requests</label>
                    <textarea name="notes" id="notes" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-gold" rows="3" placeholder="Any special requests or notes"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="px-4 py-2 bg-gray-300 text-dark rounded hover:bg-gray-400 transition duration-300" onclick="closeOrderModal()">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gold text-white rounded hover:bg-opacity-90 transition duration-300">Place Order</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Modal and Mobile Menu -->
    <script>
        function openOrderModal(mealId, mealName) {
            document.getElementById('modalMealId').value = mealId;
            document.getElementById('modalMealName').textContent = mealName;
            document.getElementById('orderModal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
            document.getElementById('quantity').value = 1;
            document.getElementById('notes').value = '';
        }

        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
