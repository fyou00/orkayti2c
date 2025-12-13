{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kopi Paste</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-amber-100 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="bg-amber-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-coffee text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-amber-800 mb-2">Kopi Paste</h1>
            <p class="text-gray-600">Silakan login untuk melanjutkan</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg shadow-xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror" 
                        required 
                        autofocus 
                        placeholder="masukkan email"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror" 
                        required 
                        placeholder="masukkan password"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input 
                        id="remember" 
                        type="checkbox" 
                        name="remember" 
                        class="w-4 h-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500"
                    >
                    <label for="remember" class="ml-2 text-gray-700">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-bold text-lg"
                >
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <!-- Back to Home -->
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="text-amber-600 hover:text-amber-700">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

        <!-- Demo Accounts Info -->
        <div class="mt-6 bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600 mb-2 font-bold">Akun Demo:</p>
            <div class="text-sm text-gray-600">
                <p><strong>Admin:</strong> admin@kopipaste.com | password</p>
                <p><strong>Kasir:</strong> kasir@kopipaste.com | password</p>
            </div>
        </div>
    </div>
</body>
</html>