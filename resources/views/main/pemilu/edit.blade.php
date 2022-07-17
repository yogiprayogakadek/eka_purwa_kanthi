<div class="col-12">
    <form id="formEdit">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Pemilu</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id_pemilu" id="id_pemilu" value="{{$data->id_pemilu}}">
                    <label for="tanggal-pemilu">Tanggal Pemilu</label>
                    <input type="date" class="form-control tanggal_pemilu" name="tanggal_pemilu" id="tanggal-pemilu" value="{{$data->tanggal_pemilu}}">
                    <div class="invalid-feedback error-tanggal_pemilu"></div>
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