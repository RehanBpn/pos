@vite('resources/css/app.css')
<div class="flex h-full">

    <div class="flex items-center justify-center h-auto w-full bg-gray-50">
       

        <div class="bg-white rounded-xl shadow-lg p-6 max-w-lg h-[600px]">
             <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">➕ Tambah Produk</h1>
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <input type="file" name="image"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="text" name="nama_produk" placeholder="Nama Produk"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="text" name="kode" placeholder="Kode (kosongkan untuk otomatis)"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="number" name="qty" placeholder="Stock"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none" value="{{ old('qty', $barang->qty ?? 1) }}">

                <select name="satuan" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="pcs">pcs</option>
                    <option value="kg">kg</option>
                </select>

                <input type="number" name="modal_awal" placeholder="Modal Awal"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="text" name="kategori" placeholder="Kategori (elektronik, dll)"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">

                <input type="number" name="harga_jual" placeholder="Harga Jual"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">


                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
