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
            <input type="date" id="tanggal_penjualan" name="tanggal_penjualan" value="{{ date('Y-m-d') }}" required disabled>
        </div>

        <!-- Input Pelanggan dengan Autocomplete -->
        <div>
            <label for="search_pelanggan">Cari ID/Nama Pelanggan:</label>
            <input type="text" id="search_pelanggan" placeholder="Ketik ID atau Nama Pelanggan">
            <select id="pelanggan_id" name="pelanggan_id" required onchange="updateTotal()" disabled>
                <option value="" readonly required >Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->id }} - {{ $pelanggan->nama_pelanggan }} </option>
                @endforeach
            </select>
        </div>

        <!-- Input Produk dengan Autocomplete -->
        <div id="produk_section">
            <label for="search_produk">Cari ID/Nama Produk:</label>
            <input type="text" class="search-produk" placeholder="Ketik ID atau Nama Produk">
            
            <select name="produk[]" class="produk-select" onchange="updateTotal()" required disabled>
                <option value="">Pilih Produk</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}"> 
                        {{ $produk->id }} - {{ $produk->nama_produk }}
                    </option>
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
            source: pelangganData.map(p => ({ label: p.id + " - " + p.nama_pelanggan, value: p.id })),
            select: function(event, ui) {
                $("#pelanggan_id").val(ui.item.value).trigger('change');
            }
        });

        // Autocomplete Produk
        $(".search-produk").autocomplete({
            source: produkData.map(p => ({ label: p.id + " - " + p.nama_produk, value: p.id })),
            select: function(event, ui) {
                let selectBox = $(this).siblings(".produk-select");
                selectBox.val(ui.item.value).trigger('change');
            }
        });
    });

    function addProductField() {
        const additionalProducts = document.getElementById("additional_products");
        const produkSection = document.getElementById("produk_section").cloneNode(true);
        additionalProducts.appendChild(produkSection);

        // Terapkan autocomplete ke input produk baru
        $(produkSection).find(".search-produk").autocomplete({
            source: @json($produks).map(p => ({ label: p.id + " - " + p.nama_produk, value: p.id })),
            select: function(event, ui) {
                $(this).siblings(".produk-select").val(ui.item.value).trigger('change');
            }
        });
    }

    function updateTotal() {
        let totalHarga = 0;
        const produkSelects = document.querySelectorAll('.produk-select');
        const jumlahInputs = document.querySelectorAll('.jumlah-produk');
        const pelangganId = parseInt(document.getElementById("pelanggan_id").value) || 0;

        produkSelects.forEach((select, index) => {
            const harga = parseFloat(select.options[select.selectedIndex]?.getAttribute('data-harga') || 0);
            const jumlah = parseInt(jumlahInputs[index]?.value) || 1;
            totalHarga += harga * jumlah;
        });

        // Terapkan diskon jika ID pelanggan >= 2
        if (pelangganId >= 2) {
            totalHarga *= 0.9; // Diskon 10%
        }

        document.getElementById("total_harga").value = totalHarga.toFixed(2);
    }
    </script>
@endsection
