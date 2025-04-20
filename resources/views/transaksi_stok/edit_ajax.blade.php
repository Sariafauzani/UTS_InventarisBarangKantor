@empty($transaksi_stok)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/transaksi_stok') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/transaksi_stok/' . $transaksi_stok->transaksi_stok_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <select name="barang_kode" id="barang_kode" class="form-control" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach($barang as $b)
                                <option value="{{ $b->barang_kode }}" {{ $b->barang_kode == $transaksi_stok->barang_kode ? 'selected' : '' }}>
                                    {{ $b->barang_kode }} - {{ $b->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="masuk" {{ $transaksi_stok->type == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ $transaksi_stok->type == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                        <small id="error-type" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $transaksi_stok->quantity }}" required>
                        <small id="error-quantity" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control">{{ $transaksi_stok->keterangan }}</textarea>
                        <small id="error-keterangan" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    barang_kode: {
                        required: true
                    },
                    type: {
                        required: true
                    },
                    quantity: {
                        required: true,
                        min: 1
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataTransaksiStok.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
