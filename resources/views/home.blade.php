@extends('layouts.app')

@section('title', 'Kopi Paste - We\'ve got your morning covered')

@push('styles')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                    url('images/coffee_hero.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .bg-coffee { background: rgba(107, 68, 35, 0.9); }
    
    .testimonial-card {
        background: #FDF8F3;
        border-left: 4px solid #E8B86D;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6 py-32">
            <div class="max-w-2xl">
                <p class="text-white text-xl mb-4 font-light">We've got your morning covered with</p>
                <h1 class="font-serif text-white text-8xl font-bold mb-6" style="line-height: 1.1;">Coffee</h1>
                <p class="text-white text-lg mb-8 leading-relaxed">
                    It is best to start your day with a cup of coffee. Discover the best flavours coffee you will ever have. We provide the best for our customers.
                </p>
                <a href="{{ route('menu.public') }}" class="btn-gold px-8 py-4 rounded-full text-lg font-semibold inline-block">Order Now</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-serif text-5xl text-brown font-bold mb-6">Discover the best coffee</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Kopi Paste is a coffee shop that provides you with quality coffee that helps boost your productivity and helps build your mood. Having a cup of coffee is good, but having a cup of real coffee is greater. There is no doubt that you will enjoy this coffee more than others you have ever tasted.
                    </p>
                    <a href="{{ route('about') }}" class="btn-gold px-6 py-3 rounded-full font-semibold inline-block">Learn More</a>
                </div>
                <div class="flex justify-center">
                    <img src="/images/cup_coffee_beans.png" alt="Coffee Beans">
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-serif text-5xl text-brown font-bold mb-4">Enjoy a new blend of coffee style</h2>
                <p class="text-gray-600 text-lg">Explore all flavours of coffee with us. There is always a new cup worth experiencing</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Menu Card 1 -->
                <div class="card-hover bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1534778101976-62847782c213?w=400" alt="Cappuccino" class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="font-serif text-2xl text-brown font-bold mb-2">Cappuccino</h3>
                        <p class="text-gray-600 text-sm mb-2">Coffee 50% | Milk 50%</p>
                        <p class="text-brown text-2xl font-bold mb-4">Rp 18.000</p>
                        <a href="{{ route('menu.public') }}" class="btn-gold px-6 py-2 rounded-full font-semibold inline-block w-full">Order Now</a>
                    </div>
                </div>

                <!-- Menu Card 2 -->
                <div class="card-hover bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1561882468-9110e03e0f78?w=400" alt="Cafe Latte" class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="font-serif text-2xl text-brown font-bold mb-2">Cafe Latte</h3>
                        <p class="text-gray-600 text-sm mb-2">Coffee 50% | Milk 50%</p>
                        <p class="text-brown text-2xl font-bold mb-4">Rp 18.000</p>
                        <a href="{{ route('menu.public') }}" class="btn-gold px-6 py-2 rounded-full font-semibold inline-block w-full">Order Now</a>
                    </div>
                </div>

                <!-- Menu Card 3 -->
                <div class="card-hover bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1579992357154-faf4bde95b3d?w=400" alt="Mocha" class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="font-serif text-2xl text-brown font-bold mb-2">Mocha</h3>
                        <p class="text-gray-600 text-sm mb-2">Coffee 50% | Milk 50%</p>
                        <p class="text-brown text-2xl font-bold mb-4">Rp 22.000</p>
                        <a href="{{ route('menu.public') }}" class="btn-gold px-6 py-2 rounded-full font-semibold inline-block w-full">Order Now</a>
                    </div>
                </div>

                <!-- Menu Card 4 -->
                <div class="card-hover bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=400" alt="Espresso" class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="font-serif text-2xl text-brown font-bold mb-2">Espresso</h3>
                        <p class="text-gray-600 text-sm mb-2">Coffee 50% | Milk 50%</p>
                        <p class="text-brown text-2xl font-bold mb-4">Rp 12.000</p>
                        <a href="{{ route('menu.public') }}" class="btn-gold px-6 py-2 rounded-full font-semibold inline-block w-full">Order Now</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('menu.public') }}" class="btn-gold px-8 py-4 rounded-full text-lg font-bold inline-block">
                    View All Menu <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-cream">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-serif text-5xl text-brown font-bold mb-4">Why are we different?</h2>
                <p class="text-gray-600 text-xl">We don't just make your coffee, we make your day!</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white p-8 rounded-lg text-center card-hover">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-coffee text-6xl text-brown"></i>
                    </div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Supreme Beans</h3>
                    <p class="text-gray-600">Beans that provides great taste</p>
                </div>

                <div class="bg-white p-8 rounded-lg text-center card-hover">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-award text-6xl text-brown"></i>
                    </div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">High Quality</h3>
                    <p class="text-gray-600">We provide the highest quality</p>
                </div>

                <div class="bg-white p-8 rounded-lg text-center card-hover">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-mug-hot text-6xl text-brown"></i>
                    </div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Extraordinary</h3>
                    <p class="text-gray-600">Coffee like you have never tasted</p>
                </div>

                <div class="bg-white p-8 rounded-lg text-center card-hover">
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-6xl text-brown"></i>
                    </div>
                    <h3 class="font-serif text-2xl text-brown font-bold mb-3">Affordable Price</h3>
                    <p class="text-gray-600">Our Coffee prices are easy to afford</p>
                </div>
            </div>

            <div class="text-center">
                <p class="text-gray-600 text-xl mb-6">Great ideas start with great coffee. Lets help you achieve that</p>
                <h3 class="font-serif text-4xl text-brown font-bold mb-8">Get started today.</h3>
                <a href="{{ route('menu.public') }}" class="btn-gold px-8 py-4 rounded-full text-lg font-semibold inline-block">Join Us</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32 bg-coffee">
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?q=80'); background-size: cover;"></div>
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h2 class="font-serif text-6xl font-bold mb-6">Get a chance to have an Amazing morning</h2>
                    <p class="text-xl mb-8 leading-relaxed">We are giving you are one time opportunity to experience a better life with coffee.</p>
                    <a href="{{ route('menu.public') }}" class="btn-gold px-8 py-4 rounded-full text-lg font-semibold inline-block">Order Now</a>
                </div>
                <div class="flex justify-center">
                    <img src="/images/cup.png" alt="Coffee Cup" class="w-66 h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-serif text-5xl text-brown font-bold mb-4">Our coffee perfection feedback</h2>
                <p class="text-gray-600 text-xl">Our customers has amazing things to say about us</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="testimonial-card p-12 rounded-lg relative">
                    <div class="text-8xl text-brown mb-6">"</div>
                    <p class="text-gray-700 text-lg leading-relaxed mb-8">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                    <div class="text-center">
                        <img src="https://i.pravatar.cc/100?img=12" alt="Customer" class="w-20 h-20 rounded-full mx-auto mb-4">
                        <h4 class="font-serif text-2xl text-brown font-bold">Monkey D. Luffy</h4>
                        <p class="text-gray-600">Project Manager</p>
                    </div>
                    
                    <!-- Navigation Arrows -->
                    {{-- <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <button class="btn-gold w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <button class="btn-gold w-12 h-12 rounded-lg flex items-center justify-center">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="relative py-32 bg-coffee">
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?q=80'); background-size: cover;"></div>
        <div class="relative max-w-4xl mx-auto px-6 text-center">
            <h2 class="font-serif text-5xl text-white font-bold mb-4">Subscribe to get the Latest News</h2>
            <p class="text-white text-xl mb-8">Don't miss out on our latest news, updates, tips and special offers</p>
            
            <form class="flex max-w-2xl mx-auto">
                <input type="email" placeholder="Enter your mail" class="flex-1 px-6 py-4 rounded-l-full text-lg focus:outline-none" required>
                <button type="submit" class="btn-gold px-8 py-4 rounded-r-full text-lg font-semibold">Subscribe</button>
            </form>
        </div>
    </section>
@endsection