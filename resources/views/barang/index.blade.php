@extends('layouts.template')
  
@section('content')
<div class="card card-outline card-primary">
    <!-- Menampilkan judul halaman dari variabel $page->title dan tombol Tambah -->
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-sm btn-primary mt-1">Tambah</button> 
        </div>
    </div>
    <div class="card-body">
        <!-- Menampilkan notifikasi sukses atau error dari sesi -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Tabel kosong dengan id="table_barang" yang akan diisi otomatis oleh DataTables (AJAX) -->
        <table class="table-bordered table-striped table-hover table-sm table" id="table_barang">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Unit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- Modal kosong yang akan digunakan untuk menampilkan form tambah/edit/hapus data secara dinamis -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection

<!-- Menyisipkan JavaScript ke dalam section @stack('js') di layout utama -->
@push('css')
@endpush

@push('js')
<script>
    // Mengisi #myModal dengan konten dari URL menggunakan AJAX
    function modalAction(url = '') { 
        $('#myModal').load(url, function () { 
            $('#myModal').modal('show'); // menampilkan modal
        }); 
    }
    // Mengaktifkan plugin DataTables
    $(document).ready(function () {
        var dataBarang = $('#table_barang').DataTable({
            serverSide: true, // data diambil dari server
            ajax: {           // Mengambil data dari barang/list via POST
                url: "{{ url('barang/list') }}",
                type: "POST",
                dataType: "json",
            },
            columns: [ // Menyusun kolom yang ditampilkan berdasarkan response JSON dari controller
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_barang",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "unit",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
