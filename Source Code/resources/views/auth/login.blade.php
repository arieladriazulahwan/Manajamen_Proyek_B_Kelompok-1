<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-blue-800 min-h-screen flex items-center justify-center">

    <div class="bg-white/10 backdrop-blur-md shadow-xl rounded-2xl p-8 w-full max-w-md border border-white/20">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Login</h2>

        @if(session('error'))
            <p class="text-red-300 text-center mb-3">{{ session('error') }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="text-white">Email</label>
                <input type="email" name="email"
                       class="w-full mt-1 p-3 rounded-lg bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                       placeholder="example@mail.com" required>
            </div>

            <div>
                <label class="text-white">Password</label>
                <input type="password" name="password"
                       class="w-full mt-1 p-3 rounded-lg bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                       placeholder="••••••••" required>
            </div>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Login
            </button>

            <p class="text-center text-white mt-4">
                Belum punya akun?
                <a href="/register" class="text-yellow-300 hover:underline">Register</a>
            </p>
        </form>
    </div>

</body>
</html>
