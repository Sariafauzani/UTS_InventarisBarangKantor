@if(empty($transaksi_stok))
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data transaksi tidak ditemukan.
                </div>
                <a href="{{ url('/transaksi_stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Transaksi Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th width="30%">ID Transaksi</th>
                        <td>{{ $transaksi_stok->transaksi_stok_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ $transaksi_stok->barang->barang_kode ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $transaksi_stok->barang->barang_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Barang Masuk/Keluar</th>
                        <td>{{ $transaksi_stok->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Jenis transaksi</th>
                        <td>{{ ucfirst($transaksi_stok->type) }}</td>
                    </tr>
                    <tr>
                        <th>Stok Saat Ini</th>
                        <td>{{ $transaksi_stok->barang->stok_barang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $transaksi_stok->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Input</th>
                        <td>{{ $transaksi_stok->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
            </div>
        </div>
    </div>
@endif
