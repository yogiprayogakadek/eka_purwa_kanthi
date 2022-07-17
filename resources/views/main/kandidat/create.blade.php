<div class="col-12">
    <form id="formAdd">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Kandidat</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            @if (count($pemilu) != 0)
            <div class="card-body">
                <div class="form-group">
                    <label for="tanggal-pemilu">Tanggal Pemilu</label>
                        <select name="tanggal_pemilu" id="tanggal-pemilu" class="form-control select2-show-search tanggal_pemilu">
                            <option value="">Pilih tanggal pemilu</option>
                            @foreach ($pemilu as $pemilu)
                            <option value="{{$pemilu->id_pemilu}}">{{$pemilu->tanggal_pemilu}}</option>
                            @endforeach
                        </select>
                    <div class="invalid-feedback error-tanggal_pemilu"></div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Kandidat</label>
                        <select name="nama" id="nama" class="form-control select2-show-search nama">
                            @foreach ($kandidat as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="group-hide">
                    <div class="form-group">
                        <label for="tempat-lahir">Tempat Lahir</label>
                        <input type="text" class="form-control tempat_lahir" name="tempat_lahir" id="tempat-lahir" disabled>
                        <div class="invalid-feedback error-tempat_lahir"></div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal-lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control tanggal_lahir" name="tanggal_lahir" id="tanggal-lahir" disabled>
                        <div class="invalid-feedback error-tanggal_lahir"></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control alamat" name="alamat" id="alamat" disabled></textarea>
                        <div class="invalid-feedback error-alamat"></div>
                    </div>
                    <div class="form-group">
                        <label for="jenis-kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis-kelamin" class="form-control jenis_kelamin" disabled>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="1">Laki-Laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                        <div class="invalid-feedback error-jenis_kelamin"></div>
                    </div>
                    <div class="form-group">
                        <label for="no-hp">No. Hp</label>
                        <input type="text" class="form-control no_hp" name="no_hp" id="no-hp" disabled>
                        <div class="invalid-feedback error-no_hp"></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="visi">Visi</label>
                                <textarea class="form-control visi" name="visi" id="visi" placeholder="masukkan visi kandidat"></textarea>
                                <div class="invalid-feedback error-visi"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="group-misi">
                                <div class="form-group">
                                    <label for="misi">Misi</label>
                                    <textarea class="form-control misi0" name="misi[0]" id="misi0" placeholder="masukkan misi kandidat"></textarea>
                                    <div class="invalid-feedback error-misi0"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-add-misi">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-save pull-right" type="button">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i>
                <strong>Tidak ada Pemilihan Umum yang aktif atau sudah lewat dari tanggal pemilihan</strong>
            </div>
            @endif
        </div>
    </form>
</div>

<script>
    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        // width: '100%'
    });
</script>