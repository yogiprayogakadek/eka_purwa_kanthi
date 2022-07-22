<div class="card">
    <div class="card-header">
        <div class="card-title">Data Kegiatan</div>
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
                <th>Tanggal Kegiatan</th>
                <th>Tempat Kegiatan</th>
                {{-- <th>Keterangan</th> --}}
                @can('ketua_sekretaris')
                <th>Status</th>
                <th>Aksi</th>
                @endcan
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->tanggal_kegiatan}}</td>
                    <td>{{$data->tempat_kegiatan}}</td>
                    {{-- <td>{{$data->keterangan}}</td> --}}
                    @can('ketua_sekretaris')
                    <td>
                        <select name="status" id="status" class="form-control" data-id="{{$data->id_kegiatan}}" data-status="{{$data->status}}">
                            <option value="1" {{$data->status == '1' ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$data->status == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$data->id_kegiatan}}">
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