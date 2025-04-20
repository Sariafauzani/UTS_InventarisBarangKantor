@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/transaksi_stok/create_ajax') }}')" class="btn btn-sm btn-primary mt-1">Tambah</button> 
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table-bordered table-striped table-hover table-sm table" id="table_transaksi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Transaksi</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <!-- <th>Waktu Transaksi</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = ''){ 
        $('#myModal').load(url, function(){ 
            $('#myModal').modal('show'); 
        }); 
    } 
    $(document).ready(function() {
        $('#table_transaksi').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('transaksi_stok/list') }}",
                dataType: "json",
                type: "POST",
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "barang_kode", className: "", orderable: true, searchable: true },
                { data: "barang_nama", className: "", orderable: true, searchable: true },
                { data: "type", className: "", orderable: true },
                { data: "quantity", className: "text-right", orderable: true },
                { data: "keterangan", className: "", orderable: false },
                //{ data: "created_at", className: "", orderable: true },
                { data: "aksi", className: "text-center", orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
