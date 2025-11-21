<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-blue-800 min-h-screen flex items-center justify-center">

    <div class="bg-white/10 backdrop-blur-md shadow-xl rounded-2xl p-8 w-full max-w-md border border-white/20">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Register</h2>

        <form action="/register" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="text-white">Name</label>
                <input type="text" name="name"
                       class="w-full mt-1 p-3 rounded-lg bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                       placeholder="Nama lengkap" required>
            </div>

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

            <div>
                <label class="text-white">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full mt-1 p-3 rounded-lg bg-white/20 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300"
                       placeholder="••••••••" required>
            </div>

            <button
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                Daftar
            </button>

            <p class="text-center text-white mt-4">
                Sudah punya akun?
                <a href="/login" class="text-yellow-300 hover:underline">Login</a>
            </p>
        </form>
    </div>

</body>
</html>
