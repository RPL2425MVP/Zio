<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $transaksi->id_transaksi }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="text-center">INVOICE</h2>
    <p><strong>No Invoice:</strong> {{ $transaksi->id_transaksi }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi }}</p>
    <p><strong>Status:</strong> {{ $transaksi->status }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detail as $detail)
                <tr>
                    <td>{{ $detail->produk ? $detail->produk->nama_produk : 'Produk tidak ditemukan' }}</td>
                    <td class="text-center">{{ $detail->jumlah }}</td>
                    <td class="text-right">Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td class="text-right"><strong>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 30px;">Terima kasih telah berbelanja!</p>
</body>
</html>