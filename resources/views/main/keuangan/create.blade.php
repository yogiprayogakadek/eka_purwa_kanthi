<div class="col-12">
    <form id="formAdd">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Keuangan</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="jenis">Jenis Keuangan</label>
                    <select name="jenis" id="jenis" class="form-control jenis">
                        <option value="">Pilih jenis keuangan...</option>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                    <div class="invalid-feedback error-jenis"></div>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control tanggal" name="tanggal" id="tanggal" placeholder="masukkan tanggal">
                    <div class="invalid-feedback error-tanggal"></div>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="text" class="form-control jumlah" name="jumlah" id="jumlah" placeholder="masukkan jumlah">
                    <div class="invalid-feedback error-jumlah"></div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control keterangan" rows="5" placeholder="masukkan keterangan"></textarea>
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