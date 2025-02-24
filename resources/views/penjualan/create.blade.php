@extends('layouts.app')

@section('title', 'Tambah Penjualan')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
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
            <input type="date" id="tanggal_penjualan" name="tanggal_penjualan" value="{{ date('Y-m-d') }}" required readonly>
        </div>

        <!-- Input Pelanggan dengan Autocomplete -->
        <div>
            <label for="search_pelanggan">Cari ID/Nama Pelanggan:</label>
            <input type="text" id="search_pelanggan" placeholder="Ketik ID atau Nama Pelanggan">
            <input type="text" id="pelanggan_display" readonly>
            <input type="hidden" id="pelanggan_id" name="pelanggan_id" required>
        </div>

        <!-- Input Produk dengan Autocomplete -->
        <div id="produk_section">
            <label for="search_produk">Cari ID/Nama Produk:</label>
            <input type="text" class="search-produk" placeholder="Ketik ID atau Nama Produk">
            
            <input type="text" class="produk-display" readonly>
            <input type="hidden" name="produk[]" class="produk-id" required>
            <input type="hidden" name="harga[]" class="produk-harga" required>

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

    <!-- jQuery UI untuk autocomplete -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
    $(document).ready(function() {
        let pelangganData = @json($pelanggans);
        let produkData = @json($produks);

        // Autocomplete Pelanggan
        $("#search_pelanggan").autocomplete({
            source: pelangganData.map(p => ({ label: p.id + " - " + p.nama_pelanggan, value: p.id, nama: p.nama_pelanggan })),
            select: function(event, ui) {
                $("#pelanggan_display").val(ui.item.label);
                $("#pelanggan_id").val(ui.item.value);
            }
        });

        // Autocomplete Produk
        $(".search-produk").autocomplete({
            source: produkData.map(p => ({ label: p.id + " - " + p.nama_produk, value: p.id, harga: p.harga })),
            select: function(event, ui) {
                let parentDiv = $(this).closest("#produk_section");
                parentDiv.find(".produk-display").val(ui.item.label);
                parentDiv.find(".produk-id").val(ui.item.value);
                parentDiv.find(".produk-harga").val(ui.item.harga); // Simpan harga produk
                updateTotal();
            }
        });
    });

    function addProductField() {
        const additionalProducts = document.getElementById("additional_products");
        const produkSection = document.getElementById("produk_section").cloneNode(true);
        additionalProducts.appendChild(produkSection);

        // Terapkan autocomplete ke input produk baru
        $(produkSection).find(".search-produk").autocomplete({
            source: @json($produks).map(p => ({ label: p.id + " - " + p.nama_produk, value: p.id, harga: p.harga })),
            select: function(event, ui) {
                let parentDiv = $(this).closest("#produk_section");
                parentDiv.find(".produk-display").val(ui.item.label);
                parentDiv.find(".produk-id").val(ui.item.value);
                parentDiv.find(".produk-harga").val(ui.item.harga); // Simpan harga produk
                updateTotal();
            }
        });
    }

    function updateTotal() {
        let totalHarga = 0;
        const jumlahInputs = document.querySelectorAll('.jumlah-produk');

        jumlahInputs.forEach((input, index) => {
            const harga = parseFloat($(input).closest("#produk_section").find(".produk-harga").val()) || 0; // Ambil harga dari input hidden
            const jumlah = parseInt(input.value) || 1;
            totalHarga += harga * jumlah;
        });

        // Terapkan diskon jika ID pelanggan >= 2
        const pelangganId = parseInt(document.getElementById("pelanggan_id").value) || 0;
        if (pelangganId >= 2) {
            totalHarga *= 0.9; // Diskon 10%
        }

        document.getElementById("total_harga").value = totalHarga.toFixed(2);
    }
    </script>
@endsection