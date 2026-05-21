@vite('resources/css/app.css')
<div class="flex items-center w-full">

    <div class="flex items-center justify-center">
    <div class="flex-1 p-10 h-[830px] w-[550px]">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Produk</h1>

        <div class="bg-blue-100 rounded-xl shadow-lg p-6 max-w-lg">
            <form action="{{ route('barang.update', $allbarang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <input type="text" name="nama_produk" value="{{ $allbarang->nama_produk }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="text" name="kode" value="{{ $allbarang->kode }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="number" name="qty" value="{{ old('qty', $allbarang->qty) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <select name="satuan" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="pcs" {{ $allbarang->satuan == 'pcs' ? 'selected' : '' }}>pcs</option>
                    <option value="kg" {{ $allbarang->satuan == 'kg' ? 'selected' : '' }}>kg</option>
                </select>

                <input type="number" name="modal_awal" value="{{ $allbarang->modal_awal }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="text" name="kategori" value="{{ $allbarang->kategori }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="number" name="harga_jual" value="{{ $allbarang->harga_jual }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="file" name="image" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                @if($allbarang->image)
                    <img src="{{ asset('storage/'.$allbarang->image) }}" alt="{{ $allbarang->nama_produk }}" class="w-24 h-24 object-cover rounded-lg mt-2">
                @endif

                <button type="submit"
                        class="w-full bg-yellow-500 text-white py-2 rounded-lg font-semibold hover:bg-yellow-600 transition">
                    Update
                </button>
            </form>
        </div>
    </div>
    </div>
</div>
