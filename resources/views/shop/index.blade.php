<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<div class="flex min-h-screen bg-gray-50">

    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Konten utama --}}
    <div class="flex-1 p-6">

        {{-- Search --}}
        <div class="flex mb-6 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" x-data="{
        search : '', 
        items : [''],
        get filteredItems(){
        return this.items.filter(
        i => i.startsWith(this.search)
                )
            }
        }">
            <input type="text"
                   placeholder="Cari produk..."
                   class="w-full outline-none"
                   x-model="search">
                <ul>
                    <template x-for="item in filteredItems" :key="item">
                    <li x-text="item"></li>
                    </template>
                </ul>
            <span class="">search</span>
        </div>

        {{-- Grid Produk --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($allbarang as $barang)

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">

                @if($barang->image)
                    <img src="{{ asset('storage/'.$barang->image) }}"
                         alt="{{ $barang->nama_produk }}"
                         class="w-full h-40 object-cover rounded-lg mb-3">
                @endif

                <h2 class="font-bold text-lg">
                    {{ $barang->nama_produk }}
                </h2>

                <p class="text-sm text-gray-500">
                     {{ $barang->kode }}
                </p>

                <p class="text-sm">
                    Stok: {{ $barang->qty ?? '-' }}
                    {{ $barang->satuan ?? '' }}
                </p>

                <p class="text-green-600 font-semibold">
                    Rp {{ number_format($barang->harga_jual,0,',','.') }}
                </p>

                {{-- Form tambah keranjang --}}
                <form action="{{ route('cart.add') }}"
                      method="POST"
                      class="mt-auto">

                    @csrf

                    <input type="hidden"
                           name="kode"
                           value="{{ $barang->kode }}">

                    <input type="hidden"
                           name="qty"
                           value="1">

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg mt-3 hover:bg-blue-700 transition">

                        + Keranjang

                    </button>

                </form>

            </div>

            @endforeach

        </div>
    </div>

    {{-- Sidebar Keranjang --}}
<div class="w-96 bg-white border-l p-6 flex flex-col"
     x-data="{ selected: [] }">

    <h2 class="text-2xl font-bold mb-4">Keranjang</h2>

    <div class="flex flex-col gap-4 overflow-y-auto">
        @forelse($cartItems as $item)
        <div class="border rounded-2xl p-3 shadow-sm flex gap-3">

            {{-- Checkbox --}}
            {{-- <input type="checkbox"
                   value="{{ $item->id }}"
                   x-model="selected"> --}}

            {{-- Gambar --}}
            <div class="w-20 h-20 flex-shrink-0">
                @if($item->barang->image)
                    <img src="{{ asset('storage/'.$item->barang->image) }}"
                         class="w-full h-full object-cover rounded-xl">
                @else
                    <div class="w-full h-full bg-gray-200 rounded-xl"></div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1">
                <h3 class="font-semibold text-lg">
                    {{ $item->barang->nama_produk }}
                </h3>
                <p class="text-sm text-gray-500">{{ $item->barang->kode }}</p>

                {{-- Qty Control --}}
                <div class="flex items-center gap-2 mt-2">
                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-8 h-8 bg-gray-200 rounded-lg hover:bg-gray-300">-</button>
                    </form>

                    <span class="font-semibold text-lg">{{ $item->qty }}</span>

                    <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-8 h-8 bg-blue-500 text-white rounded-lg hover:bg-blue-600">+</button>
                    </form>
                </div>

                <p class="text-green-600 font-bold mt-1">
                    Rp {{ number_format($item->barang->harga_jual * $item->qty,0,',','.') }}
                </p>
            </div>
        </div>
        @empty
        <div class="text-center text-gray-400 py-10">Keranjang kosong</div>
        @endforelse
    </div>

    {{-- Footer --}}
    <div class="mt-6 border-t pt-4">
    <form method="POST" action="{{ route('checkout.index') }}">
        @csrf

        {{-- kirim selected item ke controller --}}
        {{-- <template x-for="id in selected" :key="id">
            <input type="hidden" name="selected[]" :value="id">
        </template> --}}

        {{-- <button type="submit"
            :disabled="selected.length === 0"
            :class="selected.length === 0
                ? 'w-full text-white py-3 rounded-xl bg-gray-300 cursor-not-allowed'
                : 'w-full text-white py-3 rounded-xl bg-green-600 hover:bg-green-700'"> --}}
        <button type="submit" class="bg-green-600 w-full text-white rounded-xl h-[50px] transition hover:bg-green-700">
            Bayar
        </button>
    </form>

    {{-- Info tambahan --}}
</div>
</div>


