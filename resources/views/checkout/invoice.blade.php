@vite('resources/css/app.css')

<div class="p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Invoice {{ $trx->kode_transaksi }}</h2>
    <p>Tanggal: {{ $trx->created_at->format('d/m/Y H:i') }}</p>
    <p>Metode: {{ ucfirst($trx->payment_type) }}</p>

    {{-- Tabel item --}}
    <table class="w-full mt-4 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Produk</th>
                <th class="p-2">Qty</th>
                <th class="p-2">Harga</th>
                <th class="p-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trx->items as $item)
            <tr>
                <td class="p-2">{{ $item->barang->nama_produk }}</td>
                <td class="p-2">{{ $item->qty }}</td>
                <td class="p-2">Rp {{ number_format($item->harga,0,',','.') }}</td>
                <td class="p-2">Rp {{ number_format($item->subtotal,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Ringkasan --}}
    <div class="mt-4 space-y-1">
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
    <div class="mt-6 flex gap-4">
        <a href="{{ route('shop.index') }}"
           class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition text-center">
           ← Back
        </a>
        <a href="{{ route('checkout.index') }}"
           class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-center">
           Checkout Lagi
        </a>
    </div>
</div>
