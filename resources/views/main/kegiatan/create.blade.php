<div class="col-12">
    <form id="formAdd">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Kegiatan</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama-kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control nama_kegiatan" name="nama_kegiatan" id="nama-kegiatan" placeholder="masukkan nama kegiatan">
                    <div class="invalid-feedback error-nama_kegiatan"></div>
                </div>
                <div class="form-group">
                    <label for="tanggal-kegiatan">Tanggal Kegiatan</label>
                    <input type="date" class="form-control tanggal_kegiatan" name="tanggal_kegiatan" id="tanggal-kegiatan" placeholder="masukkan tanggal kegiatan">
                    <div class="invalid-feedback error-tanggal_kegiatan"></div>
                </div>
                <div class="form-group">
                    <label for="tempat-kegiatan">Tempat Kegiatan</label>
                    <input type="text" class="form-control tempat_kegiatan" name="tempat_kegiatan" id="tempat-kegiatan" placeholder="masukkan tempat kegiatan">
                    <div class="invalid-feedback error-tempat_kegiatan"></div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control keterangan" rows="5" placeholder="masukkan keterangan kegiatan"></textarea>
                    <div class="invalid-feedback error-keterangan"></div>
                </div>
                {{-- </form> --}}
                <div class="form-group">
                    <button class="btn btn-success btn-save pull-right" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('#keterangan').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
        popatmouseup: true,
    });
</script>