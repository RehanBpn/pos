@vite('resources/css/app.css')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.11/dist/cdn.min.js"></script>

<style>
    @media print {
        @page{
            size: 80mm auto;
            margin: 5mm;
        }
        .no-print{
            display: none !important;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .print {
            width: 80mm;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            font-size: 100%;
        }
        table th, table td{
            padding: 2px 0;
        }
    }
</style>

<div class="flex items-center justify-center p-20">
<div class="print p-4 w-[80mm] bg-white shadow border rounded">
    <h2 class="text-xl font-bold mb-4 text-center">Invoice {{ $trx->kode_transaksi }}</h2>
    <p class="text-right">Tanggal: {{ $trx->created_at->format('d/m/Y H:i') }}</p>
    <p class="text-right">Metode: {{ ucfirst($trx->payment_type) }}</p>

    {{-- Tabel item --}}
    <table class="w-full mt-4 text-left">
        @foreach($trx->items as $item)

        <tr>
            <th>Nama Produk</th>
            <td>:</td>
            <td>{{ $item->barang->nama_produk }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>:</td>
            <td>{{ $item->qty }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>:</td>
            <td>Rp.{{ number_format($item->harga,0,',','.') }}</td>
        </tr>
        <tr>
            <th>Total Belanja</th>
            <td>:</td>
            <td>Rp.{{ number_format($item->subtotal,0,',','.')  }}</td>
        </tr>
            @endforeach
    </table>

    {{-- Ringkasan --}}
    <div class="mt-4 space-y-1 border rounded-lg p-2">
        <p>Subtotal: Rp {{ number_format($trx->subtotal,0,',','.') }}</p>
        <p>Admin: Rp {{ number_format($trx->admin,0,',','.') }}</p>
        @if($trx->payment_type === 'online')
            <p>Ongkir: Rp {{ number_format($trx->ongkir,0,',','.') }}</p>
        @endif
        <p class="font-bold">Total: Rp {{ number_format($trx->total,0,',','.') }}</p>
        <p>Bayar: Rp {{ number_format($trx->bayar,0,',','.') }}</p>
        <p>Kembalian: Rp {{ number_format($trx->kembalian,0,',','.') }}</p>
    </div>

    {{-- Tombol --}}
    <div class="flex mt-6 no-print" x-data>
        <a href="{{ route('shop.index') }}"
           class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition text-center">
           Back
        </a>
        <a href="javascript:void(0)" @click="window.print()" class="flex-1 bg-blue-600 text-white rounded-lg text-center py-2 transition hover:bg-blue-500">
            Cetak
        </a>
    </div>
</div>
</div>
