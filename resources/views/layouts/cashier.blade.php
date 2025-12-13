<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kasir - Kopi Paste')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-orange-800 text-white flex-shrink-0 hidden md:block">
            <div class="p-6">
                <h2 class="text-2xl font-bold"><i class="fas fa-coffee"></i> Kopi Paste</h2>
                <p class="text-sm text-orange-200">Kasir Panel</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('cashier.dashboard') }}" class="flex items-center px-6 py-3 text-orange-200 hover:bg-orange-700 hover:text-white transition {{ request()->routeIs('cashier.dashboard') ? 'bg-orange-700 text-white' : '' }}">
                    <i class="fas fa-dashboard w-6"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('cashier.order.index') }}" class="flex items-center px-6 py-3 text-orange-200 hover:bg-orange-700 hover:text-white transition {{ request()->routeIs('cashier.order.*') ? 'bg-orange-700 text-white' : '' }}">
                    <i class="fas fa-shopping-cart w-6"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('cashier.transaction.index') }}" class="flex items-center px-6 py-3 text-orange-200 hover:bg-orange-700 hover:text-white transition {{ request()->routeIs('cashier.transaction.*') ? 'bg-orange-700 text-white' : '' }}">
                    <i class="fas fa-receipt w-6"></i>
                    <span>Transaksi</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-6 border-t border-orange-700">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-orange-200">Kasir</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded transition">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <button class="md:hidden mr-4" onclick="toggleSidebar()">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ now()->format('l, d F Y') }}</p>
                            <p class="text-sm font-bold text-orange-600" id="currentTime"></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" onclick="toggleSidebar()"></div>
    
    <script>
        function toggleSidebar() {
            document.querySelector('aside').classList.toggle('hidden');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }

        // Update time every second
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID');
            document.getElementById('currentTime').textContent = timeString;
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>

    @stack('scripts')
</body>
</html>