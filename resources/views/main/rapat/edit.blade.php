<div class="col-12">
    <form id="formEdit">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Rapat</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id_rapat" id="id_rapat" value="{{$data->id_rapat}}">
                    <label for="perihal-rapat">Perihal Rapat</label>
                    <input type="text" class="form-control perihal_rapat" name="perihal_rapat" id="perihal-rapat" placeholder="masukkan perihal rapat" value="{{$data->perihal_rapat}}">
                    <div class="invalid-feedback error-perihal_rapat"></div>
                </div>
                <div class="form-group">
                    <label for="tanggal-rapat">Tanggal Rapat</label>
                    <input type="date" class="form-control tanggal_rapat" name="tanggal_rapat" id="tanggal-rapat" placeholder="masukkan tanggal rapat" value="{{$data->tanggal_rapat}}">
                    <div class="invalid-feedback error-tanggal_rapat"></div>
                </div>
                <div class="form-group">
                    <label for="tempat-rapat">Tempat rapat</label>
                    <input type="text" class="form-control tempat_rapat" name="tempat_rapat" id="tempat-rapat" placeholder="masukkan tempat rapat" value="{{$data->tempat_rapat}}">
                    <div class="invalid-feedback error-tempat_rapat"></div>
                </div>
                <div class="form-group">
                    <label for="pimpinan-rapat">Pimpinan Rapat</label>
                    <input type="text" class="form-control pimpinan_rapat" name="pimpinan_rapat" id="pimpinan-rapat" placeholder="masukkan pimpinan rapat" value="{{$data->pimpinan_rapat}}">
                    <div class="invalid-feedback error-pimpinan_rapat"></div>
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