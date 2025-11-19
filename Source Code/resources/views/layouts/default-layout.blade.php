<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invicytory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 text-2xl font-bold text-blue-600">
                Invicytory
            </div>
            <nav class="mt-4 space-y-2">
                <a href="/dashboard" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Dashboard</a>
                <a href="/items" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Data Barang</a>
                <a href="/incoming" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Barang Masuk</a>
                <a href="/outgoing" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Barang Keluar</a>
                <a href="/categories" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Kategori</a>
                <a href="/products" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Produk</a>
                <a href="/orders" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Pesanan</a>
                <a href="/reports" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Laporan</a>
                <a href="/settings" class="block px-6 py-2 text-gray-700 hover:bg-blue-100">Pengaturan</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard Gudang')</h1>
                <div class="flex items-center space-x-4">
                    
                </div>
            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
