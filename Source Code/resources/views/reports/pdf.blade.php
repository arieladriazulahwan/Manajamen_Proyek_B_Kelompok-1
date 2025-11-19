<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Gudang</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            margin-top: 30px;
            color: #1a237e;
            border-bottom: 2px solid #1a237e;
            padding-bottom: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .footer {
            text-align: center;
            font-size: 11px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Laporan Gudang</h1>
    <p style="text-align:center;">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>

    {{-- Barang Masuk --}}
    @if ($type == 'all' || $type == 'incomings')
        <h2>Barang Masuk</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomings as $incoming)
                    <tr>
                        <td>{{ $incoming->item_name }}</td>
                        <td>{{ $incoming->quantity }}</td>
                        <td>{{ $incoming->description ?? '-' }}</td>
                        <td>{{ $incoming->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Barang Keluar --}}
    @if ($type == 'all' || $type == 'outgoings')
        <h2>Barang Keluar</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($outgoings as $outgoing)
                    <tr>
                        <td>{{ $outgoing->item_name }}</td>
                        <td>{{ $outgoing->quantity }}</td>
                        <td>{{ $outgoing->description ?? '-' }}</td>
                        <td>{{ $outgoing->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Stok Barang --}}
    @if ($type == 'all' || $type == 'items')
        <h2>Stok Barang Saat Ini</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Tercatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Kategori & Produk --}}
    @if ($type == 'all' || $type == 'products')
        <h2>Data Kategori & Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Pesanan --}}
    @if ($type == 'all' || $type == 'orders')
        <h2>Data Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Jumlah Produk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td>{{ $order->products->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>© {{ date('Y') }} Sistem GudangKu — Semua data bersifat rahasia</p>
    </div>

</body>
</html>
