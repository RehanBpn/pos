@vite('resources/css/app.css')
<div class="flex h-screen w-full">
    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>

    {{-- Main content --}}

<div class="p-6 bg-gray-50 w-full">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    {{-- Statistik --}}
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-blue-500 text-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold">Omzet Hari Ini</h2>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($omzetHariIni,0,',','.') }}</p>
        </div>
        <div class="bg-yellow-400 text-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold">Jumlah Transaksi</h2>
            <p class="text-2xl font-bold mt-2">{{ $jumlahTransaksi }}</p>
        </div>
        <div class="bg-green-400 text-gray-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold">Pendapatan Total</h2>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($pendapatan,0,',','.') }}</p>
        </div>
    </div>

    {{-- Transaksi terbaru --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Transaksi Terbaru</h2>
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Kode</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Metode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiTerbaru as $trx)
                <tr>
                    <td class="p-2">{{ $trx->kode_transaksi }}</td>
                    <td class="p-2">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-2">Rp {{ number_format($trx->total,0,',','.') }}</td>
                    <td class="p-2">{{ ucfirst($trx->payment_type) }}</td>
                </tr>
                
            </tbody>
            @endforeach
        </table>
        <p>{{ $jumlahTransaksi }}</p>
    </div>
</div>

</div>
