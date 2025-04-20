@empty($transaksi_stok)
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
                <a href="{{ url('/transaksi_stok') }}" class="btn btn-warning">Kembali</a> 
                </div> 
            </div> 
        </div> 
    </div>
@else
    <form action="{{ url('/transaksi_stok/' . $transaksi_stok->transaksi_stok_id . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title">Hapus Data Transaksi Stok</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                </div> 
                <div class="modal-body"> 
                    <div class="alert alert-warning"> 
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5> 
                        Apakah Anda yakin ingin menghapus data transaksi berikut?
                    </div> 
                    <table class="table table-sm table-bordered table-striped"> 
                        <tr>
                            <th class="text-right col-4">ID Transaksi :</th>
                            <td class="col-8">{{ $transaksi_stok->transaksi_stok_id }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Kode Barang :</th>
                            <td>{{ $transaksi_stok->barang->barang_kode ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Nama Barang :</th>
                            <td>{{ $transaksi_stok->barang->barang_nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Jenis Transaksi :</th>
                            <td>{{ ucfirst($transaksi_stok->type) }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Jumlah :</th>
                            <td>{{ $transaksi_stok->quantity }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Keterangan :</th>
                            <td>{{ $transaksi_stok->keterangan ?? '-' }}</td>
                        </tr>
                    </table> 
                </div> 
                <div class="modal-footer"> 
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button> 
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button> 
                </div> 
            </div> 
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $("#form-delete").validate({
                rules: {},
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                $('#table_transaksi').DataTable().ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
