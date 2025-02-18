@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
    <h1>Tambah Penjualan</h1>

    @if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div>
            <label for="tanggal_penjualan">Tanggal Penjualan:</label>
            <input type="date" id="tanggal_penjualan" name="tanggal_penjualan" required>
        </div>

        <div>
            <label for="pelanggan_id">Pelanggan:</label>
            <select id="pelanggan_id" name="pelanggan_id" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->id }} - {{ $pelanggan->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>

        <div id="produk_section">
            <label for="produk[]">Produk:</label>
            <select name="produk[]" class="produk-select" onchange="updateTotal()" required>
                <option value="">Pilih Produk</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
            
            <label for="jumlah_produk[]">Jumlah:</label>
            <input type="number" name="jumlah_produk[]" value="1" min="1" class="jumlah-produk" oninput="updateTotal()" required>
        </div>

        <div id="additional_products"></div>

        <button type="button" id="add_product" onclick="addProductField()">Tambah Produk</button>

        <div>
            <label for="total_harga">Total Harga:</label>
            <input type="number" name="total_harga" id="total_harga" readonly required>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <script>
    function addProductField() {
        const additionalProducts = document.getElementById("additional_products");
        const produkSection = document.getElementById("produk_section").cloneNode(true);
        additionalProducts.appendChild(produkSection);
    }

    function updateTotal() {
        let totalHarga = 0;
        const produkSelects = document.querySelectorAll('.produk-select');
        const jumlahInputs = document.querySelectorAll('.jumlah-produk');

        produkSelects.forEach((select, index) => {
            const harga = parseFloat(select.options[select.selectedIndex]?.getAttribute('data-harga') || 0);
            const jumlah = parseInt(jumlahInputs[index]?.value) || 1;
            totalHarga += harga * jumlah;
        });

        document.getElementById("total_harga").value = totalHarga.toFixed(2);
    }
    </script>
@endsection