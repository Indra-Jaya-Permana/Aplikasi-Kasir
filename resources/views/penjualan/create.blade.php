@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
    <h1>Tambah Penjualan</h1>
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div>
            <label for="tanggal_penjualan">Tanggal Penjualan:</label>
            <input type="date" name="tanggal_penjualan" required>
        </div>

        <div>
            <label for="pelanggan_id">Pelanggan:</label>
            <select id="pelanggan_id" name="pelanggan_id" onchange="togglePelangganInput()" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}</option>
                @endforeach
                <option value="non-member">Bukan Member</option>
            </select>
        </div>

        <div id="nama_pelanggan_input" style="display:none;">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan">
        </div>

        <div id="produk_section">
            <label for="produk[]">Produk:</label>
            <select name="produk[]" onchange="updateTotal()" required>
                <option value="">Pilih Produk</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>

            <label for="jumlah_produk[]">Jumlah:</label>
            <input type="number" name="jumlah_produk[]" value="1" min="1" oninput="updateTotal()" required>
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
        let totalHarga = 0;

        // Fungsi untuk menampilkan input nama pelanggan jika memilih non-member
        function togglePelangganInput() {
            const pelangganSelect = document.getElementById("pelanggan_id");
            const namaPelangganInput = document.getElementById("nama_pelanggan_input");
            if (pelangganSelect.value == "non-member") {
                namaPelangganInput.style.display = "block";
            } else {
                namaPelangganInput.style.display = "none";
            }
        }

        // Fungsi untuk menambahkan pilihan produk baru
        function addProductField() {
            const produkSection = document.getElementById("produk_section");
            const additionalProducts = document.getElementById("additional_products");
            const newProductField = produkSection.cloneNode(true);
            additionalProducts.appendChild(newProductField);
        }

        // Fungsi untuk menghitung total harga
        function updateTotal() {
            totalHarga = 0;
            const produkSelects = document.querySelectorAll('select[name="produk[]"]');
            const jumlahInputs = document.querySelectorAll('input[name="jumlah_produk[]"]');

            produkSelects.forEach((select, index) => {
                const harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga') || 0);
                const jumlah = parseInt(jumlahInputs[index].value) || 1;
                totalHarga += harga * jumlah;
            });

            document.getElementById("total_harga").value = totalHarga.toFixed(2);
        }
    </script>
@endsection
