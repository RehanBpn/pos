<div class="flex">
    {{-- Sidebar --}}
    <x-sidebar  />

    {{-- Konten utama --}}
    <div class="flex-1 p-8 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Produk</h1>

        <a href="{{ route('barang.create') }}" 
           class="inline-block mb-4 bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           + Tambah Produk
        </a>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Nama Produk</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Satuan</th>
                        <th class="px-4 py-3">Modal Awal</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga Jual</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($allbarangs as $barang)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center">
                            @if($barang->image)
                                <img src="{{ asset('storage/'.$barang->image) }}" 
                                     alt="{{ $barang->nama_produk }}" 
                                     class="w-16 h-16 object-cover rounded-lg mx-auto">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $barang->nama_produk }}</td>
                        <td class="px-4 py-3">{{ $barang->kode }}</td>
                        <td class="px-4 py-3">{{ $barang->qty ?? ''}}</td>
                        <td class="px-4 py-3">{{ $barang->satuan ?? '' }}</td>
                        <td class="px-4 py-3 text-green-600 font-semibold">Rp {{ number_format($barang->modal_awal,0,',','.') }}</td>
                        <td class="px-4 py-3">{{ $barang->kategori }}</td>
                        <td class="px-4 py-3 text-blue-600 font-semibold">Rp {{ number_format($barang->harga_jual,0,',','.') }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('barang.edit', $barang->id) }}" 
                               class="inline-block px-3 py-1 text-sm rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                               Edit
                            </a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-block px-3 py-1 text-sm rounded bg-red-100 text-red-700 hover:bg-red-200"
                                        onclick="return confirm('Yakin hapus produk ini?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
