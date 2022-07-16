<div class="col-12">
    <form id="formEdit">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Pengumuman</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id_pengumuman" id="id_pengumuman" value="{{$data->id_pengumuman}}">
                    <label for="judul">Judul Pengumuman</label>
                    <input type="text" class="form-control judul" name="judul" id="judul" placeholder="masukkan nama kegiatan" value="{{$data->judul}}">
                    <div class="invalid-feedback error-judul"></div>
                </div>
                <div class="form-group">
                    <label for="isi">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" class="form-control isi" rows="5" placeholder="masukkan isi kegiatan">{{$data->isi}}</textarea>
                    <div class="invalid-feedback error-isi"></div>
                </div>
                {{-- </form> --}}
                <div class="form-group">
                    <button class="btn btn-success btn-update pull-right" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('#isi').summernote({
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