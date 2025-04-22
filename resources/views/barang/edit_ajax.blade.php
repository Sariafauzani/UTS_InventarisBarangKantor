@empty($barang)
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
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/barang/' . $barang->barang_id . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">- Pilih Kategori -</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->kategori_id }}">
                                    {{ $k->kategori_kode }} - {{ $k->kategori_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kode Barang</label>
                            <small class="text-muted">(Gunakan format: [kode kategori]-[nomor urut], contoh: KTG002-005)</small>
                        <input type="text" name="barang_kode" id="barang_kode" class="form-control" required>
                        <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input value="{{ $barang->barang_nama }}" type="text" name="barang_nama" id="barang_nama" class="form-control" required>
                        <small id="error-barang_nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok_barang" id="stok_barang" class="form-control" required>
                        <small id="error-stok_barang" class="error-text form-text text-danger"></small>
                     </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit" id="unit" class="form-control" required>
                            <option value="">- Pilih Unit -</option>
                            <option value="pcs">PCS</option>
                            <option value="pack">Pack</option>
                            <option value="rim">Rim</option>
                            <option value="rim">ml</option>
                            <option value="rim">Botol</option>
                            <option value="rim">Unit</option>
                        </select>
                        <small id="error-unit" class="error-text form-text text-danger"></small>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
  
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    kategori_kode: { required: true },
                    barang_kode: { required: true, minlength: 3, maxlength: 20 },
                    barang_nama: { required: true, minlength: 3, maxlength: 100 },
                    unit: { required: true }, // cukup required, tidak perlu number
                    stok_barang: { required: true, number: true }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if(response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataBarang.ajax.reload();
                            } else {
                                $('.error-text').text('');
        
                            if (response.msgField) { 
                                $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                        }

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
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty