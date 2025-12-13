<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kopi Paste</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-linear-to-br from-amber-100 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="bg-amber-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-coffee text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-amber-800 mb-2">Kopi Paste</h1>
            <p class="text-gray-600">Daftar akun baru</p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-user"></i> Nama Lengkap
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror" 
                        required 
                        autofocus
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-user-tag"></i> Role
                    </label>
                    <select 
                        id="role" 
                        name="role" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                        required
                    >
                        <option value="cashier">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror" 
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">
                        <i class="fas fa-lock"></i> Konfirmasi Password
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                        required
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-bold text-lg"
                >
                    <i class="fas fa-user-plus"></i> Daftar
                </button>

                <div class="text-center mt-6">
                    <p class="text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700 font-bold">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>