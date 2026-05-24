@vite('resources/css/app.css')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<div class="flex items-center justify-center p-30">
<div x-data="checkout({{ $subtotal }})" class="p-6 bg-gray-50 h-[] w-[550px] border border-r-4">
    <h2 class="text-xl font-bold mb-4">Checkout</h2>

    {{-- Tabel produk --}}
    <table class="w-full mb-6 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Produk</th>
                <th class="p-2">Qty</th>
                <th class="p-2">Harga</th>
                <th class="p-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td class="p-2">{{ $item->barang->nama_produk }}</td>
                <td class="p-2">{{ $item->qty }}</td>
                <td class="p-2">Rp {{ number_format($item->barang->harga_jual,0,',','.') }}</td>
                <td class="p-2">Rp {{ number_format($item->barang->harga_jual * $item->qty,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Metode pembayaran --}}
    <div class="mb-4">
        <label class="block font-semibold">Metode Pembayaran</label>
        <select x-model="paymentType" class="border rounded px-3 py-2">
            <option value="cash">Cash</option>
            <option value="online">Online</option>
        </select>
    </div>

    {{-- Ringkasan --}}
    <div class="flex-box items-end">
        <p>Subtotal: Rp <span x-text="subtotal"></span></p>
        <p>Admin: Rp <span x-text="admin"></span></p>
        <p x-show="paymentType==='online'">Ongkir: Rp <span x-text="ongkir"></span></p>
        <p class="font-bold">Total: Rp <span x-text="total"></span></p>
    </div>

    {{-- Input bayar --}}
    <div class="mt-4">
        <label class="block font-semibold">Bayar</label>
        <input type="number" x-model="bayar" class="border rounded px-3 py-2">
        <p>Kembalian: Rp <span x-text="kembalian"></span></p>
    </div>

    {{-- Form submit --}}
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <input type="hidden" name="subtotal" :value="subtotal">
        <input type="hidden" name="payment_type" :value="paymentType">
        <input type="hidden" name="bayar" :value="bayar">
        {{-- kirim items --}}
        @foreach($cartItems as $item)
            <input type="hidden" name="items[{{ $loop->index }}][barang_id]" value="{{ $item->barang_id }}">
            <input type="hidden" name="items[{{ $loop->index }}][qty]" value="{{ $item->qty }}">
        @endforeach

        <div class="flex gap-4 mt-6">
        <a href="{{ route('shop.index') }}"
           class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition text-center">
           ← Back
        </a>
            <button type="submit"
                class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Bayar
            </button>
        </div>
    </form>
</div>
</div>
<script>
function checkout(subtotal){
    return {
        subtotal: subtotal,
        admin: 2000,
        ongkir: 10000,
        paymentType: 'cash',
        bayar: 0,
        get total(){ return this.subtotal + this.admin + (this.paymentType==='online'?this.ongkir:0) },
        get kembalian(){ return this.bayar - this.total }
    }
}
</script>
