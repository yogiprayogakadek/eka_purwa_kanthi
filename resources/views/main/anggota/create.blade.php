<div class="col-12">
    <form id="formAdd">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Anggota</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control">
                        @foreach ($jabatan as $jabatan)
                        <option value="{{$jabatan->id_jabatan}}">{{$jabatan->nama_jabatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Anggota</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama anggota">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group">
                    <label for="tempat-lahir">Tempat Lahir</label>
                    <input type="text" class="form-control tempat_lahir" name="tempat_lahir" id="tempat-lahir" placeholder="masukkan tempat lahir">
                    <div class="invalid-feedback error-tempat_lahir"></div>
                </div>
                <div class="form-group">
                    <label for="tanggal-lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control tanggal_lahir" name="tanggal_lahir" id="tanggal-lahir" placeholder="masukkan tanggal lahir">
                    <div class="invalid-feedback error-tanggal_lahir"></div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control alamat" name="alamat" id="alamat" placeholder="masukkan alamat"></textarea>
                    <div class="invalid-feedback error-alamat"></div>
                </div>
                <div class="form-group">
                    <label for="jenis-kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis-kelamin" class="form-control jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="1">Laki-Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                    <div class="invalid-feedback error-jenis_kelamin"></div>
                </div>
                <div class="form-group">
                    <label for="no-hp">No. Hp</label>
                    <input type="text" class="form-control no_hp" name="no_hp" id="no-hp" placeholder="masukkan no hp">
                    <div class="invalid-feedback error-no_hp"></div>
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control foto" name="foto" id="foto" placeholder="masukkan foto">
                    <div class="invalid-feedback error-foto"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control email" name="email" id="email" placeholder="masukkan email"> 
                    <div class="invalid-feedback error-email"></div>
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