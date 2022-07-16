<div class="col-12">
    <form id="formAbsensi">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Absensi</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle text-center">No</th>
                            <th rowspan="2" class="align-middle text-center">Nama Anggota</th>
                            <th colspan="2" class="text-center">Absensi</th>
                        </tr>
                        <tr>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Tidak Hadir</th>
                        </tr>
                    </thead>
                    {{-- <form id="form"> --}}
                        <tbody>
                            <input type="hidden" name="id_rapat" id="id_rapat" value="{{$rapat->id_rapat}}">
                            @foreach($anggota as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-center">
                                        <input type="radio" name="absensi_{{$loop->iteration}}" data-user="{{$item->id_user}}" value="1" class="absensi" {{array_key_exists($item->id_user, $peserta) ? ($peserta[$item->id_user] == 1 ? 'checked' : '') : ''}}>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="absensi_{{$loop->iteration}}" data-user="{{$item->id_user}}" value="0" class="absensi" {{array_key_exists($item->id_user, $peserta) ? ($peserta[$item->id_user] == 0 ? 'checked' : '') : 'checked'}}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    {{-- </form> --}}
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                asas
                            </td>
                            <td>
                                <button class="btn btn-primary pull-right btn-proses-absensi" type="button">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>
</div>