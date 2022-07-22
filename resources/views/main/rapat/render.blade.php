<div class="card">
    <div class="card-header">
        <div class="card-title">Data Rapat</div>
        <div class="card-options">
            {{-- <button class="btn btn-success btn-print">
                <i class="fa fa-print"></i> Cetak
            </button> --}}
            @can('ketua_sekretaris')
            <button class="btn btn-primary btn-add" style="margin-left: 2px">
                <i class="fa fa-plus"></i> Tambah
            </button>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped" id="tableData">
            <thead>
                <th>No</th>
                <th>Perihal Rapat</th>
                <th>Tanggal Rapat</th>
                <th>Tempat Rapat</th>
                <th>Pimpinan Rapat</th>
                <th>Peserta Rapat</th>
                <th>Notulen</th>
                @can('ketua_sekretaris')
                <th>Aksi</th>
                @endcan
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->perihal_rapat}}</td>
                    <td>{{$data->tanggal_rapat}}</td>
                    <td>{{$data->tempat_rapat}}</td>
                    <td>{{$data->pimpinan_rapat}}</td>
                    <td>
                        <span class="badge {{$data->peserta_rapat == null ? 'bg-primary btn-absen' : 'bg-info detail-absen'}}" style="cursor: pointer" data-id="{{$data->id_rapat}}" data-absen="{{$data->peserta_rapat}}">{{$data->peserta_rapat == null ? 'Absen' : 'Edit/Lihat Absen'}}</span>
                    </td>
                    <td>
                        <span class="badge {{$data->notulen == null ? 'bg-primary' : 'bg-info'}} btn-notulen" style="cursor: pointer" data-id="{{$data->id_rapat}}" data-notulen="{{$data->notulen}}">{{$data->notulen == null ? 'Tambah Notulen' : 'Edit/Lihat Notulen'}}</span>
                    </td>
                    @can('ketua_sekretaris')
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$data->id_rapat}}">
                            <i class="fa fa-edit"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$data->id_data}}">
                            <i class="fa fa-trash"></i>
                        </button> --}}
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNotulen" tabindex="-1" role="dialog" aria-labelledby="Notulen" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notulen</h5>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" name="id_rapat" id="id_rapat">
                    <div class="form-group">
                        <label for="notulen">Notulen</label>
                        <textarea class="form-control" name="notulen" id="notulen" rows="3"></textarea>
                        <div class="invalid-feedback error-notulen"></div>
                    </div>
                </div>
            </div>
            @can('ketua_sekretaris')
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-update-notulen">Simpan</button>
            </div>
            @endcan
        </div>
    </div>
</div>

<!-- Modal detail absen -->
<div class="modal fade" id="modalAbsen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Detail Absen</h5>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="hidden" name="id_rapat" id="id_rapat">
                    <table class="table table-hover table-bordered" id="tableAbsen">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Kehadiran</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" rowspan="2" class="align-middle text-center">
                                    <b>Total</b>
                                </td>
                                <td>Hadir</td>
                                <td id="totalHadir"></td>
                            </tr>
                            <tr>
                                <td>Tidak Hadir</td>
                                <td id="totalTidakHadir"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @can('ketua_sekretaris')
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-update-absen">Ubah</button>
            </div>
            @endcan
        </div>
    </div>
</div>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>